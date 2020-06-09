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
									<h3 class="panel-title">Data Guru</h3>
									<div class="right">
										<!-- Button trigger modal -->
                                        <a href="/guru/exportexcel" class="btn btn-primary btn-sm">Export Excel</a>
                                        <a href="/guru/exportpdf" class="btn btn-primary btn-sm">Export PDF</a>
                                    @if(auth()->user()->role == 'admin')
                                    <a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importfile">Import Excel</a>
									<button type="button" class="btn"><i class="lnr lnr-plus-circle" data-toggle="modal" data-target="#exampleModal"></i></button>
									@endif
                                    </div>
								</div>
								<div class="panel-body">
									<table class="table table-hover" id="table-guru">
										<thead>
											<tr>
												<th>ID</th>
                                                <th>Nama Guru</th>
                                                <th>NIP</th>
												<!-- <th>Nama Belakang</th> -->
												<th>Telepon</th>
												<th>Alamat</th>
                                                @if(auth()->user()->role == 'admin')
                                                <th>Aksi</th>
                                                @endif
											</tr>
										</thead>
										<tbody>
                                        @foreach($data_guru as $guru)
                                            <tr>
                                                <td>{{$guru->id}}</td>
                                                <td><a href="guru/{{$guru->id}}/profile">{{$guru->nama}}</a></td>
                                                <td>{{$guru->nip}}</td>
                                                <td>{{$guru->telepon}}</td>
                                                <td>{{$guru->alamat}}</td>
                                                @if(auth()->user()->role == 'admin')
                                                <td>
                                                    <a href="/guru/{{$guru->id}}/edit" class="btn btn-warning lnr lnr-pencil"></a>
                                                    <a href="#" class="btn btn-danger fa fa-trash-o deleteguru" guru-id="{{$guru->id}}"></a>
                                                    {{-- <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Danger</button> --}}
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
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
          <form action="/guru/create" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
            <div class="form-group{{$errors->has('nama') ? ' has-error' : ''}}">
              <label for="nama">Nama Guru</label>
              <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Guru" value="{{old('nama')}}">
              @if($errors->has('nama'))
                  <span class="help-block">{{$errors->first('nama')}}</span>
              @endif
            </div>
            <div class="form-group{{$errors->has('nip') ? ' has-error' : ''}}">
                <label for="nip">NIP</label>
                <input name="nip" type="text" class="form-control" id="nip" placeholder="NIP" value="{{old('nip')}}">
                @if($errors->has('nip'))
                    <span class="help-block">{{$errors->first('nip')}}</span>
                @endif
              </div>
            <div class="form-group{{$errors->has('telepon') ? ' has-error' : ''}}">
                <label for="telepon">Telepon</label>
                <input name="telepon" type="text" class="form-control" id="telepon" placeholder="Telepon" value="{{old('telepon')}}">
                @if($errors->has('telepon'))
                    <span class="help-block">{{$errors->first('telepon')}}</span>
                @endif
              </div>
              <div class="form-group{{$errors->has('alamat') ? ' has-error' : ''}}">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" id="alamat" rows="3">{{old('alamat')}}</textarea>
                @if($errors->has('alamat'))
                    <span class="help-block">{{$errors->first('alamat')}}</span>
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
	// $(document).ready(function(){
	// 		$('#datatable').DataTable({
	// 			processing:true,
	// 			serverside:true,
	// 			ajax:"{{route('ajax.get.data.siswa')}}",
	// 			columns:[
	// 				{data: 'id', name: 'id'},
	// 				{data: 'nama_lengkap', name: 'nama_lengkap'},
	// 				{data: 'jenis_kelamin', name: 'jenis_kelamin'},
	// 				{data: 'agama', name: 'agama'},
	// 				{data: 'alamat', name: 'alamat'},
	// 				{data: 'rata2nilai', name: 'rata2nilai'},
	// 				{data: 'aksi', name: 'aksi'},
	// 			]
	// 		});

        $(document).ready(function(){
            $('#table-guru').DataTable();

			$('body').on('click','.deleteguru',function(){
			var guru_id = $(this).attr('guru-id');
			swal({
				  title: "Yakin?",
				  text: "Apakah Data Siswa dengan id "+guru_id +" mau dihapus??",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
					// console.log(willDelete)
				  if (willDelete) {
				    window.location = "/guru/"+guru_id+"/delete";
				  }
			});
		});
	});
</script>

@stop
