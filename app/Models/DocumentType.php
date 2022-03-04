<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\InputOption;
use Illuminate\Support\Arr;

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
            $documentType->save();

            foreach ($request->input_format as $eachInputFormat) {
                $inputFormat = new InputFormat;
                $inputFormat->name = $eachInputFormat['name'];
                $inputFormat->type = $eachInputFormat['type'];
                $inputFormat->document_type_id = $documentType->id;
                $inputFormat->save();

                // if ($inputFormat->type == 'option' && isset($eachInputFormat['option'])) {
                //     foreach ($eachInputFormat['option'] as $eachOption) {
                //         $inputOption = new InputOption;
                //         $inputOption->name = $eachOption;
                //         $inputOption->input_format_id = $inputFormat->id;
                //         $inputOption->save();
                //     }
                // }
            }


            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public static function updateDocumentType($request, $id)
    {
        try {

            DB::beginTransaction();
            $documentType = self::with(['input_format', 'input_format.input_option'])->where("id", $id)->first();
            $documentType->name = $request['name'];
            $documentType->information = $request['information'];
            $documentType->save();

            $newInputFormat = Arr::pluck($request["input_format"], "id");
            foreach (InputFormat::where("document_type_id", $id)->get() as $eachInputFormat) {
                if (!isset($eachInputFormat->id))
                    continue;

                //will be deleted
                if (!in_array($eachInputFormat->id, $newInputFormat)) {
                    $eachInputFormat->delete();
                }
            }


            foreach ($request['input_format'] as $eachInputFormat) {
                $inputFormat = Arr::has($eachInputFormat, "id") ?  InputFormat::findOrFail($eachInputFormat["id"]) : new InputFormat;
                $inputFormat->name = $eachInputFormat["name"];
                $inputFormat->type = $eachInputFormat["type"];
                $inputFormat->document_type_id = $documentType->id;
                $inputFormat->save();

                // if (Arr::has($eachInputFormat, "option") && $eachInputFormat["type"] == "option") {

                //     $newOption = Arr::pluck($eachInputFormat['option'], "id");

                //     foreach (InputOption::where("input_format_id", $eachInputFormat["id"])->get() as $eachInputOption) {
                //         if (!isset($eachInputOption->id))
                //             continue;

                //         //will be deleted
                //         if (!in_array($eachInputOption->id, $newOption)) {
                //             $eachInputOption->delete();
                //         }
                //     }

                //     foreach ($eachInputFormat['option'] as $eachOption) {
                //         $inputOption = Arr::has($eachOption, "id") ? InputOption::findOrFail($eachOption["id"]) : new InputOption;
                //         $inputOption->name = $eachOption["name"];
                //         $inputOption->input_format_id = $inputFormat->id;
                //         $inputOption->save();
                //     }
                // }
            }

            DB::commit();
            // dd(DB::commit());
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
