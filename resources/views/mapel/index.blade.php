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
                                    {{-- <a href="/guru/exportexcel" class="btn btn-primary btn-sm">Export Excel</a>
                                    <a href="/guru/exportpdf" class="btn btn-primary btn-sm">Export PDF</a>
                                @if(auth()->user()->role == 'admin')
                                <a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importfile">Import Excel</a>
                                <button type="button" class="btn"><i class="lnr lnr-plus-circle" data-toggle="modal" data-target="#exampleModal"></i></button>
                                @endif --}}
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover" id="table-mapel">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>KODE MAPEL</th>
                                            <th>MATA PELAJARAN</th>
                                            <!-- <th>Nama Belakang</th> -->
                                            <th>SEMESTER</th>
                                            {{-- <th>Alamat</th>
                                            @if(auth()->user()->role == 'admin')
                                            <th>Aksi</th>
                                            @endif --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mapel as $mpl)
                                        <tr>
                                            <td>{{$mpl->id}}</td>
                                            {{-- <td><a href="mpl/{{$mpl->id}}/profile">{{$mpl->nama}}</a></td> --}}
                                            <td>{{$mpl->kode}}</td>
                                            <td>{{$mpl->nama}}</td>
                                            <td>{{$mpl->semester}}</td>
                                            {{-- @if(auth()->user()->role == 'admin')
                                            <td>
                                                <a href="/guru/{{$guru->id}}/edit" class="btn btn-warning lnr lnr-pencil"></a>
                                                <a href="#" class="btn btn-danger fa fa-trash-o deleteguru" guru-id="{{$guru->id}}"></a>
                                            </td>
                                            @endif --}}
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


@endsection

@section('footer')
<script>
    $(document).ready(function(){
        $('#table-mapel').DataTable();
    });
</script>

@endsection
