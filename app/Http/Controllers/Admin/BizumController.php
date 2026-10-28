<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bizum;
use Illuminate\Http\Request;

class BizumController extends Controller
{
    // Llista tots els bizums
    public function index()
    {
        $bizums = Bizum::with('compteOrigen', 'compteDesti')->get();
        return view('admin.bizums.index', compact('bizums'));
    }
}