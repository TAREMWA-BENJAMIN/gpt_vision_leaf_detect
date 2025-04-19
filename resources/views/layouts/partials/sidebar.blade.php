<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            ADMIN<span>UI</span>
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
            <li class="nav-item active">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Community</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#email" role="button" aria-expanded="false" aria-controls="email">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="email">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="email/inbox.html" class="nav-link">Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="email/read.html" class="nav-link">Read</a>
                        </li>
                        <li class="nav-item">
                            <a href="email/compose.html" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="apps/chat.html" class="nav-link">
                    <i class="link-icon" data-feather="message-square"></i>
                    <span class="link-title">Chat</span>
                </a>
            </li>
            <li class="nav-item nav-category">Components</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">UI Kit</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="ui-components/accordion.html" class="nav-link">Accordion</a>
                        </li>
                        <li class="nav-item">
                            <a href="ui-components/scrollspy.html" class="nav-link">Scrollspy</a>
                        </li>
                        <li class="nav-item">
                            <a href="ui-components/spinners.html" class="nav-link">Spinners</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button" aria-expanded="false" aria-controls="forms">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title">Forms</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="forms">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="forms/basic-elements.html" class="nav-link">Basic Elements</a>
                        </li>
                        <li class="nav-item">
                            <a href="forms/advanced-elements.html" class="nav-link">Advanced Elements</a>
                        </li>
                        <li class="nav-item">
                            <a href="forms/editors.html" class="nav-link">Editors</a>
                        </li>
                        <li class="nav-item">
                            <a href="forms/wizard.html" class="nav-link">Wizard</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Users</li>
            <li class="nav-item">
                <a href="apps/calendar.html" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">User List</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#auth" role="button" aria-expanded="false" aria-controls="auth">
                    <i class="link-icon" data-feather="unlock"></i>
                    <span class="link-title">Authentication</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="auth/login.html" class="nav-link">Logins</a>
                        </li>
                        <li class="nav-item">
                            <a href="auth/register.html" class="nav-link">Register</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Settings</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emailaaa" role="button" aria-expanded="false" aria-controls="email">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">System</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="email">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="auth/login.html" class="nav-link">Regions</a>
                        </li>
                        <li class="nav-item">
                            <a href="auth/register.html" class="nav-link">Sub Regions</a>
                        </li>
                        <li class="nav-item">
                            <a href="auth/register.html" class="nav-link">Countries</a>
                        </li>
                        <li class="nav-item">
                            <a href="auth/register.html" class="nav-link">Districts</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>