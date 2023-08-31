<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $news = News::all();
            return datatables()->of($news)
                ->addColumn('action', function ($row) {
                    $html = '<a href="/news/edit/' . $row->id . '" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
                    $html .= '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i></button>';
                    $html .= '<button image="'.$row->image.'" data-target="#'.$row->id.'" data-itm="'.$row->id.'" title="click to change image" class="btn btn-secondary btn-xs text-white ml-2 view-img"><i class="fa fa-eye"></i></button> ';
                    return $html;
                })->toJson();
        }
        return view('backend.news.list');
    }

    public function add(Request $request) {
        $validatedData = $request->validate([
            'image' => 'mimes:png,jpeg,jpg,gif, jfif',
            'title' => 'required',
            'description' => 'required',
            'body' => 'required'
        ]);

        $news = new News;
        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->description = $request->description;
        $news->body = $request->body;



        if($request->hasFile('image')) {
            // Get file with the extension
            $fileWithExt = $request->image->getClientOriginalName();

            // Get just file name
            $fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

            // Get just Extension
            $extension = $request->image->getClientOriginalExtension();

            // File to store
            $fileNameToStore = $fileName.'.'.$extension;
            // Upload image
            if(News::where('image', 'public/storage/newsImages/'.$fileNameToStore)->exists()){
            }
            else{
                $path = $request->image->storeAs('newsImages', $fileNameToStore, 'public');
            }

        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $news->image = '/storage/newsImages/'.$fileNameToStore;
        $news->save();

        return ['success' => true, 'message' => 'News Saved Successfully'];
    }

    public function edit($id) {
        $news = News::find($id);

        return view('backend.news.edit', compact('news'));
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'body' => 'required'
        ]);
        $news = News::find($id);
        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->description = $request->description;
        $news->body = $request->body;

        $news->save();


        return ['success' => true, 'message' => 'Updated Successfully'];
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

            $new = News::findOrFail($id);
            if(News::where('id','!=', $id)->where('image', $new->image)->exists()){
                // Do not delete this image from the storage
            }else {
                $location = substr($new->image,20);
                Storage::delete('public/newsImages/'.$location);
            }
            // Upload image
            if($fileNameToStore != $new->image){
                $path = $request->file('image')->storeAs('newsImages', $fileNameToStore, 'public');
            }

            
            $new->image = '/storage/newsImages/'.$fileNameToStore;
            
            $new->save();

            
            return redirect()->back();
        }
        else {
            // Alert::info('Nothing changed');
            return redirect()->back();
        }

    }

    
    public function delete($id) {
        $news = News::find($id);
        if($news->image != '/storage/newsImages/noimage.jpg')
        {
            if(News::where('id','!=', $news->id)->where('image', $news->image)->exists()){
                // Do not delete this image from the storage
            }else {
                $location = substr($news->image,20);
                Storage::delete('public/newsImages/'.$location);
            }
        }
        $news->delete();
        return ['success' => true, 'message' => 'News deleted Successfully'];
    }
}
