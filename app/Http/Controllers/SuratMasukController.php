<?php

namespace App\Http\Controllers;

use App\Models\DisposisiPegawai;
use App\Models\KopSurat;
use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'List Surat Masuk';
        $data['breadcumb'] = 'List Surat Masuk';

        if (Auth::user()->tipe != 'Superadmin' && Auth::user()->tipe != 'Kepala Sekolah' &&  Auth::user()->tipe != 'TU Umum') {
            $data['surat_masuk'] = SuratMasuk::where(function($query) {
                    $user = Auth::user();
                    $query->where('id_user', $user->id) // Kondisi jika ID user sama dengan akun saat ini
                        ->orWhere('disposisi_jabatan', $user->jabatan); // Kondisi jika jabatan sama dengan akun saat ini
                })->orderBy('id', 'asc')->get();
        } else {
            if (Auth::user()->tipe == 'Kepala Sekolah') {
                $data['surat_masuk'] = SuratMasuk::whereNotIn('status_surat',[1])->orderby('id', 'asc')->get();
            } else {
                if (Auth::user()->tipe == 'Pegawai') {
                    $data['surat_masuk'] = SuratMasuk::where('disposisi_jabatan',Auth::user()->jabatan)->orderby('id', 'asc')->get();
                } else {
                    $data['surat_masuk'] = SuratMasuk::orderby('id', 'asc')->get();
                }
                
            }
            
        }
        
        $data['roles'] = Role::whereNotIn('name',['Superadmin'])->pluck('name')->all();
        $data['pegawai'] = User::whereNotIn('tipe',['Superadmin'])->where('jabatan','!=','')->get();

        return view('surat_masuk.index', $data);
    }
    public function laporan(Request $request)
    {
        $data['page_title'] = 'Laporan Surat Masuk';
        $data['breadcumb'] = 'Laporan Surat Masuk';
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if ( $start_date != null &&  $end_date != null) {
            $data['surat_masuk'] = SuratMasuk::whereBetween('tgl_surat',[$start_date,$end_date])->orderby('id', 'asc')->get();
        } else {
            $data['surat_masuk'] = SuratMasuk::orderby('id', 'asc')->get();
        }
        
        $data['roles'] = Role::whereNotIn('name',['Superadmin'])->pluck('name')->all();
        $data['pegawai'] = User::whereNotIn('tipe',['Superadmin'])->get();

        return view('surat_masuk.laporan', $data);
    }
    public function Printlaporan(Request $request)
    {
        $data['page_title'] = 'Laporan Surat Masuk';
        $data['breadcumb'] = 'Laporan Surat Masuk';
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if ( $start_date != null &&  $end_date != null) {
            $data['surat_masuk'] = SuratMasuk::whereBetween('tgl_surat',[$start_date,$end_date])->orderby('id', 'asc')->get();
        } else {
            $data['surat_masuk'] = SuratMasuk::orderby('id', 'asc')->get();
        }
        
        $data['roles'] = Role::whereNotIn('name',['Superadmin'])->pluck('name')->all();
        $data['pegawai'] = User::whereNotIn('tipe',['Superadmin'])->get();
        $data['kop'] = KopSurat::first();

        return view('surat_masuk.print_laporan', $data);
    }
    public function indexDisposisi()
    {
        $data['page_title'] = 'List Surat Disposisi';
        $data['breadcumb'] = 'List Surat Disposisi';
        // $data['surat_masuk'] = SuratMasuk::where('status_surat',5)->orderby('id', 'asc')->get();

        if (Auth::user()->tipe != 'Superadmin' && Auth::user()->tipe != 'Kepala Sekolah' &&  Auth::user()->tipe != 'TU Umum') {
            $data['surat_masuk'] = SuratMasuk::where('status_surat',5)->where(function($query) {
                    $user = Auth::user();
                    $query->where('id_user', $user->id) // Kondisi jika ID user sama dengan akun saat ini
                        ->orWhere('disposisi_jabatan', $user->jabatan); // Kondisi jika jabatan sama dengan akun saat ini
                })->orderBy('id', 'asc')->get();
        } else {
            if (Auth::user()->tipe == 'Kepala Sekolah') {
                $data['surat_masuk'] = SuratMasuk::where('status_surat',5)->whereNotIn('status_surat',[1])->orderby('id', 'asc')->get();
            } else {
                if (Auth::user()->tipe == 'Pegawai') {
                    $data['surat_masuk'] = SuratMasuk::where('status_surat',5)->where('disposisi_jabatan',Auth::user()->jabatan)->orderby('id', 'asc')->get();
                } else {
                    $data['surat_masuk'] = SuratMasuk::where('status_surat',5)->orderby('id', 'asc')->get();
                }
                
            }
            
        }
        
        $data['roles'] = Role::whereNotIn('name',['Superadmin'])->pluck('name')->all();
        $data['pegawai'] = User::whereNotIn('tipe',['Superadmin'])->get();

        return view('disposisi.index', $data);
    }
    public function printDisposisi($id)
    {
        $data['page_title'] = 'List Surat Disposisi';
        $data['breadcumb'] = 'List Surat Disposisi';
        $data['surat_masuk'] = SuratMasuk::find($id);

        return view('disposisi.print', $data);
    }
    public function printDisposisiV2($id)
    {
        $data['page_title'] = 'List Surat Disposisi';
        $data['breadcumb'] = 'List Surat Disposisi';
        $data['surat_masuk'] = SuratMasuk::find($id);
        $data['kop'] = KopSurat::first();

        return view('disposisi.print-v2', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new SuratMasuk();
        $data->no_surat = $request->no_surat;
        $data->instansi_pengirim = $request->instansi_pengirim;
        $data->tgl_surat = $request->tgl_surat;
        $data->diterima_tgl = $request->diterima_tgl;
        $data->no_agenda = $request->no_agenda;
        $data->klasifikasi = $request->klasifikasi;
        $data->perihal = $request->perihal;
        $data->lampiran = $request->lampiran;
        $data->status = $request->status;
        $data->sifat = $request->sifat;
        $data->status_surat = 1;
        $data->id_user = Auth::user()->id;

        // upload document 
        $dokumenval = $request->file;

        $documentLaporanPath = public_path('documents/document-surat/');
        $documentSurat = $dokumenval->getClientOriginalName();
        $i = 1;
        while (file_exists($documentLaporanPath . $documentSurat)) {
            $documentSurat = pathinfo($dokumenval->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenval->getClientOriginalExtension();
            $i++;
        }
        $dokumenval->move($documentLaporanPath, $documentSurat);
        $data->file = $documentSurat;
        if ($data->save()) {
                return redirect()->route('surat-masuk')->with(['success' => 'Surat Masuk added successfully!']);
        } else {
            Alert::error('Failed', 'Surat Masuk failed added successfully!');
            return redirect()->to('surat-masuk');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = SuratMasuk::find($id);
            if ($request->tindakan == 'Ajukan') {
                $data->tindakan = $request->tindakan;
                $data->tgl_ajuan = $request->tgl_ajuan;
            } else {
                $data->tindakan = $request->tindakan;
                $data->tgl_ajuan = $request->tgl_ajuan;
            }
            $data->catatan = $request->catatan;
            $data->catatan_penolakan = null;
            $data->status_surat = 3;
            $data->save();
            
            return redirect()->route('surat-masuk')->with(['success' => 'Surat Masuk update successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Surat Masuk failed updated successfully!');
            return redirect()->to('surat-masuk');
        }
    }
    public function verifikasi(Request $request, $id)
    {
        try {
            $data = SuratMasuk::find($id);
            if ($request->catatan_penolakan != null) {
                $data->catatan_penolakan = $request->catatan_penolakan;
                $data->status_surat = 1;
            } else {
                $data->catatan_penolakan = null;
                $data->disposisi_jabatan = $request->disposisi_jabatan;
                $data->catatan_tindak_lanjut = $request->catatan_tindak_lanjut;
                $data->tindakan_segera = $request->tindakan_segera;
                $data->tindakan_biasa = $request->tindakan_biasa;
                $data->status_surat = 4;
            }
            $data->save();
            
            return redirect()->route('surat-masuk')->with(['success' => 'Surat Masuk update successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Surat Masuk failed updated successfully!');
            return redirect()->to('surat-masuk');
        }
    }
    public function disposisi(Request $request, $id)
    {
        // dd($request->all());
        try {
            $data = SuratMasuk::find($id);
            $data->tgl_disposisi = $request->tgl_disposisi;
            $data->catatan_disposisi = $request->catatan_disposisi;
            $data->kepala_konsentrasi_keahlian = $request->kepala_konsentrasi_keahlian;
            $data->disposisi_jabatan = $request->jabatan;
            $data->intruksi = $request->intruksi;
            $data->status_surat = 5;
            $data->save();

            if ($request->id_pegawai_disposisi != null ) {
                foreach ($request->id_pegawai_disposisi as $value) {
                   $newDetail = new DisposisiPegawai();
                   $newDetail->id_surat = $data->id;
                   $newDetail->id_pegawai = $value;
                   $newDetail->save();
                }
            }
            
            return redirect()->route('surat-masuk')->with(['success' => 'Disposisi Surat Masuk successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Disposisi Surat Masuk failed!');
            return redirect()->to('surat-masuk');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = SuratMasuk::find($id);

            $cek = DisposisiPegawai::where('id_surat',$data->id)->get();

            if (count($cek) != 0 ) {
                foreach ($cek as $value) {
                   $newDetail = DisposisiPegawai::find($value->id);
                   $newDetail->delete();
                }
            }

            $data->delete();

            
            return redirect()->route('surat-masuk')->with(['success' => 'Berhasil dihapus!']);
        } catch (\Throwable $th) {
            Alert::error('Failed', 'Disposisi Surat Masuk failed!');
            return redirect()->to('surat-masuk');
        }
    }
}
