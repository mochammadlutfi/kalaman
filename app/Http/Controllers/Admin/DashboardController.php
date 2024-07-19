<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Training;
use App\Models\Payment;

use Carbon\Carbon;
class DashboardController extends Controller
{

    public function index(){
        $user = auth()->user();
        $ovr = Collect([
            // 'training' => Training::get()->count(),
            // 'user' => User::get()->count(),
            // 'pembayaran' => Payment::get()->count(),
        ]);

        // $now = Carbon::today();
        // $berlangsung = Training::
        // withCount('user')->where('tgl_mulai', '>=', $now)->get();

        return view('admin.dashboard',[
            // 'ovr' => $ovr,
            // 'berlangsung' => $berlangsung 
        ]);
    }
}
