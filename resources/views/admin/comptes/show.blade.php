<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Detall Compte</h2>
            <a href="{{ route('admin.comptes.index') }}" class="btn btn-outline-secondary btn-sm">← Tornar</a>
        </div>
    </x-slot>

    <div class="container my-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header"><h5 class="mb-0">Informació del Compte</h5></div>
            <div class="card-body">
                <p><strong>IBAN:</strong> {{ $compte->iban }}</p>
                <p><strong>Àlies:</strong> {{ $compte->alias }}</p>
                <p><strong>Tipus:</strong> {{ $compte->tipusCompte->nom }}</p>
                <p><strong>Client:</strong> {{ $compte->client->user->name }}</p>
                <p><strong>Saldo:</strong> {{ number_format($compte->saldo, 2) }} €</p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header"><h5 class="mb-0">Moviments</h5></div>
            <div class="card-body">
                @if($compte->bizums->isEmpty())
                    <p class="text-muted">No hi ha moviments per aquest compte.</p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Origen</th>
                                <th>Destí</th>
                                <th>Quantitat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($compte->bizums as $bizum)
                                <tr>
                                    <td>{{ $bizum->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $bizum->compteOrigen->iban }}</td>
                                    <td>{{ $bizum->compteDesti->iban }}</td>
                                    <td>{{ number_format($bizum->quantitat, 2) }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>