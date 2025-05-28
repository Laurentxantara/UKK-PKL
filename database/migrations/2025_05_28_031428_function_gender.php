<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
            DROP FUNCTION IF EXISTS getGenderName;

            CREATE FUNCTION getGenderName(genderCode VARCHAR(1))
            RETURNS VARCHAR(20)
            DETERMINISTIC
            BEGIN
                DECLARE result VARCHAR(20);

                IF genderCode = 'L' THEN
                    SET result = 'Laki-laki';
                ELSEIF genderCode = 'P' THEN
                    SET result = 'Perempuan';
                ELSE
                    SET result = 'Tidak diketahui';
                END IF;

                RETURN result;
            END;
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS getGenderName;");
    }
};