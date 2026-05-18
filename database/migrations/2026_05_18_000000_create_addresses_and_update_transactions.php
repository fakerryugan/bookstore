<?php

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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_penerima');
            $table->string('telepon');
            $table->text('alamat_lengkap');
            $table->string('kota');
            $table->string('kode_pos');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->text('alamat_pengiriman')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('alamat_pengiriman');
        });

        Schema::dropIfExists('addresses');
    }
};
