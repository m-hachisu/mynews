<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');
    
    public static $rules = array(
      'name' => 'required',
      'gender' => 'required',
      'hobby' => 'required',
      'introduction' => 'required',
    );
    
    // Profile Modelに関連付け
    public function profile_histories()
    {
      return $this->hasMany('App\Models\ProfileHistory');
    }
}
