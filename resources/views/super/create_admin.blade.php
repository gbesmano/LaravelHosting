<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Consistent Button Styles */
        .btn-custom {
            background-color: #0D6EFD;
            color: #ffffff;
            border-radius: 20px;
            font-size: 0.95rem;
            padding: 8px 15px;
            transition: all 0.3s ease;
            border: none;
            animation: fadeInUp 1.5s forwards;
        }

        .btn-custom:hover {
            background-color: #0b5ed7;
            color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
            animation: pulse 1s infinite alternate;
        }

        .card {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 15px;
            background-color: #ffffff;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s forwards;
        }

        .card-body {
            padding: 2rem;
        }

        label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #495057;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            border-radius: 20px;
            border: 1px solid #ced4da;
            padding: 0.6rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            animation: fadeInUp 1.2s ease forwards;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #0D6EFD;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transform: scale(1.02);
        }

        .form-container {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            margin-top: 3rem;
            animation: slideIn 1.5s ease forwards;
        }

        .form-title {
            font-weight: 700;
            color: #0D6EFD;
            margin-top: 3rem;
            margin-bottom: 1rem;
            font-size: 2rem;
            font-family: 'Poppins', sans-serif;
            opacity: 0;
            animation: fadeInScale 1.5s forwards;
        }

        .input-group-text {
            background-color: #0D6EFD;
            color: #ffffff;
            border: none;
            border-radius: 20px 0 0 20px;
        }

        .input-group {
            margin-bottom: 1rem;
            animation: fadeInUp 1.5s ease forwards;
        }

        /* Error message styling */
        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
        }

        /* Animation Effects */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.05);
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('super/partials/aside')
        <div class="main p-3">
            <div class="text-center">
                <h1 class="form-title">
                    Create an Admin
                </h1>
            </div>

            <!-- Success message section -->
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row justify-content-center mt-4">
                <div class="col-sm-12 col-md-8 col-lg-6">
                    <div class="card form-container">
                        <div class="card-body">
                            <form action="/super/admins/register" method="POST" class="row g-3">
                                @csrf
                                <input type="hidden" value="admin" name="type">

                                <!-- First Name -->
                                <div class="col-md-6">
                                    <label for="firstname">First Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-user"></i></span>
                                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname"
                                            placeholder="John" value="{{ old('firstname') }}" required>
                                        @error('firstname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6">
                                    <label for="lastname">Last Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-user"></i></span>
                                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname"
                                            placeholder="Doe" value="{{ old('lastname') }}" required>
                                        @error('lastname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                            placeholder="test@email.com" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Locality -->
                                <div class="col-md-6">
                                    <label for="locality">Locality</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-map-marker"></i></span>
                                        <input type="text" class="form-control @error('locality') is-invalid @enderror" id="locality" name="locality"
                                            placeholder="Ex. Naga" value="{{ old('locality') }}" required>
                                        @error('locality')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Mobile No -->
                                <div class="col-md-6">
                                    <label for="mobile_no">Mobile No</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-mobile"></i></span>
                                        <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no"
                                            placeholder="+639" value="{{ old('mobile_no') }}" required>
                                        @error('mobile_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Birthdate -->
                                <div class="col-md-6">
                                    <label for="birthdate">Birthdate</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-calendar"></i></span>
                                        <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate"
                                            value="{{ old('birthdate') }}" required>
                                        @error('birthdate')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-lock"></i></span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                        placeholder="Password"  value="{{ old('password') }}" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-lock"></i></span>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                            name="password_confirmation" placeholder="Confirm Password" value="{{ old('password_confirmation') }}" required>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button class="btn btn-custom w-100">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="{{ asset('script.js') }}"></script>
</body>

</html>
