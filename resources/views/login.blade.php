<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelMate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0b0e1f, #0040ff);
            height: 100vh;
            color: white; 
            overflow: hidden;
        }

        h1, h2, h3 {
            font-family: 'Bangers', cursive;
        }

        .content-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100vh;
            padding: 0 30px;
        }

        .left-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        .left-content img {
            max-width: 400px;
            height: auto;
        }

        .left-content h1 {
            font-size: 8rem;
            margin-top: 20px;
            text-align: left;
        }

        .left-content p {
            font-size: 2rem;
            font-weight: 700;
            text-align: left;
            max-width: 550px;
        }

        .right-content {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
            padding: 40px;
            max-width: 700px;
            width: 100%; /* Ensures the form takes up all available space */
        }

        .btn-custom {
            background-color: #0d6efd;
            color: #ffffff;
            border-radius: 20px;
            padding: 14px 20px;
            transition: all 0.3s ease;
            border: none;
            font-size: 1.1rem;
        }

        .btn-custom:hover {
            background-color: #0b5ed7;
            color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .input-group-text {
            background-color: #0d6efd;
            color: #ffffff;
            border: none;
            border-radius: 15px 0 0 15px;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            border-radius: 15px;
            border: 1px solid #ced4da;
            padding: 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            text-align: center;
        }

        .text-primary:hover {
            text-decoration: underline;
        }

        .btn-custom {
            width: 100%;
            background-color: #0d6efd;
            border: none;
            color: white;
            padding: 12px;
            border-radius: 20px;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background-color: #0b5ed7;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .left-content h1 {
                font-size: 4rem; /* Adjust font size on smaller screens */
            }

            .left-content p {
                font-size: 1.2rem; /* Adjust text size on smaller screens */
            }

            .card {
                max-width: 100%; /* Ensure form takes full width on smaller screens */
            }
        }
    </style>
</head>

<body>
    <div class="container content-wrapper">
        <!-- Left Content (Logo and Text) -->
        <div class="left-content">
            <img src="{{ asset('assets/Travel.png') }}" alt="TravelMate Logo">
            <h1>TRAVELMATE</h1>
            <p>Explore the world with us. Login to manage your trips or register to start your adventure.</p>
        </div>

        <!-- Right Content (Form) -->
        <div class="right-content">
            <div class="card bg-light mb-4">
                <div class="card-body">
                    <h1 class="form-title text-center">Login to your account</h1>
                    @if(session('error'))
                        <div class="error-message text-center">{{ session('error') }}</div> <!-- Generic error for invalid credentials -->
                    @endif
                    <form action="/login-account" method="POST">
                        @csrf
                        <!-- Email Field -->
                        <div class="input-group">
                            <span class="input-group-text"><i class="lni lni-envelope"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        
                        <!-- Password Field -->
                        <div class="input-group">
                            <span class="input-group-text"><i class="lni lni-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror

                        <button class="btn btn-custom w-100">Login</button>
                    </form>
                </div>
                <p class="text-center">Don't have an account? <a href="/register" class="text-primary">Register here</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
