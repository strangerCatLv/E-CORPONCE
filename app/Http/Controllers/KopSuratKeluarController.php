<?php

namespace App\Http\Controllers;

use App\Models\KopSuratKeluar;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KopSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Kop Surat Keluar';
        $data['breadcumb'] = 'Kop Surat Keluar';
        $data['kop'] = KopSuratKeluar::first();

        return view('kop_surat_keluar.index', $data);
    }

    public function update(Request $request)
    {
        try {
            $kop = KopSuratKeluar::first();
                if ($kop != null) {
                    $data = KopSuratKeluar::find($kop->id);
                } else {
                    $data = new KopSuratKeluar();
                }
        
                $data->nama_sekolah = $request->nama_sekolah;
                $data->website = $request->website;
                $data->email = $request->email;
                $data->telp = $request->telp;
                $data->kepala_sekolah = $request->kepala_sekolah;
                $data->nip_kepala_sekolah = $request->nip_kepala_sekolah;
                $data->alamat = $request->alamat;
    
                if ($request->hasFile('logo_sekolah')) {
                    $image = $request->file('logo_sekolah');
                    $name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('img/kop_surat/');
                    $image->move($destinationPath, $name);
                    $data->logo = $name;
                }
                $data->save();
                
                return redirect()->route('kop-surat-keluar')->with(['success' => 'Kop Surat update successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Surat Masuk failed updated successfully!');
            return redirect()->to('kop-surat');
        }
    }
}
