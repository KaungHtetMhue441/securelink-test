<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Information;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:informations',
            'country' => 'required|min:5|max:12',
            'phone' => 'required|min:5|max:12',
            "photo" => "file|mimes:jpg,png",
        ]);

        $photo = $request->file('photo');
        //store file
        $newName = uniqid() . "_photo." . $photo->extension();
        $post = new Information();
        $post->name = $request->name;
        $post->email = $request->email;
        $post->country = $request->country;
        $post->phone = $request->phone;
        $post->user_id = session('LoggedUser');
        $post->photo = $newName;
        $photo->storeAs("public/photo/", $newName);
        $post->save();
        $info = Information::where('user_id', '=', session('LoggedUser'))->get();
        return redirect()->route('home', [
            'info' => $info
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {

        $data = Information::find($data);
        return view('user.information', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = Information::find($id);
        return view('user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'country' => 'required|min:5|max:12',
            'phone' => 'required|min:5|max:12',
            "photo" => "nullable|file|mimes:jpg,png",
        ]);
        $information = Information::find($id);
        $information->name = $request->name;
        $information->email = $request->email;
        $information->country = $request->country;
        $information->phone = $request->phone;
        if (!empty($request->file('photo'))) {
            $photo = $request->file('photo');
            //store file
            $newName = uniqid() . "_photo." . $photo->extension();
            $photo->storeAs("public/photo/", $newName);
            Storage::delete('public/photo/' . $information->photo);
            $information->photo = $newName;
        }
        $information->save();
        return redirect()->route('home')->with('success', 'Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
    {
        $data = Information::find($id);
        Storage::delete('public/photo/' . $data->photo);
        $data->delete();
        return redirect()->route('home')->with('success', 'Delete Successfully');
    }
}
