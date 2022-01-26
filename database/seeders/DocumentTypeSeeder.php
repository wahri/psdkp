<?php

namespace Database\Seeders;

use App\Models\DocumentType;
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
    }
}
