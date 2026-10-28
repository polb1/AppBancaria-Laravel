<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Gestió de Tipus de Comptes</h2>
            <a href="{{ route('admin.tipus-comptes.create') }}" class="btn btn-primary btn-sm">+ Nou Tipus</a>
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
                            <th>Nom</th>
                            <th>Descripció</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tipusComptes as $tipusCompte)
                            <tr>
                                <td>{{ $tipusCompte->nom }}</td>
                                <td>{{ $tipusCompte->descripcio ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('admin.tipus-comptes.show', $tipusCompte->id) }}" class="btn btn-info btn-sm">Veure</a>
                                    <a href="{{ route('admin.tipus-comptes.edit', $tipusCompte->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('admin.tipus-comptes.destroy', $tipusCompte->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Estàs segur que vols esborrar aquest tipus?')">
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