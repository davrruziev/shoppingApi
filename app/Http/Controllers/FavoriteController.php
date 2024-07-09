<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\FavoriteRepositoryInterface;
use App\Services\FavoriteService;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public $favoriteRepository;

    public $favoriteService;

    public function __construct
    (
        FavoriteRepositoryInterface $favoriteRepository,
        FavoriteService             $favoriteService
    )
    {
        $this->favoriteRepository = $favoriteRepository;
        $this->favoriteService = $favoriteService;
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return $this->response($this->favoriteRepository->index());

    }

    public function store(Request $request)
    {
        $this->favoriteService->store($request);
        return $this->success('favorite added successfully');
    }

    public function destroy($favorite_id)
    {
        if ($this->favoriteRepository->destroy($favorite_id)) {

            return $this->success('favorite deleted successfully');
        }
        return $this->error('favorite not found');
    }
}
