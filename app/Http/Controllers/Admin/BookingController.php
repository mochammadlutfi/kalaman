<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Models\Booking;
use App\Models\User;
use App\Models\UserTraining;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::with(['user'])
            ->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<div class="dropdown">
                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" id="dropdown-default-outline-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                        </button>
                        <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-outline-primary" style="">';
                        $btn .= '<a class="dropdown-item" href="'. route('admin.booking.show', $row->id).'"><i class="si si-eye me-1"></i>Detail</a>';
                        $btn .= '<a class="dropdown-item" href="'. route('admin.booking.edit', $row->id).'"><i class="si si-note me-1"></i>Ubah</a>';
                        $btn .= '<a class="dropdown-item" href="javascript:void(0)" onclick="hapus('. $row->id.')"><i class="si si-trash me-1"></i>Hapus</a>';
                    $btn .= '</div></div>';
                    return $btn; 
                })
                ->editColumn('tgl', function ($row) {
                    $tgl =  Carbon::parse($row->tgl)->translatedFormat('d F Y');

                    return $tgl . '<br>' . $row->mulai . " - " . $row->selesai .' WIB';
                })
                ->editColumn('status', function ($row) {
                    if($row->status == 'belum bayar'){
                        return '<span class="badge bg-danger">Belum Bayar</span>';
                    }else if($row->status == 'sebagian'){
                        return '<span class="badge bg-warning">Sebagian</span>';
                    }else if($row->status == 'pending'){
                        return '<span class="badge bg-primary">Menunggu Konfirmasi</span>';
                    }else if($row->status == 'lunas'){
                        return '<span class="badge bg-success">Lunas</span>';
                    }else if($row->status == 'batal'){
                        return '<span class="badge bg-secondary">Batal</span>';
                    }
                })
                ->rawColumns(['action', 'tgl', 'status']) 
                ->make(true);
        }

        return view('admin.booking.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah()
    {
        $pelanggan = User::latest()->get();

        return view('admin.booking.form',[
            'pelanggan' => $pelanggan 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan(Request $request)
    {
        $rules = [
            'nis' => 'required|numeric|unique:anggota,nis',
            'nama' => 'required|string',
            'jk' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
        ];

        $pesan = [
            'nis.required' => 'NIS Wajib Diisi!',
            'nis.numeric' => 'NIS Hanya Boleh Angka!',
            'nis.unique' => 'NIS Sudah Terdaftar!',
            'nama.required' => 'Nama Lengkap Wajib Diisi!',
            'jk.required' => 'Bidang Wajib Diisi!',
            'kelas.required' => 'Kelas Wajib Diisi!',
            'alamat.required' => 'Alamat Wajib Diisi!',
        ];


        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            DB::beginTransaction();
            try{

                $data = new Anggota();
                $data->nis = $request->nis;
                $data->nama = $request->nama;
                $data->jk = $request->jk;
                $data->kelas = $request->kelas;
                $data->hp = $request->hp;
                $data->email = $request->email;
                $data->alamat = $request->alamat;
                $data->status = 'aktif';
                $data->ekskul_id = $request->ekskul_id;
                $data->save();

            }catch(\QueryException $e){
                DB::rollback();
                return response()->json([
                    'fail' => true,
                    'errors' => $e,
                    'pesan' => 'Error Menyimpan Data Anggota',
                ]);
            }

            DB::commit();
            return redirect()->route('anggota.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data = Booking::with('user')
        ->withSum([ 'bayar' => fn ($query) => $query->where('status', 'setuju')], 'jumlah')
        ->where('id', $id)
        ->first();
        // dd($data);

        return view('admin.booking.detail',[
            'data' => $data,
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Anggota::where('id', $id)->first();
        $ekskul = Ekskul::orderBy('nama', 'ASC')->get();
        return view('anggota.edit',[
            'data' => $data,
            'ekskul' => $ekskul
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nis' => 'required|numeric|unique:anggota,nis',
            'nama' => 'required|string',
            'jk' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
        ];

        $pesan = [
            'nis.required' => 'NIS Wajib Diisi!',
            'nis.numeric' => 'NIS Hanya Boleh Angka!',
            'nis.unique' => 'NIS Sudah Terdaftar!',
            'nama.required' => 'Nama Lengkap Wajib Diisi!',
            'jk.required' => 'Bidang Wajib Diisi!',
            'kelas.required' => 'Kelas Wajib Diisi!',
            'alamat.required' => 'Alamat Wajib Diisi!',
        ];


        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            DB::beginTransaction();
            try{

                $data = Anggota::where('id', $id)->first();
                $data->nis = $request->nis;
                $data->nama = $request->nama;
                $data->jk = $request->jk;
                $data->kelas = $request->kelas;
                $data->hp = $request->hp;
                $data->email = $request->email;
                $data->alamat = $request->alamat;
                $data->status = 'aktif';
                $data->ekskul_id = $request->ekskul_id;
                $data->save();

            }catch(\QueryException $e){
                DB::rollback();
                return response()->json([
                    'fail' => true,
                    'errors' => $e,
                    'pesan' => 'Error Menyimpan Data Anggota',
                ]);
            }

            DB::commit();
            if($request->level_id > 2){
                return back()->withErrors($validator->errors());
            }

            return redirect()->route('anggota.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{

            $data = Anggota::where('id', $id)->first();
            $data->delete();

        }catch(\QueryException $e){
            DB::rollback();
            return response()->json([
                'fail' => true,
                'errors' => $e,
                'pesan' => 'Gagal Hapus Data!',
            ]);
        }

        DB::commit();
        return response()->json([
            'fail' => false,
            'pesan' => 'Berhasil Hapus Data!',
        ]);
    }

    public function cek(Request $request)
    {
        dd($request->all());
    }
}
