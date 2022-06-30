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
        $main_category = MainCategory::where('slug', $slug)->first();
        $categories = Category::where('main_category_id', $main_category->id)->with('items')->paginate(9);

        // $url = url()->current();
        // if (str_contains($url, 'local-materials')) {
        //     $title = "Construction Local materials";
        //     $nav = "local";
        // } else if (str_contains($url, 'mechanical-and-electrical')) {
        //     $title = "Mechanical and Electrical Materials";
        //     $nav = "mechanical";
        // }else if (str_contains($url, 'electronic-tools')) {
        //     $title = "Electronic Tools";
        //     $nav = "electronic";
        // }else if (str_contains($url, 'vehicle-and-trucks')) {
        //     $title = "Vehicle and Trucks";
        //     $nav = "vehicle";
        // }else if (str_contains($url, 'land-movers')) {
        //     $title = "Land Movers";
        //     $nav = "land";
        // }else if (str_contains($url, 'industrial-materials')) {
        //     $title = "Construction Industrial Materials";
        //     $nav = "industrial";
        // }else if (str_contains($url, 'plumbing-materials')) {
        //     $title = "Plumbing Materials";
        //     $nav = "plumbing";
        // }else if (str_contains($url, 'electrical-materials')) {
        //     $title = "Electrical Materials";
        //     $nav = "electrical";
        // }else if (str_contains($url, 'other-services')) {
        //     $title = "Other Services";
        //     $nav = "services";
        // }

        return view('frontend.template.list');
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
