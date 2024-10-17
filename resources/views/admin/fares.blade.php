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

        /* Fares text styling */
        h1 {
            color: #0D6EFD; /* Make "Fares" text this color */
            margin-top: 20px; /* Add some margin on top of the "Fares" text */
        }
    </style>
</head>
<body>
    <div class="wrapper">
        @include('admin/partials/aside')
        <div class="main p-3">
            <div class="text-center">
                <h1>Fares</h1>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <!-- SweetAlert for Success -->
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: "{{ session('success') }}",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        </script>
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

                    <!-- Vehicle Filter Dropdown -->
                    <x-filter 
                        :options="[ 
                            ['value' => 'e-trike', 'label' => 'E-Trike'],
                            ['value' => 'traditional jeepney', 'label' => 'Traditional Jeepney'],
                            ['value' => 'modern jeepney', 'label' => 'Modern Jeepney'],
                            ['value' => 'tricycle', 'label' => 'Tricycle'],
                            ['value' => 'taxi', 'label' => 'Taxi'],
                            ['value' => 'padyak', 'label' => 'Padyak']
                        ]"
                        rowSelector="#faresTableBody tr"
                        columnIndex="1"
                        defaultLabel="All Vehicles"
                    />

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vehicle</th>
                                    <th>Locality</th>
                                    <th>Operating Hours</th>
                                    <th>Distance</th>
                                    <th>Initial Fare</th>
                                    <th>Additional Fare</th>
                                    <th>Discounted Fare</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="faresTableBody">
                                @forelse ($fares as $fare)
                                    <tr>
                                        <td data-label="#"> {{ $loop->iteration }} </td>
                                        <td data-label="Vehicle">{{ $fare->vehicle }}</td>
                                        <td data-label="Locality">{{ $fare->designated_locality }}</td>
                                        <td data-label="Operating Hours">{{ $fare->operating_hours }}</td>
                                        <td data-label="Distance">{{ $fare->distance }}</td>
                                        <td data-label="Initial Fare">{{ $fare->initial_fare }}</td>
                                        <td data-label="Additional Fare">{{ $fare->additional_fare }}</td>
                                        <td data-label="Discounted Fare">{{ $fare->discounted_fare }}</td>
                                        <td data-label="Actions">
                                            <i class="lni lni-more" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a href="/admin/fares/edit/{{ $fare->id }}" class="dropdown-item">Edit</a>
                                                <form action="/admin/fares/delete/{{ $fare->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
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
    <script>
        // Vehicle filter functionality
        document.getElementById('vehicleFilter').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const filterValue = document.getElementById('vehicleFilter').value.toLowerCase();
            const rows = document.querySelectorAll('#faresTableBody tr');

            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                const vehicle = cells[1]?.textContent.trim().toLowerCase();

                if (filterValue === 'all' || vehicle === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
    <script src="{{ asset('script.js') }}"></script>
</body>
</html>
