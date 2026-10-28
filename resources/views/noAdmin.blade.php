<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Accès Prohibit</h2>
    </x-slot>

    <div class="container my-4">
        <div class="card shadow-sm text-center">
            <div class="card-body py-5">
                <h1 class="display-1 text-danger">403</h1>
                <h4 class="mb-3">No ets administrador. Torna a l'inici</h4>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">← Tornar a l'inici</a>
            </div>
        </div>
    </div>
</x-app-layout>