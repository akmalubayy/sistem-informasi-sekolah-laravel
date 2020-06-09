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
									<h3 class="panel-title">Data Siswa</h3>
									<div class="right">
										<!-- Button trigger modal -->
									<a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importfile">Import Excel</a>
									<a href="/siswa/exportexcel" class="btn btn-primary btn-sm">Export Excel</a>
									<a href="/siswa/exportpdf" class="btn btn-primary btn-sm">Export PDF</a>
									<button type="button" class="btn"><i class="lnr lnr-plus-circle" data-toggle="modal" data-target="#exampleModal"></i></button>
									</div>
								</div>
								<div class="panel-body">
									<table class="table table-hover" id="datatable">
										<thead>
											<tr>
												<th>ID</th>
												<th>Nama Lengkap</th>
												<!-- <th>Nama Belakang</th> -->
												<th>Jenis Kelamin</th>
												<th>Agama</th>
												<th>Alamat</th>
												<th>Rata-Rata</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>

										</tbody>
									</table>
										<!-- kuraung kurawal $data_siswa->links() -->
								</div>
							</div>
							<!-- END TABLE HOVER -->
						</div>
					</div>
				</div>
			</div>
		</div>



	<!-- Modal Input Siswa -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Imput Data Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/siswa/create" method="POST" enctype="multipart/form-data">
        	{{csrf_field()}}
		  <div class="form-group{{$errors->has('nama_depan') ? ' has-error' : ''}}">
		    <label for="nama_depan">Nama Depan</label>
		    <input name="nama_depan" type="text" class="form-control" id="nama_depan" placeholder="Nama Depan" value="{{old('nama_depan')}}">
			@if($errors->has('nama_depan'))
				<span class="help-block">{{$errors->first('nama_depan')}}</span>
			@endif
		  </div>
		  <div class="form-group{{$errors->has('nama_belakang') ? ' has-error' : ''}}">
		    <label for="nama_belakang">Nama Belakang</label>
		    <input name="nama_belakang" type="text" class="form-control" id="nama_belakang" placeholder="Nama Belakang" value="{{old('nama_belakang')}}">
			@if($errors->has('nama_belakang'))
				<span class="help-block">{{$errors->first('nama_belakang')}}</span>
			@endif
          </div>
          <div class="form-group{{$errors->has('tgl_lahir') ? ' has-error' : ''}}">
		    <label for="tgl_lahir">Tanggal Lahir</label>
		    <input name="tgl_lahir" type="date" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" value="{{old('tgl_lahir')}}">
			@if($errors->has('tgl_lahir'))
				<span class="help-block">{{$errors->first('tgl_lahir')}}</span>
			@endif
		  </div>
		 <div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
		 	<label for="email">Email</label>
		 	<input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{old('email')}}">
			 @if($errors->has('email'))
				<span class="help-block">{{$errors->first('email')}}</span>
			@endif
		 </div>
		  <div class="form-group{{$errors->has('jenis_kelamin') ? ' has-error' : ''}}">
		    <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
		    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
		      <option value="L"{{(old('jenis_kelamin') == 'L') ? ' selected' : ''}}>Laki-Laki</option>
		      <option value="P"{{(old('jenis_kelamin')	== 'P') ? ' selected' : ''}}>Perempuan</option>
		    </select>
			@if($errors->has('jenis_kelamin'))
				<span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
			@endif
		  </div>
		  <div class="form-group{{$errors->has('agama') ? ' has-error' : ''}}">
		    <label for="agama">Agama</label>
		    <input name="agama" type="text" class="form-control" id="agama" placeholder="Agama" value="{{old('agama')}}">
			@if($errors->has('agama'))
				<span class="help-block">{{$errors->first('agama')}}</span>
			@endif
		  </div>
		  <div class="form-group">
		    <label for="alamat">Alamat</label>
		    <textarea name="alamat" class="form-control" id="alamat" rows="3">{{old('alamat')}}</textarea>
		  </div>
		  <div class="form-group {{$errors->has('avatar') ? ' has-error' : ''}}">
	  		<label for="avatar">Avatar</label>
		  	<input name="avatar" type="file" class="form-control" id="avatar">
			@if($errors->has('avatar'))
				<span class="help-block">{{$errors->first('avatar')}}</span>
			@endif
		  </div>
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


<!-- Modal Import -->

<div class="modal fade" id="importfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import File Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!!Form::open(['route' => 'siswa.import', 'class' => 'form-horizontal','enctype' => 'multipart/form-data'])!!}

        {!!Form::file('data_siswa')!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      	<input type="submit" class="btn btn-primary btn-sm" value="Import">
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


<!-- Akhit Modal Impport -->
@endsection

@section('footer')
<script>
	// <!-- Jquery  -->
	$(document).ready(function(){
			$('#datatable').DataTable({
				processing:true,
				serverside:true,
				ajax:"{{route('ajax.get.data.siswa')}}",
				columns:[
					{data: 'id', name: 'id'},
					{data: 'nama_lengkap', name: 'nama_lengkap'},
					{data: 'jenis_kelamin', name: 'jenis_kelamin'},
					{data: 'agama', name: 'agama'},
					{data: 'alamat', name: 'alamat'},
					{data: 'rata2nilai', name: 'rata2nilai'},
					{data: 'aksi', name: 'aksi'},
				]
			});

			$('body').on('click','.deletesis',function(){
			var siswa_id = $(this).attr('siswa-id');
			swal({
				  title: "Yakin?",
				  text: "Apakah Data Siswa dengan id "+siswa_id +" mau dihapus??",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
					// console.log(willDelete)
				  if (willDelete) {
				    window.location = "/siswa/"+siswa_id+"/delete";
				  }
			});
		});
	});
</script>

@stop
