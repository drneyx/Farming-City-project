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
                    $html = '<a href="#" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
                    $html .= '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete">Del</button>';
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

    public function delete($id) {

        News::find($id)->delete();
        return ['success' => true, 'message' => 'Deleted Successfully'];
    }
}
