<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $estadosBrasileiros = array(
'AC'=>'Acre',
'AL'=>'Alagoas',
'AP'=>'Amapá',
'AM'=>'Amazonas',
'BA'=>'Bahia',
'CE'=>'Ceará',
'DF'=>'Distrito Federal',
'ES'=>'Espírito Santo',
'GO'=>'Goiás',
'MA'=>'Maranhão',
'MT'=>'Mato Grosso',
'MS'=>'Mato Grosso do Sul',
'MG'=>'Minas Gerais',
'PA'=>'Pará',
'PB'=>'Paraíba',
'PR'=>'Paraná',
'PE'=>'Pernambuco',
'PI'=>'Piauí',
'RJ'=>'Rio de Janeiro',
'RN'=>'Rio Grande do Norte',
'RS'=>'Rio Grande do Sul',
'RO'=>'Rondônia',
'RR'=>'Roraima',
'SC'=>'Santa Catarina',
'SP'=>'São Paulo',
'SE'=>'Sergipe',
'TO'=>'Tocantins'
);
   
    
    public function run()
    {
         
        //
        foreach ($this->estadosBrasileiros as $key => $val){
//            dd ($val);
          DB::table('state')->insert([
            'name' => $val,
            'UF' => $key,
            'created_at' => date("Y-m-d H:i:s"),  
            'updated_at' => date("Y-m-d H:i:s")  
        ]);
        }
    }
}
