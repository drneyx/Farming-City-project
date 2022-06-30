<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $categories = Category::all();
            return datatables()->of($categories)
                ->addColumn('action', function ($row) {
                    $html = '<a href="#" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
                    $html .= '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete">Del</button>';
                    return $html;
                })->toJson();
        }
        return view('backend.categories.list');
    }

    // public function categories(Request $request) {
    //     if ($request->ajax()) {
    //         $categories = Category::all();
    //         return datatables()->of($categories)
    //             ->addColumn('action', function ($row) {
    //                 $html = '<a href="#" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
    //                 $html .= '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete">Del</button>';
    //                 return $html;
    //             })->toJson();
    //     }

    //     return view('backend.categories.list');
    // }
    public function add(Request $request) {
        $name = $request->name;
        $slug = $request->slug;
        $main_category_id = $request->main_name;

        $category = new Category;
        $category->name = $name;
        $category->slug = $slug;
        $category->main_category_id = $main_category_id;

        $category->save();
        return ['success' => true, 'message' => 'Inserted Successfully'];
    }


    public function update(Request $request, $id) {
        $name = $request->name;
        $slug = $request->slug;
        $main_category_id = $request->main_name;

        $category = Category::find($id);
        $category->name = $name;
        $category->slug = $slug;
        $category->main_category_id = $main_category_id;

        $category->save();
        return ['success' => true, 'message' => 'Updated Successfully'];
    }

    public function delete($id) {

        Category::find($id)->delete();
        return ['success' => true, 'message' => 'Deleted Successfully'];
    }

    public function items($id) {
        $items = Item::where('category_id', $id)->get();
        return response()->json($items);
    }

    public function mainCategories() {
        $maincat = MainCategory::all();
        return response()->json($maincat);
    }
}
