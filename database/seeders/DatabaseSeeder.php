<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\CandidateEnglishLevelSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             StateSeeder::class,
             CandidateEnglishLevelSeeder::class,
             ]);
//         $this->call('CandidateEnglishLevelSeeder');
    }
}
