<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category) {
        return new CategoryResource($category);
    }

    public function getProductsByCategoryId(Category $category) {
        $products = $category->products()->with('category')->orderBy("id","desc")->paginate(10);
        return ProductResource::collection($products);
    }

    public function index() {
        $categories = Category::orderBy("id","desc")->paginate(10);
        return CategoryResource::collection($categories);
    }
}
