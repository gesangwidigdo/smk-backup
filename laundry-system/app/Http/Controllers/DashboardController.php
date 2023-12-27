<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $member = Member::count();
        $baru = Transaksi::where('status', '=', 'baru')->count();
        $proses = Transaksi::where('status', '=', 'proses')->count();
        $pendapatan = Transaksi::where('dibayar', '=', 'dibayar')->sum('total_bayar');
        $thisMonth = Carbon::now()->month;
        $pendapatan_bulanan = Transaksi::where('dibayar', '=', 'dibayar')->whereMonth('tgl', '=', $thisMonth)->sum('total_bayar');
        

        return Response()->json([
            'member' => $member,
            'baru' => $baru,
            'proses' => $proses,
            'pendapatan' => $pendapatan,
            'pendapatan_bulanan' => $pendapatan_bulanan
        ]);
    }
}
