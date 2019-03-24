@extends('style.app')

@section('body')
<div class="well" style="margin-top: 15px;" >
	<div class="row">
		<div class="col-md-4">
			
		</div>
		<div class="col-md-4">
			<h2>Creating New Folder</h2>
		</div>
		<div class="col-md-4">
			
		</div>
	</div>
</div>
<div class="container">
	<form method="POST" action="{{ route('save') }}">
		@csrf
		<div class="form-group">
			<label>Folder Name</label>		
			<input type="text" name="folder_name">	
		</div>
		
		<input type="submit" value="Create" class="btn btn-primary">
	</form>
</div>

@endsection