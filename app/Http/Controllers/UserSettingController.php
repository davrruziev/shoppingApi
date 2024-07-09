<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserSettingResource;
use App\Models\UserSetting;
use App\Http\Requests\StoreUserSettingRequest;
use App\Http\Requests\UpdateUserSettingRequest;
use App\Services\UserSettingService;

class UserSettingController extends Controller
{
    public $userSettingService;
    public function __construct(UserSettingService $userSettingService)
    {
        $this->userSettingService = $userSettingService;
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return $this->response(UserSettingResource::collection(UserSetting::all()));
    }

    public function store(StoreUserSettingRequest $request)
    {
        if (auth()->user()->settings()->where('setting_id', $request->setting_id)->exists()) {
            return $this->error("userSetting already exists");
        }
        $userSetting = $this->userSettingService->store($request);
        return $this->success("userSetting created", $userSetting);
    }

    public function show(UserSetting $userSetting)
    {
        //
    }

    public function update(UpdateUserSettingRequest $request, UserSetting $userSetting)
    {
        $userSetting = $this->userSettingService->update($userSetting, $request);

        return $this->success("userSetting updated", $userSetting);
    }

    public function destroy(UserSetting $userSetting)
    {
        $userSetting->delete();

        return $this->success('UserSetting deleted');
    }
}
