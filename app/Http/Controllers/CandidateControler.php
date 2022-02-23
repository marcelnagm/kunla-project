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
        'cellphone' => 'required|max:12',
        'email' => 'required|max:255',
        'cv_url' => 'required|max:255',
        'status_id' => 'required|max:1'
    );
    private $searchble = array(
        'title' => '%',
        'role_id' => '%',
        'payment_min' => 'min',
        'payment_max' => 'max',
        'state_id' => 'in',
        'city' => 'in',
        'remote' => 'in',
        'english_level' => 'in'
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
        return Candidate::where('gid', $id)->first();
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
        $candidate = Candidate::where('gid', $id)->first();
        $candidate->update($this->validate($request, $this->rules));

        return response()->json([
                    'status' => true,
                    'msg' => 'Candidate successfully updated!',
        ]);
    }

    public function publish(Request $request, $id) {
        $candidate = Candidate::where('gid', $id)->first();
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

        return $candidate = Candidate::where('gid', $id)->first()->delete();
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


//        dd ($request->all());

        $data = $request->all();
        
        if (isset($data['state_id']) ) {
            if ($data['state_id'] != '') {
                $states[] = $data['state_id'];
                $data['state_id'] = $states;
            }else{
            unset($data['state_id']);
            }
            } 
            $states = array();
            foreach ($data as $d => $val) {
                if (strpos($d, 'state_id_') !== false) {
                    unset($data[$d]);
                    $states[] = str_replace('state_id_', '', $d);
                    $data['state_id'] = $states;
                }
            }
            $citys = array ();
            foreach ($data as $d => $val) {
                if (strpos($d, 'city_') !== false) {
                    unset($data[$d]);
                    $citys[] = str_replace('city_', '', $d);
                    $data['city'] = $citys;
                }
            }
            $english_levl = array ();
            foreach ($data as $d => $val) {
                if (strpos($d, 'english_level_') !== false) {
                    unset($data[$d]);
                    $english_levl[] = str_replace('english_level_', '', $d);
                    $data['english_level'] = $english_levl;
                }
            }
            $remotes = array ();
            foreach ($data as $d => $val) {
                if (strpos($d, 'remote_') !== false) {
                    unset($data[$d]);
                    $remotes[] = str_replace('remote_', '', $d);
                    $data['remote'] = $remotes;
                }
            }
        
//          


//        dd($data);
        $param = array();
        /**
         * @var $search 
         */
//        $search = new luminate\Database\Eloquent\Builder();
        $search = Candidate::select()->where('published_at', "!=", NULL)
                        ->where('status_id', 1)->orderBy('published_at', 'desc');
        foreach ($this->searchble as $key => $val) {

            if (array_key_exists($key, $data)) {

                if ($data[$key] != '') {
                    $param[$key] = $request->input($key);
                    if ($val == '=') {
                        $search = $search->where($key, $request->input($key));
                    }

                    if ($val == 'in') {
//                        dd('in');
                        if (is_array($data[$key])) {
                            $search = $search->whereIn($key, $data[$key]);
//                            dd('in');
                        } else {
//                            dd('not in');
                            $search = $search->where($key, $data[$key]);
                        }
                    }
                    if ($val == '%') {
                        if ($key == 'role_id') {
                            $search = $search->join('candidate_role', 'candidate.role_id', '=', 'candidate_role.id')
                                    ->where('role', 'like', $val . $data[$key] . $val);
                        } else {
                            $search = $search->where($key, 'like', $val . $data[$key] . $val);
                        }
                    }
                    if ($val == 'min' || $val == 'max') {
                        $search = $search->where(str_replace('_' . $val, '', $key),
                                $val == 'min' ? '>=' : '<=',
                                $data[$key]);
                    }
                }
            }
        }
        if ($request->has('order_by')) {
            foreach ($request->input('order_by')[0] as $order => $type) {
//                      
                $search->orderBy($order, $type);
                if ($order == 'candidate_role.role') {
                    $search = $search->join('candidate_role', 'candidate.role_id', '=', 'candidate_role.id');
                    $search->orderBy($order, $type);
                }
                if ($order == 'state.name') {
                    $search = $search->join('state', 'candidate.state_id', '=', 'state.id');
                    $search->orderBy($order, $type);
                }
            }
        }
        if ($request->input('page') != null) {
            $search->skip(10 * $data['page'])->take(10);
        }
//         
//        dd($search->toSql());

        return array(
            'search' => $search,
            'param' => $param
        );
    }

}
