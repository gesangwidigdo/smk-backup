<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paket;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
    public function show()
    {
        $data = Paket::get();
        return Response()->json($data);
    }
    
    public function getById($id)
    {
        $data = Paket::get()->where('id_paket', $id)->first();
        return Response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
            'harga' => 'required'
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $save = Paket::create([
            'jenis' => $request->jenis,
            'harga' => $request->harga,
        ]);

        if ($save) {
            return Response()->json([
                'success' => true,
                'message' => 'Berhasil Menambahkan Data'
            ]);
        } else {
            return Response()->json(['message' => 'Gagal Menambahkan Data']);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
            'harga' => 'required'
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $update = Paket::where('id_paket', $id)->update([
            'jenis' => $request->jenis,
            'harga' => $request->harga
        ]);

        if ($update) {
            return Response()->json([
                'success' => true,
                'message' => 'Berhasil Mengubah Data'
            ]);
        } else {
            return Response()->json(['message' => 'Gagal Mengubah Data']);
        }
    }

    public function delete($id)
    {
        $delete = Paket::where('id_paket', $id)->delete();
        if ($delete) {
            return Response()->json(['message' => 'Berhasil Menghapus Data']);
        } else {
            return Response()->json(['message' => 'Gagal Menghapus Data']);
        }
    }
}
