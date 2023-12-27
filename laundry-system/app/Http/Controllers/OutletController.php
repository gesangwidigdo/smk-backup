<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Outlet;
use JWTAuth;

class OutletController extends Controller
{
    public $users;
    public function __construct()
    {
        $this->users = JWTAuth::parseToken()->authenticate();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_outlet' => 'required',
            'alamat' => 'required'
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $save = Outlet::create([
            'nama_outlet' => $request->nama_outlet,
            'alamat' => $request->alamat
        ]);

        $data = Outlet::where('id_outlet', $save->id)->first();

        return Response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditambahkan',
            'data' => $data
        ]);
    }

    public function getAll($limit = NULL, $offset = NULL)
    {
        $data = Outlet::get();
        return Response()->json(['data' => $data]);
    }

    public function getById($id)
    {
        $data = Outlet::where('id_outlet', $id)->first();

        return Response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_outlet' => 'required',
            'alamat' => 'required'
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $update = Outlet::where('id_outlet', $id)->update([
            'nama_outlet' => $request->nama_outlet,
            'alamat' => $request->alamat
        ]);

        if ($update) {
            return Response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diupdate'
            ]);
        } else {
            return Response()->json([
                'success' => false,
                'message' => 'Data Gagal Diupdate'
            ]);
        }
    }

    public function delete($id)
    {
        $delete = Outlet::where('id_outlet', $id)->delete();

        if ($delete) {
            return Response()->json([
                'success' => true,
                'message' => 'Data Berhasil Dihapus'
            ]);
        } else {
            return Response()->json([
                'success' => false,
                'message' => 'Data Gagal Dihapus'
            ]);
        }
    }
}
