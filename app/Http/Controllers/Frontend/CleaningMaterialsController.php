<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class CleaningMaterialsController extends Controller
{
    public function index() {
        $main_category = MainCategory::where('slug', 'cleaning-materials')->first();
        $categories = Category::where('main_category_id', $main_category->id)->with('items')->paginate(9);

        return view('frontend.templates.list', compact('categories'));
    }

    public function firstImage($id) {
        $gallery = Gallery::where('item_id', $id)->first();

        if ($gallery) {
            return $gallery->image;
        } else {
            return '';
        }
    }
}
