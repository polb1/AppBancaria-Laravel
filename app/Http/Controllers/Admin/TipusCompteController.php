<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipusCompte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TipusCompteController extends Controller
{
    // Mostrem el tipus de comptes
    public function index()
    {
        $tipusComptes = TipusCompte::all();
        return view('admin.tipus-comptes.index', compact('tipusComptes'));
    }

    // Formulari per crear un nou tipus de compte
    public function create()
    {
        return view('admin.tipus-comptes.create');
    }

    // Guardem el nou tipus de compte
    public function store(Request $request)
    {
        $request->validate([
            'nom'        => ['required', 'string', 'max:20'],
            'descripcio' => ['nullable', 'string'],
            'imatge'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imatge = null;
        if ($request->hasFile('imatge')) {
            $imatge = Storage::put('tipus_comptes', $request->imatge);
        }

        TipusCompte::create([
            'nom'        => $request->nom,
            'descripcio' => $request->descripcio,
            'imatge'     => $imatge,
        ]);

        return redirect()->route('admin.tipus-comptes.index')->with('success', 'Tipus de compte creat correctament.');
    }

    // Veure el tipus de compte
    public function show(string $id)
    {
        $tipusCompte = TipusCompte::with('comptes')->findOrFail($id);
        return view('admin.tipus-comptes.show', compact('tipusCompte'));
    }

    // Per editar el tipus de compte
    public function edit(string $id)
    {
        $tipusCompte = TipusCompte::findOrFail($id);
        return view('admin.tipus-comptes.edit', compact('tipusCompte'));
    }

    // Per actualitzar el tipus de compte
    public function update(Request $request, string $id)
    {
        $tipusCompte = TipusCompte::findOrFail($id);

        $request->validate([
            'nom'        => ['required', 'string', 'max:20'],
            'descripcio' => ['nullable', 'string'],
            'imatge'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('imatge')) {
            if ($tipusCompte->imatge) {
                Storage::delete($tipusCompte->imatge);
            }
            $tipusCompte->imatge = Storage::put('tipus_comptes', $request->imatge);
        }

        $tipusCompte->update([
            'nom'        => $request->nom,
            'descripcio' => $request->descripcio,
            'imatge'     => $tipusCompte->imatge,
        ]);

        return redirect()->route('admin.tipus-comptes.index')->with('success', 'Actualitzat correctament.');
    }

    // Eliminem un tipus de compte
    public function destroy(string $id)
    {
        $tipusCompte = TipusCompte::findOrFail($id);

        if ($tipusCompte->imatge) {
            Storage::delete($tipusCompte->imatge);
        }

        $tipusCompte->delete();

        return redirect()->route('admin.tipus-comptes.index')->with('success', 'Eliminat correctament.');
    }
}