<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Fer un Bizum</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">← Tornar</a>
        </div>
    </x-slot>

    <div class="container my-4">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Formulari Bizum --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">Nova transferència</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('bizum.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="compte_origen_id" class="form-label">Compte origen</label>
                        <select name="compte_origen_id" id="compte_origen_id" class="form-select" required>
                            <option value="">Selecciona un compte...</option>
                            @foreach($comptes as $compte)
                                <option value="{{ $compte->id }}" {{ old('compte_origen_id') == $compte->id ? 'selected' : '' }}>
                                    {{ $compte->alias }} — {{ $compte->iban }} ({{ number_format($compte->saldo, 2) }} €)
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('compte_origen_id')" />
                    </div>

                    <div class="mb-3">
                        <label for="compte_desti_id" class="form-label">Compte desti (IBAN)</label>
                        <select name="compte_desti_id" id="compte_desti_id" class="form-select" required>
                            <option value="">Selecciona un compte desti...</option>
                            @foreach($comptesdesti as $comptedesti)
                                <option value="{{ $comptedesti->id }}" {{ old('compte_desti_id') == $comptedesti->id ? 'selected' : '' }}>
                                    {{ $comptedesti->iban }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('compte_desti_id')" />
                    </div>

                    <div class="mb-3">
                        <label for="quantitat" class="form-label">Quantitat (€)</label>
                        <input type="number" name="quantitat" id="quantitat" class="form-control"
                            min="0.01" step="0.01" value="{{ old('quantitat') }}" required>
                        <x-input-error :messages="$errors->get('quantitat')" />
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar Bizum</button>
                </form>
            </div>
        </div>

        {{-- Últims 10 bizums --}}
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Últims 10 moviments</h5>
            </div>
            <div class="card-body">
                @if($bizums->isEmpty())
                    <p class="text-muted">No hi ha moviments recents.</p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Tipus</th>
                                <th>Origen</th>
                                <th>Desti</th>
                                <th>Quantitat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bizums as $bizum)
                                <tr>
                                    <td>{{ $bizum->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if(in_array($bizum->compte_origen_id, $comptes->pluck('id')->toArray()))
                                            <span class="badge bg-danger">Enviat</span>
                                        @else
                                            <span class="badge bg-success">Rebut</span>
                                        @endif
                                    </td>
                                    <td>{{ $bizum->compteOrigen->iban }}</td>
                                    <td>{{ $bizum->compteDesti->iban }}</td>
                                    <td class="{{ in_array($bizum->compte_origen_id, $comptes->pluck('id')->toArray()) ? 'text-danger' : 'text-success' }} fw-bold">
                                        {{ in_array($bizum->compte_origen_id, $comptes->pluck('id')->toArray()) ? '-' : '+' }}{{ number_format($bizum->quantitat, 2) }} €
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