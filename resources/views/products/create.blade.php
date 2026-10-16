<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Add Product | WebAdmin</title>

    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product-create.css') }}">

    <script src="{{ asset('js/users.js') }}" defer></script>

    <link rel="icon" type="image/svg+xml"
          href="{{ asset('laravel-icon.svg') }}">
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

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN -->
    <div class="main-wrapper">

        <header class="page-header">
            <div class="header-title">
                <button type="button"
                        class="mobile-menu"
                        id="menuButton"
                        aria-label="Open menu"
                        aria-expanded="false">☰</button>

                <div>
                    <h1>Add Product</h1>
                    <p>Create a new product in your system</p>
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

        <main class="product-create-content">

            <section class="product-form-card">

                <h2>Product Information</h2>
                <p class="form-subtitle">
                    Enter the details of the new product.
                </p>

                <form method="POST"
                      action="{{ route('products.store') }}">
                    @csrf

                    <div class="product-form-grid">

                        <div class="product-form-group">
                            <label for="name">Product Name <span>*</span></label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Enter product name"
                                   required>
                            @error('name')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="product-form-group">
                            <label for="code">Product Code <span>*</span></label>
                            <input type="text" id="code" name="code"
                                   value="{{ old('code') }}"
                                   placeholder="Enter product code"
                                   required>
                            @error('code')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="product-form-group">
                            <label for="cost">Cost (Rs.) <span>*</span></label>
                            <input type="number" id="cost" name="cost"
                                   step="0.01" min="0"
                                   value="{{ old('cost') }}"
                                   placeholder="0.00" required>
                            @error('cost')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="product-form-group">
                            <label for="price">Price (Rs.) <span>*</span></label>
                            <input type="number" id="price" name="price"
                                   step="0.01" min="0"
                                   value="{{ old('price') }}"
                                   placeholder="0.00" required>
                            @error('price')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="product-form-group">
                            <label for="quantity">Quantity <span>*</span></label>
                            <input type="number" id="quantity"
                                   name="quantity" min="0" step="1"
                                   value="{{ old('quantity') }}"
                                   placeholder="Enter quantity" required>
                            @error('quantity')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="product-form-group full-width">
                            <label for="description">Description</label>
                            <textarea id="description"
                                      name="description"
                                      rows="4"
                                      placeholder="Enter product description">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="product-form-actions">
                        <a href="{{ route('products.index') }}"
                           class="product-cancel-btn">Cancel</a>

                        <button type="submit"
                                class="product-save-btn">
                            Save Product
                        </button>
                    </div>

                </form>
            </section>

        </main>
    </div>
</div>

</body>
</html>
