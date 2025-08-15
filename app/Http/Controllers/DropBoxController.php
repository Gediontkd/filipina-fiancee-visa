<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\DropBox;
use Storage;
use Auth;

class DropBoxController extends Controller
{
    public function index()
    {
        $files = DropBox::where('user_id', Auth::id())->orderBY('id', 'DESC')->get();
        return view('web.user.dropbox.index', compact('files'));
    }

    public function show($id)
    {
        $file = DropBox::where('id', $id)->first();
        return view('web.user.dropbox.show', compact('file'));
    }

    public function create(Request $request)
    {
        
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $name = $request->file->getClientOriginalName();
            Storage::putFileAs('public/dropbox', $request->file('file'), $name);            
            $request['name'] = $name;
            $request['user_id'] = Auth::id();
            DropBox::create($request->all());
            $status = true;
            $message = 'File has been uploaded!';
            $data = '';
        } else {
            $status = false;
            $message = 'Something went worng please try again!';
            $data = '';            
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function edit(Request $request, $id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy(Request $request, $id)
    {
        Storage::disk('public')->delete('/dropbox/' . $request->name);
        DropBox::where('id', $id)->delete();
        return redirect()->back()->with('success', 'File has been deleted!');   
    }
}
