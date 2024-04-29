<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PENJADWALAN KAPUSDATIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <h5 class="card-title">Tanggal: {{ $jadwal->tanggal }}</h5>
                <p class="card-text">Hari: {{ $jadwal->hari }}</p>
                <p class="card-text">Tujuan: {{ $jadwal->tujuan }}</p>
                <p class="card-text">Pemesanan Tiket: {{ $jadwal->pemesanan_tiket }}</p>
                <p class="card-text">Pencairan: {{ $jadwal->pencairan ? 'Sudah' : 'Belum' }}</p>
                <p class="card-text">Catatan: {{ $jadwal->catatan }}</p>
                <p class="card-text">No ST/UND: {{ $jadwal->no_st_und }}</p>

                <!-- Tampilkan nama berkas pencairan jika sudah diupload -->
                @if ($jadwal->berkas_pencarian)
                    <div class="mt-3">
                        <p><strong>Berkas Pencairan:</strong> <a
                                href="{{ asset('/storage/berkas_pencarian/' . $jadwal->berkas_pencarian) }}"
                                download>{{ $jadwal->berkas_pencarian }}</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
