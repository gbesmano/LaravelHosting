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
            text-align: center; /* Center the text in th and td */
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

        /* Center Destinations text and match color with thead */
        h1 {
            color: #0D6EFD; /* Matches thead background color */
            margin-top: 2rem; /* Adds space on top */
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
    </style>
</head>
<body>
	<div class="wrapper">
		@include('owner/partials/aside')
		<div class="main p-3">
            <div class="text-center">
                <h1 class="mt-5">Destinations</h1> <!-- Added mt-5 for margin and changed color -->
            </div>
            <div class="row justify-content-center mt-5">
            	<div class="col-sm-12 col-md-10 col-lg-10">
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
                            ['value' => 'Resort', 'label' => 'Resort'],
                            ['value' => 'Hotel', 'label' => 'Hotel'],
                            ['value' => 'Park', 'label' => 'Park'],
                            ['value' => 'Adventure', 'label' => 'Adventure'],
                            ['value' => 'Sports', 'label' => 'Sports'],
                            ['value' => 'Wine & Beer', 'label' => 'Wine & Beer'],
                            ['value' => 'Restaurant', 'label' => 'Restaurant'],
                            ['value' => 'Fastfood', 'label' => 'Fastfood'],
                            ['value' => 'Church', 'label' => 'Church'],
                            ['value' => 'Art Galleries', 'label' => 'Art Galleries']
                        ]"
                        rowSelector="#destinationsTable tr"
                        columnIndex="3"
                        defaultLabel="All Destinations"
                    />
            		<div class="table-responsive">
            			<table class="table table-hover table-striped">
            				<thead>
                                <th>#</th>
                                <th>Company Name</th>
                                <th>Destination</th>
                                <th>Category</th>
                                <th>Operating Hours</th>
                                <th>Address</th>
                                <th>Locality</th>
                                <th>Actions</th>
            				</thead>
            				<tbody id="destinationsTable">
            					@forelse ($destinations as $destination)
                                    <tr>
                                        <td data-label="#"> {{ $loop->iteration }} </td>
                                        <td data-label="Company Name">{{ $destination->company_name }}</td>
                                        <td data-label="Destination">{{ $destination->destination_name }}</td>
                                        <td data-label="Category">{{ $destination->category }}</td>
                                        <td data-label="Operating Hours">{{ $destination->operating_hours }}</td>
                                        <td data-label="Address">{{ $destination->destination_address }}</td>
                                        <td data-label="Locality">{{ $destination->locality }}</td>
                                        <td data-label="Actions">
                                            <i class="lni lni-more" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a href="/owner/applications/view/{{ $destination->id }}" class="dropdown-item">View</a>
                                                <a href="/owner/applications/edit/{{ $destination->id }}" class="dropdown-item">Edit</a>
                                                <a href="/owner/destination/presentation/{{ $destination->id }}" class="dropdown-item">Edit Landing Page</a>
                                                <form action="/owner/applications/delete/{{ $destination->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No data yet</td>
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
        document.addEventListener('DOMContentLoaded', function() {
            const filterDropdown = document.querySelector('[data-filter-dropdown]');
            const rows = document.querySelectorAll('#destinationsTable tr');

            if (filterDropdown) {
                filterDropdown.addEventListener('change', function() {
                    const filterValue = this.value.toLowerCase();
                    rows.forEach(row => {
                        const categoryCell = row.children[3]?.textContent.trim().toLowerCase();
                        if (filterValue === '' || categoryCell === filterValue) {
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
