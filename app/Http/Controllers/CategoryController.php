<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function list()
    {
        $categories = Category::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })->orderBy('id', 'desc')
            ->paginate(5);

        $categories->appends(request()->all());

        return view('admin.category.list', compact('categories'));
    }

    // driect category create page
    public function createPage()
    {
        return view('admin.category.create');
    }

    // create category
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    //delete category data
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Category Deleted...']);
    }

    //edit category data
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('category'));
    }

    //update Category data
    public function update(Request $request)
    {
        // dd($request->all());
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id', $request->categoryId)->update($data);
        return redirect()->route('category#list')->with(['updateSuccess' => 'Category Updated !']);
    }



    //category validation check

    private function categoryValidationCheck($request)
    {
        validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name,' . $request->categoryId
        ])->validate();
    }


    //request category data
    private function requestCategoryData($request)
    {
        return [
            'name' => $request->categoryName
        ];
    }

}