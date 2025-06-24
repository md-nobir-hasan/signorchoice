<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use Stringable;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:Show Videos']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $n['data'] = Video::orderBy('serial', 'desc')->paginate(10);
        $n['count'] = Video::get();
        return view('backend.video.index', $n);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ccan('Create Videos');
        $n['serial'] = count(Video::all()) + 1;
        return view('backend.video.create', $n);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        $this->ccan('Create Videos');

        $data = $request->validated();

        if ($data['type'] == 'youtube') {
            $data['url'] = str()->after($data['url'], 'v=');
        }

        Video::create($data);
        return redirect()->route('video.index')->with('success', "$request->name is created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $Video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $Video)
    {
        $this->ccan('Edit Videos');

        $n['datum'] = $Video;
        return view('backend.video.edit', $n);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoRequest $request, Video $Video)
    {
        $this->ccan('Edit Videos');

        $data = $request->validated();
        if ($data['type'] == 'youtube') {
            $data['url'] = str()->after($data['url'], 'v=');
        }

        $Video->update($data);
        return redirect()->route('video.index')->with('success', "$request->name is Update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $Video)
    {
        $this->ccan('Delete Videos');

        $status = $Video->delete();

        if ($status) {
            request()->session()->flash('success', 'Video successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting Videos');
        }
        return back();
    }
}
