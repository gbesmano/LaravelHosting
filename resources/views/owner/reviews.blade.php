<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <style>
        /* Table Styles */
        .table {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .table th, .table td {
            text-align: center; /* Center align table header and table data */
            padding: 12px;
            vertical-align: middle;
        }

        .table th {
            background-color: #0D6EFD;
            color: #ffffff;
            text-transform: uppercase;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .table td {
            color: #000000; /* Keep the review values black */
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .dropdown-menu {
            min-width: auto;
        }

        .lni-more {
            cursor: pointer;
            color: #0D6EFD;
        }

        .lni-more:hover {
            color: #0b5ed7;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table tr {
                display: block;
                margin-bottom: 15px;
            }

            .table td {
                display: block;
                text-align: right;
                font-size: 0.875rem;
                border-bottom: 1px solid #ddd;
                padding: 8px;
            }

            .table td:before {
                content: attr(data-label);
                float: left;
                font-weight: 600;
                color: #495057;
            }

            .table td:last-child {
                border-bottom: 0;
            }

            .table-responsive {
                border: none;
            }
        }

        /* Add margin-top to the reviews section */
        .reviews-section {
            margin-top: 30px;
        }

        /* Make the "Reviews" heading the same color as the table header */
        .reviews-section h1 {
            color: #0D6EFD;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        @include('owner/partials/aside')
        <div class="main p-3">
            <div class="text-center reviews-section">
                <h1>Reviews</h1>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Filter Dropdown for Review Status -->
                    <x-filter 
                        :options="[ 
                            ['value' => 'pending', 'label' => 'Pending'],
                            ['value' => 'declined', 'label' => 'Declined']
                        ]"
                        rowSelector="#reviewsTable tr"
                        columnIndex="7"
                        defaultLabel="All Status"
                    />

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Destination</th>
                                    <th>Review Title</th>
                                    <th>Reviewer</th>
                                    <th>Ratings</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="reviewsTable">
                                @forelse ($reviews as $review)
                                <tr>
                                    <td data-label="#"> {{ $loop->iteration }} </td>
                                    <td data-label="Company Name">{{ $review->destination->company_name }}</td>
                                    <td data-label="Destination">{{ $review->destination->destination_name }}</td>
                                    <td data-label="Review Title">{{ $review->review_title }}</td>
                                    <td data-label="Reviewer">{{ $review->user->firstname }} {{ $review->user->lastname }}</td>
                                    <td data-label="Ratings">{{ $review->rating }}</td>
                                    <td data-label="Date Created">{{ $review->formatted_created_at}}</td>
                                    <td data-label="Status">{{ ucfirst($review->status) }}</td>
                                    <td data-label="Action">
                                        <i class="lni lni-more" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#proofModal{{ $review->_id }}">View</a>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reportModal{{ $review->_id }}">Report</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Proof & Comment Modal -->
                                <div class="modal fade" id="proofModal{{ $review->_id }}" tabindex="-1" aria-labelledby="proofLabel{{ $review->_id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h1 class="modal-title fs-4 fw-bold text-dark" id="proofLabel{{ $review->_id }}">Proof & Comment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img class="img-fluid rounded mb-4 shadow-sm" src="{{ asset('images/proofs/' . $review->proof) }}" alt="Proof">
                <p class="text-muted mt-3">{{ $review->comment }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-100 fw-bold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

                                <!-- Report Modal -->
                                <div class="modal fade" id="reportModal{{ $review->_id }}" tabindex="-1" aria-labelledby="reportLabel{{ $review->_id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h1 class="modal-title fs-4 fw-bold text-dark" id="reportLabel{{ $review->_id }}">Report Review</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/owner/reports/store" method="POST">
                @csrf
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Hidden Fields -->
                    <input type="hidden" value="{{ $review->id }}" name="review_id" id="review_id">
                    <input type="hidden" value="{{ $review->destination_id }}" name="destination_id" id="destination_id">

                    <!-- Report Reason Options -->
                    @php
                    $reportOptions = [
                        ['name' => 'report_reason', 'value' => 'False information', 'label' => 'False information'],
                        ['name' => 'report_reason', 'value' => 'Offensive language', 'label' => 'Offensive language'],
                        ['name' => 'report_reason', 'value' => 'Spam', 'label' => 'Spam'],
                        ['name' => 'report_reason', 'value' => 'Conflict of interest', 'label' => 'Conflict of interest'],
                        ['name' => 'report_reason', 'value' => 'Privacy violation', 'label' => 'Privacy violation'],
                        ['name' => 'report_reason', 'value' => 'Irrelevant content', 'label' => 'Irrelevant content'],
                        ['name' => 'report_reason', 'value' => 'Threats', 'label' => 'Threats']
                    ];
                    @endphp

                    <x-input-radio :options="$reportOptions" name="reason" class="mb-3" />
                    <x-textarea-field label="Others" name="others" id="others" class="mt-3" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary w-100 fw-bold" type="submit">Submit Report</button>
                </div>
            </form>
        </div>
    </div>
</div>

                                @empty
                                <tr>
                                    <td colspan="9" class="text-center">No data yet</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
