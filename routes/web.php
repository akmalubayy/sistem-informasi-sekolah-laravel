<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('kirimemail', function(){
//     \Mail::raw('Hallo test Email', function ($message) {
//         $message->to('mhmdakmal46@gmail.com', 'Ubay');
//         $message->subject('Pendaftaran Siswa');
//     });

// });

Route::get('/', 'SiteController@home');
Route::get('/contact', 'SiteController@contact');
Route::get('/register', 'SiteController@register');
Route::post('/postregister', 'SiteController@postregister');





Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    Route::get('/siswa/{id}/edit', 'SiswaController@edit');
    Route::post('/siswa/{id}/update', 'SiswaController@update');
    Route::get('/siswa/{id}/delete', 'SiswaController@delete');
    Route::get('/siswa/{id}/profile', 'SiswaController@profile');
    Route::post('/siswa/{id}/addnilai', 'SiswaController@addnilai');
    Route::get('/siswa/{id}/{idmapel}/deletenilai', 'SiswaController@deletenilai');
    Route::get('/siswa/exportexcel', 'SiswaController@exportExcel');
    Route::get('/siswa/exportpdf', 'SiswaController@exportPDF');
    Route::post('/siswa/import', 'SiswaController@importexcel')->name('siswa.import');
    Route::get('/posts', 'PostController@index')->name('posts.index');
    Route::get('/post/{id}/delete', 'PostController@delete');
    // Route::get('/post/{id}/edit','PostController@edit');
    Route::post('/post/{id}/update', 'PostController@update');
    Route::get('post/add', [
        'uses' => 'PostController@add',
        'as' => 'posts.add'
    ]);

    Route::post('post/create', [
        'uses' => 'PostController@create',
        'as' => 'posts.create',
    ]);
    Route::post('/guru/{guru}/create', [
        'uses' => 'MapelController@store',
        'as' => 'mapel.guru.store',
    ]);

    // Route::get('post/{id}/delete',[
    // 	'uses' => 'PostController@delete',
    // 	'as' => 'posts.delete',
    // ]);

    Route::get('post/{id}/edit', [
        'uses' => 'PostController@edit',
        'as' => 'posts.edit',
    ]);
});

Route::group(['middleware' => ['auth', 'checkRole:admin,siswa']], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/guru/{id}/profile', 'GuruController@profile');
    Route::get('/guru', 'GuruController@index');
    Route::post('/guru/create', 'GuruController@create');
    Route::get('/guru/{id}/edit', 'GuruController@edit');
    Route::POST('/guru/{id}/update', 'GuruController@update');
    Route::get('/guru/{guru}/delete', 'GuruController@delete');
    Route::get('/forum', 'ForumController@index');
    Route::POST('/forum/create', 'ForumController@create');
    Route::get('/forum/{id}/details', 'ForumController@details');
    Route::get('/guru/exportexcel', 'GuruController@exportExcel');
    Route::get('/guru/exportpdf', 'GuruController@exportPDF');
    Route::post('/forum/{forum}/comment', 'ForumKomentarController@store')->name('forum.komentar.store');
    Route::get('/mapel', 'MapelController@index');
    Route::get('/pembayaran', function () {
        return 'View Pembayaran';
    });
});

Route::group(['middleware' => ['auth', 'checkRole:siswa']], function () {
    Route::get('/profilesaya', 'SiswaController@profilesaya');
});

Route::get('/getdatasiswa', [
    'uses' => 'SiswaController@getdatasiswa',
    'as' => 'ajax.get.data.siswa',
]);

Route::get('/{slug}', [
    'uses' => 'SiteController@singlepost',
    'as' => 'site.single.post'
]);
