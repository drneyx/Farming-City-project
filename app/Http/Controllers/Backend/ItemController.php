<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $categories = Item::all();
            return datatables()->of($categories)
                ->addColumn('action', function ($row) {
                    $html = '<a href="/items/edit/' . $row->id . '" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
                    $html .= '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete">Del</button>';
                    return $html;
                })->toJson();
        }
        return view('backend.items.list');
    }

    public function categories() {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function add(Request $request) {
        $validatedData = $request->validate([
            'images.*' => 'mimes:png,jpeg,jpg,gif, jfif'
        ]);

        $item = new Item; 
        $item->name = $request->name;
        $item->slug = $request->slug;
        $item->description = $request->description;
        $item->category_id = $request->category_id;

        $item->save();

        $saved_item = Item::latest()->first();

        if($request->hasFile('images')) {
            $imageList = [];
            foreach($request->images as $image) {
                // Get file with the extension
                $fileWithExt = $image->getClientOriginalName();

                // Get just file name
                $fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

                // Get just Extension
                $extension = $image->getClientOriginalExtension();

                // File to store
                $fileNameToStore = $fileName.'.'.$extension;
                // Upload image
                if(Gallery::where('image', 'public/storage/itemImages/'.$fileNameToStore)->exists()){
                }
                else{
                    $path = $image->storeAs('itemImages', $fileNameToStore, 'public');
                }
                if ($this->imageCheck('/storage/itemImages/'.$fileNameToStore, $imageList) == 0) {
                    $imageList[] = [
                        'image' => '/storage/itemImages/'.$fileNameToStore,
                        'item_id' => $saved_item->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }
            DB::table('galleries')->insert($imageList);
        }

        return ['success' => true, 'message' => 'Inserted Successfully'];
    }


    public function imageCheck($image, $list) {
        $value = 0;
        foreach ($list as $lst) {
            if (in_array($image, $lst)) {
                $value = 1;
                return $value;
            }
        }
        return $value;
    }


    public function edit($id) {
        $categories = Category::all();
        $item = Item::find($id);

        return  view('backend.items.edit', compact('categories', 'item'));
    }

    public function update(Request $request, $id) {

        $item = Item::find($id);
        $item->name = $request->name;
        $item->slug = $request->slug;
        $item->description = $request->description;
        $item->category_id = $request->category_id;

        $item->save();


        return ['success' => true, 'message' => 'Updated Successfully'];
    }


    public function delete($id) {
        $item = Item::find($id);
        $gallery = Gallery::where('item_id', $item->id);

        
        foreach($gallery as $g) {
            if($g->image != '/storage/itemImages/noimage.jpg')
            {
                if(Gallery::where('id','!=', $g->id)->where('image', $g->image)->exists()){
                    // Do not delete this image from the storage
                }else {
                    $location = substr($g->image,21);
                    Storage::delete('public/itemImages/'.$location);
                }
            }

        }
        $gallery->delete();
        $item->delete();

        return ['success' => true, 'message' => 'Deleted Successfully'];
    }
}
