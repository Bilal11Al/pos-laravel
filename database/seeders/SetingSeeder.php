<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //yg atas ini orm
        Settings::create([
            'app_name' => 'Poin Of sales 2025',
            'address' => 'Jln Karet Baru',
            'phone_number' => '08979377325',
        ]);
        //Query Builder
        // DB::table('settings')->create([
        //     'app_name' => 'Poin Of sales 2025',
        //     'address' => 'Jln Karet Baru',
        //     'phone_number' => '08979377325',
        // ]);
    }
}
