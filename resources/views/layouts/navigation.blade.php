<nav class="navbar navbar-light bg-white border-bottom">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <img src="{{ asset('imatges/Logo-AppBancaria.png') }}"
                alt="AppBancaria"
                style="height: 36px; width: auto;">
            <span class="fw-bold" style="color: #1a3c5e;">AppBancaria</span>
        </a>

        <!-- Menu dreta -->
        <div class="d-flex align-items-center gap-3">

            <!-- Nom usuari -->
            <span class="text-muted" style="font-size: 14px;">{{ Auth::user()->name }}</span>

            <!-- Perfil -->
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm">
                Perfil
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm text-white" style="background-color: #1a3c5e;">
                    Tancar sessió
                </button>
            </form>

        </div>

    </div>
</nav>