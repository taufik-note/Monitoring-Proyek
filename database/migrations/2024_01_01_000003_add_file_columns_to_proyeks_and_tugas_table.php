<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Tambahkan kolom file untuk tabel proyeks
        Schema::table('proyeks', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('status');
            $table->string('file_name')->nullable()->after('file_path');
            $table->string('file_type')->nullable()->after('file_name');
            $table->integer('file_size')->nullable()->after('file_type');
        });

        // Tambahkan kolom file untuk tabel tugas
        Schema::table('tugas', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('status');
            $table->string('file_name')->nullable()->after('file_path');
            $table->string('file_type')->nullable()->after('file_name');
            $table->integer('file_size')->nullable()->after('file_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Hapus kolom file dari tabel proyeks
        Schema::table('proyeks', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'file_name', 'file_type', 'file_size']);
        });

        // Hapus kolom file dari tabel tugas
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'file_name', 'file_type', 'file_size']);
        });
    }
};
