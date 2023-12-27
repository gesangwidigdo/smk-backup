<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaksiModel;
use Illuminate\Support\Facades\Validator;

class transaksiController extends Controller
{
    public function insertTransaksi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_barang' => 'required',
                'id_pembeli' => 'required'
            ]
        );
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $save = transaksiModel::create([
            'id_barang' => $request->id_barang,
            'id_pembeli' => $request->id_pembeli
        ]);
        if ($save) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }

    public function updateTransaksi(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_barang' => 'required',
                'id_pembeli' => 'required'
            ]
        );
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $update = transaksiModel::where('id', $id)->update([
            'id_barang' => $request->id_barang,
            'id_pembeli' => $request->id_pembeli
        ]);
        if ($update) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }

    public function deleteTransaksi($id)
    {
        $delete = transaksiModel::where('id', $id)->delete();
        if ($delete) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
}
