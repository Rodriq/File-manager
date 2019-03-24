<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $fillable = [
		'name', 'extension', 'url', 'path','folder_id','real_name','parent_folder',
	];

}
