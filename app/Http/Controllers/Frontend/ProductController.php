<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function getProduct($slug)
    {
        $product=Product::with(['photos','attributeValues','brand','categories'])->whereSlug($slug)->first();
        return view('frontend.products.index',compact(['product']));
    }
}
