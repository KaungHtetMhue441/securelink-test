<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    
    public function store(Request $request){
        
            $request->validate([
                "post_id" => "required|integer",
                "photos" => "nullable",
                "photos.*" => "file|max:3000|mimes:jpg,png"
            ]);
    
            if($request->hasFile('photos')){
    
                foreach ($request->file('photos') as $photo){
    
                    //store file
                    $newName = uniqid()."_photo.".$photo->extension();
                    $photo->storeAs("public/photo/",$newName);//storage
    
                    //making thumbnail
                    $img = Image::make($photo);
                    //reduce photo size
                    $img->fit(200,200);
                    $img->save("storage/thumbnail/".$newName);//public
    
                    //save in db
                    $photo = new Photo();
                    $photo->name = $newName;
                    $photo->post_id = $request->post_id;
                    $photo->user_id = session()->get('LoggedUser');
                    $photo->save();
    
                }
    
            }
    
            return redirect()->back()->with('status','Post Photo Added');
        
    }
}
