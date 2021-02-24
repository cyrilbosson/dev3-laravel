<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\MovieRequest;
use App\Models\Artist;
use App\Models\Country;
use App\Models\Movie;
use App\Notifications\MovieCreated;

class MovieController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('ajax')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = optional(Auth()->user())->unreadNotifications;

        if ($notifications && $notifications->count()) {
            foreach ($notifications as $notification) {
                $notification->markAsRead();
            }
        }

        return view('movies.index', [
                    'movies' => Movie::paginate(10),
                    'notifications' => $notifications,
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create', [
                        'countries' => Country::all(),
                        'artists' => Artist::all(),
                    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        Movie::create($request->all());

        return redirect()->route('movie.index')
                         ->with('ok', __('Movie has been saved !'));
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
    public function edit(Movie $movie)
    {
        return view('movies.edit', [
                        'movie' => $movie,
                        'countries' => Country::all(),
                        'artists' => Artist::all(),
                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $movie->update($request->all());

        // Manage poster
        $poster = $request->file( 'poster' );

        if ($poster) {
            $filename = 'poster_' . $movie->id . '.' . $poster->guessClientExtension();
            Image::make( $poster )->fit( 180, 240 )
                                  ->save( public_path( '/uploads/posters/' . $filename ) );
        }

        Auth::user()->notify(new MovieCreated($movie));

        return redirect()->route('movie.index')
                         ->with('ok', __('Movie has been updated !'));
    }

    /**
     * Manage actors
     */
    public function actors(Movie $movie)
    {
        return view('movies.actors', [
            'movie' => $movie,
            'artists' => Artist::all(),
        ]);
    }

    /**
     * Attach an actor to a movie
     */
    public function attach(Request $request, Movie $movie)
    {
        $artist = Artist::findOrFail($request->actor_id);

        $movie->actors()->attach($artist, ['role_name' => $request->role_name]);

        return redirect()->route('movie.actors', $movie->id)
                         ->with('ok', __(':name has been attached to movie ":movie"', [
                                            'name' => $artist->firstname . ' ' . $artist->name,
                                            'movie' => $movie->title
                                ]));
    }

    /**
     * Detach an actor from a movie
     */
    public function detach(Request $request, Movie $movie, Artist $artist)
    {
        if ($artist) {
            $movie->actors()->detach($artist);
        }

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json();
    }
}
