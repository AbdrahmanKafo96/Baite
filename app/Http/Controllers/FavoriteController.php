<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Favorite::where('user_id', Auth::user()->id)->with('services')->get();
        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavoriteRequest $request)
    {
        $user_id = Auth::user()->id;
        // Check if item is already in the favorite list
        $favorite = Favorite::where('user_id',  $user_id)->where('service_id', $request->service_id)->first();

        if (!$favorite) {
            // Add the item to the favorite list
            Favorite::create([
                'user_id' => $user_id,
                'service_id' => $request->service_id,
            ]);

            return response()->json(['message' => 'Item added to favorites']);
        } else {
            return response()->json(['message' => 'Item already in favorites']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        return response()->json($favorite);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        $favorite->delete();

        return response()->json(['message' => 'Item removed from favorites']);
    }
}
