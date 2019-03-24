@extends('style.app')

@section('body')
<div class="container" style="margin-top: 20px">
	<div class="panel panel-default">
		<div class="panel-body">
			<form method="POST" action="{{route('update',$folder_name->id)}}" class="form-control">
				@csrf
				<div class="form-group">
					<label>
						New Folder name
					</label>
					<input type="text" name="folder_name" class="form-group" value="{{$folder_name->folder_name}}">
				</div>
				<div class="form-group">

					<input type="submit" name="" value="Rename" class="btn btn-primary">
				</div>

			</form>
		</div>

		
	</div>
</div>

@endsection