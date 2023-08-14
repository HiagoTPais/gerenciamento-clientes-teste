<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_type')->insert([
            ['id' => 1, 'type' => 'Pessoa Física'],
            ['id' => 2, 'type' => 'Pessoa Jurídica']
        ]);
    }
}
