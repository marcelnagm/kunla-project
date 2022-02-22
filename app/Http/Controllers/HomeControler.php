<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Candidate;
use App\Models\CandidateEnglishLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\CandidateControler;

class HomeControler extends Controller {

    
    private $payment_max=array(
        '2000',
        '3000',
        '4000',
        '5000',
        '6000',
        '7000',
        );
       
    private $candidates;
    
    public function index() {
        
        $candidates = Candidate::where('published_at', "!=" , NULL)
                ->where('status_id',1)->orderBy('published_at','desc')->limit(5)->get();;
//                dd($candidates[0]);
        return view('home', array(
            'states' => State::all(),
            'candidates' =>$candidates,
            'payment_max' => $this->payment_max
        ));
    }
    
    public function index_search(Request $request) {
        
          $result = (new CandidateControler)->search($request);
//          dd ($result);
        
//        dd ($request->input('cursor'));
       
        
       
        $this->candidates  = $result['search']->paginate(10) ;
       
        $city  = $result['search'];
//       dd ($candidates);
//        dd(State::whereIn('id', $candidates->pluck('state_id'))->get());
        $city = $city->
                select('city')->groupBy('city')->get()->toArray() ; 
        
        
        return view('search', array(
            'statesAll' => State::all(),
            'states' => State::whereIn('id', $this->candidates->pluck('state_id'))->get(),
            'city' =>  $city,
            'payment_max' => $this->payment_max,
            'english_levels' => CandidateEnglishLevel::all(),
            'candidates' =>$this->candidates->items(),
            'paginator' => $this->candidates,
            'param' => $result['param']
        ));
    }
    
    public function search_more(Request $request) {
        
           $result = (new CandidateControler)->search($request);
        
        $candidates  = $result['search']->paginate(10) ;
//        dd ($candidates );
        
        return view('desktop.list', array(
            'candidates' =>$candidates->items(),          
        ));
    }
    
    
    public function detail($gid) {
        
        $candidate = Candidate::where('gid',$gid)->first();
        return view('detail', array(            
            'candidate' =>$candidate
        ));
    }

   

}
