<!-- resources/views/layouts/partials/navbar-items.blade.php -->
<ul class="navbar-nav">
    <!-- Language Dropdown -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('files/images/flags/ug.png') }}" class="wd-20 me-1" title="us" alt="us"> 
            <span class="ms-1 me-1 d-none d-md-inline-block">Uganda</span>
        </a>
       
    </li>

    <!-- Profile Dropdown -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="wd-30 ht-30 rounded-circle" src="{{ asset('files/images/faces/face1.jpg') }}" alt="profile">
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                <div class="mb-3">
                    <img class="wd-80 ht-80 rounded-circle" src="{{ asset('files/images/faces/face1.jpg') }}" alt="">
                </div>
                <div class="text-center">
                    <p class="tx-16 fw-bolder">Amiah Burton</p>
                    <p class="tx-12 text-muted">amiahburton@gmail.com</p>
                </div>
            </div>
            <ul class="list-unstyled p-1">
                <li class="dropdown-item py-2">
                    <a href="general/profile.html" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="dropdown-item py-2">
                    <a href="javascript:;" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="edit"></i>
                        <span>Edit Profile</span>
                    </a>
                </li>
                <li class="dropdown-item py-2">
                    <a href="javascript:;" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="repeat"></i>
                        <span>Switch User</span>
                    </a>
                </li>
                <li class="dropdown-item py-2">
                    <a href="javascript:;" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="log-out"></i>
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
</ul>