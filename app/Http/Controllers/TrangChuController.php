<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\danhgia;
use App\Models\sanpham;
use App\Models\tintuc;
use App\Models\tuvan;

class TrangChuController extends Controller
{
    public function index()
    {
        $sanphamnoibat = sanpham::where('featured', 1)->limit(4)->get();
        // $danhgia = danhgia::orderBy('id', 'desc')->limit(3)->get();
        $danhgia = danhgia::where('trangthai', 1)
        ->orderBy('id', 'desc')
        ->limit(3)
        ->get();
        $tintuc = tintuc::orderBy('id', 'desc')->limit(6)->get();

        return view('pages.trangchu', compact('sanphamnoibat', 'danhgia', 'tintuc'));
    }

    public function guituvan(Request $request)
    {
        tuvan::create($request->all());
        return redirect()->back();
    }
}
