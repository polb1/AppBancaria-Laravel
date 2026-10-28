<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('user')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $client = Client::with('user', 'comptes')->findOrFail($id);
        return view('admin.clients.show', compact('client'));
    }

    public function edit(string $id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'dni'            => ['required', 'string', 'max:9', 'unique:clients,dni,' . $id],
            'data_naixament' => ['required', 'date'],
            'telefon'        => ['required', 'string', 'max:15'],
        ]);

        $client->update([
            'dni'            => $request->dni,
            'data_naixament' => $request->data_naixament,
            'telefon'        => $request->telefon,
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client actualitzat correctament.');
    }

    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Eliminat correctament.');
    }
}