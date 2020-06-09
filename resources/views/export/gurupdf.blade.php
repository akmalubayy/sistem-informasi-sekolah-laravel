<style>
    table {
      border-collapse: collapse;
    }

    table, td, th {
      border: 1px solid black;
    }
    </style>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAMA LENGKAP</th>
                <th>NOMOR TELEPON</th>
                <th>ALAMAT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guru as $gr)
            <tr>
                <td>{{$gr->id}}</td>
                <td>{{$gr->nama}}</td>
                <td>{{$gr->telepon}}</td>
                <td>{{$gr->alamat}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
