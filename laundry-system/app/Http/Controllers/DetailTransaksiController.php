<?php

namespace App\Http\Controllers;
use App\DetailTransaksi;
use App\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use JWTAuth;

class DetailTransaksiController extends Controller
{
    public $users;
    public function __construct()
    {
        $this->users = JWTAuth::parseToken()->authenticate();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required',
            'id_paket' => 'required',
            'qty' => 'required'
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $detail = new DetailTransaksi();
        $detail->id_transaksi = $request->id_transaksi;
        $detail->id_paket = $request->id_paket;

        // GET HARGA PAKET
        $paket = Paket::where('id_paket', '=', $detail->id_paket)->first();
        $harga = $paket->harga;

        $detail->qty = $request->qty;
        $detail->subtotal = $detail->qty * $harga;

        $detail->save();

        $data = DetailTransaksi::where('id_detail_transaksi', $detail->id)->first();
        
        if ($detail) {
            return Response()->json([
                'success' => true,
                'message' => 'Berhasil Menambahkan Detail Transaksi', 
                'data' => $data]);
        } else {
            return Response()->json(['message' => 'Gagal Menambahkan Data']);
        }
    }
    
    public function showAllDetail()
    {
        $detail = DetailTransaksi::get();
        return Response()->json(['data' => $detail]);
    }

    public function showDetailById($id)
    {
        $detail = DB::table('detail_transaksi')->join('paket', 'detail_transaksi.id_paket', 'paket.id_paket')
                                                ->select('detail_transaksi.*', 'paket.jenis')
                                                ->where('detail_transaksi.id_transaksi', '=', $id)
                                                ->get();
        
        return Response()->json(['message' => 'Sukses Menampilkan Data','data' => $detail]);
    }

    public function getTotal($id)
    {
        $total = DetailTransaksi::where('id_transaksi', $id)->sum('subtotal');

        return Response()->json([
            'total' => $total
        ]);
    }
}
