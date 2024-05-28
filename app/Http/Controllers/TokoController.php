<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\toko;

class TokoController extends Controller
{
    public function show()
    {
        $barang = toko::all();
        return response()->json($barang);
    }

    function solo(Request $req)
    {
        // $user = auth("sanctum")->user()->id;
        // $data = toko::where("id_user", $user->id)->get();
        $tas = toko::all();
        return response()->json([
            "message" => "Ini data kamu","data" => $tas
        ]);
        // dd(["message" => "test"]);
    }

    public function add(Request $req)
    {
         $data = toko::create([
            "id_user" => $req->user()->id,
            "nama_barang" => $req->Nama,
            "jumlah_barang" => $req->Jumlah,
            "harga_barang" => $req->Harga
         ]);

         return response()->json([
            "message" => "Data Berhasil Ditambah" , "data" => $data
         ]);
    }

    public function edit(Request $req)
    {
        $barang = toko::find($req->id);
        $barang->id_user = $req->id_user;
        $barang->Nama = $req->Nama;
        $barang->jumlah_barang = $req->Jumalh;
        $barang->harga_barang = $req->Harga;
        $result = $barang->save();
        if($result)
        {
            return ["result" => "Item Has Been Uptaded"];
        }else
        {
            return ["result" => "Yahh Not Can"];
        }
    }

    public function update(Request $request,$id)
    {
        $data = toko::find($id);

        $data->update($request->except('token'));

        return response()->json(['message'=>'data telah di ubah', 'data'=>$data],200);
    }

    function ubah(Request $request,$id)
    {
        $data = toko::find($id);
        $data->Nama = $request->nama_barang;
        $data->Jumlah = $request-> jumlah_barang ;
        $data->Harga = $request-> harga_barang;

        $data->save();

        return response()->json([
            "message" => "data telah diubah"
        ]);
    }



    public function destroy($id)
    {
        $data = toko::findOrFail($id);
        $data->delete();

        return response()->json([
            "message" => "data telah di hapus"
        ]); 
    }
}
