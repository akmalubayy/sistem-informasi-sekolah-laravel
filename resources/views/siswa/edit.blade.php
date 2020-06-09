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
							<h3 class="panel-title">Data Siswa</h3>
						</div>
						<div class="panel-body">
							<form action="/siswa/{{$siswa->id}}/update" method="POST" enctype="multipart/form-data">
			        			{{csrf_field()}}
							  <div class="form-group{{$errors->has('nama_depan') ? ' has-error' : ''}}">
							    <label for="nama_depan">Nama Depan</label>
							    <input name="nama_depan" type="text" class="form-control" id="nama_depan" placeholder="Nama Depan" value="{{$siswa->nama_depan}}">
								@if($errors->has('nama_depan'))
									<span class="help-block">{{$errors->first('nama_depan')}}</span>
								@endif
							  </div>
							  <div class="form-group{{$errors->has('nama_belakang') ? ' has-error' : ''}}">
							    <label for="nama_belakang">Nama Belakang</label>
							    <input name="nama_belakang" type="text" class="form-control" id="nama_belakang" placeholder="Nama Belakang" value="{{$siswa->nama_belakang}}">
								@if($errors->has('nama_belakang'))
									<span class="help-block">{{$errors->first('nama_belakang')}}</span>
								@endif
							  </div>
							  <div class="form-group{{$errors->has('jenis_kelamin') ? ' has-error' : ''}}">
							    <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
							    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
							      <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif>Laki-Laki</option>
							      <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
							    </select>
								@if($errors->has('jenis_kelamin'))
									<span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
								@endif
							  </div>
							  <div class="form-group{{$errors->has('agama') ? ' has-error' : ''}}">
							    <label for="agama">Agama</label>
							    <input name="agama" type="text" class="form-control" id="agama" placeholder="Agama" value="{{$siswa->agama}}">
								@if($errors->has('agama'))
									<span class="help-block">{{$errors->first('agama')}}</span>
								@endif
							  </div>
							  <div class="form-group">
							    <label for="alamat">Alamat</label>
							    <textarea name="alamat" class="form-control" id="alamat" rows="3">{{$siswa->alamat}}</textarea>
							  </div>
							  <div class="form-group{{$errors->has('avatar') ? ' has-error' : ''}}">
							  	<label for="avatar">Avatar</label>
							  	<input name="avatar" type="file" class="form-control" id="avatar">
								@if($errors->has('avatar'))
									<span class="help-block">{{$errors->first('avatar')}}</span>
								@endif
							  </div>
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
