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
			<th>NAMA LENGKAP</th>
			<th>JENIS KELAMIN</th>
			<th>AGAMA</th>
			<th>RATA-RATA NILAI</th>
		</tr>
	</thead>
	<tbody>
		@foreach($siswa as $s)
		<tr>
			<td>{{$s->nama_lengkap()}}</td>
			<td>{{$s->jenis_kelamin}}</td>
			<td>{{$s->agama}}</td>
			<td>{{$s->hitung()}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
