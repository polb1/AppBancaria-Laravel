<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0">Gestió de Bizums</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">← Tornar</a>
        </div>
    </x-slot>

    <div class="container my-4">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                @if($bizums->isEmpty())
                    <p class="text-muted">No hi ha bizums registrats.</p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Compte Origen</th>
                                <th>Client Origen</th>
                                <th>Compte Destí</th>
                                <th>Client Destí</th>
                                <th>Quantitat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bizums as $bizum)
                                <tr>
                                    <td>{{ $bizum->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $bizum->compteOrigen->iban }}</td>
                                    <td>{{ $bizum->compteOrigen->client->user->name }}</td>
                                    <td>{{ $bizum->compteDesti->iban }}</td>
                                    <td>{{ $bizum->compteDesti->client->user->name }}</td>
                                    <td class="fw-bold">{{ number_format($bizum->quantitat, 2) }} €</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>