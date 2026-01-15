<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Insérer les statuts prédéfinis
        DB::table('statuses')->insert([
            ['name' => 'New', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Executed', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Planned', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Late', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};