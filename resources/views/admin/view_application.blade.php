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
    <style>
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
        }

        .card h4 {
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.2rem;
            color: #0D6EFD;
        }

        .btn-info {
            background-color: #0D6EFD;
            color: #fff;
            font-weight: 500;
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            padding: 10px 15px;
        }

        .btn-info:hover {
            background-color: #0b5ed7;
            color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .btn-danger {
            border-radius: 20px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #dc3545;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        /* Modal Image Styles */
        .modal-body img {
            border-radius: 10px;
        }

        /* Modal Header, Body, Footer Centering */
        .modal-header, .modal-footer {
            justify-content: center;
        }

        /* Style for Destination Name */
        h1 {
            color: #0D6EFD;
            margin-top: 2rem;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .card h4 {
                font-size: 1.5rem;
            }

            .btn-info {
                padding: 12px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
	<div class="wrapper">
		@include('admin/partials/aside')
		<div class="main p-3">
            <div class="text-center">
                <h1>{{ $application->destination_name }}</h1>
            </div>

            <div class="row justify-content-center mt-5">
            	<div class="col-sm-12 col-md-8 col-lg-10">
        			<!-- First Card -->
        			<div class="card mb-4">
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
	                                    disabled="true"
	                                    :value="old('company_name', $application->company_name  ?? '')"
	                                />

	                                <x-input-field
	                                    label="Company Address"
	                                    name="company_address"
	                                    id="company_address"
	                                    type="text"
	                                    placeholder="123 Street Name"
	                                    disabled="true"
	                                    :value="old('company_address', $application->company_address  ?? '')"
	                                />

	                                <x-textarea-field
	                                    label="About"
	                                    name="about"
	                                    id="about"
	                                    type="textarea"
	                                    placeholder="Description of the company"
	                                    disabled="true"
	                                    :value="old('about', $application->about  ?? '')"
	                                />
	                            </div>

	                            <div class="col-md-6">
		                            <div class="row">
		                            	<label class="form-label">View files</label>
		                            	<div class="col-sm-12 col-md-6">

		                            	    <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#companyPermitModal">
		                            	        Company Permit
		                            	    </button>

		                            	    <button type="button" class="btn btn-info w-100 mt-4" data-bs-toggle="modal" data-bs-target="#locationClearanceModal">
		                            	        Location Clearance
		                            	    </button>

		                            	    <button type="button" class="btn btn-info w-100 mt-4" data-bs-toggle="modal" data-bs-target="#barangayClearanceModal">
		                            	        Barangay Clearance
		                            	    </button>

		                            	    <button type="button" class="btn btn-info w-100 mt-4" data-bs-toggle="modal" data-bs-target="#philhealthModal">
		                            	        Philhealth
		                            	    </button>
		                            	</div>

		                            	<div class="col-sm-12 col-md-6">
		                            	    <button type="button" class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#corporateBankAccountModal">
		                            	        Corporate Bank Account
		                            	    </button>

		                            	    <button type="button" class="btn btn-info w-100 mt-4" data-bs-toggle="modal" data-bs-target="#secRegistrationModal">
		                            	        SEC Registration
		                            	    </button>

		                            	    <button type="button" class="btn btn-info w-100 mt-4" data-bs-toggle="modal" data-bs-target="#tinModal">
		                            	        TIN
		                            	    </button>

		                            	    <button type="button" class="btn btn-info w-100 mt-4" data-bs-toggle="modal" data-bs-target="#sssModal">
		                            	        SSS
		                            	    </button>
		                            	</div>
		                            </div>
	                            </div>
                            </div>
        				</div>
        			</div>

        			<!-- Second Card -->
        			<div class="card">
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
	                                    disabled="true"
	                                    :value="old('destination_name', $application->destination_name  ?? '')"
	                                />

	                                <x-input-field
	                                    label="Category"
	                                    name="category"
	                                    id="category"
	                                    type="text"
	                                    placeholder="Destination Category"
	                                    disabled="true"
	                                    :value="old('category', $application->category  ?? '')"
	                                />

	                                <x-input-field
	                                    label="Operating Hours"
	                                    name="operating_hours"
	                                    id="operating_hours"
	                                    type="text"
	                                    placeholder="Operating Hours"
	                                    disabled="true"
	                                    :value="old('operating_hours', $application->operating_hours  ?? '')"
	                                />

	                                <x-input-field
	                                    label="Destination Address"
	                                    name="destination_address"
	                                    id="destination_address"
	                                    type="text"
	                                    placeholder="Destination Address"
	                                    disabled="true"
	                                    :value="old('destination_address', $application->destination_address  ?? '')"
	                                />
                                </div>
                                <div class="col-md-6">
                                	
                                	<x-input-field
                                	    label="Nearest Landmark 1"
                                	    name="nearest_landmark1"
                                	    id="nearest_landmark1"
                                	    type="text"
                                	    placeholder="Landmark 1"
                                	    disabled="true"
                                	    :value="old('nearest_landmark1', $application->nearest_landmark1  ?? '')"
                                	/>

                                	<x-input-field
                                	    label="Nearest Landmark 2"
                                	    name="nearest_landmark2"
                                	    id="nearest_landmark2"
                                	    type="text"
                                	    placeholder="Landmark 2"
                                	    disabled="true"
                                	    :value="old('nearest_landmark2', $application->nearest_landmark2  ?? '')"
                                	/>

                                	<x-input-field
                                	    label="Nearest Landmark 3"
                                	    name="nearest_landmark3"
                                	    id="nearest_landmark3"
                                	    type="text"
                                	    placeholder="Landmark 3"
                                	    disabled="true"
                                	    :value="old('nearest_landmark3', $application->nearest_landmark3  ?? '')"
                                	/>

                                	<x-input-field
                                	    label="Amenities"
                                	    name="amenities"
                                	    id="amenities"
                                	    type="textarea"
                                	    placeholder="List of amenities"
                                	    disabled="true"
                                	    :value="old('amenities', $application->amenities  ?? '')"
                                	/>
                                </div>
        					</div>

        					@if ($application->user_id !== auth()->user()->id) 
	        					<div class="row mt-4">
	        						<div class="col-4">
		                                <form action="/admin/applications/approve/{{ $application->id }}" method="POST">
	                                        @csrf
	                                        @method('PUT')
	                                        <button type="submit" class="btn btn-primary w-100">Approve</button>
	                                    </form>
		                            </div>
		                            <div class="col-4">
									<form action="/admin/applications/decline/{{ $application->id }}" method="POST">
	                                        @csrf
	                                        @method('PATCH')                             
		                                <button class="btn btn-warning w-100">Reject</button>
										</form>
		                            </div>
		                            <div class="col-4">
		                                <form action="/admin/applications/delete/{{ $application->id }}" method="POST">
	                                        @csrf
	                                        @method('DELETE')
	                                        <button type="submit" class="btn btn-danger w-100">Delete</button>
	                                    </form>
		                            </div>
	        					</div>
        					@endif
        				</div>
        			</div>
            	</div>
            </div>
        </div>
	</div>
	<!-- Modal for Company Permit -->
	<div class="modal fade" id="companyPermitModal" tabindex="-1" aria-labelledby="companyPermitLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header justify-content-center">
	                <h1 class="modal-title fs-5 text-center" id="companyPermitLabel">Company Permit</h1>
	            </div>
	            <div class="modal-body text-center">
	                <img class="w-100" src="{{ asset('images/company_permit/' . $application->company_permit)}}" alt="Company Permit">
	            </div>
	            <div class="modal-footer justify-content-center">
	                <button type="button" class="btn btn-info w-50" data-bs-dismiss="modal" style="border-radius: 25px; padding: 12px 20px;">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for Location Clearance -->
	<div class="modal fade" id="locationClearanceModal" tabindex="-1" aria-labelledby="locationClearanceLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header justify-content-center">
	                <h1 class="modal-title fs-5 text-center" id="locationClearanceLabel">Location Clearance</h1>
	            </div>
	            <div class="modal-body text-center">
	                <img class="w-100" src="{{ asset('images/location_clearance/' . $application->location_clearance)}}" alt="Location Clearance">
	            </div>
	            <div class="modal-footer justify-content-center">
	                <button type="button" class="btn btn-info w-50" data-bs-dismiss="modal" style="border-radius: 25px; padding: 12px 20px;">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for Barangay Clearance -->
	<div class="modal fade" id="barangayClearanceModal" tabindex="-1" aria-labelledby="barangayClearanceLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header justify-content-center">
	                <h1 class="modal-title fs-5 text-center" id="barangayClearanceLabel">Barangay Clearance</h1>
	            </div>
	            <div class="modal-body text-center">
	                <img class="w-100" src="{{ asset('images/barangay_clearance/' . $application->barangay_clearance)}}" alt="Barangay Clearance">
	            </div>
	            <div class="modal-footer justify-content-center">
	                <button type="button" class="btn btn-info w-50" data-bs-dismiss="modal" style="border-radius: 25px; padding: 12px 20px;">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for Philhealth -->
	<div class="modal fade" id="philhealthModal" tabindex="-1" aria-labelledby="philhealthLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header justify-content-center">
	                <h1 class="modal-title fs-5 text-center" id="philhealthLabel">Philhealth</h1>
	            </div>
	            <div class="modal-body text-center">
	                <img class="w-100" src="{{ asset('images/philhealth/' . $application->philhealth)}}" alt="Philhealth">
	            </div>
	            <div class="modal-footer justify-content-center">
	                <button type="button" class="btn btn-info w-50" data-bs-dismiss="modal" style="border-radius: 25px; padding: 12px 20px;">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for Corporate Bank Account -->
	<div class="modal fade" id="corporateBankAccountModal" tabindex="-1" aria-labelledby="corporateBankAccountLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header justify-content-center">
	                <h1 class="modal-title fs-5 text-center" id="corporateBankAccountLabel">Corporate Bank Account</h1>
	            </div>
	            <div class="modal-body text-center">
	                <img class="w-100" src="{{ asset('images/corporate_bank_account/' . $application->corporate_bank_account)}}" alt="Corporate Bank Account">
	            </div>
	            <div class="modal-footer justify-content-center">
	                <button type="button" class="btn btn-info w-50" data-bs-dismiss="modal" style="border-radius: 25px; padding: 12px 20px;">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for SEC Registration -->
	<div class="modal fade" id="secRegistrationModal" tabindex="-1" aria-labelledby="secRegistrationLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header justify-content-center">
	                <h1 class="modal-title fs-5 text-center" id="secRegistrationLabel">SEC Registration</h1>
	            </div>
	            <div class="modal-body text-center">
	                <img class="w-100" src="{{ asset('images/sec_registration/' . $application->sec_registration)}}" alt="SEC Registration">
	            </div>
	            <div class="modal-footer justify-content-center">
	                <button type="button" class="btn btn-info w-50" data-bs-dismiss="modal" style="border-radius: 25px; padding: 12px 20px;">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for TIN -->
	<div class="modal fade" id="tinModal" tabindex="-1" aria-labelledby="tinLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header justify-content-center">
	                <h1 class="modal-title fs-5 text-center" id="tinLabel">TIN</h1>
	            </div>
	            <div class="modal-body text-center">
	                <img class="w-100" src="{{ asset('images/tin/' . $application->tin)}}" alt="TIN">
	            </div>
	            <div class="modal-footer justify-content-center">
	                <button type="button" class="btn btn-info w-50" data-bs-dismiss="modal" style="border-radius: 25px; padding: 12px 20px;">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal for SSS -->
	<div class="modal fade" id="sssModal" tabindex="-1" aria-labelledby="sssLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header justify-content-center">
	                <h1 class="modal-title fs-5 text-center" id="sssLabel">SSS</h1>
	            </div>
	            <div class="modal-body text-center">
	                <img class="w-100" src="{{ asset('images/sss/' . $application->sss)}}" alt="SSS">
	            </div>
	            <div class="modal-footer justify-content-center">
	                <button type="button" class="btn btn-info w-50" data-bs-dismiss="modal" style="border-radius: 25px; padding: 12px 20px;">Close</button>
	            </div>
	        </div>
	    </div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ asset('script.js') }}"></script>
</body>
</html>
