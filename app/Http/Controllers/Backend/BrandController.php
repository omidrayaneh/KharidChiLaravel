<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::paginate(10);
        return view('admin.brands.index',compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=>'required|unique:brands',
            'description'=>'required'
        ],[
            'title.required'=>'عنوان برند خالیست',
            'title.unique'=>'این برند قبلا ثبت شده است',
            'description.required'=>'توضیحات برند خالیست'
        ]);
    if($validator->fails()){
        return redirect('/administrator/brands')->withErrors($validator)->withInput();
    }
    else
        $brand =new Brand();
        $brand->title=$request->input('title');
        $brand->description=$request->input('description');
        $brand->photo_id=$request->input('photo_id');
        $brand->save();

        Session::flash('susses', 'برند با موفقیت اضافه شد');

        return redirect('administrator/brands');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand=Brand::with('photo')->whereId($id)->first();
        return view('admin.brands.edit',compact(['brand']));
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
        $validator=Validator::make($request->all(),[
            'title'=>'required|unique:brands,title,'.$id,
            'description'=>'required'
        ],[
            'title.required'=>'عنوان برند خالیست',
            'title.unique'=>'این برند قبلا ثبت شده است',
            'description.required'=>'توضیحات برند خالیست'
        ]);
        if($validator->fails()){
            return redirect('/administrator/brands')->withErrors($validator)->withInput();
        }
        else
            $brand =Brand::findOrFail($id);
        $brand->title=$request->input('title');
        $brand->description=$request->input('description');
        $brand->photo_id=$request->input('photo_id');
        $brand->save();

        Session::flash('susses', 'برند با موفقیت ویرایش شد');

        return redirect('administrator/brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        Session::flash('success', 'برند با موفقیت حذف شد');
        return redirect('/administrator/brands');
    }
}
