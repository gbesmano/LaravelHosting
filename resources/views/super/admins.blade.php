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

        /* Admins text styling */
        h1 {
            color: #0D6EFD; /* Make "Admins" text this color */
            margin-top: 20px; /* Add some margin on top of the "Admins" text */
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('super/partials/aside')
        <div class="main p-3">
            <div class="text-center">
                <h1>Admins</h1>
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

                    <!-- Search Bar -->
                    <div class="row mb-3">
                        <div class="col-md-6"> <!-- Set the search bar size to retain its width -->
                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Locality</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="faresTableBody">
                                @forelse ($admins as $admin)
                                <tr>
                                    <td data-label="#"> {{ $loop->iteration }} </td>
                                    <td data-label="Name">{{ $admin->firstname }} {{ $admin->lastname }}</td>
                                    <td data-label="Locality">{{ $admin->locality }}</td>
                                    <td data-label="Email">{{ $admin->email }}</td>
                                    <td data-label="Mobile Number">{{ $admin->mobile_no }}</td>
                                    <td data-label="Date Created">{{ $admin->created_at->timezone('Asia/Manila')->format('F j, Y') }}</td>

                                    <td data-label="Actions">
                                        <i class="lni lni-more" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a href="/super/admins/edit/{{ $admin->id }}" class="dropdown-item">Edit</a>
                                            <form action="/super/admins/delete/{{ $admin->id }}" method="POST">
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
        // Search functionality
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const rows = document.querySelectorAll('#faresTableBody tr');

            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    const searchValue = this.value.toLowerCase();

                    rows.forEach(row => {
                        const rowText = row.textContent.trim().toLowerCase();
                        if (rowText.includes(searchValue)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
    <script src="{{ asset('script.js') }}"></script>
</body>

</html>
