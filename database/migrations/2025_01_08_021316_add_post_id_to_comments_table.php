<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     // Schema::table('comments', function (Blueprint $table) {
    //     //     $table->unsignedBigInteger('post_id')->after('id'); // Menambahkan kolom post_id setelah kolom id
    //     //     $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade'); // Menambahkan foreign key
    //     // });
    // }

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     // Schema::table('comments', function (Blueprint $table) {
    //     //     $table->dropForeign(['post_id']); // Menghapus foreign key
    //     //     $table->dropColumn('post_id');    // Menghapus kolom
    //     // });
    // }
};
