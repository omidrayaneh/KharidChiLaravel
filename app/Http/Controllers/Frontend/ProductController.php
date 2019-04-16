<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function getProduct($slug)
    {
        $product = Product::with(['photos', 'attributeValues.attributeGroup', 'brand', 'categories'])->whereSlug($slug)->first();
        $relatedProduct = Product::with('categories')->whereHas('categories', function ($q) use ($product) {
            $q->whereIn('id', $product->categories);
        })->get();
        return view('frontend.products.index', compact(['product', 'relatedProduct']));
    }

    public function getProductByCategory($id)
    {
        $category = Category::whereId($id)->first();
        return view('frontend.categories.index',compact(['category']));
    }

    public function apiGetProduct($id){
        $products = Product::with('photos')->whereHas('categories', function($q) use($id){
            $q->where('id', $id);
        })->paginate(3);
        $response =[
            'products' => $products
        ];
        return response()->json($response, 200);
    }
    public function apiGetSortedProduct($id,$sort,$paginate)
    {
        $products=Product::with('photos')->whereHas('categories',function ($q) use($id){
            $q->where('id',$id);
        })->orderBy('price',$sort)
            ->paginate($paginate);

        $response=[
            'products'=>$products,
        ];

        return response()->json($response,200);
    }
}
