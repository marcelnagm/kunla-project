<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Str;

class CandidateEnglishLevelSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $levels = [
        'técnico', 'básico', 'intermediário', 'avançado', 'fluente'
    ];
    private $status = [
        'Ativo', 'Inativo', 'Em espera'
    ];

    public function run() {
        //
        foreach ($this->levels as $key) {
//            dd ($val);
            DB::table('candidate_english_level')->insert([
                'level' => $key,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }

        foreach ($this->status as $key) {
//            dd ($val);
            DB::table('candidate_status')->insert([
                'status' => $key,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
        for ($i = 0; $i < 5; $i++) {
            DB::table('candidate_role')->insert([
                'role' => Str::random(20),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
           
        }
         for ($i = 0; $i < 85; $i++) {
                DB::table('candidate')->insert([
                    'role_id' => random_int(1, 4),
                    'title' => Str::random(20),
                    'payment' => random_int(1000, 5000),
                    'CID' => Str::random(20),
                    'state_id' => random_int(1, 27),
                    'city' => Str::random(20),
                    'remote' => random_int(0, 1)
                    , 'move_out' => random_int(0, 1),
                    'description' => Str::random(20),
                    'english_level' => random_int(1, 4),
                    'full_name' => Str::random(40), 
                    'cellphone' => random_int(11111111, 99999999),
                    'email' => Str::random(10).'@'.Str::random(10).".".Str::random(3)
                    , 'cv_url' =>'http://'.Str::random(10).'.'.Str::random(10).".".Str::random(3), 
        'status_id' => random_int(1, 3),
                    
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            }

        DB::table('users')->insert([
            'name' => Str::random(20),
            'api_token' => '1                                                       ',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }

}
