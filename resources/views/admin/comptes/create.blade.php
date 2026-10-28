<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Nou Tipus de Compte</h2>
            <a href="{{ route('admin.tipus-comptes.index') }}" class="btn btn-outline-secondary btn-sm">← Tornar</a>
        </div>
    </x-slot>

    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.tipus-comptes.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required maxlength="20">
                        <x-input-error :messages="$errors->get('nom')" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripció</label>
                        <textarea name="descripcio" class="form-control" rows="3">{{ old('descripcio') }}</textarea>
                        <x-input-error :messages="$errors->get('descripcio')" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imatge</label>
                        <input type="file" name="imatge" class="form-control" accept="image/*">
                        <x-input-error :messages="$errors->get('imatge')" />
                    </div>

                    <button type="submit" class="btn btn-primary">Crear Tipus</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>