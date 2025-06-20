<!-- resources/views/layouts/partials/navbar-items.blade.php -->
<ul class="navbar-nav">
    <!-- Language Dropdown -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('files/images/flags/ug.png') }}" class="wd-20 me-1" title="us" alt="us"> 
            <span class="ms-1 me-1 d-none d-md-inline-block">Uganda</span>
        </a>
    </li>

    <!-- Profile Dropdown (Debug Mode) -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="wd-30 ht-30 rounded-circle" src="{{ Auth::user() && Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default-avatar.png') }}" alt="profile">
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                <div class="mb-3">
                    <img class="wd-80 ht-80 rounded-circle" src="{{ Auth::user() && Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default-avatar.png') }}" alt="">
                </div>
                <div class="text-center">
                    <p class="tx-16 fw-bolder mb-0">{{ Auth::user() ? (Auth::user()->name ?? Auth::user()->first_name) : 'No user' }}</p>
                    <p class="tx-12 text-muted mb-0">{{ Auth::user() ? Auth::user()->email : 'No email' }}</p>
                </div>
                <div class="text-danger small mt-2">DEBUG: {{ Auth::user() ? json_encode(Auth::user()) : 'No Auth::user()' }}</div>
            </div>
            <ul class="list-unstyled p-1">
                <li class="dropdown-item py-2">
                    <a href="{{ route('profile.show') }}" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="dropdown-item py-2">
                    <a href="{{ route('profile.edit') }}" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="edit"></i>
                        <span>Edit Profile</span>
                    </a>
                </li>
                <li class="dropdown-item py-2">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="text-body ms-0 border-0 bg-transparent w-100 text-start">
                            <i class="me-2 icon-md" data-feather="log-out"></i>
                            <span>Log Out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </li>
</ul>