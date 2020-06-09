@extends('layouts.master')

@section('content')

	<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<!-- @if(session('sukses'))
				<div class="alert alert-success" role="alert">
				  {{session('sukses')}}
				</div>
				@endif -->
				<div class="row">
					<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">All Posts</h3>
									<div class="right">
										<!-- Button trigger modal -->
									<a href="{{route('posts.add')}}" class="btn btn-primary btn-sm">Add New Post</a>
									</div>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>ID</th>
												<th>TITLE</th>
												<th>AUTHOR</th>
												<th>AKSI</th>
											</tr>
										</thead>
										<tbody>
											@foreach($posts as $post)
											<tr>
												<td>{{$post->id}}</td>
												<td>{{$post->title}}</td>
												<td>{{$post->user->name}}</td>
												<td>
													<a target="_blank" href="{{route('site.single.post', $post->slug)}}" class="btn btn-info btn-sm">View</a>
													<a href="{{route('posts.edit', $post->id)}}" class="btn btn-warning btn-sm">Edit</a>
													<a href="#" class="btn btn-danger btn-sm deletepost" post-id="{{$post->id}}">Delete</a>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<!-- END TABLE HOVER -->
						</div>
					</div>
				</div>
			</div>
		</div>

@endsection

@section('footer')
<script>
	$('.deletepost').click(function(){
		var post_id = $(this).attr('post-id');
		swal({
			  title: "Yakin?",
			  text: "Apakah Berita ini "+post_id +" mau dihapus??",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
				// console.log(willDelete)
			  if (willDelete) {
			    window.location = "/post/"+post_id+"/delete";
			  }
		});
	});
</script>

@stop
