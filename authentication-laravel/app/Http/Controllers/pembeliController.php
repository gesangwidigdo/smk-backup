<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pembeliModel;
use Illuminate\Support\Facades\Validator;

class pembeliController extends Controller
{
    public function insertPembeli(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_pembeli' => 'required',
                'jk_pembeli' => 'required',
                'no_telp' => 'required',
                'alamat' => 'required'
            ]
        );
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $save = pembeliModel::create([
            'nama_pembeli' => $request->nama_pembeli,
            'jk_pembeli' => $request->jk_pembeli,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat
        ]);

        if ($save) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }

    public function updatePembeli(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_pembeli' => 'required',
                'jk_pembeli' => 'required',
                'no_telp' => 'required',
                'alamat' => 'required'
            ]
        );
        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $update = pembeliModel::where('id', $id)->update([
            'nama_pembeli' => $request->nama_pembeli,
            'jk_pembeli' => $request->jk_pembeli,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat
        ]);
        if ($update) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }

    public function deletePembeli($id)
    {
        $delete = pembeliModel::where('id', $id)->delete();
        if ($delete) {
            return Response()->json(['status' => 1]);
        } else {
            return Response()->json(['status' => 0]);
        }
    }
}
