<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $title }} | Test</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
		@include('admin/partials/aside')
		<div class="main p-3">
            <div class="text-center">
                <h1 class="form-title">
                    Create a Fare
                </h1>
            </div>

            <div class="row justify-content-center mt-5">
            	<div class="col-sm-12 col-md-10 col-lg-8">
            		@if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="lni lni-checkmark-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
            		<div class="card form-container">
            			<div class="card-body">
            				<form action="/admin/fares/store" method="POST" class="row g-4">
	                            @csrf
	                            <div class="col-md-6">
                                    <label for="designated_locality" class="form-label">Designated Locality</label>
	                                <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-map-marker"></i></span>
                                        <input type="text" class="form-control" name="designated_locality" id="designated_locality" placeholder="Enter designated locality" required>
                                    </div>

                                    <label for="vehicle" class="form-label">Vehicle</label>
	                                <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-car"></i></span>
                                        <input type="text" class="form-control" name="vehicle" id="vehicle" placeholder="Enter vehicle type" required>
                                    </div>

                                    <label for="distance" class="form-label">Distance</label>
	                                <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-ruler"></i></span>
                                        <input type="text" class="form-control" name="distance" id="distance" placeholder="Enter distance (e.g., 50km)" required>
                                    </div>

                                    <label for="operating_hours" class="form-label">Operating Hours</label>
	                                <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-timer"></i></span>
                                        <input type="text" class="form-control" name="operating_hours" id="operating_hours" placeholder="Enter operating hours (e.g., 7AM - 8PM)" required>
                                    </div>
	                            </div>

	                            <div class="col-md-6">
                                    <label for="initial_fare" class="form-label">Initial Fare</label>
	                                <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-money-protection"></i></span>
                                        <input type="text" class="form-control" name="initial_fare" id="initial_fare" placeholder="Enter initial fare (e.g., P100)" required>
                                    </div>

                                    <label for="additional_fare" class="form-label">Additional Fare</label>
	                                <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-coin"></i></span>
                                        <input type="text" class="form-control" name="additional_fare" id="additional_fare" placeholder="Enter additional fare (e.g., P100)" required>
                                    </div>

									<label for="discounted_fare" class="form-label">Discounted Fare</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="lni lni-offer"></i></span>
                                        <input type="text" class="form-control" name="discounted_fare" id="discounted_fare" placeholder="Enter discounted fare (e.g., P100)" required>
                                    </div>

	                            </div>

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
