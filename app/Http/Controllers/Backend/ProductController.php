<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::paginate(10);
        return view('admin.products.index',compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::with('childrenRecursive')->where('parent_id',null)->get();
        $brands=Brand::all();
        return view('admin.products.create',compact(['brands']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function generateSku()
    {
        $number=mt_rand(1000,99999);
        if ($this->checkSku($number)){
            return $this->generateSku();
        }
        return (string)$number;
    }

    public function checkSku($number)
    {
        return Product::where('sku',$number)->exists();
    }


    function makeSlug($string)
    {
        $string = strtolower($string);
        $string = str_replace(['؟', '?'], '', $string);
        return preg_replace('/\s+/u', '-', trim($string));
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function store(Request $request)
    {

        //return $request->all();
        $newProduct = new Product();
        $newProduct->title = $request->title;
        $newProduct->sku = $this->generateSKU();
        $newProduct->slug = $this->makeSlug($request->slug);
        $newProduct->status = $request->status;
        $newProduct->price = $request->price;
        $newProduct->discount_price = $request->discount_price;
        $newProduct->short_description = $request->short_description;
        $newProduct->long_description = $request->long_description;
        $newProduct->brand_id = $request->brand;
        $newProduct->meta_desc = $request->meta_desc;
        $newProduct->meta_title = $request->meta_title;
        $newProduct->meta_keywords = $request->meta_keywords;
        $newProduct->user_id = Auth::user()->id;

        $newProduct->save();

        $attributes = explode(',', $request->input('attributes')[0]);
        $photos = explode(',', $request->input('photo_id')[0]);

        $newProduct->categories()->sync($request->categories);
        $newProduct->attributeValues()->sync($attributes);
        $newProduct->photos()->sync($photos);

        Session::flash('success', 'محصول با موفقیت اضافه شد.');
        return redirect('/administrator/products');


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
