<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "registrations";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email', 'profile_image','country','state','city','sex','education','language_known'
    ];
    
	//custom timestamps name
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
}
