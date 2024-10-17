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
        .card {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 15px;
            background-color: #ffffff;
        }

        .card-body {
            padding: 2rem;
        }

        .form-title {
            font-weight: 700;
            color: #0D6EFD;
            margin-top: 1.5rem; /* Reduced margin */
            margin-bottom: 1rem;
            font-size: 1.8rem; /* Smaller font size */
            font-family: 'Poppins', sans-serif;
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
        input[type="date"],
        textarea {
            border-radius: 20px;
            border: 1px solid #ced4da;
            padding: 0.6rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus,
        textarea:focus {
            outline: none;
            border-color: #0D6EFD;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transform: scale(1.02);
        }

        .form-container {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            margin-top: 1.5rem; /* Reduced margin */
        }
    </style>
</head>
<body>
	<div class="wrapper">
		@include('owner/partials/aside')
		<div class="main p-3">
            <div class="text-center">
                <h1 class="form-title">{{ $application->destination_name }}</h1>
            </div>

            <div class="row justify-content-center mt-5">
            	<div class="col-sm-12 col-md-8 col-lg-10">
    				@if (session('success'))
    		            <div class="alert alert-success alert-dismissible fade show" role="alert">
    		                {{ session('success') }}
    		                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    		            </div>
    		        @endif
        			<form action="/owner/applications/update/{{ $application->id }}" method="POST" enctype="multipart/form-data">
        				@csrf
        				@method('PUT')

        				<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        				<input type="hidden" name="status" value="approved">
	        			<!-- First Card -->
	        			<div class="card mb-4 form-container">
	        				<div class="card-body">
	        					<h4>Company Details</h4>
	        					<div class="row">
	                            	<div class="col-md-6">
		                                <x-input-field
		                                    label="Company Name"
		                                    name="company_name"
		                                    id="company_name"
		                                    type="text"
		                                    placeholder="Company Inc."
		                                    :value="old('company_name', $application->company_name  ?? '')"
		                                />

		                                <x-input-field
		                                    label="Company Address"
		                                    name="company_address"
		                                    id="company_address"
		                                    type="text"
		                                    placeholder="123 Street Name"
		                                    :value="old('company_address', $application->company_address  ?? '')"
		                                />

		                                <x-textarea-field
		                                    label="About"
		                                    name="about"
		                                    id="about"
		                                    type="textarea"
		                                    placeholder="Description of the company"
		                                    :value="old('about', $application->about  ?? '')"
		                                />
		                            </div>

		                            <div class="col-md-6">
			                            <div class="row">
			                            	<div class="col-sm-12 col-md-6">
				                                <x-input-field
				                                    label="Company Permit"
				                                    name="company_permit"
				                                    id="company_permit"
				                                    type="file"
				                                    placeholder="Permit ID"
				                                    :value="old('company_permit')"
				                                />

				                                <x-input-field
				                                    label="Location Clearance"
				                                    name="location_clearance"
				                                    id="location_clearance"
				                                    type="file"
				                                    placeholder="Location Clearance ID"
				                                    :value="old('location_clearance')"
				                                />

				                                <x-input-field
				                                    label="Barangay Clearance"
				                                    name="barangay_clearance"
				                                    id="barangay_clearance"
				                                    type="file"
				                                    placeholder="Barangay Clearance ID"
				                                    :value="old('barangay_clearance')"
				                                />

				                                <x-input-field
				                                    label="Philhealth"
				                                    name="philhealth"
				                                    id="philhealth"
				                                    type="file"
				                                    placeholder="Philhealth ID"
				                                    :value="old('philhealth')"
				                                />
			                            	</div>

			                            	<div class="col-sm-12 col-md-6">
				                                <x-input-field
				                                    label="Corporate Bank Account"
				                                    name="corporate_bank_account"
				                                    id="corporate_bank_account"
				                                    type="file"
				                                    placeholder="Bank Account No."
				                                    :value="old('corporate_bank_account')"
				                                />

				                                <x-input-field
				                                    label="SEC Registration"
				                                    name="sec_registration"
				                                    id="sec_registration"
				                                    type="file"
				                                    placeholder="SEC Registration No."
				                                    :value="old('sec_registration')"
				                                />

				                                <x-input-field
				                                    label="TIN"
				                                    name="tin"
				                                    id="tin"
				                                    type="file"
				                                    placeholder="TIN No."
				                                    :value="old('tin')"
				                                />

				                                <x-input-field
				                                    label="SSS"
				                                    name="sss"
				                                    id="sss"
				                                    type="file"
				                                    placeholder="SSS No."
				                                    :value="old('sss')"
				                                />
			                            	</div>
			                            </div>
		                            </div>
	                            </div>
	        				</div>
	        			</div>

	        			<!-- Second Card -->
	        			<div class="card form-container">
	        				<div class="card-body">
	        					<h4>Destination Details</h4>
	        					<div class="row">
	                                <div class="col-md-6">
		                                <x-input-field
		                                    label="Destination Name"
		                                    name="destination_name"
		                                    id="destination_name"
		                                    type="text"
		                                    placeholder="Destination Name"
		                                    :value="old('destination_name', $application->destination_name  ?? '')"
		                                />

		                                <x-input-field
		                                    label="Category"
		                                    name="category"
		                                    id="category"
		                                    type="text"
		                                    placeholder="Destination Category"
		                                    :value="old('category', $application->category  ?? '')"
		                                />

		                                <x-input-field
		                                    label="Operating Hours"
		                                    name="operating_hours"
		                                    id="operating_hours"
		                                    type="text"
		                                    placeholder="Ex. Monday - Friday, 10:00PM - 9:00PM"
		                                    :value="old('operating_hours', $application->operating_hours  ?? '')"
		                                />

		                                <x-input-field
		                                    label="Destination Address"
		                                    name="destination_address"
		                                    id="destination_address"
		                                    type="text"
		                                    placeholder="Ex. Panganiban Drive"
		                                    :value="old('destination_address', $application->destination_address  ?? '')"
		                                />
										<x-input-field
		                                    label="Locality"
		                                    name="locality"
		                                    id="locality"
		                                    type="text"
		                                    placeholder="Ex. Naga"
		                                    :value="old('Locality', $application->destination_address  ?? '')"
		                                />
	                                </div>
	                                <div class="col-md-6">
	                                	
	                                	<x-input-field
	                                	    label="Nearest Landmark 1"
	                                	    name="nearest_landmark1"
	                                	    id="nearest_landmark1"
	                                	    type="text"
	                                	    placeholder="Landmark 1"
	                                	    :value="old('nearest_landmark1', $application->nearest_landmark1  ?? '')"
	                                	/>

	                                	<x-input-field
	                                	    label="Nearest Landmark 2"
	                                	    name="nearest_landmark2"
	                                	    id="nearest_landmark2"
	                                	    type="text"
	                                	    placeholder="Landmark 2"
	                                	    :value="old('nearest_landmark2', $application->nearest_landmark2  ?? '')"
	                                	/>

	                                	<x-input-field
	                                	    label="Nearest Landmark 3"
	                                	    name="nearest_landmark3"
	                                	    id="nearest_landmark3"
	                                	    type="text"
	                                	    placeholder="Landmark 3"
	                                	    :value="old('nearest_landmark3', $application->nearest_landmark3  ?? '')"
	                                	/>

	                                	<x-input-field
	                                	    label="Amenities"
	                                	    name="amenities"
	                                	    id="amenities"
	                                	    type="textarea"
	                                	    placeholder="List of amenities"
	                                	    :value="old('amenities', $application->amenities  ?? '')"
	                                	/>
	                                </div>
	        					</div>
	        				</div>
	        			</div>

	        			<button type="submit" class="btn btn-primary w-100 mt-4">Update</button>
        			</form>
            	</div>
            </div>
        </div>
	</div>
	<!-- Modal for Company Permit -->
	<div class="modal fade" id="companyPermitModal" tabindex="-1" aria-labelledby="companyPermitLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="companyPermitLabel">Company Permit</h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <img class="w-100" src="{{ asset('images/company_permit/' . $application->company_permit)}}" alt="Company Permit">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for Location Clearance -->
	<div class="modal fade" id="locationClearanceModal" tabindex="-1" aria-labelledby="locationClearanceLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="locationClearanceLabel">Location Clearance</h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <img class="w-100" src="{{ asset('images/location_clearance/' . $application->location_clearance)}}" alt="Location Clearance">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for Barangay Clearance -->
	<div class="modal fade" id="barangayClearanceModal" tabindex="-1" aria-labelledby="barangayClearanceLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="barangayClearanceLabel">Barangay Clearance</h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <img class="w-100" src="{{ asset('images/barangay_clearance/' . $application->barangay_clearance)}}" alt="Barangay Clearance">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for Philhealth -->
	<div class="modal fade" id="philhealthModal" tabindex="-1" aria-labelledby="philhealthLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="philhealthLabel">Philhealth</h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <img class="w-100" src="{{ asset('images/philhealth/' . $application->philhealth)}}" alt="Philhealth">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for Corporate Bank Account -->
	<div class="modal fade" id="corporateBankAccountModal" tabindex="-1" aria-labelledby="corporateBankAccountLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="corporateBankAccountLabel">Corporate Bank Account</h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <img class="w-100" src="{{ asset('images/corporate_bank_account/' . $application->corporate_bank_account)}}" alt="Corporate Bank Account">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for SEC Registration -->
	<div class="modal fade" id="secRegistrationModal" tabindex="-1" aria-labelledby="secRegistrationLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="secRegistrationLabel">SEC Registration</h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <img class="w-100" src="{{ asset('images/sec_registration/' . $application->sec_registration)}}" alt="SEC Registration">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for TIN -->
	<div class="modal fade" id="tinModal" tabindex="-1" aria-labelledby="tinLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="tinLabel">TIN</h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <img class="w-100" src="{{ asset('images/tin/' . $application->tin)}}" alt="TIN">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for SSS -->
	<div class="modal fade" id="sssModal" tabindex="-1" aria-labelledby="sssLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h1 class="modal-title fs-5" id="sssLabel">SSS</h1>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
	            <div class="modal-body">
	                <img class="w-100" src="{{ asset('images/sss/' . $application->sss)}}" alt="SSS">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ asset('script.js') }}"></script>
</body>
</html>
