<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tire Trading System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #0d6efd, #0a58ca);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-card {
            background: #fff;
            border-radius: 15px;
            padding: 2rem;
            width: 100%;
            max-width: 550px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        .register-card h3 {
            color: #0d6efd;
            font-weight: 700;
        }
    </style>
</head>
<body>

<div class="register-card">
    <h3 class="text-center">Create Your Account</h3>
    <p class="text-muted text-center mb-4">Register as a customer to start booking and ordering.</p>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Middle Name</label>
                <input type="text" name="mname" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100">Register</button>

        <p class="mt-3 text-center">Already have an account? 
            <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
        </p>
    </form>
</div>

</body>
</html>
