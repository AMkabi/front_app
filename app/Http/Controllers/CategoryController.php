<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // 取得
    public function getCategorys(){
        $categorys = Category::all();
        return $categorys;
    }
    
    // 追加
    public function addCategorys(Request $request){
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        
        $categorys = Category::all();
        return $categorys;
    }
    
    // 更新
    public function updateCategorys(Request $request){
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->save();
        
        $categorys = Category::all();
        return $categorys;
    }
}
