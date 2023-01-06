<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use League\Flysystem\File;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::with('category', 'genre', 'country')->orderBy('id', 'DESC')->get();
        return view('admin.movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movies = Movie::with('category', 'genre', 'country')->orderBy('id', 'DESC')->get();
        $categories = Category::pluck('title', 'id');
        $genres = Genre::pluck('title', 'id');
        $countries = Country::pluck('title', 'id');
        return view('admin.movies.form', compact('movies', 'genres', 'countries', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];

        $image = $request->file('image');

        $path = 'uploads/movies/';

        if($image) {
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0, 9999).".".$image->getClientOriginalExtension();
            $image->move($path, $new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movies = Movie::with('category', 'genre', 'country')->orderBy('id', 'DESC')->get();
        $movie = Movie::with('category', 'genre', 'country')->find($id);
        $categories = Category::pluck('title', 'id');
        $genres = Genre::pluck('title', 'id');
        $countries = Country::pluck('title', 'id');
        return view('admin.movies.form', compact('movies', 'movie', 'genres', 'countries', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];

        $image = $request->file('image');

        $path = 'uploads/movies/';

        if($image) {
            if(!empty($movie->image) && file_exists($path.$movie->image)) {
                unlink($path.$movie->image);
            }
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0, 9999).".".$image->getClientOriginalExtension();
            $image->move($path, $new_image);
            $movie->image = $new_image;
        }
        $movie->save();
        return redirect()->route('movies.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $path = 'uploads/movies/'.$movie->image;
        if(!empty($movie->image) && file_exists($path)) {
            unlink($path);
        }
        $movie->delete();
        return redirect()->back();
    }
}
