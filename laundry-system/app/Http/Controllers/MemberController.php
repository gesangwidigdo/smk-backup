<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function showAll()
    {
        $data = Member::get();
        return Response()->json(['data' => $data]);
    }

    public function getById($id)
    {
        $data = Member::get()->where('id_member', $id)->first();

        return Response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request-> all(), [
            'nama_member' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'no_tlp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $save = Member::create([
            'nama_member' => $request->nama_member,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_tlp' => $request->no_tlp,
        ]);

        $data = Member::where('id_member', '=', $save->id)->first();

        if ($save) {
            return Response()->json([
                'success' => true,
                'message' => 'Berhasil Menambahkan Data', 
                'data' => $data
            ]);
        } else {
            return Response()->json(['message' => 'Gagal Ditambahkan']);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_member' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'no_tlp' => 'required|string'
        ]);

        if ($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $update = Member::where('id_member', $id)->update([
            'nama_member' => $request->nama_member,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_tlp' => $request->no_tlp
        ]);

        if ($update) {
            return Response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diupdate'
            ]);
        } else {
            return Response()->json(['message' => 'Gagal Update']);
        }
        
    }

    public function delete($id)
    {
        $delete = Member::where('id_member', $id)->delete();

        if ($delete) {
            return Response()->json(['message' => 'Berhasil Menghapus Data']);
        } else {
            return Response()->json(['message' => 'Gagal Menghapus Data']);  
        }
    }
}
