

@if($tostaffpenting == "yes")
	Selamat siang, ada keluhan dan saran baru, tolong cek sistem.
@else
	@if($status == "Belum Diproses")
	Selamat siang, keluhan dan saran anda telah masuk, dan statusnya Belum Diproses
	@elseif($status == "Diterima")
	Selamat siang, keluhan dan saran anda Diterima.
	<br>
	Pesan:
	<br>
	{!! $pesan !!}
	@else
	Selamat siang, keluhan dan saran anda Ditolak.
	<br>
	Pesan:
	<br>
	{!! $pesan !!}
	@endif
@endif