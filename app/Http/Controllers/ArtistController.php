<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ArtistRequest;
use App\Models\Artist;
use App\Models\Country;

class ArtistController extends Controller
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
        return view('artists.index', ['artists' => Artist::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artists.create', ['countries' => Country::all(),]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtistRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        Artist::create($data);

        return redirect()->route('artist.index')
                         ->with('ok', __('Artist has been saved !'));
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
    public function edit(Artist $artist)
    {
        $this->authorize('update', $artist);

        return view('artists.edit', [
                        'artist' => $artist,
                        'countries' => Country::all(),
                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtistRequest $request, Artist $artist)
    {
        $this->authorize('update', $artist);

        $artist->update($request->all());

        return redirect()->route('artist.index')
                         ->with('ok', __('Artist has been updated !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();

        return response()->json();
    }
}
