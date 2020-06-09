@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
             {{-- @if(session('sukses'))
				<div class="alert alert-success" role="alert">
				  {{session('sukses')}}
				</div>
				@endif --}}
				<div class="row">
					<div class="col-md-12">
							<!-- TABLE HOVER -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Forum</h3>
									<div class="right">
										<!-- Button trigger modal -->
									<a href="#" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModal">Tambah Forum</a>
                                    </div>
								</div>
								<div class="panel-body">
                                    <ul class="list-unstyled activity-list">
                                        @foreach ($forum as $frm)
										<li>
											<img src="{{$frm->user->siswa->getAvatar()}}" alt="Avatar" class="img-circle pull-left avatar">
                                        <p><a href="/forum/{{$frm->id}}/details">{{$frm->user->siswa->nama_lengkap()}} : {{$frm->judul}} </a>  <span class="timestamp">{{$frm->created_at->diffForHumans()}}</span></p>
										</li>
                                        @endforeach
                                    </ul>
                                    {{$forum->links()}}
                                </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection


	<!-- Modal Input Forum -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Forum</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="/forum/create" method="POST">
                  {{csrf_field()}}
                <div class="form-group{{$errors->has('judul') ? ' has-error' : ''}}">
                  <label for="judul">Judul</label>
                  <input name="judul" type="text" class="form-control" id="judul" placeholder="judul" value="{{old('judul')}}">
                  @if($errors->has('judul'))
                      <span class="help-block">{{$errors->first('judul')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="konten">Konten</label>
                  <textarea name="konten" class="form-control" id="konten" rows="5">{{old('konten')}}</textarea>
                </div>
                {{-- <!-- <div class="form-group {{$errors->has('avatar') ? ' has-error' : ''}}">
                    <label for="avatar">Avatar</label>
                    <input name="avatar" type="file" class="form-control" id="avatar">
                  @if($errors->has('avatar'))
                      <span class="help-block">{{$errors->first('avatar')}}</span>
                  @endif
                </div> --> --}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Akhir Modal Input Siswa -->
