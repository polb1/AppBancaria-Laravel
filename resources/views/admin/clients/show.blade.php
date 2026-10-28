<x-app-layout>
    <x-slot name="header">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Comptes Bancaris</h5>
            </div>
            <div class="card-body">
                @if ($client->comptes->isEmpty())
                    <p class="text-muted">Aquest client no té cap compte.</p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>IBAN</th>
                                <th>Àlies</th>
                                <th>Tipus</th>
                                <th>Saldo</th>
                                <th>Accions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client->comptes as $compte)
                                <tr>
                                    <td>{{ $compte->iban }}</td>
                                    <td>{{ $compte->alias }}</td>
                                    <td>{{ $compte->tipusCompte->nom }}</td>
                                    <td>{{ number_format($compte->saldo, 2) }} €</td>
                                    <td>
                                        <a href="{{ route('admin.comptes.show', $compte->id) }}"
                                            class="btn btn-info btn-sm">Veure</a>
                                        <a href="{{ route('admin.comptes.edit', $compte->id) }}"
                                            class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('admin.comptes.destroy', $compte->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Estas segur que vols esborrar aquest compte?')">
                                                Esborrar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
</x-app-layout>
