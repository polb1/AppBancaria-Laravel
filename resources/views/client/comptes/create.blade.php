<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Nou Compte Bancari</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">← Tornar</a>
        </div>
    </x-slot>

    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('comptes.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Àlies del compte</label>
                        <input type="text" name="alias" class="form-control"
                            placeholder="Ex: Estalvis, Nòmina..."
                            value="{{ old('alias') }}" required>
                        <x-input-error :messages="$errors->get('alias')" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipus de compte</label>
                        <select name="tipus_compte_id" class="form-select" required>
                            <option value="">Selecciona un tipus...</option>
                            @foreach($tipusComptes as $tipusCompte)
                                <option value="{{ $tipusCompte->id }}" {{ old('tipus_compte_id') == $tipusCompte->id ? 'selected' : '' }}>
                                    {{ $tipusCompte->nom }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('tipus_compte_id')" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Saldo inicial (€)</label>
                        <input type="number" name="saldo" class="form-control"
                            placeholder="0.00"
                            min="0" step="0.01"
                            value="{{ old('saldo', 0) }}" required>
                        <x-input-error :messages="$errors->get('saldo')" />
                    </div>

                    <button type="submit" class="btn btn-primary">Crear Compte</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>