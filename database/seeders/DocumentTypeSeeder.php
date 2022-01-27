<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use App\Models\InputFormat;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create superadmin user
        $document = new DocumentType();
        $document->name = "Daftar Arsip Inaktif";
        $document->information = "Pencipta Arsip (K/L) : Kementerian Kelautan Dan Perikanan";
        $document->save();

        $format = new InputFormat();
        $format->name = "Kode Klasifikasi";
        $format->type = "text";
        $format->document_type_id = $document->id;

        $format = new InputFormat();
        $format->name = "No Item Arsip";
        $format->type = "text";
        $format->document_type_id = $document->id;
    }
}
