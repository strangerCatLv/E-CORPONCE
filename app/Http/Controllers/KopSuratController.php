<?php

namespace App\Http\Controllers;

use App\Models\KopSurat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KopSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Kop Surat';
        $data['breadcumb'] = 'Kop Surat';
        $data['kop'] = KopSurat::first();

        return view('kop_surat.index', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KopSurat  $kopSurat
     * @return \Illuminate\Http\Response
     */
    public function show(KopSurat $kopSurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KopSurat  $kopSurat
     * @return \Illuminate\Http\Response
     */
    public function edit(KopSurat $kopSurat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KopSurat  $kopSurat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $kop = KopSurat::first();
                if ($kop != null) {
                    $data = KopSurat::find($kop->id);
                } else {
                    $data = new KopSurat();
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
                
                return redirect()->route('kop-surat')->with(['success' => 'Kop Surat update successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Surat Masuk failed updated successfully!');
            return redirect()->to('kop-surat');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KopSurat  $kopSurat
     * @return \Illuminate\Http\Response
     */
    public function destroy(KopSurat $kopSurat)
    {
        //
    }
}
