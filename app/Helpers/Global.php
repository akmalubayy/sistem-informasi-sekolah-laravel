<?php

function top5Ranking()
{
	$siswa = \App\Siswa::all();

    	// function map tersedia untuk chaining dengan object atau collection
    	$siswa->map(function($s){
    		$s->rataRataNilai = $s->hitung();
    		return $s;
    	});

    	$siswa = $siswa->sortByDesc('rataRataNilai')->take(5);

    	return $siswa;
}

	function countsiswa()
	{
		return \App\Siswa::count();
	}

	function countguru()
	{
		return \App\Guru::count();
    }

    function countforum()
    {
        return \App\Forum::count();
    }

    function countmapel()
    {
        return \App\Mapel::count();
    }
?>
