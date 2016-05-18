@if($status == "Belum Diproses")
Selamat siang, surat anda telah masuk, dan statusnya Belum Diproses
@elseif($status == "Diproses")
Selamat siang, surat anda saat ini sedang Diproses
@else
Selamat siang, surat anda sudah selesai dan dapat diambil di Sekretariat FIA.
@endif
