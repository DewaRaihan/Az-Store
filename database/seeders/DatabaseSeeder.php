<?php

namespace Database\Seeders;

use App\Models\CashFlow;
use App\Models\Customer;
use App\Models\Detail;
use App\Models\MonthlySummary;
use App\Models\Oprasional;
use App\Models\ServiceHp;
use App\Models\User;
use App\Models\Hp;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user utama untuk testing
        $mainUser = User::factory()->create([
            'name' => 'Admin Toko',
            'email' => 'admin@tokohp.com',
            'password' => bcrypt('password')
        ]);

        // Buat user tambahan
        $otherUsers = User::factory(3)->create();
        $allUsers = collect([$mainUser])->merge($otherUsers);


        // Buat HP - sebagian available, sebagian sold
        $availableHps = Hp::factory()->count(15)->available()->create();
        $soldHps = Hp::factory()->count(10)->sold()->create();
        $allHps = $availableHps->merge($soldHps);

        // Transaksi Pembelian (HP masuk - hp_in terisi)
        Transaction::factory()->count(8)->purchase()->create([
            'user_id' => $allUsers->random()->id,
        ]);

        // Transaksi Penjualan (HP keluar - hp_out terisi)
        Transaction::factory()->count(6)->selling()->create([
            'user_id' => $allUsers->random()->id,
        ]);

        // Transaksi Trade-in (kedua HP terisi)
        Transaction::factory()->count(4)->trade()->create([
            'user_id' => $allUsers->random()->id,
        ]);

        // Update status HP berdasarkan transaksi (jika perlu)
        $this->updateHpStatusBasedOnTransactions();

        Customer::factory(10)->create();

        // Buat detail dan HP (HP terhubung ke detail)
        Detail::factory(10)->create();

        // Buat data service HP (relasi ke HP dan user)
        ServiceHp::factory(10)->create();

        // Buat data operasional toko
        Oprasional::factory(10)->create();

        // Buat catatan arus kas (cashflow)
        CashFlow::factory(10)->create();

        // Buat rekap bulanan
        MonthlySummary::factory(12)->create();

        $this->command->info('🎉 Dummy data berhasil dibuat!');
    }

    /**
     * Update status HP berdasarkan transaksi
     */
    private function updateHpStatusBasedOnTransactions()
    {
        // HP yang ada di hp_out transaksi selling dianggap sold
        $soldHpIds = Transaction::where('type_trans', 'selling')
            ->whereNotNull('hp_out')
            ->pluck('hp_out')
            ->unique();

        Hp::whereIn('id', $soldHpIds)->update(['status' => 'sold']);

        // HP yang ada di hp_in transaksi purchase/trade dianggap available
        $availableHpIds = Transaction::whereIn('type_trans', ['purchase', 'trade'])
            ->whereNotNull('hp_in')
            ->pluck('hp_in')
            ->unique();

        Hp::whereIn('id', $availableHpIds)->update(['status' => 'available']);
    }
}