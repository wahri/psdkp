<?php

namespace Database\Seeders;

use App\Models\DocumentArchive;
use App\Models\DocumentArchiveInfo;
use App\Models\InputFormat;
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
        $document->name = "ARSIP LAPORAN GELAR OPERASI DAN JURNAL";
        $document->save();

        $document_archive = new DocumentArchive();
        $document_archive->document_type_id = $document->id;
        $document_archive->room_id = "1";
        $document_archive->locker_id = "1";
        $document_archive->rack_id = "1";
        $document_archive->box_id = "1";
        $document_archive->file = "tes";
        $document_archive->save();

        $format = new InputFormat();
        $format->name = "Nama Dokumen";
        $format->document_type_id = $document->id;
        $format->save();

        $document_archive_info = new DocumentArchiveInfo();
        $document_archive_info->document_archive_id = $document_archive->id;
        $document_archive_info->input_format_id = $format->id;
        $document_archive_info->value = "Laporan Pelaksanaan Operasi KP. HIU MACAN 05, Periode I";
        $document_archive_info->save();

        $format = new InputFormat();
        $format->name = "Tanggal/Bulan";
        $format->document_type_id = $document->id;
        $format->save();

        $document_archive_info = new DocumentArchiveInfo();
        $document_archive_info->document_archive_id = $document_archive->id;
        $document_archive_info->input_format_id = $format->id;
        $document_archive_info->value = "17 - 19 Februari";
        $document_archive_info->save();

        $format = new InputFormat();
        $format->name = "Kapal/Speedboat";
        $format->document_type_id = $document->id;
        $format->save();

        $document_archive_info = new DocumentArchiveInfo();
        $document_archive_info->document_archive_id = $document_archive->id;
        $document_archive_info->input_format_id = $format->id;
        $document_archive_info->value = "Hiu Macan 05";
        $document_archive_info->save();

        $format = new InputFormat();
        $format->name = "Jumlah";
        $format->document_type_id = $document->id;
        $format->save();

        $document_archive_info = new DocumentArchiveInfo();
        $document_archive_info->document_archive_id = $document_archive->id;
        $document_archive_info->input_format_id = $format->id;
        $document_archive_info->value = "2";
        $document_archive_info->save();

        $format = new InputFormat();
        $format->name = "Keterangan";
        $format->document_type_id = $document->id;
        $format->save();

        $document_archive_info = new DocumentArchiveInfo();
        $document_archive_info->document_archive_id = $document_archive->id;
        $document_archive_info->input_format_id = $format->id;
        $document_archive_info->value = "Asli";
        $document_archive_info->save();

        // $option = new InputOption();
        // $option->name = "Asli";
        // $option->input_format_id = $format->id;
        // $option->save();

        // $option = new InputOption();
        // $option->name = "Palsu";
        // $option->input_format_id = $format->id;
        // $option->save();
    }
}
