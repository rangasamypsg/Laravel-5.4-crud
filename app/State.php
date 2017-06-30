<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "states";
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
