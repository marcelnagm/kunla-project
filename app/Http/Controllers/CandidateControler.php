<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateControler extends Controller {

    public function index() {
        return Candidate::orderBy('id')->cursorPaginate(2);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $rules = array(
            'title' => 'required|max:255',
            'role_id' => 'required|max:255',
            'title' => 'required|max:255',
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

//          $messsages = array(
//		'email.required'=>'You cant leave Email field empty',
//		'name.required'=>'You cant leave name field empty',
//                'name.min'=>'The field has to be :min chars long',
//	);

        $data = $this->validate($request, $rules);
//        dd ($data);
//	$validator = Validator::make(Input::all(), $rules,$messsages);


        $cand = new Candidate($data);

        $cand->save();


        return response()->json([
                    'status' => true,
                    'msg' => 'Address successfully added!',
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address) {
        $address->lat = $request->lat;
        $address->lng = $request->lng;

        $address->update();

        return response()->json([
                    'status' => true,
                    'success_url' => redirect()->intended('/cart-checkout')->getTargetUrl(),
                    'msg' => 'Address successfully updated!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *     
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        return Candidate::find($id)->delete();
    }

}
