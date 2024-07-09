<?php
namespace App\Services;

class UserSettingService
{
    public function store($request)
    {
        return auth()->user()->settings()->create([
            'setting_id' => $request->setting_id,
            'value_id' => $request->value_id ?? null,
            'switch' => $request->switch ?? null
        ]);
    }

    public function update($userSetting, $request)
    {
        $userSetting->update([
            'value_id' => $request->value_id ?? null,
            'switch' => $request->switch ?? null,
        ]);
    }
}
