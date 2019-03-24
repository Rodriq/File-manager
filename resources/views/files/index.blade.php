
@extends('style.app')
@section('styles')
<style type="text/css">
.index-content a:hover{
	color:black;
	text-decoration:none;
}
.index-content{
	margin-bottom:20px;
	padding:50px 0px;

}
.index-content .row{
	margin-top:20px;
}
.index-content a{
	color: black;
}
.index-content .card{
	background-color: #FFFFFF;
	padding:0;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius:14px;
	box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);

}
.index-content .card:hover{
	box-shadow: 0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.3);
	color:black;
}
.index-content .card img{
	width:100%;
	border-top-left-radius: 14px;
	border-top-right-radius: 14px;
}
.index-content .card h4{
	margin:10px;
}
.index-content .card p{
	margin:20px;
	opacity: 0.65;
}
.index-content .blue-button{
	width: auto;
	-webkit-transition: background-color 1s , color 1s; /* For Safari 3.1 to 6.0 */
	transition: background-color 1s , color 1s;
	min-height: 20px;
	background-color: #002E5B;
	color: #ffffff;
	border-radius: 40px;
	text-align: center;
	font-weight: lighter;
	margin: 0px 20px 15px 20px;
	padding: 5px 0px;
	display: inline-block;
}
.index-content .blue-button:hover{
	background-color: #dadada;
	color: red;
}
@media (max-width: 768px) {

	.index-content .col-lg-4 {
		margin-top: 20px;
	}
}
</style>
@endsection
{{-- @extends('style.app') --}}
@section('body')
<div class="well-lg">
	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#foldermodal">Create New Folder</button>

	<!-- Modal -->
	<div id="foldermodal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style="background:blue; font-size: 32px; color: white;">
					<h4 class="modal-title">Creating Folder...</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>
				<div class="modal-body">
					<div class="container">


						<form method="POST" action="{{route('files.save')}}">
							@csrf
							<div class="form-group">
								<label>Folder Name</label>		
								<input type="text" name="folder_name" class="form-control">	
								<input type="hidden" name="folder_id" value="{{$folder->id}}">
							</div>
						</div>
					</div>
					<div class="modal-footer" align="self">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<input type="submit" name="" value="Create" class="btn btn-primary">
					</form>
				</div>
			</div>

		</div>
	</div>
	<!-- Trigger the modal with a button -->
	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"  style="margin-left:60%;"><i class="fas fa-plus"> 	</i> Add File</button>
	<br>&nbsp;
	<hr>
	<h2>Showing Contents of <b><i>{{$folder->fname}} </i></b> Folder</h2>
	<hr>

</div>

{{--   --}}
<div class="row">
	@foreach($folders as $folder)
	<div class="col-md-4">
		<div class="card" style="text-align: center;">
			<a href="{{route('view',$folder->id)}}">
				<img src="/folders/folder.png" alt="{{$folder->fname}}" class="grow" style="margin-left: 45px;width: 110px; height: 100px; cursor: pointer;">
			</a>
			<div class="card-body">
				<h3 class="card-title">{{$folder->fname}}</h3>
				<a href="{{route('delete',$folder->id)}}" class="deleteFolder btn btn-danger">
					<i class="fas fa-trash"></i> Delete				</a>
					<div class="btn btn-info renameFolder" data-id="{{$folder->id}}" data-name="{{$folder->fname}}">
						<i class="fas fa-edit"></i> Rename
					</div>

				</div>

				<div class="card-footer">
					<small class="text-muted">Created : {{$folder->created_at->diffForHumans()}}</small>

				</div>
			</div>
		</div>
		@endforeach						

	</div>
	<br>
	<hr>

	<ul class="nav nav-tabs" id="myTab" role="tablist" style="font-size:26px; text-align:center; background:#000066; ">
		<li class="nav-item col-md-3">	
			<a class="nav-link active" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="true" style="color:#b3d9ff; border: 0px;">Images</a>

		</li>

		<li class="nav-item col-md-3">	
			<a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos" role="tab" aria-controls="videos" aria-selected="true" style="color:#b3d9ff; border: 0px;">Videos</a>

		</li>

		<li class="nav-item col-md-3">
			<a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
		</li>
		<li class="nav-item col-md-3">
			<a class="nav-link" id="others-tab" data-toggle="tab" href="#others" role="tab" aria-controls="others" aria-selected="false">Others</a>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="images" role="tabpanel" aria-labelledby="images-tab">
			<div class="index-content">
				<div class="row">
					@foreach($f['images'] as $image)
					<div class="col-md-3">
						<div class="card">
							<a href="{{url($image->url)}}">
								<img src="{{($image->url)}}" height="140px" alt="{{$image->real_name}}">
							</a>
							<h4>{{$image->real_name}}</h4>

							<div class="btn-group mr-2" role="group" aria-label="First group">
								<button type="button" class="btn-sm btn-secondary"><i class="fas fa-edit"></i> Rename file</button>
								<button type="button" class="btn-sm btn-secondary"><i class="fas fa-trash"></i> Delete file</button>
							</div>

						</div>

					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
			vnnnnnn
		</div>

		<div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
			<div class="index-content">
				<div class="container">
					<div class="row">

						@foreach($f['documents'] as $document)
						<div class="col-md-3">
							<div class="card">
								<a href="{{url($document->url)}}">

									<img src="/folders/document.png" height="140px" alt="{{$document->real_name}}">
								</a>
								<h4>{{$document->real_name}}</h4>

								<div class="btn-group mr-2" role="group" aria-label="First group">
									<button type="button" class="btn-sm btn-secondary"><i class="fas fa-edit"></i> Rename file</button>
									<button type="button" class="btn-sm btn-secondary"><i class="fas fa-trash"></i> Delete file</button>
								</div>
							</div>

						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="others" role="tabpanel" aria-labelledby="others-tab">..fffffffffff.</div>
	</div>

	<div class="container" style="margin-top:20px;">

		<div class="container">
			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header" style="background:blue; font-size: 32px; color: white;">
							<h4 class="modal-title">Choose A File</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form method="POST" action="{{route('files.store',$id)}}" enctype="multipart/form-data" class="form-control">
								@csrf
								<div class="form-group">
									<label>File </label>
									<input type="file" name="file" style="color: green;">
								</div>
								<div class="form-group">
									<label><b>Name File</b></label>
									<input type="text" name="real_name" placeholder="Mandatory">
								</div>

							</div>
							<div class="modal-footer" style="align-self: center;">
								<input type="submit" name="" value="Add" class="btn-lg btn-primary">
								<button type="button" class="btn-lg btn-danger" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>

{{-- <div class="row">
	@foreach($files as $file)

	<div class="col-md-3">
		<img src="{{url($file->url)}}"  class="img-circle" alt="Yor file" height= "120px" width= "110px">
	</div>

	@endforeach
</div>
--}}</div>



@endsection