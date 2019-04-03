<?php

namespace App\Http\Controllers\Backend;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {

    }


    public function upload(Request $request)
    {


        $uploadFile=$request->file('file');

        $filename=time().$uploadFile->getClientOriginalName();
        $original_name=$uploadFile->getClientOriginalName();
        Storage::disk('local')->putFileAs(
            'public/photos',$uploadFile,$filename
        );

        $photo=new Photo();
        $photo->original_name=$original_name;
        $photo->path=$filename;
        $photo->user_id=Auth::user()->id;
        $photo->save();

        return response()->json([
            'photo_id'=>$photo->id
        ]);
    }
    public function store(Request $request){

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
