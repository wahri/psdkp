<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\InputOption;

class DocumentType extends Model
{
    use HasFactory;

    protected $guarded = "id";

    public static $rules = [
        'name' => 'required',
        'information' => 'nullable',
        'input_format.*' => 'required|min:1',
        'input_format.*.name' => 'required',
        'input_format.*.type' => 'required',
    ];

    public static $messages = [
        'name.required' => 'Nama dokumen tidak boleh kosong!',
        'input_format.required' => 'Tambahkan minimal 1 format input!',
        'input_format.min' => 'Tambahkan minimal 1 format input!',
        'input_format.*.name.required' => 'Nama input tidak boleh kosong!',
        'input_format.*.type.required' => 'Tipe input boleh kosong!',
    ];


    public function input_format()
    {
        return $this->hasMany(InputFormat::class, 'document_type_id');
    }


    public static function saveDocumentType($request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();

            $documentType = new self;
            $documentType->name = $request->name;
            $documentType->information = $request->information;

            if ($documentType->save()) {
                foreach ($request->input_format as $eachInputFormat) {
                    $inputFormat = new InputFormat;
                    $inputFormat->name = $eachInputFormat['name'];
                    $inputFormat->type = $eachInputFormat['type'];
                    $inputFormat->document_type_id = $documentType->id;

                    if ($inputFormat->save() && $inputFormat->type == 'option' && isset($eachInputFormat['option'])) {
                        foreach ($eachInputFormat['option'] as $eachOption) {
                            $inputOption = new InputOption;
                            $inputOption->name = $eachOption;
                            $inputOption->input_format_id = $inputFormat->id;
                            $inputOption->save();
                        }
                    }
                }
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

}
