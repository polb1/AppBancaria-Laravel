<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bizum;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // PRIMER comprovem si és admin
        if (Auth::user()->email === 'admin@admin.cat') {
            return redirect()->route('admin.dashboard');
        }

        $user = Auth::user();
        $client = $user->client;

        if (!$client) {
            return redirect()->route('logout')->with('error', 'Aquest usuari no té cap client associat.');
        }

        $comptes = $client->comptes()->with('tipusCompte')->get();

        $comptesIds = $comptes->pluck('id');

        $bizums = Bizum::with(['compteOrigen', 'compteDesti'])
            ->where(function ($q) use ($comptesIds) {
                $q->whereIn('compte_origen_id', $comptesIds)
                  ->orWhereIn('compte_desti_id', $comptesIds);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('client.dashboard', compact('client', 'comptes', 'bizums'));
    }
}