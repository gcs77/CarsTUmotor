<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE `vehiculos` MODIFY `hp` INT UNSIGNED NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE `vehiculos` MODIFY `hp` SMALLINT UNSIGNED NOT NULL');
    }
};
