<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AppBancaria — Registre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bank-card {
            max-width: 480px;
            width: 100%;
        }
        .bank-header {
            background-color: #1a3c5e;
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 1.5rem;
            text-align: center;
        }
        .bank-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="bank-card shadow-lg">

        {{-- Capçalera --}}
        <div class="bank-header">
            <h1>AppBancaria</h1>
            <p style="font-size: 0.85rem; opacity: 0.8; margin: 0;">Crea el teu compte</p>
        </div>

        {{-- Formulari Registre --}}
        <div class="card border-0 rounded-0 rounded-bottom">
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="name" class="form-control w-100"
                            value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control w-100"
                            value="{{ old('dni') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Data de Naixement</label>
                        <input type="date" name="data_naixament" class="form-control w-100"
                            value="{{ old('data_naixament') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telèfon</label>
                        <input type="text" name="telefon" class="form-control w-100"
                            value="{{ old('telefon') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control w-100"
                            value="{{ old('email') }}" required autocomplete="username">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contrasenya</label>
                        <input type="password" name="password" class="form-control w-100"
                            required autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirma la Contrasenya</label>
                        <input type="password" name="password_confirmation" class="form-control w-100"
                            required autocomplete="new-password">
                    </div>

                    <div class="d-grid mt-4 mb-3">
                        <button type="submit" class="btn text-white" style="background-color: #1a3c5e;">
                            Registrar-se
                        </button>
                    </div>

                    <div class="text-center">
                        <span class="text-muted small">Ja tens compte?</span>
                        <a href="{{ route('login') }}" class="small ms-1" style="color: #1a3c5e;">Inicia sessió</a>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>