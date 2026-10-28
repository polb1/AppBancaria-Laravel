<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AppBancaria</title>
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
            max-width: 450px;
            width: 100%;
        }

        .bank-header {
            background-color: #1a3c5e;
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 2rem;
            text-align: center;
        }

        .bank-header h1 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .bank-header p {
            font-size: 0.9rem;
            opacity: 0.8;
            margin: 0;
        }
    </style>
</head>

<body>

    <div class="bank-card shadow-lg">

        {{-- Capçalera --}}
        <div class="bank-header">
            <h1>AppBancaria</h1>
            <p>Gestiona els teus comptes de forma segura i senzilla</p>
        </div>

        {{-- Formulari Login --}}
        <div class="card border-0 rounded-0 rounded-bottom">
            <div class="card-body p-4">

                <h5 class="mb-4 text-center text-muted">Inicia sessió</h5>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                            autofocus>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contrasenya</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label text-muted" for="remember">Recorda'm</label>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn text-white" style="background-color: #1a3c5e;">
                            Iniciar Sessió
                        </button>
                    </div>

                    <div class="text-center">
                        <span class="text-muted small">Encara no tens compte?</span>
                        <a href="{{ route('register') }}" class="small ms-1" style="color: #1a3c5e;">Registra't</a>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
