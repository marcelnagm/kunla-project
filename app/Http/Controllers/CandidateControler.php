<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Restorant;
use Illuminate\Http\Request;


class CandidateControler extends Controller
{
   
    public function index()
    {
        return Candidate::orderBy('id')->cursorPaginate(2);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $cand = new Candidate();
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
    public function show( Request $request,$id)
    {
        return Candidate::find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
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
    public function destroy($id)
    {
        
        return Candidate::find($id)->delete();
    }

}
