<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Candidate;
use Illuminate\Http\Request;

class HomeControler extends Controller {

       
    public function index() {
        
        $candidates = Candidate::where('published_at', "!=" , NULL)
                ->where('status_id',1)->orderBy('published_at','desc')->limit(5)->get();;
//                dd($candidates[0]);
        return view('home', array(
            'states' => State::all(),
            'candidates' =>$candidates 
        ));
    }

   
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
        return Candidate::where('gid',$id)->first();
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
        $candidate =Candidate::where('gid',$id)->first();
        $candidate->update($this->validate($request, $this->rules));

        return response()->json([
                    'status' => true,                   
                    'msg' => 'Candidate successfully updated!',
        ]);
    }
    
    public function publish(Request $request, $id) {
        $candidate =Candidate::where('gid',$id)->first();
        $candidate->status_id = 1;
        $candidate->published_at = date("Y-m-d H:i:s");
        $candidate->update();

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

        return $candidate =Candidate::where('gid',$id)->first()->delete();
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
        /**
         * @var $search 
         */
//        $search = new luminate\Database\Eloquent\Builder();
        $search =Candidate::select(); 
        foreach ($this->searchble as $key => $val){            
            if ($request->has($key)){
                if ($val == '='){
                      $search= $search->where($key,$request->input($key));
                }
                if ($val == 'in'){
                      $search= $search->whereIn($key,$request->input($key));
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
//        dd($request->input('order_by'));
        foreach($request->input('order_by')[0] as $order => $type) {
//                      
            $search->orderBy($order,$type);                
             if ($order == 'candidate_role.role'){
                     $search= $search->join('candidate_role', 'candidate.role_id', '=', 'candidate_role.id');
                     $search->orderBy($order,$type);                
                    }
             if ($order == 'state.name'){
                     $search= $search->join('state', 'candidate.state_id', '=', 'state.id');
                     $search->orderBy($order,$type);                
                    }            
        }
//         
//        dd($search->toSql());
        return $search->paginate(10);
    }

}
