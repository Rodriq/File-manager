<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use App\Folder;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\User;



class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        // dd($id);    
        if (!$request->real_name) {
            $real_name = time();
        }
        else {

            $real_name = $request->real_name;
            $folder = Folder::findOrFail($id);
            if ($request->hasFile('file')) {
                if ($request->file('file')->isValid()) {
                    $file = $request->file('file');
                    $ext = $file->extension();
                // $path = $file->path();
                    $folder_id = $id;
                    $folder_name = $folder->folder_name;
                    $parent_folder = $folder->parent_folder.'/'.$folder_name;
                    // dd($parent_folder);
                // $parent_folder = "/public/".$folder_name;
                    $file_name = time()."File".$folder_id.".".$ext;
                    $file->storeAs($parent_folder, $file_name);
                    $path = Storage::url($parent_folder."/".$file_name);
                    $f= $parent_folder."/".$file_name;
                    // dd($f);
                    $uri = preg_replace("/public/", 'storage' ,$f);
                    // dd($uri); 

                    $url = asset($uri);
                // Now Saving to the database

                    File::create(['name'=>$file_name, 'folder_id'=>$folder_id, 'extension'=>$ext, 'url'=>$url, 'path'=>$path, 'real_name'=>$real_name, 'parent_folder'=>$parent_folder]);
                    return redirect()->back();
                }

            }
            else {
                echo 'Please select a file';
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    
    public function saveFolder(Request $request)
    {
        $folder_id = $request->folder_id;
        // dd($folder_id);
        $folder = Folder::findOrFail($folder_id);
        $in_folder_name = $folder->folder_name;
        $parent_folder = $folder->parent_folder.'/'.$in_folder_name;
        $fname = $request->folder_name;
        $owner_id = Auth::id();
        $folder_name = time()."Folder".$owner_id;
        Folder::create(['folder_name'=>$folder_name, 'fname'=>$fname, 'owner_id'=>$owner_id, 'parent_folder'=>$parent_folder ]);

        Storage::makeDirectory($parent_folder.'/'.$folder_name);
        return redirect()->back();
    }


    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }

    public function newFolder(Request $request, $id)
    {
        $folder = Folder::findOrFail($id);
        // $parent_folder = Storage::url(Auth::id()."/".$folder);
        // $new_parent_folder = preg_replace( '/storage/', 'public', $parent_folder);
        $parent_folder = $folder->parent_folder;
        $parent_folder_name = $folder->folder_name;
        $new_parent_folder = $parent_folder.'/'.$parent_folder_name;

        // dd($new_parent_folder);

        $fname = $request->folder_name;
        $owner_id = Auth::id();
        $folder_name = time()."Folder".$owner_id;
        Folder::create(['folder_name'=>$folder_name, 'fname'=>$fname, 'owner_id'=>$owner_id, 'parent_folder'=>$new_parent_folder]);

        Storage::makeDirectory($new_parent_folder.'/'.$folder_name);
        return redirect()->route('folder');
    }
}
