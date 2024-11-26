<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Recoleta HR Recruitment System</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap');

        @font-face {
            font-family: 'Recoleta';
            src: url('/fonts/Recoleta-Black.ttf') format('truetype');
            font-weight: 900;
            font-style: normal;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #07799F;
            font-family: 'Lato', sans-serif;
            margin: 0;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .register-title {
            font-family: 'Recoleta', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            color: #07799F;
        }

        .register-subtitle {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
            margin-top: -1rem;
        }

        .form-control {
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #4B4B4B;
            border-color: #4B4B4B;
            font-weight: 700;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h1 class="register-title">Recoleta</h1>
        <p class="register-subtitle">Pelamar Registration</p>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Username" name="username" required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" placeholder="Email" name="email" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Phone Number" name="phone_number">
            </div>
            <div class="mb-3">
                <textarea class="form-control" placeholder="Address" name="address"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload Resume</label>
                <input type="file" class="form-control" name="resume">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <div class="mt-3">
            <a href="/login" class="text-muted">Already have an account? Login</a>
        </div>
    </div>
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>