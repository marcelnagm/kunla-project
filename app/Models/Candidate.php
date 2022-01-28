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

class Candidate extends Model {

    protected $table = 'candidate';
    protected $fillable = [
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

//    public function __construct($param) {
//        foreach ()
//        
//    }
    
    public function __toString() {
        return $this->role;
    }

}
