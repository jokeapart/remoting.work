<?php

namespace Database\Seeders;

use App\Models\BPO;
use Illuminate\Database\Seeder;

class BPOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        BPO::factory(10)->create();
    }
}
