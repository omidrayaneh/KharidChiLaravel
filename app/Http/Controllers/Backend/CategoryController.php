<?php

namespace App\Http\Controllers\Backend;

use App\AttributeGroup;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id', null)
            ->paginate(10);
        return view('admin.categories.index', compact(['categories']));
    }


    public function create()
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id', null)
            ->get();
        return view('admin.categories.create', compact(['categories']));
    }


    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->parent_id = $request->input('category_parent');
        $category->meta_title = $request->input('meta_title');
        $category->meta_desc = $request->input('meta_desc');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->save();

        Session::flash('categories-session', 'دسته بندی با موفقیت اضافه شد.');
        return redirect('/administrator/categories');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id', null)
            ->get();
        $category = Category::findOrfail($id);
        return view('admin.categories.edit', ['categories' => $categories, 'category' => $category]);

    }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->parent_id = $request->input('category_parent');
        $category->meta_title = $request->input('meta_title');
        $category->meta_desc = $request->input('meta_desc');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->save();

        Session::flash('categories-session', 'دسته بندی با موفقیت ویرایش شد.');
        return redirect('/administrator/categories');
    }

    public function destroy($id)
    {
        $category = Category::with('childrenRecursive')->where('id', $id)->first();
        if (count($category->childrenRecursive) > 0) {
            Session::flash('error', ' دسته بندی ' . $category->name . ' دارای زیر دسته می باشد و حذف آن امکان پذیر نیست.');
            return redirect('/administrator/categories');
        }
        $category->delete();
        Session::flash('categories-error', 'دسته بندی با موفقیت حذف شد.');
        return redirect('/administrator/categories');
    }

    public function indexSetting($id)
    {
        $category = Category::findOrFail($id);
        $attributesGroup = AttributeGroup::all();
        return view('admin.categories.index-setting', compact(['category', 'attributesGroup']));
    }

    public function saveSetting(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->attributesGroup()->sync($request->attributesGroup);
        $category->save();
        return redirect('/administrator/categories');
    }

    public function apiIndex()
    {
        $categories = Category::with('childrenRecursive')
            ->where('parent_id', null)
            ->get();
        $response=[
            'categories'=>$categories
        ];
        return response()->json($response,200);
    }
    public function apiIndexAttribute(Request $request)
    {
        $categories= $request->all();
        $attributeGroup = AttributeGroup::with('attributesValue','categories')
            ->whereHas('categories',function ($q) use ($categories){
                $q->whereIn('categories.id',$categories);
            })->get();
        $response=[
            'attributes'=>$attributeGroup
        ];
        return response()->json($response,200);
    }


}
