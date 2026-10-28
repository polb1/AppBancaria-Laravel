<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Detall Tipus de Compte</h2>
            <a href="{{ route('admin.tipus-comptes.index') }}" class="btn btn-outline-secondary btn-sm">← Tornar</a>
        </div>
    </x-slot>

    <div class="container my-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header"><h5 class="mb-0">Informació</h5></div>
            <div class="card-body">
                <p><strong>Nom:</strong> {{ $tipusCompte->nom }}</p>
                <p><strong>Descripció:</strong> {{ $tipusCompte->descripcio ?? '—' }}</p>
                @if($tipusCompte->imatge)
                    <p><strong>Imatge:</strong></p>
                    <img src="{{ Storage::url($tipusCompte->imatge) }}" alt="{{ $tipusCompte->nom }}" class="img-thumbnail" style="max-width: 200px;">
                @endif
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header"><h5 class="mb-0">Comptes amb aquest tipus</h5></div>
            <div class="card-body">
                @if($tipusCompte->comptes->isEmpty())
                    <p class="text-muted">No hi ha comptes amb aquest tipus.</p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>IBAN</th>
                                <th>Àlies</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tipusCompte->comptes as $compte)
                                <tr>
                                    <td>{{ $compte->iban }}</td>
                                    <td>{{ $compte->alias }}</td>
                                    <td>{{ number_format($compte->saldo, 2) }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>