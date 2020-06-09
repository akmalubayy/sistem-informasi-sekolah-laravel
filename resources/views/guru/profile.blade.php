@extends('layouts.master')

@section('header')

<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

@endsection
@section('content')

	<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				{{-- <div class="container-fluid">
					@if(session('sukses'))
						<div class="alert alert-success" role="alert">
						  {{session('sukses')}}
						</div>
					@endif --}}

					@if(session('error'))
						<div class="alert alert-danger" role="alert">
						  {{session('error')}}
						</div>
					@endif
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="{{$guru->getAvatar()}}" class="img-circle" alt="Avatar">
										<h3 class="name">{{$guru->nama}}</h3>
										<span class="online-status status-available">Available</span>
									</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<!-- TABBED CONTENT -->
								<div class="panel">
                                <!-- Button trigger modal -->
                                @if(auth()->user()->role == 'admin')
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalMapel">
                                    Tambah Mata Pelajaran
                                </button>
                                @endif
								<div class="panel-heading">
									<h3 class="panel-title">{{$guru->nama}} Mata Pelajaran Class</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
                                                <th>Kode</th>
												<th>Nama</th>
												<th>Semester</th>
											</tr>
										</thead>
										<tbody>
											@foreach($guru->mapel as $mapela)
											<tr>
                                                <td>{{$mapela->kode}}</td>
												<td>{{$mapela->nama}}</td>
												<td>{{$mapela->semester}}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<div class="panel">
								<div id="chartsnilai"></div>
								</div>
							</div>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
@endsection

@section('footer')

@stop

<!-- Modal -->
<div class="modal fade" id="ModalMapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('mapel.guru.store', $guru)}}" method="POST">
              {{csrf_field()}}
              <div class="form-group{{$errors->has('kode') ? ' has-error' : ''}}">
                <label for="kode">Kode Mata Pelajaran</label>
                <input name="kode" type="text" class="form-control" id="kode" placeholder="Kode Mapel" value="{{old('kode')}}">
                @if($errors->has('kode'))
                    <span class="help-block">{{$errors->first('kode')}}</span>
                @endif
              </div>
              <div class="form-group{{$errors->has('nama') ? ' has-error' : ''}}">
                <label for="nama">Mata Pelajaran</label>
                <input name="nama" type="text" class="form-control" id="nama" placeholder="Mata Pelajaran" value="{{old('nama')}}">
                @if($errors->has('nama'))
                    <span class="help-block">{{$errors->first('nama')}}</span>
                @endif
              </div>
              <div class="form-group{{$errors->has('semester') ? ' has-error' : ''}}">
                <label for="semester">Semester</label>
                    <select class="form-control" id="semester" name="semester">
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                    @if($errors->has('semester'))
                    <span class="help-block">{{$errors->first('semester')}}</span>
                    @endif
                </select>
              </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>
