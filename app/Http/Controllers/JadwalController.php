<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import model product
use App\Models\jadwal;
//import return type View
use Illuminate\View\View;
//import return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;




class JadwalController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request): View
    {
        $keyword = $request->input('keyword');

        $jadwals = Jadwal::latest();

        if ($keyword) {
            $jadwals->where('tanggal', 'like', "%$keyword%")
                ->orWhere('hari', 'like', "%$keyword%")
                ->orWhere('tujuan', 'like', "%$keyword%")
                ->orWhere('pemesanan_tiket', 'like', "%$keyword%")
                ->orWhere('pencairan', 'like', "%$keyword%")
                ->orWhere('catatan', 'like', "%$keyword%")
                ->orWhere('no_st_und', 'like', "%$keyword%");
        }

        // // Inisialisasi array kata kunci yang diizinkan
        // $allowedKeywords = ['apapun', 'masalahnya', 'cintaku', 'tetap', 'kamu'];

        // // Ambil nilai pencarian dari input form
        // $keyword = $request->input('keyword');

        // // Inisialisasi query utama untuk mengambil data jadwal
        // $jadwalsQuery = Jadwal::latest();

        // // Periksa apakah kata kunci yang dimasukkan pengguna sesuai dengan yang diizinkan
        // if ($keyword) {
        //     // Jika sesuai, lakukan pencarian sesuai dengan kata kunci tersebut
        //     $jadwalsQuery->where(function ($query) use ($allowedKeywords, $keyword) {
        //         foreach ($allowedKeywords as $allowedKeyword) {
        //             $query->orWhere('tanggal', 'like', "%$keyword%")
        //                 ->orWhere('hari', 'like', "%$keyword%")
        //                 ->orWhere('tujuan', 'like', "%$keyword%")
        //                 ->orWhere('pemesanan_tiket', 'like', "%$keyword%")
        //                 ->orWhere('pencairan', 'like', "%$keyword%")
        //                 ->orWhere('catatan', 'like', "%$keyword%")
        //                 ->orWhere('no_st_und', 'like', "%$keyword%");
        //         }
        //     });
        // }
        $jadwals = $jadwals->paginate(10);

        return view('jadwals.index', compact('jadwals'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('jadwals.create'); // Mengembalikan view untuk menambahkan jadwal
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $request->validate([
            'tanggal'           => 'required|date',
            'hari'              => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tujuan'            => 'required|string',
            'pemesanan_tiket'   => 'required|integer',
            'berkas_pencarian'  => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'pencairan'         => 'required|boolean',
            'catatan'           => 'nullable|string',
            'no_st_und'         => 'nullable|string',
        ]);

        // Handle file upload for berkas_pencarian if provided
        $berkasPencarian = $request->file('berkas_pencarian');
        $namaBerkas = $berkasPencarian->getClientOriginalName();
        $berkasPencarian->storeAs('public/berkas_pencarian', $namaBerkas);


        // Create jadwal
        Jadwal::create([
            'tanggal' => $request->tanggal,
            'hari' => $request->hari,
            'tujuan' => $request->tujuan,
            'pemesanan_tiket' => $request->pemesanan_tiket,
            'berkas_pencarian' => $namaBerkas,
            'pencairan' => $request->pencairan,
            'catatan' => $request->catatan,
            'no_st_und' => $request->no_st_und,
        ]);

        // Redirect to index
        return redirect()->route('jadwals.index')->with(['success' => 'Jadwal berhasil disimpan!']);
    }

    /**
     * Menampilkan detail jadwal.
     *
     * @param  string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id): \Illuminate\View\View
    {
        // Dapatkan jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Tampilkan tampilan dengan jadwal
        return view('jadwals.show', compact('jadwal'));
    }


    /**
     * edit
     *
     * @param  string $id
     * @return View
     */
    public function edit(string $id): View
    {
        // Dapatkan jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Render view dengan jadwal
        return view('jadwals.edit', compact('jadwal'));
    }

    /**
     * update
     *
     * @param  Request $request
     * @param  string  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Dapatkan jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Validasi form
        $request->validate([
            'tanggal'           => 'required',
            'hari'              => 'required',
            'tujuan'            => 'required',
            'pemesanan_tiket'   => 'required',
            'pencairan'         => 'required',
            'catatan'           => 'nullable',
            'no_st_und'         => 'nullable',
            'berkas_pencarian'  => 'nullable|file|mimes:pdf,doc,docx|max:2048', // Move this here
        ]);

        // Handle file upload untuk berkas_pencarian jika diberikan
        if ($request->hasFile('berkas_pencarian')) {
            // Upload berkas baru
            $berkasPencarian = $request->file('berkas_pencarian');
            $namaBerkas = $berkasPencarian->getClientOriginalName();
            $berkasPencarian->storeAs('public/berkas_pencarian', $namaBerkas);

            // Hapus berkas lama jika ada
            if ($jadwal->berkas_pencarian) {
                Storage::delete('public/berkas_pencarian/' . $jadwal->berkas_pencarian);
            }

            // Simpan nama berkas yang baru di database
            $jadwal->update(['berkas_pencarian' => $namaBerkas]);
        }

        // Perbarui jadwal
        $jadwal->update([
            'tanggal'           => $request->tanggal,
            'hari'              => $request->hari,
            'tujuan'            => $request->tujuan,
            'pemesanan_tiket'   => $request->pemesanan_tiket,
            'pencairan'         => $request->pencairan,
            'catatan'           => $request->catatan,
            'no_st_und'         => $request->no_st_und,
        ]);

        // Redirect ke index
        return redirect()->route('jadwals.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Dapatkan jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Hapus berkas pencairan jika ada
        if ($jadwal->berkas_pencarian) {
            Storage::delete('public/berkas_pencarian/' . $jadwal->berkas_pencarian);
        }

        // Hapus jadwal dari database
        $jadwal->delete();

        // Redirect ke index
        return redirect()->route('jadwals.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    /**
     * Menangani tindakan share jadwal ke WhatsApp.
     *
     * @param  string  $id
     * @return RedirectResponse
     */
    public function share($id): RedirectResponse
    {
        // Dapatkan jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($id);

        // Buat pesan WhatsApp dengan data jadwal
        $message = "Assalamualaikum WR.WB.\n Berikut Penjadwalan:\n";
        $message .= "Tanggal: {$jadwal->tanggal}\n";
        $message .= "Hari: {$jadwal->hari}\n";
        $message .= "Tujuan: {$jadwal->tujuan}\n";
        $message .= "Pemesanan Tiket: {$jadwal->pemesanan_tiket}\n";
        $message .= "Pencairan: {$jadwal->pencairan}\n";
        $message .= "Berkas Pencairan: {$jadwal->berkas_pencarian}\n";
        $message .= "Catatan: {$jadwal->catatan}\n";

        // Bagikan pesan ke WhatsApp menggunakan URL schema
        $whatsappUrl = "https://wa.me/?text=" . urlencode($message);

        // Redirect kembali ke halaman sebelumnya atau halaman lain jika perlu
        return Redirect::to($whatsappUrl);
    }
}