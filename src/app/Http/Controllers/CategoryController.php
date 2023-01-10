<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
    }
    
    // display all authors
    public function list()
    {
        $items = Category::orderBy('name', 'asc')->get();
        return view(
            'category.list',
            [
                'title' => 'Kategorijas',
                'items' => $items
            ]
        );
    }

    public function create()
    {
        return view(
            'category.form',
            [
                'title' => 'Pievienot autoru',
                'category' => new Category()
            ]
        );
    }


    public function put(Request $request)
    {
        $category = new Category();
        $this->saveCategoryData($category, $request);
        return redirect('/categories');
    }

    public function patch(Category $category, Request $request)
    {
        $this->saveCategoryData($category, $request);
        return redirect('/categories');
    }

    private function saveCategoryData(Category $Category, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $Category->name = $validatedData['name'];
        $Category->save();
    }

    public function update(Category $category)
    {
        return view(
            'category.form',
            [
                'title' => 'Rediģēt autoru',
                'category' => $category
            ]
        );
    }



    public function delete(Category $category)
    {
        $category->delete();
        return redirect('/categories');
    }
}
