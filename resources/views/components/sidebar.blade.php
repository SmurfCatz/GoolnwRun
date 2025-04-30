<div class="card shadow-lg border-0 " id="sidebar" style="width: 250px;">
    <div class="sidebar-heading d-flex justify-content-center bg-primary text-white">
        Menu
    </div>
    <ul class="ant-menu ant-menu-light ant-menu-root " role="menu" style="width: 250px;">
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
    </ul>
</div>

<style>
    /* Sidebar Styles */
    .sidebar {
        width: 250px;
        margin-left: 7%;
        margin-top: 50px;
    }

    .sidebar .sidebar-heading {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-transform: uppercase;
        padding: 10px 0;
        color: white;
        border-radius: 6px 6px 0 0;
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
        color: #007bff;
    }

    .sidebar ul li.active a {
        background-color: rgba(231, 233, 235, 0.44);
        color: #007bff;
        font-weight: bold;
        border-left: 5px solid #007bff;
    }
</style>