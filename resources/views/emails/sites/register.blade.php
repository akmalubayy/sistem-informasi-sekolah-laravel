@component('mail::message')
# Pendaftaran Siswa

Selamat Datang, Anda Sekarang adalah Bagian Dari Keluarga Kami

@component('mail::button', ['url' => 'https://instagram.com/akmalubayy'])
Visit Page
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
