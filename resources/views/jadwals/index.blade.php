<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PENJADWALAN KAPUSDATIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: darkgray">

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">JADWAL KAPUSDATIN 2024-2025</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded" style="background: lightgray">
                    <div class="card-body">
                        <a href="{{ route('jadwals.create') }}" class="btn btn-md btn-success mb-3">ADD JADWAL</a>

                        <form class="d-flex mb-5" role="search" action="{{ route('jadwals.index') }}" method="GET">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                name="keyword" value="{{ request('keyword') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">TANGGAL</th>
                                        <th scope="col">HARI</th>
                                        <th scope="col">TUJUAN</th>
                                        <th scope="col">PEMESANAN TIKET</th>
                                        <th scope="col">BERKAS PENCARIAN</th>
                                        <th scope="col">PENCAIRAN</th>
                                        <th scope="col">CATATAN</th>
                                        <th scope="col">NO ST/UND</th>
                                        <th scope="col">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwals as $jadwal)
                                        <tr>
                                            <td style="white-space: nowrap;">{{ $jadwal->tanggal }}</td>
                                            <td style="white-space: nowrap;">{{ $jadwal->hari }}</td>
                                            <td style="white-space: nowrap;">{{ $jadwal->tujuan }}</td>
                                            <td style="white-space: nowrap;">{{ $jadwal->pemesanan_tiket }}</td>
                                            <td style="white-space: nowrap;">
                                                @if ($jadwal->berkas_pencarian)
                                                    <a href="{{ asset('/storage/berkas_pencarian/' . $jadwal->berkas_pencarian) }}"
                                                        download>{{ $jadwal->berkas_pencarian }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="white-space: nowrap;">{{ $jadwal->pencairan }}</td>
                                            <td style="white-space: nowrap;">{{ $jadwal->catatan }}</td>
                                            <td style="white-space: nowrap;">{{ $jadwal->no_st_und }}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('jadwals.destroy', $jadwal->id) }}"
                                                    method="POST">
                                                    <a href="{{ route('jadwals.show', $jadwal->id) }}"
                                                        class="btn btn-sm btn-dark mb-2">SHOW</a>
                                                    <a href="{{ route('jadwals.edit', $jadwal->id) }}"
                                                        class="btn btn-sm btn-primary mb-2">EDIT</a>
                                                    <!-- Add WhatsApp Share -->
                                                    <a href="{{ route('jadwals.share', $jadwal->id) }}"
                                                        class="btn btn-sm btn-success mb-2">SHARE</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger mb-2">HAPUS</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Data Jadwals belum Tersedia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $jadwals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>

</body>

</html>
