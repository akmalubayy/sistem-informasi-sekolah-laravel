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
							<div class="panel panel-headline">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$forum->judul}}</h3>
                                    <p class="panel-subtitle">{{$forum->created_at->diffForHumans()}}</p>
                                </div>
                                <div class="panel-body">
                                    {{$forum->konten}}
                                    <hr>
                                    <form action="{{route ('forum.komentar.store', $forum)}}" method="POST">
                                        {{csrf_field()}}
                                    <textarea name="konten" class="form-control" id="konten"  placeholder="Komentar" rows="4"></textarea>
                                    <br>
                                    {{-- <a type="button" href="/" class="btn btn-primary btn-sm">Komentar</a> --}}
                                    {{-- <input type="submit" class="btn btn-info btn-sm" value="Publish"> --}}
      	                            <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    <h3>Komentar</h3>
                                    <ul class="list-unstyled activity-list">
                                        @foreach ($forum->komentar as $frm)
                                        <li>
                                        <img src="https://ui-avatars.com/api/?name={{$frm->user->name}}" alt="Avatar" class="img-circle pull-left avatar">
                                            <p><a href="#">{{$frm->user->name}}</a></p>
                                            <p>{{$frm->konten}} <span class="timestamp">{{$frm->created_at->diffForHumans()}}</span></p>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection
