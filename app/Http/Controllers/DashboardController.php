<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return match (auth()->user()->role->name) {
            'admin'    => redirect()->route('admin.dashboard'),
            'member'   => redirect()->route('member.dashboard'),
            'panitia'  => redirect()->route('panitia.dashboard'),
            'keuangan' => redirect()->route('keuangan.dashboard'),
            default    => abort(403),
        };
    }
}
