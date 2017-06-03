<?php

namespace App\Http\Controllers;

use App\Term;
use App\Date;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function relation(Request $request, $slug)
    {
        $term = Term::where('slug', $slug)->first();

        if($request->parent_id && $term->id != $request->parent_id) {
            $isparent = $term->parents()->where('parent_id', $request->parent_id)->exists();
            if(!$isparent) {
                $parent = Term::find($request->parent_id);
                $term->parents()->attach($parent);    
            }
        }
        if($request->child_id && $term->id != $request->child_id) {
            $ischild = $term->children()->where('child_id', $request->child_id)->exists();
            if(!$ischild) {
                $child = Term::find($request->child_id);
                $term->children()->attach($child);
            }
        }
        return redirect()->action('WebController@timeline', $term->slug);
    }

    public function date(Request $request, $slug)
    {
        $term = Term::where('slug', $slug)->first();
        $date = Date::find($request->id);

        $isterm = $date->terms()->where('term_id', $term->id)->exists();
        if(!$isterm) {
            $date->terms()->attach($term);
        }
        return redirect()->action('WebController@timeline', $term->slug);
    }

    public function post(Request $request, $slug, $id) 
    {
        $term = Term::where('slug', $slug)->first();
        $date = Date::find($id);

        $post = new Post;
        $post->user_id = Auth::id();
        $post->date_id = $date->id;
        $post->name = $request->name;
        $post->description = $request->description;

        $post->save();

        return redirect()->action('WebController@timeline', $term->slug);
    }


    public function index()
    {
        
        $terms = Term::where('user_id', Auth::id())->paginate(20);
        return view('terms.index', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:150',
            'description' => 'required',
        ]);

        $term = new Term;
        $term->user_id = Auth::id();
        $term->name = $request->name;
        $term->description = $request->description;

        $term->save();

        return redirect()->action('TermController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        //
    }
}
