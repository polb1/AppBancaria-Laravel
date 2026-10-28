<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Gestió de Comptes</h2>
            <a href="{{ route('admin.comptes.create') }}" class="btn btn-primary btn-sm">+ Nou Compte</a>
        </div>
    </x-slot>

    <div class="container my-4">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>IBAN</th>
                            <th>Àlies</th>
                            <th>Tipus</th>
                            <th>Client</th>
                            <th>Saldo</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comptes as $compte)
                            <tr>
                                <td>{{ $compte->iban }}</td>
                                <td>{{ $compte->alias }}</td>
                                <td>{{ $compte->tipusCompte->nom }}</td>
                                <td>{{ $compte->client->user->name }}</td>
                                <td>{{ number_format($compte->saldo, 2) }} €</td>
                                <td>
                                    <a href="{{ route('admin.comptes.show', $compte->id) }}" class="btn btn-info btn-sm">Veure</a>
                                    <a href="{{ route('admin.comptes.edit', $compte->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('admin.comptes.destroy', $compte->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Estàs segur que vols esborrar aquest compte?')">
                                            Esborrar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>