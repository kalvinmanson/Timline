<?php

namespace App\Http\Controllers;

use App\Term;
use App\Date;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function timeline($slug)
    {
        $term = Term::where('slug', $slug)->first();
        $terms = Term::where('id', '!=', $term->id)->get();
        $dates = Date::whereDoesntHave('terms', function ($query) use ($term) {
            $query->where('term_id', $term->id);
        })->get();
        return view('web.timeline', compact('term', 'terms', 'dates'));
    }
}
