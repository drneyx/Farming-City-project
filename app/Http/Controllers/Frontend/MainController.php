<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Item;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index($slug) {
        $category = Category::where('slug', $slug)->first();
        $items = Item::where('category_id', $category->id)->with('images')->paginate(9);
        $title = $category->name;
        // return $items;
        return view('frontend.template.list', compact('title', 'items'));
    }

    public function detail($slug) {
        $item = Item::where('slug', $slug)->first();
        return view('frontend.template.detail', compact('item'));
    }

    public function firstImage($id) {
        $gallery = Gallery::where('item_id', $id)->first();

        if ($gallery) {
            return $gallery->image;
        } else {
            return '';
        }
    }

    public function categoryItems($slug) {
        $category = Category::where('slug', $slug)->first();
        $items = Item::where('category_id', $category->id)->with('images')->paginate(9);
        $title = $category->name;

        $url = url()->current();
        if (str_contains($url, 'local-materials')) {
            $nav = "local";
        } else if (str_contains($url, 'mechanical-and-electrical')) {
            $nav = "mechanical";
        }else if (str_contains($url, 'electronic-tools')) {
            $nav = "electronic";
        }else if (str_contains($url, 'vehicle-and-trucks')) {
            $nav = "vehicle";
        }else if (str_contains($url, 'land-movers')) {
            $nav = "land";
        }else if (str_contains($url, 'industrial-materials')) {
            $nav = "industrial";
        }else if (str_contains($url, 'plumbing-materials')) {
            $nav = "plumbing";
        }else if (str_contains($url, 'electrical-materials')) {
            $nav = "electrical";
        }else if (str_contains($url, 'other-services')) {
            $nav = "services";
        }
        return view('layouts.frontend.templates.category_items', compact('items', 'title','nav'));
    }
}
