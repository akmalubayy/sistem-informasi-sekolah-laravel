@extends('layouts.masterfront')

@section('content')
<!-- start banner Area -->
		<section class="banner-area relative about-banner" id="home">
			<div class="overlay overlay-bg"></div>
			<div class="container">
				<div class="row d-flex align-items-center justify-content-center">
					<div class="about-content col-lg-12">
						<h1 class="text-white">
							Pendaftaran
						</h1>
						<p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.html"> Pendaftaran</a></p>
					</div>
				</div>
			</div>
		</section>
<!-- End banner Area -->
<!-- Start search-course Area -->
			<section class="search-course-area relative" style="background: unset;">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row justify-content-between align-items-center">
						<div class="col-lg-3 col-md-6 search-course-left">
							<h1 class="text-white">
								Daftarkan Segera <br>
								Di Sekolah Terbaik!
							</h1>
							<p class="text-white">
								Gapai Masa depanmu bersama kami, wujudkan impianmu dengan pembelajaran pembelajaran international
							</p>
						</div>
						<div class="col-lg-49 col-md-6 search-course-right section-gap">
							{!! Form::open(['url' => '/postregister','class' => 'form-wrap']) !!}
								<h4 class="text-white pb-20 text-center mb-30">Pendaftaran Siswa</h4>
								{!!Form::text('nama_depan','', ['class' => 'form-control','placeholder' => 'Nama Depan'])!!}
								{!!Form::text('nama_belakang','', ['class' => 'form-control','placeholder' => 'Nama Belakang'])!!}
								<div class="form-select" id="service-select" style="margin-bottom: 5px">
								{!!Form::select('agama',['' => 'Masukan Agama','Islam' => 'ISLAM','Kristen' => 'KRISTEN','Katolik' => 'KATOLIK','Hindu' => 'HINDU','Budha','Khong Hu Cu' => 'KHONG HU CU']);!!}
								</div>
								<div class="form-select" id="service-select" style="margin-bottom: 5px">
								{!!Form::select('jenis_kelamin',['' => 'Pilih Jenis Kelamin','L' => 'Laki-Laki', 'P' => 'Perempuan']);!!}
                                </div>
                                {!!Form::date('tgl_lahir','', ['class' => 'form-control','placeholder' => 'Tanggal Lahir'])!!}
								{!!Form::textarea('alamat','', ['class' => 'form-control','placeholder' => 'Masukan Alamat Lengkap'])!!}
								{!!Form::email('email','',['class' => 'form-control','placeholder' => 'Masukan Email'])!!}
								{!!Form::password('password',['class' => 'form-control','placeholder' => 'Masukan Password'])!!}
								<input type="submit" value="kirim" class="primary-btn text-uppercase">
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</section>
			<!-- End search-course Area -->

@stop

<!-- {!!Form::email('email','',['class' => 'form-control','placeholder' => 'Masukan Email'])!!}
								{!!Form::password('password',['class' => 'form-control','placeholder' => 'Masukan Password'])!!} -->
