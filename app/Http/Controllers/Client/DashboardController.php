<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bizum;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $client = $user->client;

        // Carreguem els comptes del client amb el seu tipus
        $comptes = $client->comptes()->with('tipusCompte')->get();

        // Obtenim els ids dels comptes per filtrar bizums
        $comptesIds = $comptes->pluck('id');

        // Últims 5 bizums enviats o rebuts pel client
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