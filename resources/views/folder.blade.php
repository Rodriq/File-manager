@extends('style.app')
@section('styles')
<style type="text/css">
.grow { transition: all .2s ease-in-out; }
.grow:hover { transform: scale(1.1); }
</style>
@endsection
@section('body')
<div class="container" style="margin-top: 10px;">

	<!-- Modal -->
	<div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background:blue; font-size: 32px; color: white;">
					<h5 class="modal-title" id="exampleModalLongTitle">Renaming Folder</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<form method="POST" action="">
						@csrf
						<div class="form-group">
							<label>
								New Folder name
							</label>
							<input type="text" name="folder_name" class="form-control" value="">
						</div>
					</div>
					<div class="modal-footer" style="align-self: center;">
						<input type="submit" name="" value="Rename" class="btn btn-primary">

						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<!-- Button trigger modal -->
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
		Create New Folder
	</button>

	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background:blue; font-size: 32px; color: white;>
				<h5 class="modal-title" id="exampleModalLongTitle">Creating New Folder</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<form method="POST" action="{{ route('save') }}">
						@csrf
						<div class="form-group">
							<label>Folder Name</label>		
							<input type="text" name="folder_name" class="form-control">	
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							{{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
							<input type="submit" value="Create" class="btn btn-primary">

						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<hr>
<div class="row">
	@foreach($folders as $folder)
	<div class="col-md-4">
		<div class="card" style="text-align: center;">
			<a href="{{route('view',$folder->id)}}">
				<img src="folders/folder.png" class="grow" style="margin-left: 45px;width: 100px; height: 100px; cursor: pointer;">
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

</div>

@endsection
@section('scripts')
<script type="text/javascript">
	$(function () {
		$('.renameFolder').click(function(evt){
			evt.preventDefault();
			var modal = $('#renameModal');
			var id = $(this).data('id');
			var name = $(this).data('name');
			$(modal).find('form')
			.attr('action', `update/${id}`)
			.find('input[name="folder_name"]:first').val(name);
			$(modal).modal('show');
		});
		$('.deleteFolder').on('click', function (evt) {
			evt.preventDefault();
			var url = $(this).attr('href');
			swal({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				type: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then(function(confirm) {
				if (confirm.value) {
					window.location.href = url;
				}
			});
		});
	});
</script>
@endsection