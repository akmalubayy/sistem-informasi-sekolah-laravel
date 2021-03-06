@extends('layouts.master')

@section('header')

<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

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
											<li>Tanggal Lahir<span>{{$siswa->tgl_lahir->format('d M Y')}}</span></li>
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
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
									Tambah Nilai
								</button>
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
												<th>Aksi</th>
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
													<a href="#" class="nilai" data-type="text" data-pk="{{$matapelajaran->id}}" data-url="/api/siswa/{{$siswa->id}}/editnilai" data-title="Masukkan Nilai">{{$matapelajaran->pivot->nilai}}</a>
												</td>
												<td>
													<a href="#" class="btn btn-danger btn-sm deletenilai" siswa-id="{{$siswa->id}}" nilaipel="{{$matapelajaran->id}}">Delete</a>
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="/siswa/{{$siswa->id}}/addnilai" method="POST" enctype="multipart/form-data">
        	{{csrf_field()}}
			<div class="form-group">
				<label for="mapel">Mata Pelajaran</label>
				<select class="form-control" id="mapel" name="mapel">
				@foreach($matapel as $mp)
					<option value="{{$mp->id}}">{{$mp->nama}}</option>
				@endforeach
				</select>
			</div>
		  <div class="form-group{{$errors->has('nilai') ? ' has-error' : ''}}">
		    <label for="nilai">Nilai</label>
		    <input name="nilai" type="text" class="form-control" id="nilai" placeholder="Nilai" value="{{old('nilai')}}">
			@if($errors->has('nilai'))
				<span class="help-block">{{$errors->first('nilai')}}</span>
			@endif
		  </div>
      </div>
      <div class="modal-footer">
    	<button type="submit" class="btn btn-primary">Simpan</button>
      </form>
	  </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<!-- Javascript -->
	<script src="{{asset('highcharts/highcharts.js')}}"></script>
	<!-- <script src="https://code.highcharts.com/highcharts.js}}"></script> -->
	<!-- <script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script> -->
	<script>
		Highcharts.chart('chartsnilai', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan Nilai Siswa'
    },
    xAxis: {
        categories: {!!json_encode($categories)!!}, //tanda seru adalah echo spesial agar file json tidak terender sebagai html
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nilai'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Nilai',
        data: {!!json_encode($data)!!},
    }]
});
	$(document).ready(function() {
    $('.nilai').editable();
});
	</script>
	<script>
	$('.deletenilai').click(function(){
		var nilai = $(this).attr('nilaipel');
		var siswa_id = $(this).attr('siswa-id');
		// alert(nilai)
		swal({
			  title: "Yakin?",
			  text: "Apakah Data Nilai Siswa dengan id "+siswa_id +" mau dihapus??",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
				// console.log(willDelete)
			  if (willDelete) {
			    window.location = "/siswa/"+siswa_id +"/"+nilai +"/deletenilai";
			  }
		});
	});
	</script>
@stop
