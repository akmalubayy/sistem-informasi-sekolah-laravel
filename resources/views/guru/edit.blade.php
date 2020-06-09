@extends('layouts.master')

@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			@if(session('sukses'))
			<div class="alert alert-success" role="alert">
			  {{session('sukses')}}
			</div>
			@endif
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">Data Guru</h3>
						</div>
						<div class="panel-body">
							<form action="/guru/{{$guru->id}}/update" method="POST" enctype="multipart/form-data">
			        			{{csrf_field()}}
							  <div class="form-group{{$errors->has('nama') ? ' has-error' : ''}}">
							    <label for="nama">Nama Lengkap</label>
							    <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Lengkap" value="{{$guru->nama}}">
								@if($errors->has('nama'))
									<span class="help-block">{{$errors->first('nama')}}</span>
								@endif
                              </div>
                              <div class="form-group{{$errors->has('nip') ? ' has-error' : ''}}">
							    <label for="nip">NIP</label>
							    <input name="nip" type="text" disabled="true" class="form-control" id="nip" placeholder="NIP" value="{{$guru->nip}}">
								@if($errors->has('nip'))
									<span class="help-block">{{$errors->first('nip')}}</span>
								@endif
							  </div>
                              <div class="form-group{{$errors->has('telepon') ? ' has-error' : ''}}">
							    <label for="telepon">Telepon</label>
							    <input name="telepon" type="text" class="form-control" id="telepon" placeholder="telepon" value="{{$guru->telepon}}">
								@if($errors->has('telepon'))
									<span class="help-block">{{$errors->first('telepon')}}</span>
								@endif
							  </div>
							  <div class="form-group">
							    <label for="alamat">Alamat</label>
							    <textarea name="alamat" class="form-control" id="alamat" rows="3">{{$guru->alamat}}</textarea>
							  </div>
							  <!-- <div class="form-group{{$errors->has('avatar') ? ' has-error' : ''}}">
							  	<label for="avatar">Avatar</label>
							  	<input name="avatar" type="file" class="form-control" id="avatar">
								@if($errors->has('avatar'))
									<span class="help-block">{{$errors->first('avatar')}}</span>
								@endif
							  </div> -->
							  <button type="submit" class="btn btn-warning">Update</button>
			      			</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

<!--
 div class="form-group" disabled="disabled">
	<label for="email">Email</label>
	<input type="email" disabled="disabled" name="email" class="form-control" id="email" placeholder="Email" value="echo pakai {{}}masukan kedalam echo  -> |$siswa->user->email|">
</div>
 -->
