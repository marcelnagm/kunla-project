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

class CandidateEnglishLevel extends Model {
    protected $table = 'candidate_english_level';
    protected $fillable = [
        'level'
    ];
    
//    protected $hidden = [ ‘password’ ];
    
    public function __toString() {
        return $this->level;
    }
    
}
