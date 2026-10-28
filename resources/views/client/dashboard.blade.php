<x-app-layout>

    <div class="container my-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- COMPTES BANCARIS --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="text-center text-uppercase mb-4">Comptes Bancaris</h4>
                <div class="row justify-content-center align-items-center g-3">

                    @foreach ($comptes as $compte)
                        <div class="col-6 col-md-3">
                            <a href="{{ route('comptes.show', $compte->id) }}" class="text-decoration-none text-dark">
                                <div class="card border text-center p-2 h-100">
                                    <div class="ratio ratio-1x1 mb-2">
                                        <div class="d-flex align-items-center justify-content-center bg-light border">
                                            @if ($compte->tipusCompte->imatge)
                                                <img src="{{ Storage::url($compte->tipusCompte->imatge) }}"
                                                    alt="{{ $compte->tipusCompte->nom }}"
                                                    style="width: 70%; height: 70%; object-fit: contain;">
                                            @else
                                                <svg width="60%" height="60%" viewBox="0 0 100 100">
                                                    <line x1="0" y1="0" x2="100" y2="100"
                                                        stroke="#aaa" stroke-width="3" />
                                                    <line x1="100" y1="0" x2="0" y2="100"
                                                        stroke="#aaa" stroke-width="3" />
                                                    <rect x="1" y="1" width="98" height="98" fill="none"
                                                        stroke="#aaa" stroke-width="2" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-uppercase fw-bold mb-0" style="font-size: 13px;">{{ $compte->alias }}
                                    </p>
                                    <p class="text-muted mb-0" style="font-size: 11px;">{{ $compte->tipusCompte->nom }}
                                    </p>
                                    <p class="text-primary fw-bold mb-0">{{ number_format($compte->saldo, 2) }} €</p>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    {{-- Botó crear compte --}}
                    <div class="col-6 col-md-3">
                        <a href="{{ route('comptes.create') }}" class="text-decoration-none text-dark">
                            <div class="card border text-center p-2 h-100 d-flex align-items-center justify-content-center"
                                style="min-height: 160px;">
                                <div class="rounded-circle border border-2 d-flex align-items-center justify-content-center mb-2"
                                    style="width: 60px; height: 60px;">
                                    <span style="font-size: 28px; line-height: 1;">+</span>
                                </div>
                                <p class="text-uppercase fw-bold mb-0" style="font-size: 13px;">Crear Compte Nova</p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- ÚLTIMS MOVIMENTS --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="text-center text-uppercase mb-4">Últims Moviments</h4>
                <div class="row">
                    <div class="col-md-10">
                        @if ($bizums->isEmpty())
                            <p class="text-muted text-center">No hi ha moviments recents.</p>
                        @else
                            @foreach ($bizums as $bizum)
                                <div
                                    class="d-flex align-items-center justify-content-between border rounded px-3 py-2 mb-2 bg-white">
                                    <div>
                                        <span class="text-muted"
                                            style="font-size: 13px;">{{ $bizum->created_at->format('d/m/Y H:i') }}</span>
                                        <span class="ms-3">{{ $bizum->compteOrigen->iban }} →
                                            {{ $bizum->compteDesti->iban }}</span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span
                                            class="fw-bold {{ in_array($bizum->compte_origen_id, $comptes->pluck('id')->toArray()) ? 'text-danger' : 'text-success' }}">
                                            {{ in_array($bizum->compte_origen_id, $comptes->pluck('id')->toArray()) ? '-' : '+' }}{{ number_format($bizum->quantitat, 2) }}
                                            €
                                        </span>
                                        <a href="{{ route('comptes.show', $bizum->compte_origen_id) }}"
                                            class="btn btn-sm text-white"
                                            style="background-color: #5bc8c8; font-size: 12px;">Veure detall</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    {{-- Botó Fer Bizum --}}
                    <div class="col-md-2 d-flex flex-column align-items-center justify-content-center">
                        <a href="{{ route('bizum.index') }}" class="text-decoration-none text-dark text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-reply-fill mb-1" viewBox="0 0 16 16" style="transform: scaleX(-1);">
                                <path
                                    d="M5.921 11.9 1.353 8.62a.719.719 0 0 1 0-1.238L5.921 4.1A.716.716 0 0 1 7 4.719V6c1.5 0 6 0 7 8-2.5-4.5-7-4-7-4v1.281c0 .56-.606.898-1.079.62z" />
                            </svg>
                            <p class="text-uppercase fw-bold mb-0" style="font-size: 13px;">Fer Bizum</p>
                        </a>
                    </div>

                </div>
            </div>
</x-app-layout>
