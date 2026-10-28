<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Editar Client</h2>
            <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary btn-sm">← Tornar</a>
        </div>
    </x-slot>

    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.clients.update', $client->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control" value="{{ old('dni', $client->dni) }}" required>
                        <x-input-error :messages="$errors->get('dni')" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Data de Naixement</label>
                        <input type="date" name="data_naixament" class="form-control" value="{{ old('data_naixament', $client->data_naixament) }}" required>
                        <x-input-error :messages="$errors->get('data_naixament')" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telèfon</label>
                        <input type="text" name="telefon" class="form-control" value="{{ old('telefon', $client->telefon) }}" required>
                        <x-input-error :messages="$errors->get('telefon')" />
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar canvis</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>