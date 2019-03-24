<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\User;
use App\File;

class FolderController extends Controller
{
    //
	public function index()
	{
		
		// $folders = Folder::all();
		$folders = Auth::user()->folders()->where('parent_folder', '/public/'.Auth::id())->get();
		// dd($fol);
		return view('folder',compact('folders'));
		// return response('Hello World')->header('Content-Type', 'text/elephant');
	}

	public function create()
	{
		return view('create');
	}
	public function save(Request $request)
	{
		// $folder_id = $request->folder_id;
		// dd($folder_id);
		// $folder = Folder::findOrFail($folder_id);
		// $in_folder_name = $folder->folder_name;
		$parent_folder = '/public/'.Auth::id();
		$fname = $request->folder_name;
		$owner_id = Auth::id();
		$folder_name = time()."Folder".$owner_id;
		Folder::create(['folder_name'=>$folder_name, 'fname'=>$fname, 'owner_id'=>$owner_id, 'parent_folder'=>$parent_folder ]);

		Storage::makeDirectory($parent_folder.'/'.$folder_name);
		return redirect()->back();
		// return redirect()->back();
		
	}
	public function delete(Request $request, $id)
	{
		$folder = Folder::findOrFail($id);
		$folder_name = $folder->folder_name;
		// dd($folder_name);
		$parent_folder = $folder->parent_folder;
		Storage::deleteDirectory($parent_folder.'/'.$folder_name);
		
		Folder::findOrFail($id)->delete();

		return redirect()->back();
	}
		/**
		 * 
		 * Renaming a folder
		 */

		public function rename(Request $request,$id)
		{
			$folder_name = Folder::findOrFail($id);
			// dd($folder_name);
			return view('rename',compact('folder_name'));
		}
		public function update(Request $request, $id)
		{
			$fol = Folder::findOrFail($id);
			$oldFolderName = $fol->fname;
			// dd($oldFolderName);
			$newFolderName = $request->folder_name;
			$fol->fname = $newFolderName;
			$fol->update();
			// Storage::move($oldFolderName, $newFolderName);
			return redirect()->route('folder');
		}
		public function view(Request $request,$id)
		{

			$folder = Folder::findOrFail($id);
			$id = $folder->id;
			$folder_name = $folder->folder_name;
			$parent_folder = $folder->parent_folder;
			$folders = Folder::where('parent_folder', $parent_folder."/".$folder_name)->get();
			// dd($folders);
			$directories  = Storage::allDirectories($parent_folder."/".$folder_name);
			$filesd = Storage::files("/public/".Auth::id()."/"	.$folder_name);
			// dd($directories, $filesd);
			$filesd = preg_replace('/public/', 'storage', $filesd);
			$files = $folder->files;
			// $path = $files->first()->path;
			// dd($path);
			// $nww = preg_replace('/public',);
			$f = ['images' => [], 'documents' => [], 'others' => []];
			foreach ($files as $file) {
				if (in_array($file->extension, ['png', 'jpeg', 'jpg', 'gif', 'svg'])) {
					array_push($f['images'], $file);
				}
				elseif (in_array($file->extension, ['pdf', 'doc', 'docx', 'pptx', 'excl','xlsx'])) {
					$f['documents'][] = $file;
				}
				elseif (in_array($file->extension, ['mp4','avi','mov','3gp','flv','wmv'])) {
					$f['videos'][] = $file;
				}
				else {
					$f['others'][] = $file;
				}
			}

			// $f = [];
			// $f['images'] = [];
			// $f['documents'] = [];
			// foreach ($files as $file) {
			// 	if (in_array($file->extension, ['png', 'jpeg', 'jpg', 'gif', 'svg'])) {
			// 		if (!isset($f['images']))
			// 			$f['images'] = array();
			// 		array_push($f['images'], $file);
			// 	}
			// 	elseif (in_array($file->extension, ['pdf', 'doc', 'docx', 'pptx', 'excl'])) {
			// 		if (!isset($f['documents']))
			// 			$f['documents'] = array();
			// 		array_push($f['documents'], $file);
			// 	} 
			// 	else {
			// 		if (!isset($f['others']))
			// 			$f['others'] = array();
			// 		array_push($f['others'], $file);
			// 	}
			// }

			// dd($folder);
			// dd($path);
			//return response()->file("./storage/1/1529365354Folder1/1529365445File6.jpeg");
			return view('files.index',compact('folder','directories','filesd','files','f','folders','id'));

		}
	}
