<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\DepositSetting;
use App\Http\Controllers\Controller;

class DepositSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = DepositSetting::first();
        return view('admin.pages.settings.deposit_settings', compact('setting'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'bonus_percentage' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:0,1'
        ]);

        $setting = DepositSetting::firstOrFail();
        $setting->bonus_percentage = $request->bonus_percentage;
        $setting->status = $request->status;
        $setting->save();

        return redirect()->route('deposit.settings')->with('success', 'Deposit Setting Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
