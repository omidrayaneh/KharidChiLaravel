<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AttributeGroupController extends Controller
{

    public function index()
    {
        $attributesGroup=AttributeGroup::paginate(10);
        return view('admin.attributes.index',['attributesGroup'=>$attributesGroup]);
    }


    public function create()
    {
        return view('admin.attributes.create');

    }


    public function store(Request $request)
    {
        $attributesGroup=new AttributeGroup();
        $attributesGroup->title=$request->input('title');
        $attributesGroup->type=$request->input('type');
        $attributesGroup->save();

        Session::flash('attributes-session', 'ویژگی جدید با موفقیت اضافه شد');

        return redirect('administrator/attributes-group');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $attributeGroup=AttributeGroup::findOrFail($id);

        return view('admin.attributes.edit',['attributeGroup'=>$attributeGroup]);
    }


    public function update(Request $request, $id)
    {
        $attributesGroup= AttributeGroup::findOrFail($id);
        $attributesGroup->title=$request->input('title');
        $attributesGroup->type=$request->input('type');
        $attributesGroup->save();

        Session::flash('attributes-session', 'ویژگی  با موفقیت بروررسانی شد');

        return redirect('administrator/attributes-group');
    }


    public function destroy($id)
    {
        $attributesGroup=AttributeGroup::findOrFail($id);
        $attributesGroup->delete();
        Session::flash('attributes-delete', 'ویژگی  با موفقیت حذف شد');

        return redirect('administrator/attributes-group');
    }
}
