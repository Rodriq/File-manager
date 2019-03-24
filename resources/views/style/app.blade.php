<!DOCTYPE html>
<html>
<head>
	<title>folder</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/fa-svg-with-js.css') }}">
	@yield('styles')
</head>
<body>
	<div class="container">
		<a href="{{route('folder')}}">
			<button class="btn btn-info btn-lg" style="text-align: center;"><i class="fas fa-home"></i> Home</button>
		</a><br><br>
		<div class="container" style="margin-top: 10px;">

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
		</div>

		@yield('body')
	</div>

	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/fontawesome-all.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/swal.min.js') }}"></script>
	<script type="text/javascript">
		// $(function() {
		// 	swal(
		// 		'The Internet?',
		// 		'That thing is still around?',
		// 		'question'
		// 		)
		// });
	</script>
	@yield('scripts')
</body>
</html>