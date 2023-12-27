<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barangModel;
use Illuminate\Support\Facades\Validator;

class barangController extends Controller
{
    public function insertBarang(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_barang' => 'required',
                'harga' => 'required',
                'stok' => 'required'
            ]
        );
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $save = barangModel::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok
        ]);

        if ($save) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }

    public function updateBarang(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_barang' => 'required',
                'harga' => 'required',
                'stok' => 'required'
            ]
        );
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $update = barangModel::where('id', $id)->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok
        ]);
        if ($update) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }

    public function deleteBarang($id)
    {
        $delete = barangModel::where('id', $id)->delete();
        if ($delete) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
}
