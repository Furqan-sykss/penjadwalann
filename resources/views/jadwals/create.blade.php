<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Jadwal - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('jadwals.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TANGGAL</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" value="{{ old('tanggal') }}">

                                <!-- error message untuk tanggal -->
                                @error('tanggal')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">HARI</label>
                                <select class="form-control @error('hari') is-invalid @enderror" name="hari">
                                    <option value="" disabled selected>Pilih Hari</option>
                                    <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa
                                    </option>
                                    <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Minggu" {{ old('hari') == 'Minggu' ? 'selected' : '' }}>Minggu
                                    </option>
                                </select>

                                <!-- error message untuk hari -->
                                @error('hari')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TUJUAN</label>
                                <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                    name="tujuan" value="{{ old('tujuan') }}" placeholder="Masukkan Tujuan">

                                <!-- error message untuk tujuan -->
                                @error('tujuan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">PEMESANAN TIKET</label>
                                <input type="number"
                                    class="form-control @error('pemesanan_tiket') is-invalid @enderror"
                                    name="pemesanan_tiket" value="{{ old('pemesanan_tiket') }}"
                                    placeholder="Masukkan Jumlah Pemesanan Tiket">

                                <!-- error message untuk pemesanan_tiket -->
                                @error('pemesanan_tiket')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">BERKAS PENCARIAN</label>
                                <input type="file"
                                    class="form-control @error('berkas_pencarian') is-invalid @enderror"
                                    name="berkas_pencarian">

                                <!-- error message untuk berkas_pencarian -->
                                @error('berkas_pencarian')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">PENCAIRAN</label>
                                <select class="form-control @error('pencairan') is-invalid @enderror" name="pencairan">
                                    <option value="" disabled selected>Pilih Pencairan</option>
                                    <option value="1" {{ old('pencairan') == '1' ? 'selected' : '' }}>Ya</option>
                                    <option value="0" {{ old('pencairan') == '0' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>

                                <!-- error message untuk pencairan -->
                                @error('pencairan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">CATATAN</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" rows="5"
                                    placeholder="Masukkan Catatan">{{ old('catatan') }}</textarea>

                                <!-- error message untuk catatan -->
                                @error('catatan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">NO ST/UND</label>
                                <input type="text" class="form-control @error('no_st_und') is-invalid @enderror"
                                    name="no_st_und" value="{{ old('no_st_und') }}" placeholder="Masukkan No ST/UND">

                                <!-- error message untuk no_st_und -->
                                @error('no_st_und')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
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
