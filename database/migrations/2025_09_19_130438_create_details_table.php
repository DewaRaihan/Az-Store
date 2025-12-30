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
        Schema::create('details', function (Blueprint $table) {
            $table->id();

            // ================= IDENTITAS UNIT =================
            $table->string('brand')->nullable(); 
            // Merek HP (contoh: Apple, Samsung, Xiaomi)

            $table->string('storage')->nullable(); 
            // Kapasitas penyimpanan (contoh: 128GB, 256GB)

            $table->string('imei')->nullable(); 
            // Nomor IMEI perangkat (untuk identifikasi resmi unit)

            $table->string('serial_number')->nullable(); 
            // Nomor seri perangkat (opsional, tergantung merek)

            $table->string('color')->nullable(); 
            // Warna fisik HP (contoh: Hitam, Silver, Midnight)

            // ================= KONFIGURASI & STATUS =================
            $table->string('network')->nullable(); 
            // Jenis jaringan (normal, wifi-only, simlock, global, dual-sim)

            $table->string('warranty')->nullable(); 
            // Status garansi (resmi, distributor, toko, internasional, tidak ada)

            // ================= KONDISI FISIK =================
            $table->string('display')->nullable(); 
            // Kondisi layar (mulus, baret tipis, retak, pernah ganti LCD)

            $table->string('body')->nullable(); 
            // Kondisi body (mulus, gores ringan, gores sedang, penyok)

            // ================= KONDISI BATERAI =================
            $table->string('battery')->nullable(); 
            // Kondisi baterai secara umum (sangat baik, baik, cukup, perlu ganti)

            $table->string('battery_health')->nullable(); 
            // Persentase kesehatan baterai (contoh: 100%, 95-99%, 90-94%)

            // ================= FITUR UTAMA =================
            $table->string('face_id')->nullable(); 
            // Status Face ID (berfungsi / tidak berfungsi)

            $table->string('true_tone')->nullable(); 
            // Status True Tone (aktif / tidak aktif)

            $table->string('finger_print')->nullable(); 
            // Status fingerprint (berfungsi / tidak berfungsi)

            // ================= KAMERA =================
            $table->string('front_camera')->nullable(); 
            // Kondisi kamera depan (normal, berkabut, retak, tidak fokus)

            $table->string('rear_camera')->nullable(); 
            // Kondisi kamera belakang (semua normal, 1 rusak, berkabut, retak)

            // ================= CATATAN TAMBAHAN =================
            $table->text('other')->nullable(); 
            // Catatan tambahan kondisi unit (speaker, mic, tombol, dll)

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
