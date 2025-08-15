<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resource;

class ResourceController extends Controller
{
    public function index()
    {
        $pages = Resource::all();
        return view('web.resource.index', compact('pages'));
    }

    public function show(Request $request, $page)
    {
        return view('web.resource.'.$page.'');
    }

    public function search(Request $request)
    {
        if (isset($request->search)) {
            $getPages = Resource::where('name', 'like', '%' . $request->search . '%')
                ->get();
        } else {
            $getPages = Resource::get();
        }
        $pages = '';
        foreach ($getPages as $page) {          
            $pages .= '<li class="col-md-6"><a href="'.$page->slug.'"><img src="'.asset('assets/img/document2.png').'">'.$page->name.'</a></li>   ';
        }
        return response()->json([
            'status' => true,
            'pages' => $pages
        ]);
;    }
}
