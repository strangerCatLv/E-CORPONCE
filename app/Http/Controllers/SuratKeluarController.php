<?php

namespace App\Http\Controllers;

use App\Models\AssignTugas;
use App\Models\KopSurat;
use App\Models\KopSuratKeluar;
use App\Models\SuratKeluar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'List Surat Keluar';
        $data['breadcumb'] = 'List Surat Keluar';
        if (Auth::user()->tipe == 'Pegawai') {
            $assign_tugas = AssignTugas::where('id_pegawai',Auth::user()->id)->get()->pluck('id_surat_keluar');
            $data['surat_keluar'] = SuratKeluar::whereIn('id',$assign_tugas)->orderby('id', 'asc')->get();
        }else{
            $data['surat_keluar'] = SuratKeluar::orderby('id', 'asc')->get();
        }
        // dd($data);

        $data['pegawai'] = User::whereNotIn('tipe',['Superadmin'])->where('jabatan','!=','')->get();
        return view('surat_keluar.index', $data);
    }
    public function laporan(Request $request)
    {
        $data['page_title'] = 'Laporan Surat Keluar';
        $data['breadcumb'] = 'Laporan Surat Keluar';
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if ( $start_date != null &&  $end_date != null) {
            $data['surat_keluar'] = SuratKeluar::whereBetween('tgl_surat',[$start_date,$end_date])->orderby('id', 'asc')->get();
        } else {
            $data['surat_keluar'] = SuratKeluar::orderby('id', 'asc')->get();
        }

        return view('surat_keluar.laporan', $data);
    }
    public function Printlaporan(Request $request)
    {
        $data['page_title'] = 'Laporan Surat Keluar';
        $data['breadcumb'] = 'Laporan Surat Keluar';
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if ( $start_date != null &&  $end_date != null) {
            $data['surat_keluar'] = SuratKeluar::whereBetween('tgl_surat',[$start_date,$end_date])->orderby('id', 'asc')->get();
        } else {
            $data['surat_keluar'] = SuratKeluar::orderby('id', 'asc')->get();
        }

        $data['kop'] = KopSurat::first();


        return view('surat_keluar.print_laporan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Create Surat Keluar';
        $data['breadcumb'] = 'Create Surat Keluar';

        return view('surat_keluar.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $data = new SuratKeluar();
            $data->judul = $request->judul;
            $data->tgl_surat = $request->tgl_surat;
            $data->jenis = $request->jenis;
            $data->no_awal = $request->no_awal;
            $data->no_urut_sementara = $request->no_urut_sementara;
            $data->no_surat = $request->no_surat;
            $data->lampiran = $request->lampiran;
            $data->sifat = $request->sifat;
            $data->kepada = $request->kepada;
            $data->tembusan = $request->tembusan;
            $data->isi_surat = $request->editor;
            $data->untuk = $request->untuk;
            $data->hari = $request->hari;
            $data->tanggal = $request->tanggal;
            $data->waktu = $request->waktu;
            $data->tempat = $request->tempat;
            $data->alamat = $request->alamat;
            $data->catatan = $request->catatan;
            $data->status_surat = 1;
            $data->save();
            return redirect()->route('surat-keluar')->with(['success' => 'Surat Keluar added successfully!']);

        } catch (\Throwable $th) {
            dd($th->getMessage());
            Alert::error('Failed', 'Surat Keluar failed added!');
            return redirect()->back();
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $data = SuratKeluar::find($id);
            $data->judul = $request->judul;
            $data->tgl_surat = $request->tgl_surat;
            $data->jenis = $request->jenis;
            $data->no_awal = $request->no_awal;
            $data->no_urut_sementara = $request->no_urut_sementara;
            $data->no_surat = $request->no_surat;
            $data->lampiran = $request->lampiran;
            $data->sifat = $request->sifat;
            $data->kepada = $request->kepada;
            $data->tembusan = $request->tembusan;
            $data->isi_surat = $request->editor;
            $data->save();
            return redirect()->route('surat-keluar')->with(['success' => 'Surat Keluar updated successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Surat Keluar failed updated!');
            return redirect()->back();
        }
    }
    public function terbit($id)
    {
        try {
            $data = SuratKeluar::find($id);
            $data->status_surat = 2;
            $data->save();
            return redirect()->route('surat-keluar')->with(['success' => 'Surat Keluar terbit successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Surat Keluar failed terbit!');
            return redirect()->back();
        }
    }
    public function hapus($id)
    {
        try {
            $data = SuratKeluar::find($id);
            $data->delete();
            return redirect()->route('surat-keluar')->with(['success' => 'Surat Keluar deleted successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Surat Keluar failed deleted!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Surat Keluar';
        $data['breadcumb'] = 'Edit Surat Keluar';
        $data['surat_keluar'] = SuratKeluar::find($id);

        return view('surat_keluar.edit', $data);
    }
    public function print($id)
    {
        $data['page_title'] = 'Print Surat Keluar';
        $data['breadcumb'] = 'Print Surat Keluar';
        $data['surat_keluar'] = SuratKeluar::find($id);
        $data['kop'] = KopSuratKeluar::first();


        return view('surat_keluar.print', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = SuratKeluar::find($id);

            if ($data->delete()) {
                return redirect()->route('surat-keluar')->with(['success' => 'Berhasil dihapus!']);
            }else{
                Alert::error('Failed', 'Gagal dihapus!');
                return redirect()->back();
            }

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Gagal dihapus!');
            return redirect()->back();
        }
    }
}
