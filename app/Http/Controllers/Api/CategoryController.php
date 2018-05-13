<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use App\Transformers\CategoryTransformer;
use App\Model\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();

        return Fractal::includes(['children'])->collection($categories, new  CategoryTransformer); 
        // return response()->json($categories, 200);
    }

    public function show($id){
        $category = Category::find($id);
        return Fractal::includes(['children','articles'])->item($category, new  CategoryTransformer); 
        // return response()->json($category, 200);
    }

    public function store(\App\Http\Requests\Api\Category\StoreCategoryRequest $request){
        $category = new Category;
        $category->name = $request->name;
        $category->slug = str_slug( $request->name );
        $category->parent = $request->get('parent', 0);
        $category->save();

        return Fractal::includes('children')->item($category, new  CategoryTransformer); 
        // return response()->json($category, 201);
    }

    public function update(\App\Http\Requests\Api\Category\UpdateCategoryRequest $request, $id){
        $category = Category::findOrFail($id);
        $category->name = $request->get('name', $category->name);
        $category->slug = $request->has('name') ? str_slug( $request->get('name') ) : $category->slug;
        $category->parent = $request->get('parent', $category->parent);
        $category->update();

        return Fractal::item($category, new  CategoryTransformer); 
        // return response()->json($category, 200);
    }

    public function destroy(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}
