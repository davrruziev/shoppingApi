<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use Hamcrest\Core\Set;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->response(SettingResource::collection(Setting::all()));
    }

    public function store(StoreSettingRequest $request)
    {
        //
    }

    public function show(Setting $setting)
    {
        //
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
