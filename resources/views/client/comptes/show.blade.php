<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">{{ $compte->alias }}</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">← Tornar</a>
        </div>
    </x-slot>

    <div class="container my-4">

        {{-- Informació del compte --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">Informació del compte</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if($compte->tipusCompte->imatge)
                            <img src="{{ Storage::url($compte->tipusCompte->imatge) }}"
                                alt="{{ $compte->tipusCompte->nom }}"
                                class="img-fluid mb-3"
                                style="max-width: 120px;">
                        @endif
                    </div>
                    <div class="col-md-4">
                        <p><strong>IBAN:</strong> {{ $compte->iban }}</p>
                        <p><strong>Àlies:</strong> {{ $compte->alias }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Tipus:</strong> {{ $compte->tipusCompte->nom }}</p>
                        <p><strong>Saldo:</strong>
                            <span class="text-primary fw-bold">{{ number_format($compte->saldo, 2) }} €</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Moviments del compte --}}
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Moviments</h5>
                <a href="{{ route('bizum.index') }}" class="btn btn-primary btn-sm">Fer un Bizum</a>
            </div>
            <div class="card-body">
                @if($bizums->isEmpty())
                    <p class="text-muted">No hi ha moviments per aquest compte.</p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Tipus</th>
                                <th>Compte Origen</th>
                                <th>Compte Destí</th>
                                <th>Quantitat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bizums as $bizum)
                                <tr>
                                    <td>{{ $bizum->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($bizum->compte_origen_id == $compte->id)
                                            <span class="badge bg-danger">Enviat</span>
                                        @else
                                            <span class="badge bg-success">Rebut</span>
                                        @endif
                                    </td>
                                    <td>{{ $bizum->compteOrigen->iban }}</td>
                                    <td>{{ $bizum->compteDesti->iban }}</td>
                                    <td class="{{ $bizum->compte_origen_id == $compte->id ? 'text-danger' : 'text-success' }} fw-bold">
                                        {{ $bizum->compte_origen_id == $compte->id ? '-' : '+' }}{{ number_format($bizum->quantitat, 2) }} €
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>