<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Project;
use App\Models\Task;

use App\Services\Midtrans\CreateSnapTokenService;
use App\Services\Midtrans\CallbackService;
use Storage;
use PDF;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        if ($request->ajax()) {
            $data = Project::with(['user', 'order'])
            ->where('order_id', $id)
            ->withCount('task')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) use ($id){
                    $btn = '<a class="btn btn-gd-main btn-sm" href="'. route('user.project.show', ['id' => $id, 'project' => $row->id]).'"><i class="si si-eye me-1"></i>Detail</a>';
                    return $btn; 
                })
                ->editColumn('tgl_training', function ($row) {
                    $tgl_mulai = Carbon::parse($row->tgl_mulai);
                    $tgl_selesai = Carbon::parse($row->tgl_selesai);
                    if($tgl_mulai->eq($tgl_selesai) || $row->tgl_selesai == null){
                        return $tgl_mulai->translatedformat('d M Y');
                    }else{
                        return $tgl_mulai->translatedformat('d') . ' - '. $tgl_selesai->translatedformat('d M Y');
                    }
                })
                ->editColumn('tgl_daftar', function ($row) {
                    $tgl_mulai = Carbon::parse($row->tgl_mulai_daftar);
                    $tgl_selesai = Carbon::parse($row->tgl_selesai_daftar);
                    if($tgl_mulai->eq($tgl_selesai) || $row->tgl_selesai_daftar == null){
                        return $tgl_mulai->translatedformat('d M Y');
                    }else{
                        return $tgl_mulai->translatedformat('d M') . ' - '. $tgl_selesai->translatedformat('d M Y');
                    }
                })
                ->editColumn('status', function ($row) {
                    if($row->status == 'draft'){
                        return '<span class="badge bg-warning">Draft</span>';
                    }else if($row->status == 'buka'){
                        return '<span class="badge bg-primary">Buka</span>';
                    }else{
                        return '<span class="badge bg-danger">Tutup</span>';
                    }
                })
                ->rawColumns(['action', 'status']) 
                ->make(true);
        }
        return view('landing.training.index',[
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $project)
    {
        $user = auth()->guard('web')->user();
        $data = Project::where('id', $project)->first();

        return view('landing.order.project', [
            'data' => $data,
        ]);
    }
    
    public function calendar($id, $project)
    {
        $user = auth()->guard('web')->user();
        $data = Project::where('id', $project)->first();

        return view('landing.order.kalender', [
            'data' => $data,
        ]);
    }
    public function task($id, $project, Request $request)
    {

        if ($request->ajax()) {
            $data = Task::with(['project'])
            ->where('project_id', $project)
            ->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '';
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
                ->editColumn('status_upload', function ($row) {
                    if($row->status_upload == 0){
                        return '<span class="badge bg-danger">Belum Upload</span>';
                    }else{
                        return '<span class="badge bg-success">Sudah Upload</span>';
                    }
                })
                ->rawColumns(['action', 'status', 'harga', 'status_upload']) 
                ->make(true);
        }
        $training = Training::where('status', 'buka')->orderBy('id', 'ASC')->get();
        return view('admin.pembayaran',[
            'training' => $training
        ]);
    }

    
}
