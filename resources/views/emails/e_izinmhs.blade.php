@if($tostaffpenting == "yes")
	Selamat siang, ada pengajuan izin baru, tolong cek sistem.
@else
	@if($status == "Belum Diproses")
	Selamat siang, pengajuan izin kegiatan anda telah masuk, dan statusnya Belum Diproses
	@elseif($status == "Disetujui")
	Selamat siang, pengajuan izin anda telah Disetujui, dan saat ini menunggu proses oleh Sekretariat.
	<br>
	Pesan:
	<br>
	{!! $pesan !!}
	@elseif($status == "Diproses")
	Selamat siang, pengajuan izin anda sedang Diproses oleh Sekretariat
	@elseif($status == "Selesai")
	Selamat siang, pengajuan izin anda telah Selesai. Silahkan ambil berkas di Sekretariat
	@else
	Selamat siang, pengajuan izin anda Tidak Disetujui.
	<br>
	Pesan:
	<br>
	{!! $pesan !!}
	@endif
@endif