<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $categories;
    private $genres;
    private $countries;

    public function __construct(Category $categories, Genre $genres, Country $countries)
    {
        $this->categories = Category::with('movies')->orderBy('id', 'DESC')->where('status', 1)->get();
        $this->genres = Genre::with('movies')->orderBy('id', 'DESC')->where('status', 1)->get();
        $this->countries = Country::with('movies')->orderBy('id', 'DESC')->where('status', 1)->get();
    }
    public function home() {
        $categories = $this->categories;
        $genres = $this->genres;
        $countries = $this->countries;
        return view('pages.home', compact('categories', 'genres', 'countries'));
    }

    public function category($slug) {
        $categories = $this->categories;
        $genres = $this->genres;
        $countries = $this->countries;
        $cate_slug = Category::where('slug', $slug)->first();

        return view('pages.category', compact('categories', 'genres', 'countries', 'cate_slug'));
    }

    public function genre($slug) {
        $categories = $this->categories;
        $genres = $this->genres;
        $countries = $this->countries;
        $genre_slug = Genre::where('slug', $slug)->first();

        return view('pages.genre', compact('categories', 'genres', 'countries', 'genre_slug'));
    }

    public function country($slug) {
        $categories = $this->categories;
        $genres = $this->genres;
        $countries = $this->countries;
        $country_slug = Country::where('slug', $slug)->first();

        return view('pages.country', compact('categories', 'genres', 'countries', 'country_slug'));
    }

    public function movie($slug) {
        $categories = $this->categories;
        $genres = $this->genres;
        $countries = $this->countries;
        $movie = Movie::with('category', 'genre', 'country')->where('slug', $slug)->where('status', 1)->first();

        return view('pages.movie', compact('categories', 'genres', 'countries', 'movie'));
    }

    public function watch() {
        return view('pages.watch');
    }

    public function episode() {
        return view('pages.episode');
    }
}
