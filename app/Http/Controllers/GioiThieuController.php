<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GioiThieuController extends Controller
{
    public function thongDiepHieuTruong()
{
    return view('gioi-thieu.thong-diep-hieu-truong');
}
}
