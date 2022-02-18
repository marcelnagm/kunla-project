<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;


/**
 * Description of State
 *
 * @author marcel
 */
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Str;
use App\Models\CandidateRole;
use App\Models\State;

class Candidate extends Model {

    protected $table = 'candidate';
    protected $fillable = [
        'gid',
        'role_id',
        'title', 
        'payment',
        'CID', 'state_id', 'city', 'remote', 'move_out',
        'description', 'tecnical_degree', 'superior_degree', 
        'spec_degree', 'mba_degree', 'master_degree', 'doctor_degree', 
        'english_level', 'full_name', 'cellphone', 'email', 'cv_url', 
        'status_id','published_at'
        
    ];
    
    protected $required = [
        'role_id',
        'title', 
        'payment',
        'CID', 'state_id', 'city', 'remote', 'move_out',
        'description','english_level'
    ];
    
    protected $admin =['full_name', 'cellphone', 'email', 'cv_url', 
        'status_id'];
    
    
//    protected $hidden = [ ‘password’ ];

    public function __construct($param = null) {
     if ($param != null){
     $this->gid = md5(random_int(1,125)*time().Str::random(20));
     $this->status_id = 3;
     parent::__construct($param);   
     }
    }
    
    public function role() {
        return CandidateRole::find($this->role_id);
    }
    
    public function state() {
        return State::find($this->state_id);
    }

    public function check(){
        
    }
    
}
