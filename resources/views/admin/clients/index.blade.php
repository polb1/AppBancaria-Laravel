<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Gestió de Clients</h2>
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
                            <th>Email</th>
                            <th>DNI</th>
                            <th>Telèfon</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->user->name }}</td>
                                <td>{{ $client->user->email }}</td>
                                <td>{{ $client->dni }}</td>
                                <td>{{ $client->telefon }}</td>
                                <td>
                                    <a href="{{ route('admin.clients.show', $client->id) }}" class="btn btn-info btn-sm">Veure</a>
                                    <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Estàs segur que vols esborrar aquest client?')">
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