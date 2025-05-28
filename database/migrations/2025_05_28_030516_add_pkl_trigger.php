<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER pkl_insert_trigger
            AFTER INSERT ON rekrutpkl
            FOR EACH ROW
            BEGIN
                UPDATE siswa
                SET status_pkl = "diterima"
                WHERE id = NEW.id_siswa;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER pkl_delete_trigger
            AFTER DELETE ON rekrutpkl
            FOR EACH ROW
            BEGIN
                UPDATE siswa
                SET status_pkl = "kosong"
                WHERE id = OLD.id_siswa;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS pkl_insert_trigger');
        DB::unprepared('DROP TRIGGER IF EXISTS pkl_delete_trigger');
        
    }
};
