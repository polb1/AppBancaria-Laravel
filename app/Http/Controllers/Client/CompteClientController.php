<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bizum;
use App\Models\Compte;
use App\Models\TipusCompte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompteClientController extends Controller
{
    // Mostra el detall d'un compte bancari
    public function show(string $id)
    {
        $compte = Compte::with('tipusCompte', 'client')->findOrFail($id);

        // Comprovem que el compte pertany al client logejat
        if ($compte->client_id !== Auth::user()->client->id) {
            return redirect()->route('dashboard')->with('error', 'No tens permisos per veure aquest compte.');
        }

        // Obtenim tots els bizums enviats o rebuts per aquest compte
        $bizums = Bizum::with(['compteOrigen', 'compteDesti'])
            ->where(function ($q) use ($id) {
                $q->where('compte_origen_id', $id)
                    ->orWhere('compte_desti_id', $id);
            })
            ->latest()
            ->get();

        return view('client.comptes.show', compact('compte', 'bizums'));
    }

    public function create()
    {
        $tipusComptes = TipusCompte::all();
        return view('client.comptes.create', compact('tipusComptes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alias'           => ['required', 'string', 'max:255'],
            'tipus_compte_id' => ['required', 'exists:tipus_compte,id'],
            'saldo'           => ['required', 'numeric', 'min:0'],
        ]);

        $client = Auth::user()->client;

        $iban = 'ES' . rand(10, 99) . ' ' . rand(1000, 9999) . ' ' . rand(1000, 9999) . ' ' . rand(1000, 9999) . ' ' . rand(1000, 9999) . ' ' . rand(1000, 9999);

        Compte::create([
            'iban'            => $iban,
            'alias'           => $request->alias,
            'saldo'           => $request->saldo,
            'client_id'       => $client->id,
            'tipus_compte_id' => $request->tipus_compte_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Compte creat correctament.');
    }
}
