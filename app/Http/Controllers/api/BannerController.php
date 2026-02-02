<?php

namespace App\Http\Controllers\api;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(): JsonResponse
{
    $banners = Banner::where('status', 1)->latest()->get()->map(function ($banner) {
        $imageUrl = $banner->image ? url(Storage::url($banner->image)) : null;

        return [
            'id' => $banner->id,
            'page' => $banner->page,
            'title' => $banner->title,
            'image' => $imageUrl,
        ];
    });

    return response()->json([
        'status' => true,
        'data' => $banners
    ]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
