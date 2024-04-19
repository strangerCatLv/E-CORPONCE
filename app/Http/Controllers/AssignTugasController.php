<?php

namespace App\Http\Controllers;

use App\Models\AssignTugas;
use App\Models\SuratKeluar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AssignTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['page_title'] = 'Assign Tugas';
        $data['breadcumb'] = 'Assign Tugas';
        if ($request->assign == null) {
            if (Auth::user()->tipe == 'Pegawai') {
                $data['assign_tugas'] = AssignTugas::where('id_pegawai',Auth::user()->id)->orderBy('created_at','desc')->get();
            }else{
                $data['assign_tugas'] = AssignTugas::orderBy('created_at','desc')->get();
            }
        }else{
            if (Auth::user()->tipe == 'Pegawai') {
                $data['assign_tugas'] = AssignTugas::where('id_surat_keluar',$request->assign)->where('id_pegawai',Auth::user()->id)->orderBy('created_at','desc')->get();
            }else{
                $data['assign_tugas'] = AssignTugas::where('id_surat_keluar',$request->assign)->orderBy('created_at','desc')->get();
            }
        }
        $data['pegawai'] = User::whereNotIn('tipe',['Superadmin'])->where('jabatan','!=','')->get();
        $data['surat_keluar'] = SuratKeluar::orderby('id', 'asc')->get();

        return view('assign_tugas.index', $data);
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
        try {
            foreach ($request->id_pegawai as $key => $value) {
                $data = new AssignTugas();
                $data->id_pegawai = $value;
                $data->id_surat_keluar = $request->id_surat_keluar;
                $data->save();
            }
            return redirect()->back()->with(['success' => 'Assign tugas added successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Assign tugas failed added!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignTugas  $assignTugas
     * @return \Illuminate\Http\Response
     */
    public function show(AssignTugas $assignTugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignTugas  $assignTugas
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignTugas $assignTugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignTugas  $assignTugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = AssignTugas::find($id);
            $data->id_pegawai = $request->id_pegawai;
            $data->id_surat_keluar = $request->id_surat_keluar;
            $data->save();
            return redirect()->back()->with(['success' => 'Assign tugas edited successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Assign tugas failed edited!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignTugas  $assignTugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = AssignTugas::find($id);
            $data->delete();
            return redirect()->back()->with(['success' => 'Assign tugas deleted successfully!']);

        } catch (\Throwable $th) {
            Alert::error('Failed', 'Assign tugas failed deleted!');
            return redirect()->back();
        }
    }
}
