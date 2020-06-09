@extends('layouts.master')

@section('content')
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-6">
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Mata Pelajaran</h3>
							</div>
							<div class="panel-body">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Ranking</th>
											<th>Nama</th>
											<th>Nilai</th>
										</tr>
									</thead>
									<tbody>
										@php
											$ranking = 1;
										@endphp
										@foreach(top5Ranking() as $s)
										<tr>
											<td>{{$ranking}}</td>
											<td>{{$s->nama_lengkap()}}</td>
											<td>{{$s->rataRataNilai}}</td>
										</tr>
										@php
											$ranking++;
										@endphp
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="metric">
							<span class="icon"><i class="fa fa-user"></i></span>
							<p>
								<span class="number">{{countsiswa()}}</span>
								<span class="title">Total Siswa</span>
							</p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="metric">
							<span class="icon"><i class="fa fa-user"></i></span>
							<p>
								<span class="number">{{countguru()}}</span>
								<span class="title">Total Guru</span>
							</p>
						</div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="lnr lnr-location"></i></span>
                            <p>
                                <span class="number">{{countforum()}}</span>
                                <span class="title">Total Forum</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <span class="icon"><i class="fa fa-database"></i></span>
                            <p>
                            <span class="number">{{countmapel()}}</span>
                            <span class="titile">Total Mapel</span>
                            </p>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection

<!-- top top5Ranking() adalah helper custom function yang dibuat sendiri, yang bisa digunakan global atau di mana saja, tanpa perlu melempar variable -->
