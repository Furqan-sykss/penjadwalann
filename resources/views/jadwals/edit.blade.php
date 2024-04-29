<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Jadwal - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('jadwals.update', $jadwal->id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="font-weight-bold">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal"
                                    value="{{ $jadwal->tanggal }}">
                            </div>

                            <div class="mb-3">
                                <label class="font-weight-bold">Hari</label>
                                <input type="text" class="form-control" name="hari" value="{{ $jadwal->hari }}">
                            </div>

                            <div class="mb-3">
                                <label class="font-weight-bold">Tujuan</label>
                                <input type="text" class="form-control" name="tujuan" value="{{ $jadwal->tujuan }}">
                            </div>

                            <div class="mb-3">
                                <label class="font-weight-bold">Pemesanan Tiket</label>
                                <input type="text" class="form-control" name="pemesanan_tiket"
                                    value="{{ $jadwal->pemesanan_tiket }}">
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="pencairan"
                                    name="pencairan" {{ $jadwal->pencairan ? 'checked' : '' }}>
                                <label class="form-check-label" for="pencairan">
                                    Pencairan
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="font-weight-bold">Catatan</label>
                                <textarea class="form-control" name="catatan" rows="3">{{ $jadwal->catatan }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="font-weight-bold">NO ST/UND</label>
                                <input type="text" class="form-control" name="no_st_und"
                                    value="{{ $jadwal->no_st_und }}">
                            </div>

                            <div class="mb-3">
                                <label class="font-weight-bold">
                                    @if ($jadwal->berkas_pencarian)
                                        Update Berkas Pencairan
                                    @else
                                        Upload Berkas Pencairan
                                    @endif
                                </label>
                                <input type="file" class="form-control" name="berkas_pencarian">
                            </div>
                            <!-- Tampilkan nama berkas pencairan jika sudah ada -->
                            @if ($jadwal->berkas_pencarian)
                                <div class="mt-3">
                                    <p><strong>Berkas Pencairan:</strong> <a
                                            href="{{ asset('/storage/berkas_pencarian/' . $jadwal->berkas_pencarian) }}">{{ $jadwal->berkas_pencarian }}</a>
                                    </p>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
