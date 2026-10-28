<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Compte;
use App\Models\TipusCompte;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    public function index()
    {
        $comptes = Compte::with('client', 'tipusCompte')->get();
        return view('admin.comptes.index', compact('comptes'));
    }

    public function create()
    {
        $clients = Client::all();
        $tipusComptes = TipusCompte::all();
        return view('admin.comptes.create', compact('clients', 'tipusComptes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iban'            => ['required', 'string', 'max:34', 'unique:comptes'],
            'alias'           => ['required', 'string', 'max:255'],
            'saldo'           => ['required', 'numeric', 'min:0'],
            'client_id'       => ['required', 'exists:clients,id'],
            'tipus_compte_id' => ['required', 'exists:tipus_compte,id'],
        ]);

        Compte::create([
            'iban'            => $request->iban,
            'alias'           => $request->alias,
            'saldo'           => $request->saldo,
            'client_id'       => $request->client_id,
            'tipus_compte_id' => $request->tipus_compte_id,
        ]);

        return redirect()->route('admin.comptes.index')->with('success', 'Compte creat correctament.');
    }

    public function show(string $id)
    {
        $compte = Compte::with('client', 'tipusCompte', 'bizums')->findOrFail($id);
        return view('admin.comptes.show', compact('compte'));
    }

    public function edit(string $id)
    {
        $compte = Compte::findOrFail($id);
        $clients = Client::all();
        $tipusComptes = TipusCompte::all();
        return view('admin.comptes.edit', compact('compte', 'clients', 'tipusComptes'));
    }

    public function update(Request $request, string $id)
    {
        $compte = Compte::findOrFail($id);

        $request->validate([
            'iban'            => ['required', 'string', 'max:34', 'unique:comptes,iban,' . $id],
            'alias'           => ['required', 'string', 'max:255'],
            'saldo'           => ['required', 'numeric', 'min:0'],
            'client_id'       => ['required', 'exists:clients,id'],
            'tipus_compte_id' => ['required', 'exists:tipus_compte,id'],
        ]);

        $compte->update([
            'iban'            => $request->iban,
            'alias'           => $request->alias,
            'saldo'           => $request->saldo,
            'client_id'       => $request->client_id,
            'tipus_compte_id' => $request->tipus_compte_id,
        ]);

        return redirect()->route('admin.comptes.index')->with('success', 'Actualitzat correctament.');
    }

    public function destroy(string $id)
    {
        $compte = Compte::findOrFail($id);
        $compte->delete();

        return redirect()->route('admin.comptes.index')->with('success', 'Esborrat correctament.');
    }
}