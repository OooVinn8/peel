<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('image')->nullable();   // kolom baru
            $table->dropColumn('description');     // hapus kolom
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->dropColumn('image');
        });
    }
};
 