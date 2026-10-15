<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>All Users | WebAdmin</title>

    <link rel="stylesheet" href="{{ asset('css/users.css') }}">

    <script src="{{ asset('js/users.js') }}" defer></script>

    <link rel="icon" type="image/svg+xml" href="{{ asset('laravel-icon.svg') }}">

</head>

<body>

<div class="app-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">
            <svg viewBox="0 0 24 24">
                <path d="M12 2 20 5v6c0 5-3.5 8.5-8 11-4.5-2.5-8-6-8-11V5l8-3Z"/>
            </svg>

            <div>
                <h2>WebAdmin</h2>
                <small>Manage Your Website</small>
            </div>
        </div>

        <nav class="sidebar-nav">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}" class="nav-link">
                <svg viewBox="0 0 24 24">
                    <path d="m3 10 9-7 9 7v10H3z"/>
                    <path d="M9 20v-7h6v7"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- USERS -->
            <div class="nav-group open">

                <button type="button"
                        class="nav-link nav-toggle active"
                        aria-expanded="true">

                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M4 21a8 8 0 0 1 16 0"/>
                    </svg>

                    <span>Users</span>
                    <span class="plus">−</span>
                </button>

                <div class="submenu">
                    <a href="{{ route('users.index') }}"
                       class="submenu-link selected">
                        All Users
                    </a>

                   <a href="{{ route('users.create') }}"
                     class="submenu-link">
                         Add User
                     </a>
                </div>
            </div>

            <!-- CUSTOMERS -->
            <div class="nav-group">

                <button type="button"
                        class="nav-link nav-toggle"
                        aria-expanded="false">

                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="3"/>
                        <circle cx="17" cy="9" r="2"/>
                        <path d="M3 20a6 6 0 0 1 12 0"/>
                        <path d="M16 15a5 5 0 0 1 5 5"/>
                    </svg>

                    <span>Customers</span>
                    <span class="plus">+</span>
                </button>

                <div class="submenu">
                    <a href="{{ route('customers.index') }}" class="submenu-link">All Customers</a>
                    <a href="{{ route('customers.create') }}" class="submenu-link">Add Customer</a>
                </div>
            </div>

            <!-- PRODUCTS -->
<div class="nav-group">

    <button type="button"
            class="nav-link nav-toggle"
            aria-expanded="false">

        <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="m12 2 9 5v10l-9 5-9-5V7z"/>
            <path d="m3 7 9 5 9-5"/>
            <path d="M12 12v10"/>
        </svg>

        <span>Products</span>
        <span class="plus">+</span>
    </button>

    <div class="submenu">
        <a href="{{ route('products.index') }}"
           class="submenu-link">
            All Products
        </a>

        <a href="{{ route('products.create') }}" class="submenu-link">
            Add Product
        </a>
    </div>

</div>

        </nav>

        <!-- LOGOUT -->
        <form method="POST"
              action="{{ route('logout') }}"
              class="logout-form">
            @csrf

            <button type="submit">
                <svg viewBox="0 0 24 24">
                    <path d="M10 4H5v16h5"/>
                    <path d="M13 8l5 4-5 4"/>
                    <path d="M8 12h10"/>
                </svg>
                <span>Logout</span>
            </button>
        </form>

    </aside>

    <!-- MOBILE OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">

        <!-- PAGE HEADER -->
        <header class="page-header">

            <div class="header-title">

                <button type="button"
                        class="mobile-menu"
                        id="menuButton"
                        aria-label="Open menu"
                        aria-expanded="false">
                    ☰
                </button>

                <div>
                    <h1>Users</h1>
                    <p>Manage users in your system</p>
                </div>
            </div>

            <div class="admin-profile">
                <span class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </span>

                <span class="admin-name">
                    {{ auth()->user()->name }}
                </span>
            </div>

        </header>

        <!-- PAGE CONTENT -->
        <main class="users-content">

            
@if(session('success'))
    <div class="alert-message alert-success" role="status">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-message alert-error" role="alert">
        {{ session('error') }}
    </div>
@endif


            <!-- ADD USER BUTTON -->
            <div class="page-actions">
                
            <a href="{{ route('users.create') }}" class="add-user-btn">
              + Add User
            </a>

            </div>

            <!-- USERS TABLE CARD -->
            <section class="users-card">

                <!-- SEARCH FORM -->
                <form method="GET"
                      action="{{ route('users.index') }}"
                      class="search-form">

                    <div class="search-field">
                        <label for="search">Search</label>

                        <input type="search"
                               id="search"
                               name="search"
                               value="{{ $search }}"
                               placeholder="Search users...">
                    </div>

                    <button type="submit" class="filter-btn">
                        Filter
                    </button>

                </form>

                <!-- USERS TABLE -->
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>CREATED</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>

                                    <td>{{ $user->name }}</td>

                                    <td>{{ $user->email }}</td>

                                    <td>
                                        {{ $user->created_at->format('M d, Y') }}
                                    </td>

                                    <td>
                                        <div class="action-buttons">

                                            
                                     <a href="{{ route('users.edit', $user) }}"
                                           class="edit-link">
                                                  Edit
                                      </a>
                            
<button type="button"
        class="delete-link"
        data-user-name="{{ $user->name }}"
        data-delete-url="{{ route('users.destroy', $user) }}"
        onclick="showDeleteNotice(this)">
    Delete
</button>


                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-row">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                
<!-- DELETE NOTICE -->

<!-- DELETE CONFIRMATION MODAL -->
<div class="modal-overlay" id="deleteModal" hidden>

    <div class="modal-box"
         role="dialog"
         aria-modal="true"
         aria-labelledby="deleteModalTitle">

        <h2 id="deleteModalTitle">Delete User?</h2>

        <p id="deleteMessage">
            Are you sure you want to delete this user?
        </p>

        <form method="POST" id="deleteUserForm">
            @csrf
            @method('DELETE')

            <div class="modal-actions">

                <button type="button"
                        class="cancel-btn"
                        onclick="closeDeleteNotice()">
                    Cancel
                </button>

                <button type="submit"
                        class="confirm-delete-btn">
                    Delete
                </button>

            </div>
        </form>

    </div>
</div>


</body>
</html>
