<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Term extends Model
{
	use SoftDeletes;
    use Sluggable;
    protected $fillable = ['user_id', 'name', 'slug', 'description', 'active'];
    protected $dates = ['deleted_at'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function dates()
    {
        return $this->belongsToMany('App\Date');
    }
    public function children(){
        return $this->belongsToMany('App\Term', 'child_parent', 'parent_id', 'child_id');
    }
    public function parents(){
        return $this->belongsToMany('App\Term', 'child_parent', 'child_id', 'parent_id');
    }
}