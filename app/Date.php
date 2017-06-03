<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Date extends Model
{
	use SoftDeletes;
    protected $fillable = ['user_id', 'name', 'start_date', 'rank', 'active'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function posts()
    {
        return $this->hasMany('App\Post');

    }
    public function terms()
    {
        return $this->belongsToMany('App\Term');
    }
}
