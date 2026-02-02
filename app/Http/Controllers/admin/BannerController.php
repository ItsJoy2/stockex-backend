<?php

namespace App\Http\Controllers\admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Banner::query();

        if ($request->filter === 'active') {
            $query->where('status', 1);
        }

        if ($request->filter === 'inactive') {
            $query->where('status', 0);
        }

        $banners = $query->latest()->paginate(10);

        return view('admin.pages.banner.index', compact('banners'));
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
    // public function store(Request $request)
    // {
    //     $path = $request->file('image')->store('banners', 'public');

    //     Banner::updateOrCreate(
    //         ['page' => 'rank_reward'],
    //         [
    //             'title' => $request->title,
    //             'image' => $path,
    //             'status' => 1
    //         ]
    //     );

    //     return back()->with('success', 'Rank Reward Banner Updated');
    // }


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
    public function edit(Banner $banner)
    {
        return view('admin.pages.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner) // <-- route model binding
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp',
            'status' => 'required|in:0,1'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $banner->image = $path;
        }

        $banner->title  = $request->title;
        $banner->status = $request->status;
        $banner->save();

        return redirect()->route('banners.index')->with('success', 'Banner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
