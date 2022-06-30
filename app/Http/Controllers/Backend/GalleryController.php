<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $gallery = Gallery::with('item')->get();
            return response()->json($gallery);
        }
        return view('backend.gallery.list');
    }

    public function filteredItems($id) {
        $gallery = Gallery::with('item')->where('item_id', $id)->get();
        return response()->json($gallery);
    }
}
