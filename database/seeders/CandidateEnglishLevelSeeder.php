<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateEnglishLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $levels= [
        'técnico', 'básico', 'intermediário', 'avançado', 'fluente'
        
    ];
    
    private $status= [
        'Ativo', 'Inativo', 'Em espera'
        
    ];
    
    
    
    
    public function run()
    {
        //
        foreach ($this->levels as $key ){
//            dd ($val);
          DB::table('candidate_english_level')->insert([
            'level' => $key,
                  'created_at' => date("Y-m-d H:i:s"),  
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        }
        
        foreach ($this->status as $key ){
//            dd ($val);
          DB::table('candidate_status')->insert([
            'status' => $key,
              'created_at' => date("Y-m-d H:i:s"),  
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        }
    }
}
