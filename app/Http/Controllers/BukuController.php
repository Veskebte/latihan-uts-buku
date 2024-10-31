<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::all();
        $data['success'] = true;
        $data['result'] = $bukus;
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'isbn' => 'required',
            'judul' => 'required',
            'penulis' => 'required',
            'genre' => 'required'
        ]);

        $buku = Buku::create($validate);
        if ($buku) {
            $response['success'] = true;
            $response['message'] = 'Buku berhasil ditambahkan.';
            return response()->json($response, Response::HTTP_CREATED);
        } else {
            $response['success'] = false;
            $response['message'] = 'Gagal menambahkan buku.';
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            $response['success'] = true;
            $response['result'] = $buku;
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Buku tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'isbn' => 'required|string',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'genre' => 'required|string'
        ]);

        $buku = Buku::where('id', $id)->update($validate);
        if ($buku) {
            $response['success'] = true;
            $response['message'] = 'Buku berhasil diperbarui.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Buku tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::where('id', $id);
        if ($buku->exists()) {
            $buku->delete();
            $response['success'] = true;
            $response['message'] = 'Buku berhasil dihapus.';
            return response()->json($response, Response::HTTP_OK);
        } else {
            $response['success'] = false;
            $response['message'] = 'Buku tidak ditemukan.';
            return response()->json($response, Response::HTTP_NOT_FOUND);
        }
    }
}
