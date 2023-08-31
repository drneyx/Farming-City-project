<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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


    public function delete($id) {
        $items = Gallery::find($id);
        if($items->image != '/storage/itemImages/noimage.jpg')
        {
            if(Gallery::where('id','!=', $items->id)->where('image', $items->image)->exists()){
                // Do not delete this image from the storage
            }else {
                $location = substr($items->image,21);
                Storage::delete('public/itemImages/'.$location);
            }
        }
        $items->delete();
        return ['success' => true, 'message' => 'Image deleted Successfully'];
    }


    public function editImage(Request $request, $id){
        if($request->hasFile('image')){
            // Get file with the extension
            $fileWithExt = $request->file('image')->getClientOriginalName();

            // Get just file name
            $fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

            // Get just Extension
            $extension = $request->file('image')->getClientOriginalExtension();

            // File to store
            $fileNameToStore = $fileName.'.'.$extension;

            $gallery = Gallery::findOrFail($id);
            if(Gallery::where('id','!=', $id)->where('image', $gallery->image)->exists()){
                // Do not delete this image from the storage
            }else {
                $location = substr($gallery->image,20);
                Storage::delete('public/itemImages/'.$location);
            }
            // Upload image
            if($fileNameToStore != $gallery->image){
                $path = $request->file('image')->storeAs('itemImages', $fileNameToStore, 'public');
            }

            
            $gallery->image = '/storage/itemImages/'.$fileNameToStore;
            
            $gallery->save();

            
            return redirect()->back();
        }
        else {
            // Alert::info('Nothing changed');
            return redirect()->back();
        }
    }
}
