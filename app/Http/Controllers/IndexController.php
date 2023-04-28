<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $req)
    {
        $resPeg = Http::get('http://127.0.0.1:8001/api/pegawai/');
        $dataPegawai = collect(json_decode(json_encode($resPeg->json()['data']),true));

        $resKon = Http::get('http://127.0.0.1:8001/api/kontrak/');
        $dataKontrak = collect(json_decode(json_encode($resKon->json()['data']),true));

        $resJab = Http::get('http://127.0.0.1:8001/api/jabatan/');
        $dataJabatan= collect(json_decode(json_encode($resJab->json()['data']),true));
        
        return view('pages.index', compact('dataPegawai','dataKontrak','dataJabatan'));
    }
}
