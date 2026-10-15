<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Customer | WebAdmin</title>

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

        <nav class="sidebar-nav">

            <!-- DASHBOARD -->
            <a href="{{ route('dashboard') }}"
               class="nav-link">

                <svg viewBox="0 0 24 24">
                    <path d="m3 10 9-7 9 7v10H3z"/>
                    <path d="M9 20v-7h6v7"/>
                </svg>

                <span>Dashboard</span>
            </a>

            <!-- USERS -->
            <div class="nav-group">

                <button type="button"
                        class="nav-link nav-toggle"
                        aria-expanded="false">

                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M4 21a8 8 0 0 1 16 0"/>
                    </svg>

                    <span>Users</span>
                    <span class="plus">+</span>
                </button>

                <div class="submenu">

                    <a href="{{ route('users.index') }}"
                       class="submenu-link">
                        All Users
                    </a>

                    <a href="{{ route('users.create') }}"
                       class="submenu-link">
                        Add User
                    </a>

                </div>
            </div>

            <!-- CUSTOMERS -->
            <div class="nav-group open">

                <button type="button"
                        class="nav-link nav-toggle active"
                        aria-expanded="true">

                    <svg viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="3"/>
                        <circle cx="17" cy="9" r="2"/>
                        <path d="M3 20a6 6 0 0 1 12 0"/>
                        <path d="M16 15a5 5 0 0 1 5 5"/>
                    </svg>

                    <span>Customers</span>
                    <span class="plus">−</span>
                </button>

                <div class="submenu">

                    <a href="{{ route('customers.index') }}"
                       class="submenu-link selected">
                        All Customers
                    </a>

                    <a href="{{ route('customers.create') }}"
                       class="submenu-link">
                        Add Customer
                    </a>

                </div>
            </div>

            <!-- PRODUCTS -->
            <div class="nav-group">

                <button type="button"
                        class="nav-link nav-toggle"
                        aria-expanded="false">

                    <svg viewBox="0 0 24 24">
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

                    <a href="{{ route('products.create') }}"
                       class="submenu-link">
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
                    <h1>Edit Customer</h1>
                    <p>Update the customer information below</p>
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

        <!-- EDIT CUSTOMER CONTENT -->
        <main class="customer-content">

            <section class="customer-form-card">

                <h2>Edit Customer Details</h2>

                <form method="POST"
                      action="{{ route('customers.update', $customer) }}">

                    @csrf
                    @method('PUT')

                    <div class="customer-form-grid">

                        <!-- FULL NAME -->
                        <div class="customer-form-group">

                            <label for="name">
                                Full Name <span>*</span>
                            </label>

                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $customer->name) }}"
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
                                   value="{{ old('email', $customer->email) }}"
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
                                   value="{{ old('phone', $customer->phone) }}"
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
                                   value="{{ old('address', $customer->address) }}"
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
                            Update Customer
                        </button>

                    </div>

                </form>

            </section>

        </main>

    </div>

</div>

</body>
</html>
