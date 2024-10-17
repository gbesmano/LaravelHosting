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
    /* Container for the image with an elegant overlay effect */
    .image-container {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    .image-container img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .image-container:hover img {
        transform: scale(1.05);
    }

    /* Edit button with a floating glassy effect */
    .edit-button {
        position: absolute;
        bottom: 15px;
        right: 25px;
        background-color: rgba(255, 255, 255, 0.8);
        color: #007bff;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        font-weight: bold;
    }
    .edit-button:hover {
        background-color: #007bff;
        color: white;
        transform: translateY(-2px);
    }

    /* Elegant card styling */
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background-color: white;
        padding: 30px;
        margin-top: 15px;
    }

    /* Typography improvements */
    h1, h2 {
        font-weight: bold;
        color: #0d6efd;
    }
    h1 {
        margin-bottom: 10px;
    }
    h6 {
        font-size: 1rem;
        line-height: 1.5;
        color: #6c757d;
    }

    /* Elegant detail list styling */
    dl.row dt {
        font-weight: bold;
        color: #0d6efd;
    }
    dl.row dd {
        margin-bottom: 10px;
        color: #495057;
    }

    /* Map section styling */
    .map-image img {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Modal improvements */
    .modal-content {
        border-radius: 15px;
    }
    .modal-header {
        border-bottom: none;
    }
    .modal-footer button {
        border-radius: 25px;
        padding: 12px 20px;
        font-weight: bold;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .image-container img {
            height: 200px;
        }
        .edit-button {
            padding: 8px 18px;
            font-size: 0.9rem;
        }
        .card {
            margin-top: 10px;
            padding: 20px;
        }
    }


    </style>
</head>
<body>
    <div class="wrapper">
        @include('admin/partials/aside')
        <div class="main p-3">
            <div class="container">
                <!-- First Row: Image with Overlayed Button -->
                <div class="row mb-4">
                    <div class="col-12 image-container">
                        <img src="{{ $destination->coverphoto ? asset('images/coverphotos/' . $destination->coverphoto) : 'https://www.firstbenefits.org/wp-content/uploads/2017/10/placeholder.png' }}" alt="Destination Image">
                        <button type="button" class="edit-button" data-bs-toggle="modal" data-bs-target="#editCoverPhotoModal">
                            Edit
                        </button>
                    </div>
                </div>

                <!-- Second Row: Destination Name -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h1>{{ $destination->destination_name }}</h1>
                    </div>
                </div>

                <!-- Third Row: About Section and Map -->
                <div class="row">
                    <!-- About Section -->
                    <!-- About Section -->
                    <div class="col-md-6 mb-4">
                        <h2>About</h2>
                        <h6>{{ $destination->about }} </h6>
                        <dl class="row">
                            <dt class="col-sm-4"><strong>Company Name:</strong></dt>
                            <dd class="col-sm-8">{{ $destination->company_name }}</dd>

                            <dt class="col-sm-4"><strong>Company Address:</strong></dt>
                            <dd class="col-sm-8">{{ $destination->company_address }}</dd>

                            <dt class="col-sm-4"><strong>Category:</strong></dt>
                            <dd class="col-sm-8">{{ $destination->category }}</dd>

                            <dt class="col-sm-4"><strong>Operating Hours:</strong></dt>
                            <dd class="col-sm-8">{{ $destination->operating_hours }}</dd>

                            <dt class="col-sm-4"><strong>Destination Address:</strong></dt>
                            <dd class="col-sm-8">{{ $destination->destination_address }}</dd>

                            <dt class="col-sm-4"><strong>Nearest Landmark 1:</strong></dt>
                            <dd class="col-sm-8">{{ $destination->nearest_landmark1 }}</dd>

                            <dt class="col-sm-4"><strong>Nearest Landmark 2:</strong></dt>
                            <dd class="col-sm-8">{{ $destination->nearest_landmark2 }}</dd>

                            <dt class="col-sm-4"><strong>Nearest Landmark 3:</strong></dt>
                            <dd class="col-sm-8">{{ $destination->nearest_landmark3 }}</dd>

                            <dt class="col-sm-4"><strong>Amenities:</strong></dt>
                            <dd class="col-sm-8">{{ $destination->amenities }}</dd>

                        </dl>
                    </div>


                    <!-- Map Section -->
                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editCoverPhotoModal" tabindex="-1" aria-labelledby="editCoverPhotoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="corporateBankAccountLabel">Upload new cover photo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/destination/coverphoto/{{ $destination->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" class="form-control" id="coverphoto" name="coverphoto">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary w-100">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ asset('script.js') }}"></script>
</body>
</html>
