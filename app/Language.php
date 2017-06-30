<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	
	 /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "languages";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    //custom timestamps name
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
