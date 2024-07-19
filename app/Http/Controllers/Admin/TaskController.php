<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Storage;
use DataTables;

use App\Models\User;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $project_id = $request->project_id;
            $data = Task::with(['project'])
            ->when(isset($project_id), function($q) use($project_id){
                return $q->where('project_id', $project_id);
            })
            ->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<button type="button" class="btn btn-primary btn-sm" onclick="modalShow('. $row->id .')">Detail</a>';
                    return $btn; 
                })
                ->editColumn('tgl_tempo', function ($row) {
                    $tgl =  Carbon::parse($row->tgl_tempo)->translatedFormat('d F Y');
                    return $tgl;
                })
                ->editColumn('tgl_upload', function ($row) {
                    $tgl = Carbon::parse($row->tgl_upload);

                    return $tgl->translatedFormat('d F Y H:i');
                })
                ->editColumn('status', function ($row) {
                    if($row->status == 'belum bayar'){
                        return '<span class="badge bg-danger">Belum Bayar</span>';
                    }else if($row->status == 'sebagian'){
                        return '<span class="badge bg-warning">Sebagian</span>';
                    }else if($row->status == 'pending'){
                        return '<span class="badge bg-primary">Pending</span>';
                    }else if($row->status == 'lunas'){
                        return '<span class="badge bg-success">Lunas</span>';
                    }else if($row->status == 'batal'){
                        return '<span class="badge bg-secondary">Batal</span>';
                    }
                })
                ->rawColumns(['action', 'status', 'harga']) 
                ->make(true);
        }
        $training = Training::where('status', 'buka')->orderBy('id', 'ASC')->get();
        return view('admin.pembayaran',[
            'training' => $training
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'link_brief' => 'required',
            'tgl_tempo' => 'required',
            'tgl_upload' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama tugas harus diisi!',
            'link_brief.required' => 'Link brief harus diisi!',
            'tgl_tempo.required' => 'Tanggal tempo harus diisi!',
            'tgl_upload.required' => 'Tanggal upload harus diisi!',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }else{
            DB::beginTransaction();
            try{
                $data = new Task();
                $data->project_id = $request->project_id;
                $data->nama = $request->nama;
                $data->link_brief = $request->link_brief;
                $data->tgl_tempo = $request->tgl_tempo;
                $data->tgl_upload = $request->tgl_upload;
                $data->status = 'pending';
                $data->status_upload = 0;

                // if($request->file){
                //     $fileName = time() . '.' . $request->file->extension();
                //     Storage::disk('public')->putFileAs('uploads/pembayaran', $request->file, $fileName);
                //     $data->file = '/uploads/task/'.$fileName;
                // }
                $data->save();

            }catch(\QueryException $e){
                DB::rollback();
                return response()->json([
                    'fail' => true,
                    'pesan' => $e,
                ]);
            }

            DB::commit();
            return response()->json([
                'fail' => false,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = UserTraining::with(['user', 'training'])->where('id', $id)->first();
        $harga = ($data->training->harga) ? 'Rp '.number_format($data->training->harga,0,',','.') : 'Gratis';

        $html = '
        <div class="row mb-3">
            <label class="col-sm-4 fw-medium">Peserta</label>
            <div class="col-sm-6">
                : '. $data->user->nama .'
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-4 fw-medium">Training</label>
            <div class="col-sm-6">
                : '. $data->training->nama .'
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-4 fw-medium">Tanggal Bayar</label>
            <div class="col-sm-6">
                : '. Carbon::parse($data->tgl)->translatedFormat('d F Y') .'
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-4 fw-medium">Jumlah Bayar</label>
            <div class="col-sm-6">
                : '.$harga.'
            </div>
        </div>';

        if($data->status == 'pending'){
            $html.= ' <div class="border-top py-3 text-end">
                <button type="button" class="btn btn-alt-danger" data-bs-dismiss="modal" onclick="updateStatus('.$data->id .', `tolak`)">
                    Tolak
                </button>
                <button type="submit" class="btn btn-alt-primary" id="btn-simpan" onclick="updateStatus('.$data->id .', `lunas`)">
                    Konfirmasi
                </button>
            </div>';
        }else{
            $html.= ' <div class="border-top py-3 text-end">
                <button type="button" class="btn btn-alt-danger" data-bs-dismiss="modal" onclick="hapus('.$data->id .')">
                    Hapus
                </button>
            </div>';
        }
        echo $html;
    }

    
    public function status($id, Request $request)
    {
        DB::beginTransaction();
        try{
            $data = UserTraining::where('id', $id)->first();
            $data->status = $request->status;
            $data->save();
        }catch(\QueryException $e){
            DB::rollback();
            return response()->json([
                'fail' => true,
                'pesan' => $e,
            ]);
        }

        DB::commit();
        return response()->json([
            'fail' => false,
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
        $data = Ekskul::where('id', $id)->first();
        $pembina = User::where('level', 'pembina')->orderBy('nama', 'ASC')->get();
        return view('ekskul.edit',[
            'pembina' => $pembina,
            'data' => $data
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
        // dd($request->all());
        $rules = [
            'nama' => 'required',
            'pembina_id' => 'required',
            'deskripsi' => 'required',
            'tempat' => 'required',
            'jadwal' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Wajib Diisi!',
            'pembina_id.required' => 'Pembina Wajib Diisi!',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
            'tempat.required' => 'Tempat Wajib Diisi!',
            'mulai.required' => 'Jam Mulai Wajib Diisi!',
            'selesai.required' => 'Jam Selesai Wajib Diisi!',
        ];


        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return back()->withInput()->withErrors($validator->errors());
        }else{
            DB::beginTransaction();
            try{

                $data = Ekskul::where('id', $id)->first();
                $data->nama = $request->nama;
                $data->pembina_id = $request->pembina_id;
                $data->deskripsi = $request->deskripsi;
                $data->tempat = $request->tempat;
                $data->jadwal = json_encode($request->jadwal);
                $data->mulai = $request->mulai;
                $data->selesai = $request->selesai;
                $data->status = $request->status;
                if($request->foto){
                    if(!empty($data->foto)){
                        $cek = Storage::disk('public')->exists($data->foto);
                        if($cek)
                        {
                            Storage::disk('public')->delete($data->foto);
                        }
                    }
                    $fileName = time() . '.' . $request->foto->extension();
                    Storage::disk('public')->putFileAs('uploads/ekskul', $request->foto, $fileName);
                    $data->foto = '/uploads/ekskul/'.$fileName;
                }
                $data->save();

            }catch(\QueryException $e){
                DB::rollback();
                back()->withInput()->withErrors($validator->errors());
            }

            DB::commit();
            return redirect()->route('ekskul.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perbaikan  $perbaikan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{

            $data = UserTraining::where('id', $id)->first();
            $data->delete();

        }catch(\QueryException $e){
            DB::rollback();
            return response()->json([
                'fail' => true,
                'errors' => $e,
                'pesan' => 'Data Gagal Dihapus!',
            ]);
        }

        DB::commit();
        return response()->json([
            'fail' => false,
            'pesan' => 'Data Berhasil Dihapus!',
        ]);
    }

    public function anggota($id, Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table("anggota_eskul as a")
            ->select('a.*', 'b.nis', 'b.nama', 'b.kelas', 'b.hp', 'b.email', 'b.jk', 'b.alamat', 'c.nama as ekskul')
            ->join("anggota as b", "b.id", "=", "a.anggota_id")
            ->join("ekskul as c", "c.id", "=", "a.ekskul_id")
            ->where('a.ekskul_id', $id)
            ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route('anggota.show', $row->id).'" class="edit btn btn-primary btn-sm">Detail</a>';
                    return $actionBtn;
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->translatedFormat('d F Y');
                })
                ->editColumn('status', function ($row) {
                    if($row->status == 'draft'){
                        return '<span class="badge bg-warning">Menunggu Konfirmasi</span>';
                    }else if($row->status == 'aktif'){
                        return '<span class="badge bg-success">Aktif</span>';
                    }else if($row->status == 'tolak'){
                        return '<span class="badge bg-success">Ditolak</span>';
                    }else{
                        return '<span class="badge bg-secondary">Keluar</span>';
                    }
                })
                ->rawColumns(['action', 'status']) 
                ->make(true);
        }
    }

    
    public function cek(Request $request)
    {
        dd($request->all());
    }

    
    private function getNumber()
    {
        $q = Booking::select(DB::raw('MAX(RIGHT(nomor,5)) AS kd_max'));

        $code = 'BKN/';
        $no = 1;
        date_default_timezone_set('Asia/Jakarta');

        if($q->count() > 0){
            foreach($q->get() as $k){
                return $code . date('ym') .'/'.sprintf("%05s", abs(((int)$k->kd_max) + 1));
            }
        }else{
            return $code . date('ym') .'/'. sprintf("%05s", $no);
        }
    }
}
