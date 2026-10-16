<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Customer | WebAdmin</title>

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
                    <h1>Add Customer</h1>
                    <p>Fill in the customer details below</p>
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

        <!-- ADD CUSTOMER CONTENT -->
        <main class="customer-content">

            <section class="customer-form-card">

                <h2>Add Customer Details</h2>

                <form method="POST"
                      action="{{ route('customers.store') }}">
                    @csrf

                    <div class="customer-form-grid">

                        <!-- FULL NAME -->
                        <div class="customer-form-group">
                            <label for="name">
                                Full Name <span>*</span>
                            </label>

                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Enter customer name"
                                   required>

                            @error('name')
                                <small class="field-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- EMAIL -->
                        <div class="customer-form-group">
                            <label for="email">
                                Email <span>*</span>
                            </label>

                            <input type="email"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Enter email"
                                   required>

                            @error('email')
                                <small class="field-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- PHONE -->
                        <div class="customer-form-group">
                            <label for="phone">
                                Phone Number <span>*</span>
                            </label>

                            <input type="tel"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="Enter phone number"
                                   required>

                            @error('phone')
                                <small class="field-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- ADDRESS -->
                        <div class="customer-form-group">
                            <label for="address">
                                Address <span>*</span>
                            </label>

                            <input type="text"
                                   id="address"
                                   name="address"
                                   value="{{ old('address') }}"
                                   placeholder="Enter address"
                                   required>

                            @error('address')
                                <small class="field-error">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                    </div>

                    <!-- FORM BUTTONS -->
                    <div class="customer-form-actions">

                        <a href="{{ route('customers.index') }}"
                           class="customer-cancel-btn">
                            Cancel
                        </a>

                        <button type="submit"
                                class="customer-save-btn">
                            Save Customer
                        </button>

                    </div>

                </form>

            </section>

        </main>

    </div>
</div>

</body>
</html>
