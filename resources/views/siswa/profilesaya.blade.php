@extends('layouts.master')

@section('header')

@endsection
@section('content')

	<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- @if(session('sukses'))
						<div class="alert alert-success" role="alert">
						  {{session('sukses')}}
						</div>
					@endif

					@if(session('error'))
						<div class="alert alert-danger" role="alert">
						  {{session('error')}}
						</div>
					@endif -->
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="{{$siswa->getAvatar()}}" class="img-circle" alt="Avatar">
										<h3 class="name">{{$siswa->nama_depan}}</h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												{{$siswa->mapel->count()}} <span>Mata Pelajaran</span>
											</div>
											<div class="col-md-4 stat-item">
												{{$siswa->hitung()}} <span>Rata-Rata Nilai</span>
											</div>
											<div class="col-md-4 stat-item">
												2174 <span>Points</span>
											</div>
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>Jenis Kelamin<span>{{$siswa->jenis_kelamin}}</span></li>
											<li>Agama<span>{{$siswa->agama}}</span></li>
											<li>Alamat<span>{{$siswa->alamat}}</span></li>
										</ul>
									</div>
									<div class="text-center"><a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning">Edit Profile</a></div>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<!-- TABBED CONTENT -->
								<div class="panel">
								<!-- Button trigger modal -->
								<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
									Tambah Nilai
								</button> -->
								<div class="panel-heading">
									<h3 class="panel-title">Mata Pelajaran</h3>
								</div>
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>Kode</th>
												<th>Nama</th>
												<th>Semester</th>
												<th>Guru</th>
												<th>Nilai</th>
												<!-- <th>Aksi</th> -->
											</tr>
										</thead>
										<tbody>
										@foreach($siswa->mapel as $matapelajaran)
											<tr>
												<td>{{$matapelajaran->kode}}</td>
												<td>{{$matapelajaran->nama}}</td>
												<td>{{$matapelajaran->semester}}</td>
												<td><a href="/guru/{{$matapelajaran->guru_id}}/profile"> {{$matapelajaran->guru->nama}}</a></td>
												<td>
													{{$matapelajaran->pivot->nilai}}
												</td>
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
