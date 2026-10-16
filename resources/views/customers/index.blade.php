<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>All Customers | WebAdmin</title>

    <link rel="stylesheet"
          href="{{ asset('css/users.css') }}">

    <link rel="stylesheet"
          href="{{ asset('css/customers.css') }}">

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

                <nav class="sidebar-nav" aria-label="Main navigation">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="m3 10 9-7 9 7v10H3z"/>
                    <path d="M9 20v-7h6v7"/>
                </svg>

                <span>Dashboard</span>
            </a>

            <!-- USERS (ADMIN ONLY) -->
            @if(auth()->user() && auth()->user()->role === 'admin')
            <a href="{{ route('users.index') }}"
               class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M4 21a8 8 0 0 1 16 0"/>
                </svg>

                <span>Users</span>
            </a>
            @endif

            <!-- CUSTOMERS -->
            <a href="{{ route('customers.index') }}"
               class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="9" cy="8" r="3"/>
                    <circle cx="17" cy="9" r="2"/>
                    <path d="M3 20a6 6 0 0 1 12 0"/>
                    <path d="M16 15a5 5 0 0 1 5 5"/>
                </svg>

                <span>Customers</span>
            </a>

            <!-- PRODUCTS -->
            <a href="{{ route('products.index') }}"
               class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">

                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="m12 2 9 5v10l-9 5-9-5V7z"/>
                    <path d="m3 7 9 5 9-5"/>
                    <path d="M12 12v10"/>
                </svg>

                <span>Products</span>
            </a>

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
    <div class="sidebar-overlay"
         id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">

        <!-- HEADER -->
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
                    <h1>Customers</h1>
                    <p>Manage customers in your system</p>
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

        <!-- ALL CUSTOMERS CONTENT -->
        <main class="customer-content">

            <!-- ADD CUSTOMER BUTTON -->
            @if(auth()->user() && auth()->user()->role !== 'staff')
            <div class="customer-top-actions">

                <a href="{{ route('customers.create') }}"
                   class="customer-save-btn customer-add-btn">
                    + Add Customer
                </a>

            </div>
            @endif

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="customer-alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- CUSTOMERS TABLE CARD -->
            <section class="customer-form-card customer-list-card">

                <!-- SEARCH -->
                <form method="GET"
                      action="{{ route('customers.index') }}"
                      class="customer-search-form">

                    <div class="customer-search-group">

                        <label for="search">Search</label>

                        <input type="text"
                               id="search"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search customers...">

                    </div>

                    <button type="submit"
                            class="customer-filter-btn">
                        Filter
                    </button>

                </form>

                <!-- TABLE -->
                <div class="customer-table-wrapper">

                    <table class="customer-table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($customers as $customer)

                                <tr>
                                    <td>
                                        {{ $customers->firstItem() + $loop->index }}
                                    </td>

                                    <td>{{ $customer->name }}</td>

                                    <td>{{ $customer->email }}</td>

                                    <td>{{ $customer->phone }}</td>

                                    <td>{{ $customer->address }}</td>

                                    <td>
                                        @if(auth()->user() && auth()->user()->role !== 'staff')
                                        <div class="customer-table-actions">

                                            <a href="{{ route('customers.edit', $customer) }}"
                                               class="customer-edit-link">
                                                Edit
                                            </a>

                                            <button type="button"
                                                    class="customer-delete-btn"
                                                    data-user-name="{{ $customer->name }}"
                                                    data-delete-url="{{ route('customers.destroy', $customer) }}"
                                                    onclick="showDeleteNotice(this)">
                                                Delete
                                            </button>

                                        </div>
                                        @else
                                        <span class="view-only-text">View only</span>
                                        @endif
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6"
                                        class="customer-empty">
                                        No customers found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>

                
<!-- DELETE CONFIRMATION MODAL -->
<div class="modal-overlay" id="deleteModal" hidden>

    <div class="modal-box"
         role="dialog"
         aria-modal="true"
         aria-labelledby="deleteModalTitle">

        <h2 id="deleteModalTitle">Delete Customer?</h2>

        <p id="deleteMessage">
            Are you sure you want to delete this customer?
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
