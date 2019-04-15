<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use App\AttributeValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AttributeValueController extends Controller
{

    public function index()
    {
        $attributesValue=AttributeValue::with('attributeGroup')-> paginate(10);
        //return $attributesValue;
        return view('admin.attributes-value.index',['attributesValue'=>$attributesValue]);
    }


    public function create()
    {
        $attributesGroup=AttributeGroup::all();
        return view('admin.attributes-value.create',['attributesGroup'=>$attributesGroup]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newValue=new AttributeValue();
        $newValue->title=$request->input('title');
        $newValue->attributeGroup_id=$request->input('attribute_group');
        $newValue->save();

        Session::flash('attributes', 'مقدار ویژگی جدید با موفقیت اضافه شد');

        return redirect('administrator/attributes-value');
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
        $attributeValue=AttributeValue::with('attributesGroup')->whereId($id)->first();
        $attributesGroup=AttributeGroup::all();
        return view('admin.attributes-value.edit',['attributeValue'=>$attributeValue ,'attributesGroup'=>$attributesGroup]);
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
        $updatedValue= AttributeValue::findOrFail($id);
        $updatedValue->title=$request->input('title');
        $updatedValue->attributeGroup_id=$request->input('attribute_group');
        $updatedValue->save();


        Session::flash('attributes', 'مقدار ویژگی  با موفقیت بروررسانی شد');

        return redirect('administrator/attributes-value');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributesvalue=AttributeValue::findOrFail($id);
        $attributesvalue->delete();
        Session::flash('attributes-delete', 'مقدار ویژگی  با موفقیت حذف شد');

        return redirect('administrator/attributes-value');
    }
}
