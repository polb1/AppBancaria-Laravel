<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bizum;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BizumClientController extends Controller
{
    // Mostra el formulari per enviar un bizum + últims 10 bizums
    public function index()
    {
        $client = Auth::user()->client;
        $comptes = $client->comptes()->get();
        $comptesIds = $comptes->pluck('id');

        // Tots els comptes excepte els del client logejat
        $comptesdesti = Compte::whereNotIn('id', $comptesIds)->get();

        $bizums = Bizum::with(['compteOrigen', 'compteDesti'])
            ->where(function ($q) use ($comptesIds) {
                $q->whereIn('compte_origen_id', $comptesIds)
                    ->orWhereIn('compte_desti_id', $comptesIds);
            })
            ->latest()
            ->take(10)
            ->get();

        return view('client.bizum.index', compact('comptes', 'comptesdesti', 'bizums'));
    }
    // Processa l'enviament d'un bizum
    public function store(Request $request)
    {
        $request->validate([
            'compte_origen_id' => ['required', 'exists:comptes,id'],
            'compte_desti_id'  => ['required', 'exists:comptes,id'],
            'quantitat'        => ['required', 'numeric', 'min:0.01'],
        ]);

        $compteOrigen = Compte::findOrFail($request->compte_origen_id);
        $compteDesti  = Compte::findOrFail($request->compte_desti_id);

        // Comprovem que el compte origen pertany al client logejat
        if ($compteOrigen->client_id !== Auth::user()->client->id) {
            return redirect()->route('bizum.index')->with('error', 'No pots enviar diners des d\'aquest compte.');
        }

        // Comprovem que el compte origen i destí no són el mateix
        if ($compteOrigen->id === $compteDesti->id) {
            return redirect()->route('bizum.index')->with('error', 'No pots enviar diners al mateix compte.');
        }

        // Comprovem que hi ha saldo suficient
        if ($compteOrigen->saldo < $request->quantitat) {
            return redirect()->route('bizum.index')->with('error', 'No tens saldo suficient.');
        }

        // Descomptem el saldo del compte origen
        $compteOrigen->decrement('saldo', $request->quantitat);

        // Afegim el saldo al compte destí
        $compteDesti->increment('saldo', $request->quantitat);

        // Guardem el registre del bizum
        Bizum::create([
            'compte_origen_id' => $compteOrigen->id,
            'compte_desti_id'  => $compteDesti->id,
            'quantitat'        => $request->quantitat,
        ]);

        return redirect()->route('bizum.index')->with('success', 'Bizum enviat correctament.');
    }
}
