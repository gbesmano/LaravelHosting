<aside id="sidebar" class="expand" style="background: linear-gradient(180deg, #0b0e1f, #0040ff); color: #000; padding: 1rem; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); overflow: hidden; width: 260px; transition: width 0.5s ease;">
    <div class="d-flex align-items-center mb-3" style="margin-left: 0;">
        <div class="sidebar-logo ms-1 text-center" style="width: 100%; overflow: hidden;">
            <img src="{{ asset('assets/travel.png') }}" alt="TravelMate Logo" style="width: 120px; margin-bottom: 10px;">
            <h3 style="font-weight: bold; color: #ffffff; font-size: 2rem; text-align: center; white-space: nowrap; font-family: 'Poppins', sans-serif;">TRAVELMATE</h3>
        </div>
    </div>
    <div class="usertype text-center mb-4" style="font-size: 2rem; padding-top: 10px;">
        <h5 style="font-weight: 600; color: #ffffff; font-size: 1.8rem; font-family: 'Poppins', sans-serif;">OWNER</h5>
    </div>
    <ul class="sidebar-nav list-unstyled">

        <li class="sidebar-item mb-3">
            <div class="sidebar-item-wrapper d-flex align-items-center" style="background-color: #ffffff; border-radius: 5px; padding: 10px;">
                <a href="/owner/dashboard" class="sidebar-link d-flex align-items-center w-100" style="text-decoration: none; color: #000;">
                <i class="lni lni-agenda me-3" style="font-size: 1.5rem;"></i>
                    <span style="font-size: 1.1rem; font-family: 'Poppins', sans-serif;">Dashboard</span>
                </a>
            </div>
        </li>

        <li class="sidebar-item mb-3">
            <div class="sidebar-item-wrapper d-flex align-items-center" style="background-color: #ffffff; border-radius: 5px; padding: 10px;">
                <a href="/owner/reviews" class="sidebar-link d-flex align-items-center w-100" style="text-decoration: none; color: #000;">
                    <i class="lni lni-pencil me-3" style="font-size: 1.5rem;"></i>
                    <span style="font-size: 1.1rem; font-family: 'Poppins', sans-serif;">Reviews</span>
                </a>
            </div>
        </li>

        <li class="sidebar-item mb-3">
            <div class="sidebar-item-wrapper" style="background-color: #ffffff; border-radius: 5px;">
                <a href="#" class="sidebar-link d-flex align-items-center collapsed w-100" style="text-decoration: none; color: #000; padding: 10px;" data-bs-toggle="collapse" data-bs-target="#application" aria-expanded="false" aria-controls="application">
                    <i class="lni lni-briefcase me-3" style="font-size: 1.5rem;"></i>
                    <span style="font-size: 1.1rem; font-family: 'Poppins', sans-serif;">Application</span>
                </a>
            </div>
            <ul id="application" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="background-color: #e0e0e0; border-radius: 5px;">
                <li class="sidebar-item">
                    <a href="/owner/applications/create" class="sidebar-link" style="text-decoration: none; color: #000; padding: 5px 15px;">
                        <span style="font-size: 1rem; font-family: 'Poppins', sans-serif;">Create Application</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/owner/applications" class="sidebar-link" style="text-decoration: none; color: #000; padding: 5px 15px;">
                        <span style="font-size: 1rem; font-family: 'Poppins', sans-serif;">My Applications</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item mb-3">
            <div class="sidebar-item-wrapper d-flex align-items-center" style="background-color: #ffffff; border-radius: 5px; padding: 10px;">
                <a href="/owner/destinations" class="sidebar-link d-flex align-items-center w-100" style="text-decoration: none; color: #000;">
                    <i class="lni lni-car me-3" style="font-size: 1.5rem;"></i>
                    <span style="font-size: 1.1rem; font-family: 'Poppins', sans-serif;">Destinations</span>
                </a>
            </div>
        </li>
    </ul>
    <div class="sidebar-footer mt-5">
        <div class="sidebar-item-wrapper d-flex align-items-center" style="background-color: #ffffff; border-radius: 5px;">
            <a href="/logout" class="sidebar-link d-flex align-items-center w-100 justify-content-center" style="text-decoration: none; padding: 10px 15px; background-color: #ffffff; color: #000; border-radius: 5px;">
                <i class="lni lni-exit me-3" style="font-size: 1.5rem;"></i>
                <span style="font-size: 1.1rem; font-family: 'Poppins', sans-serif;">Logout</span>
            </a>
        </div>
    </div>
</aside>

<!-- Include Google Font Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    #sidebar.expand {
        width: 260px;
    }
    #sidebar:not(.expand) {
        width: 80px;
    }
    .sidebar-link:hover {
        background-color: rgba(0, 0, 0, 0.1);
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    .sidebar-logo, .usertype {
        transition: opacity 0.5s ease;
    }
    #sidebar:not(.expand) .sidebar-logo, #sidebar:not(.expand) .usertype {
        opacity: 0;
    }
</style>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('expand');
    }
</script>
