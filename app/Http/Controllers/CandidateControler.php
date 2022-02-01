<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateControler extends Controller {

    private $rules = array(
            'title' => 'required|max:255',
            'role_id' => 'required|max:255',
            'payment' => 'required|max:8',
            'CID' => 'required|max:244',
            'state_id' => 'required|max:2',
            'city' => 'required|max:255',
            'remote' => 'required|max:1',
            'move_out' => 'required|max:1',
            'description' => 'required|max:255',
            'english_level' => 'required|max:1',
            'full_name' => 'required|max:255', 
            'cellphone'=> 'required|max:12', 
            'email' => 'required|max:255', 
            'cv_url' => 'required|max:255' ,
            'status_id'=> 'required|max:1'
        );
    
    private $searchble= array(
        'title' => '%',
            'role_id' => '%',
            'payment_min' => 'min',
            'payment_max' => 'max',
            'state_id' => '=',
         'city' => '%',
        'remote' => '='
    );
    
   /**
    *   Retorna um Json com todos os registos
    * @return Json 
    */ 
    public function index() {
        return Candidate::orderBy('id')->cursorPaginate(10);
    }

    /**
     * Armazena um candidato 
     * A validação segue o modelo abaixo
     *  'title' => 'required|max:255',
     *       'role_id' => 'required|max:255',
     *       'payment' => 'required|max:8',
     *       'CID' => 'required|max:244',
     *       'state_id' => 'required|max:2',
     *       'city' => 'required|max:255',
     *       'remote' => 'required|max:1',
     *       'move_out' => 'required|max:1',
     *       'description' => 'required|max:255',
     *       'english_level' => 'required|max:1',
     *       'full_name' => 'required|max:255', 
     *       'cellphone'=> 'required|max:12', 
     *       'email' => 'required|max:255', 
     *       'cv_url' => 'required|max:255' ,
     *       'status_id'=> 'required|max:1'
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response retorna um json notificando que foi criado ou uma mensagem de erro de validação de campo
     */
    public function store(Request $request) {

        
        
//          $messsages = array(
//		'email.required'=>'You cant leave Email field empty',
//		'name.required'=>'You cant leave name field empty',
//                'name.min'=>'The field has to be :min chars long',
//	);

        $data = $this->validate($request, $this->rules);
//        dd ($data);
//	$validator = Validator::make(Input::all(), $rules,$messsages);


        $cand = new Candidate($data);

        $cand->save();


        return response()->json([
                    'status' => true,
                    'msg' => 'Candidadte successfully added!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        return Candidate::find($id);
    }

    /**
     * Atualiza o candidato informado {id} segue a regra de validação
     * baseado no campo(s) informado(s)
     *  'title' => 'required|max:255',
     *        'role_id' => 'required|max:255',
     *       'payment' => 'required|max:8',
     *       'CID' => 'required|max:244',
     *       'state_id' => 'required|max:2',
     *       'city' => 'required|max:255',
     *       'remote' => 'required|max:1',
     *       'move_out' => 'required|max:1',
     *       'description' => 'required|max:255',
     *       'english_level' => 'required|max:1',
     *       'full_name' => 'required|max:255', 
     *       'cellphone'=> 'required|max:12', 
     *       'email' => 'required|max:255', 
     *       'cv_url' => 'required|max:255' ,
     *       'status_id'=> 'required|max:1'
     *
     * @param  \Illuminate\Http\Request  $request     
     * @return \Illuminate\Http\Response Json com mensagem de sucesso ou mensagem de erro de validação
     */
    public function update(Request $request, $id) {
        $candidate =Candidate::find($id);
        $candidate->update($this->validate($request, $this->rules));

        return response()->json([
                    'status' => true,                   
                    'msg' => 'Candidate successfully updated!',
        ]);
    }

    /**
     * Remove o candidato especificado
     *     
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        return Candidate::find($id)->delete();
    }
    

    /**
     * Retorna os candidatos pelos parâmetros informados
     * Operado utilizado por campo
     *   'title' => '%',
     *       'role_id' => '%',
     *       'payment_min' => 'min',
     *       'payment_max' => 'max',
     *       'state_id' => '=',
     *    'city' => '%',
     *   'remote' => '='   
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        
        $param = array ();
        $search =Candidate::select(); 
        foreach ($this->searchble as $key => $val){            
            if ($request->has($key)){
                if ($val == '='){
                      $search= $search->where($key,$request->input($key));
                }
                if ($val == '%'){
                    if ($key == 'role_id'){
                     $search= $search->join('candidate_role', 'candidate.role_id', '=', 'candidate_role.id')
                             ->where('role','like',$val.$request->input($key).$val);   
                    } else{
                        $search= $search->where($key,'like',$val.$request->input($key).$val);
                    }                      
                }
                if ($val == 'min' || $val=='max'){                    
                      $search= $search->where(str_replace('_'.$val, '', $key),
                              $val  == 'min' ? '>=' : '<=',
                              $request->input($key));
               }                              
            }
        }
        
        
        return $search->paginate(10);
    }

}
