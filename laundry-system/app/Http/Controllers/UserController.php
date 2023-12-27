<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'username' => 'required',
            'password' => 'required|min:6',
            'role' => 'required',
            'id_outlet' => 'required',
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $user = new User();
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->id_outlet = $request->id_outlet;

        $user->save();

        return Response()->json([
            'success' => true,
            'message' => 'Berhasil Mendaftar'
        ]);
    }

    public function getAll()
    {
        $data = DB::table('users')->join('outlet', 'users.id_outlet', 'outlet.id_outlet')
                                    ->select('users.*', 'outlet.*')
                                    ->get();
        return Response()->json(['data' => $data]);
    }

    public function getById($id)
    {
        $data = DB::table('users')->join('outlet', 'users.id_outlet', 'outlet.id_outlet')
                                    ->select('users.nama', 'users.username', 'users.role', 'outlet.*')
                                    ->where('users.id', '=', $id)
                                    ->first();

        return Response()->json([
            'message' => 'Sukses Menampilkan Data',
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'nama' => 'required',
            'id_outlet' => 'required',
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $user = User::where('id', $id)->first();

        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->id_outlet = $request->id_outlet;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return Response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah'
        ]);
    }

    public function delete($id)
    {
        $user = User::where('id', '=', $id)->delete();

        if ($user) {
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
