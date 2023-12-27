<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\DetailTransaksi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use JWTAuth;

class TransaksiController extends Controller
{
    public $users;

    public function __construct()
    {
        $this->users = JWTAuth::parseToken()->authenticate();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required',
            
        ]);

        if ($validator->fails()) {
            return $this->response->errorResponse($validator->errors());
        }

        $transaksi = new Transaksi();
        $transaksi->id_member = $request->id_member;
        $transaksi->tgl = Carbon::now();
        $transaksi->batas_waktu = Carbon::now()->addDays(3);
        $transaksi->status = 'baru';
        $transaksi->dibayar = 'belum_dibayar';
        $transaksi->id_user = $this->users->id;

        $transaksi->save();

        $data = Transaksi::where('id_transaksi', '=', $transaksi->id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Ditambahkan', 
            'data' => $data
        ]);
    }

    public function showAll()
    {
        $data = DB::table('transaksi')->join('member', 'transaksi.id_member', 'member.id_member')
                ->select('transaksi.*', 'member.nama_member')
                ->orderBy('id_transaksi')
                ->get();

        return Response()->json(['success' => true, 'data' => $data]);
    }

    public function showById($id)
    {
        $data = DB::table('transaksi')->join('member', 'transaksi.id_member', 'member.id_member')
                ->select('transaksi.*', 'member.nama_member')
                ->where('transaksi.id_transaksi', $id)
                ->first();
    
        return Response()->json(['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_member' => 'required'
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $update = Transaksi::where('id_transaksi', $id)->update([
            'id_member' => $request->id_member
        ]);

        if ($update) {
            return Response()->json([
                'success' => true,
                'message' => 'Berhasil Update'
            ]);
        } else {
            return Response()->json(['message' => 'Gagal Update']);
        }
    }

    public function changeStatus($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $statusChanged = Transaksi::where('id_transaksi', $id)->update([
            'status' => $request->status
        ]);

        if ($statusChanged) {
            return Response()->json([
                'success' => true,
                'message' => 'Status berhasil diubah'
            ]);
        } else {
            return Response()->json(['message' => 'Status gagal diubah']);
        }
    }

    public function bayar($id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)->first();
        $total = DetailTransaksi::where('id_transaksi', $id)->sum('subtotal');
        $bayar = Transaksi::where('id_transaksi', $id)->update([
            'tgl_bayar' => Carbon::now(),
            'status' => "diambil",
            'dibayar' => "dibayar",
            'total_bayar' => $total
        ]);

        if ($bayar) {
            return Response()->json([
                'success' => true,
                'message' => 'Pembayaran Berhasil'
            ]);
        } else {
            return Response()->json(['message' => 'Pembayaran Gagal']);
        }
    }

    public function report(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'bulan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $tahun = $request->tahun;
        $bulan = $request->bulan;

        $data = DB::table('transaksi')->join('member', 'transaksi.id_member', '=', 'member.id_member')
                                        ->select('transaksi.id_transaksi', 'transaksi.tgl', 'transaksi.tgl_bayar', 'transaksi.total_bayar', 'member.nama_member')
                                        ->whereYear('tgl', '=', $tahun)
                                        ->whereMonth('tgl', '=', $bulan)
                                        ->get();
        return Response()->json($data);
    }
}
