<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Plant<span>AI</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Community</li>
            <li class="nav-item">
                <a href="{{ route('experts.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Agricultural Experts</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('community.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Farmer Forum</span>
                </a>
            </li>

            <li class="nav-item nav-category">Scan GPT DETECTION HISTORY</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#diseases" role="button" aria-expanded="false" aria-controls="diseases">
                    <i class="link-icon" data-feather="database"></i>
                    <span class="link-title">Disease Database</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="diseases">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Plant Categories</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('diseases.index') }}" class="nav-link">Disease Types</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Treatment Methods</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#reports" role="button" aria-expanded="false" aria-controls="reports">
                    <i class="link-icon" data-feather="pie-chart"></i>
                    <span class="link-title">Reports</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="reports">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('reports.pgt-ai-results') }}" class="nav-link">Detection Statistics</a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li class="nav-item nav-category">Users</li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">User List</span>
                </a>
            </li>
        </ul>
    </div>
</nav>