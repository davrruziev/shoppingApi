<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return auth()->user()->favorites()->paginate(10);

    }

    public function store(Request $request)
    {
        auth()->user()->favorites()->attach($request->product_id);
        return response()->json(
            ['message' => 'favorite added']
        );
    }

    public function destroy($favorite_id)
    {
        if (auth()->user()->favorites()->where('product_id', $favorite_id)->exists()) {
            auth()->user()->favorites()->detach($favorite_id);

            return response()->json(['success' => true, 'message' => 'favorite deleted']);
        }

        return response()->json(['success' => false, 'message' => 'product not found']);

    }
}
