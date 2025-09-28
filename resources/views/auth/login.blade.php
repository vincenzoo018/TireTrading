<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tire Trading System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #0d6efd, #0a58ca);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 15px;
            padding: 2rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        .login-card h3 {
            color: #0d6efd;
            font-weight: 700;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
            border-color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <h3>Login to Your Account</h3>
    <p class="text-muted mb-4">Welcome back! Please login to continue.</p>

    @if ($errors->has('login_error'))
        <div class="alert alert-danger">{{ $errors->first('login_error') }}</div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf

        <div class="mb-3 text-start">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>

        <p class="mt-3">Don't have an account? 
            <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
        </p>
    </form>
</div>

</body>
</html>
