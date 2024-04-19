<?php

namespace App\Http\Controllers;

use App\Exports\Laporan;
use App\Models\AssignTugas;
use App\Models\JenisKendaraan;
use App\Models\ParkirKeluar;
use App\Models\ParkirMasuk;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:dashboard', ['only'=> 'dashboard']);
    }

    public function dashboard(Request $request)
    {
        $data['page_title'] = 'Dashboard';
        $data['breadcumb'] = 'Dashboard';

        // dd(Auth::user()->getRoleNames()[0]);
        if (Auth::user()->tipe != 'Superadmin' && Auth::user()->tipe != 'Kepala Sekolah' &&  Auth::user()->tipe != 'TU Umum') {
            $data['surat_masuk'] = SuratMasuk::where(function($query) {
                    $user = Auth::user();
                    $query->where('id_user', $user->id) // Kondisi jika ID user sama dengan akun saat ini
                        ->orWhere('disposisi_jabatan', $user->jabatan); // Kondisi jika jabatan sama dengan akun saat ini
                })->orderBy('id', 'asc')->get()->count();
        } else {
            if (Auth::user()->tipe == 'Kepala Sekolah') {
                $data['surat_masuk'] = SuratMasuk::whereNotIn('status_surat',[1])->orderby('id', 'asc')->get()->count();
            } else {
                if (Auth::user()->tipe == 'Pegawai') {
                    $data['surat_masuk'] = SuratMasuk::where('disposisi_jabatan',Auth::user()->jabatan)->orderby('id', 'asc')->get()->count();
                } else {
                    $data['surat_masuk'] = SuratMasuk::orderby('id', 'asc')->get()->count();
                }
                
            }
            
        }

        if (Auth::user()->tipe == 'Pegawai') {
            $data['assign_tugas'] = AssignTugas::where('id_pegawai',Auth::user()->id)->orderby('id', 'asc')->get()->count();
        }else{
            $data['assign_tugas'] = AssignTugas::orderby('id', 'asc')->get()->count();
        }
        // dd();

        $data['surat_keluar'] = SuratKeluar::orderby('id', 'asc')->get()->count();
        $data['pegawai'] = User::where('tipe', 'Pegawai')->get()->count();

        return view('dashboard.index', $data);
    }

 
}
