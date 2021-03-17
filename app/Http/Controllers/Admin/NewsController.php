<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\News;

class NewsController extends Controller
{
    //
    public function add()
    {
        return view('admin.news.create');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, News::$rules);
        
        $news =new News;
        $from = $request->all();
        
        if (isset($from['image'])) {
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
        } else {
            $news->image_path = null;
        }
        unset($from['_token']);
        unset($from['image']);
        
        $news->fill($from);
        $news->save();
        
        return resirect('admin/news/create');
    }
}
