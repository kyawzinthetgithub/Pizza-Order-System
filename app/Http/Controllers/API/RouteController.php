<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function productList()
    {
        $products = Product::get();
        return response()->json($products, 200);
    }

    //get all category list
    public function categoryList()
    {
        $categories = Category::get();
        return response()->json($categories, 200);
    }

    //create category
    public function categoryCreate(Request $request)
    {
        $data = [
            "name" => $request->name,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
        $response = Category::create($data);

        return response()->json($response, 200);
    }

    //create contact
    public function contactCreate(Request $request)
    {
        $data = $this->getContactData($request);
        Contact::create($data);
        $contact = Contact::orderBy('created_at', 'desc')->get();
        return response()->json($contact, 200);
    }

    //delete caregory

    // public function deleteCategory(Request $request)
    // {
    //     $data = Category::where('id', $request)->first();

    //     if (isset($data)) {
    //         Category::where('id', $request)->delete();
    //         return response()->json(['status' => true, 'message' => "delete Success.", 'deleteData' => $data], 200);
    //     }
    //     return response()->json(['status' => false, 'message' => "there is no category .", 'deleteData' => $data], 200);
    // }

    public function deleteCategory($id)
    {
        $data = Category::where('id', $id)->first();

        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => "delete Success.", 'deleteData' => $data], 200);
        }
        return response()->json(['status' => false, 'message' => "there is no category .", 'deleteData' => $data], 200);
    }

    //details with post
    // public function detailCategory(Request $request)
    // {
    //     $data = Category::where('id', $request->category_id)->first();
    //     if (isset($data)) {
    //         return response()->json(['status' => true, 'category' => $data], 200);
    //     }
    //     return response()->json(['status' => false, 'category' => "There is no category ."], 403);
    // }

    //details with get method
    public function detailCategory($id)
    {
        $data = Category::where('id', $id)->first();
        if (isset($data)) {
            return response()->json(['status' => true, 'category' => $data], 200);
        }
        return response()->json(['status' => false, 'category' => "There is no category ."], 500);
    }


    //update category with post method
    public function updateCategory(Request $request)
    {
        $categoryId = $request->category_id;
        $dbSource = Category::where('id', $categoryId)->first();
        if (isset($dbSource)) {
            $data = $this->getCategoryData($request);
            Category::where('id', $categoryId)->update($data);
            $response = Category::where('id', $categoryId)->first();
            return response()->json(['status' => true, 'message' => 'category update success...', 'data' => $response], 200);
        }
        return response()->json(['status' => false, 'message' => 'there is no category for update...'], 500);
    }

    //get contact data
    private function getContactData($request)
    {
        return [
            "name" => $request->name,
            "email" => $request->email,
            "message" => $request->message,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];
    }

    //get category data
    private function getCategoryData($request)
    {
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now()
        ];
    }
}