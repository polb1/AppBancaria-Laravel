<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Test CI/CD</h2>
    </x-slot>

    <div class="container my-4">
        <div class="row g-4">

            {{-- Clients --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center h-100">
                    <div class="card-body">
                        <h5 class="card-title">Clients</h5>
                        <p class="text-muted">Gestiona els clients del banc</p>
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-primary">Veure Clients</a>
                    </div>
                </div>
            </div>

            {{-- Tipus Comptes --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center h-100">
                    <div class="card-body">
                        <h5 class="card-title">Tipus de Comptes</h5>
                        <p class="text-muted">Gestiona els tipus de compte</p>
                        <a href="{{ route('admin.tipus-comptes.index') }}" class="btn btn-primary">Veure Tipus</a>
                    </div>
                </div>
            </div>

            {{-- Comptes --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center h-100">
                    <div class="card-body">
                        <h5 class="card-title">Comptes Bancaris</h5>
                        <p class="text-muted">Gestiona els comptes bancaris</p>
                        <a href="{{ route('admin.comptes.index') }}" class="btn btn-primary">Veure Comptes</a>
                    </div>
                </div>
            </div>

            {{-- Bizums --}}
            <div class="col-md-3">
                <div class="card shadow-sm text-center h-100">
                    <div class="card-body">
                        <h5 class="card-title">Bizums</h5>
                        <p class="text-muted">Consulta els bizums realitzats</p>
                        <a href="{{ route('admin.bizums.index') }}" class="btn btn-primary">Veure Bizums</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>