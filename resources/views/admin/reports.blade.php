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
        /* Table Styles */
        .table {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .table th, .table td {
            text-align: center; /* Center the table headers and cells */
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

        /* Reports text styling */
        h1 {
            color: #0D6EFD; /* Make "Reports" text this color */
            margin-top: 20px; /* Add some margin on top of the "Reports" text */
        }
    </style>
</head>
<body>
	<div class="wrapper">
		@include('admin/partials/aside')
		<div class="main p-3">
            <div class="text-center">
                <h1>Reports</h1>
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

                    <x-filter 
                        :options="[ 
                            ['value' => 'False Information', 'label' => 'False Information'],
                            ['value' => 'Offensive Content', 'label' => 'Offensive Content'],
                            ['value' => 'Spam', 'label' => 'Spam'],
                            ['value' => 'Conflicts of Interest', 'label' => 'Conflicts of Interest'],
                            ['value' => 'Privacy Violation', 'label' => 'Privacy Violation'],
                            ['value' => 'Irrelevant Content', 'label' => 'Irrelevant Content'],
                            ['value' => 'Threats or Harassment', 'label' => 'Threats or Harassment']
                        ]"
                        rowSelector="#reportTableBody tr"
                        columnIndex="2"
                        defaultLabel="All Reports"
                    />

            		<div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>#</th>
                                <th>Destination</th>
                                <th>Report</th>
                                <th>Reviewer</th>
                                <th>Ratings</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </thead>
                            <tbody id="reportTableBody">
                                @forelse ($reports as $report)

                                <tr>
                                    <td data-label="#"> {{ $loop->iteration }} </td>
                                    <td data-label="Destination">{{ $report->review->destination->destination_name }}</td>
                                    <td data-label="Report">{{ $report->reason }}</td>
                                    <td data-label="Reviewer">{{ $report->review->user->firstname }} {{ $report->review->user->lastname }}</td>
                                    <td data-label="Ratings">{{ $report->review->rating }}</td>
                                    <td data-label="Date Created">{{ $report->formatted_created_at }}</td>
                                    <td data-label="Actions">
                                        <i class="lni lni-more" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#proofModal">View</a>
                                            <form action="/admin/reports/approve/{{ $report->id }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item">Delete</button>
                                            </form>

                                            <form action="/admin/reports/decline/{{ $report->id }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item">Decline</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h1 class="modal-title fs-4 fw-bold text-dark" id="companyPermitLabel">Proof & Comment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img class="img-fluid rounded mb-4 shadow-sm" src="{{ asset('images/proofs/' . $report->review->proof)}}" alt="Proof">
                <p class="text-muted">{{ $report->review->comment }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-100 fw-bold" data-bs-dismiss="modal">Close</button>
            </div>
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

    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            var filter = this.value.toLowerCase();
            var rows = document.querySelectorAll('#reportTableBody tr');

            rows.forEach(function (row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        document.getElementById('filterSelect').addEventListener('change', function () {
            var filter = this.value.toLowerCase();
            var rows = document.querySelectorAll('#reportTableBody tr');

            rows.forEach(function (row) {
                var reportText = row.querySelector('.report-column').textContent.toLowerCase();
                row.style.display = filter === '' || reportText.includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
