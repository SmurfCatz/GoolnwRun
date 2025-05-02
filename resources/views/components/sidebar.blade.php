<div class="sidebar shadow-lg m-0 border-0" style="position: fixed; top: 0; left: 0; height: 100vh; width: 300px;">
    @auth
    <div class="sidebar-header text-center py-3">
        <img src="{{ auth()->user()->member_image ? asset('storage/' . auth()->user()->member_image) : asset('images/default-avatar.png') }}"
            alt="Profile Picture"
            class="rounded-circle"
            width="80"
            height="80"
            style="object-fit: cover;">
        <div class="mt-2 fw-bold">{{ auth()->user()->member_name }}</div>
        <div class="text-muted" style="font-size: 14px;">{{ auth()->user()->member_email }}</div>
        <div class="text-muted" style="font-size: 14px;">{{ auth()->user()->member_role }}</div>
    </div>
    @endauth
    <ul class="ant-menu ant-menu-light ant-menu-root " role="menu" style="width: 100%;">
        @auth
        @if (auth()->user()->member_role === 'admin')
        <li class="ant-menu-item ant-menu-item-only-child {{ request()->routeIs('admin.home') ? 'active' : '' }}" role="menuitem">
            <a href="{{ route('admin.home') }}" class="ant-menu-item-link">
                <span class="ant-menu-title-content">Admin Dashboard</span>
            </a>
        </li>
        <li class="ant-menu-item ant-menu-item-only-child {{ request()->routeIs('admin.users.index') ? 'active' : '' }}" role="menuitem">
            <a href="{{ route('admin.users.index') }}" class="ant-menu-item-link">
                <span class="ant-menu-title-content">Members Management</span>
            </a>
        </li>
        <li class="ant-menu-item ant-menu-item-only-child {{ request()->routeIs('admin.organizers.index') ? 'active' : '' }}" role="menuitem">
            <a href="{{ route('admin.organizers.index') }}" class="ant-menu-item-link">
                <span class="ant-menu-title-content">Organizers Management</span>
            </a>
        </li>
        <li class="ant-menu-item ant-menu-item-only-child {{ request()->routeIs('admin.packages.index') ? 'active' : '' }}" role="menuitem">
            <a href="{{ route('admin.packages.index') }}" class="ant-menu-item-link">
                <span class="ant-menu-title-content">Package Management</span>
            </a>
        </li>
        <li class="ant-menu-item ant-menu-item-only-child {{ request()->routeIs('admin.events.index') ? 'active' : '' }}" role="menuitem">
            <a href="{{ route('admin.events.index') }}" class="ant-menu-item-link">
                <span class="ant-menu-title-content">Event Management</span>
            </a>
        </li>
        <li class="ant-menu-item ant-menu-item-only-child {{ request()->routeIs('admin.organizers.pending') ? 'active' : '' }}" role="menuitem">
            <a href="{{ route('admin.organizers.pending') }}" class="ant-menu-item-link">
                <span class="ant-menu-title-content">Approve Organizers</span>
            </a>
        </li>
        @elseif (auth('organizer'))
        <li class="ant-menu-item ant-menu-item-only-child {{ request()->routeIs('organizer.home') ? 'active' : '' }}" role="menuitem">
            <a href="{{ route('organizer.home') }}" class="ant-menu-item-link">
                <span class="ant-menu-title-content">Organizer Dashboard</span>
            </a>
        </li>
        <!-- <li class="ant-menu-item ant-menu-item-only-child {{ request()->routeIs('organizer.home') ? 'active' : '' }}" role="menuitem">
            <a href="{{ route('organizer.home') }}" class="ant-menu-item-link">
                <span class="ant-menu-title-content">Event Management</span>
            </a>
        </li> -->
        @endif
        @endauth

        @auth
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="btn w-100">
                Logout
            </button>
        </form>
        @endauth
    </ul>
</div>

<style>
    /* Sidebar Styles */
    .sidebar {
        width: 250px;
        margin-left: 7%;
        margin-top: 50px;
    }

    .sidebar .sidebar-header {
        padding: 20px;
        text-align: center;
        font-size: 20px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
        border-radius: 0 0 6px 6px;
    }

    .sidebar ul li {
        margin: 5px 0;
    }

    .sidebar ul li a {
        color: black;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        display: block;
        padding: 10px 15px;
    }

    .sidebar ul li a:hover {
        color: #6f42c1;
    }

    .sidebar ul li.active a {
        background-color: rgba(231, 233, 235, 0.44);
        color: #6f42c1;
        font-weight: bold;
        border-left: 5px solid #6f42c1;
    }

    /* Logout button fix */
    .logout-form {
        position: absolute;
        bottom: 20px;
        left: 10px;
        right: 10px;
    }

    .logout-form button {
        font-weight: bold;
        border-radius: 6px;
        background-color: #6f42c1;
        border: 0;
        color: white;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .logout-form button:hover {
        background-color: rgb(78, 47, 136);
        color: white;
    }
</style>