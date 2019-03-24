<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
	protected $fillable = [
		'folder_name','fname','owner_id','parent_folder',
	];

	public function files()
	{
		return $this->hasMany('App\File', 'folder_id', 'id');
	}

}
