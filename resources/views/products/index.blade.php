<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>All Products | WebAdmin</title>

    <link rel="icon" type="image/svg+xml"
          href="{{ asset('laravel-icon.svg') }}">

    <script src="{{ asset('js/products.js') }}" defer></script>
    

    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
<link rel="stylesheet" href="{{ asset('css/products.css') }}">

    <script src="{{ asset('js/users.js') }}" defer></script>

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

            <a href="{{ route('dashboard') }}" class="nav-link">
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
                       class="submenu-link">All Users</a>

                    <a href="{{ route('users.create') }}"
                       class="submenu-link">Add User</a>
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
            <div class="nav-group open">
                <button type="button"
                        class="nav-link nav-toggle active"
                        aria-expanded="true">
                    <svg viewBox="0 0 24 24">
                        <path d="m12 2 9 5v10l-9 5-9-5V7z"/>
                        <path d="m3 7 9 5 9-5"/>
                        <path d="M12 12v10"/>
                    </svg>
                    <span>Products</span>
                    <span class="plus">−</span>
                </button>

                <div class="submenu">
                    <a href="{{ route('products.index') }}"
                       class="submenu-link selected">
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

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <div class="main-wrapper">

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
                    <h1>Products</h1>
                    <p>Manage products in your system</p>
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

        <main class="products-content">

            <!-- ADD PRODUCT BUTTON -->
            <div class="products-toolbar">
                <a href="{{ route('products.create') }}"
                   class="add-product-btn">
                    + Add Product
                </a>
            </div>

            <!-- PRODUCTS TABLE -->
            <section class="products-card">

                <form method="GET"
                      action="{{ route('products.index') }}"
                      class="products-search-form">

                    <div class="products-search-field">
                        <label for="search">Search</label>

                        <input type="text"
                               id="search"
                               name="search"
                               placeholder="Search products..."
                               value="{{ $search }}">
                    </div>

                    <button type="submit"
                            class="products-filter-btn">
                        Filter
                    </button>
                </form>

                <div class="products-table-wrapper">
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th>CODE</th>
                                <th>COST</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>DESCRIPTION</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $product->name }}</td>

                                    <td>{{ $product->code }}</td>

                                    <td>
                                        Rs. {{ number_format((float) $product->cost, 2) }}
                                    </td>

                                    <td>
                                        Rs. {{ number_format((float) $product->price, 2) }}
                                    </td>

                                    <td>{{ $product->quantity }}</td>

                                    <td>{{ $product->description ?: '-' }}</td>

                                    <td>
                                        <div class="product-actions">
                                            <a href="{{ route('products.edit', $product) }}"
                                               class="product-edit">
                                                Edit
                                            </a>

                                            <button type="button"
                                                    class="product-delete"
                                                    data-product-name="{{ $product->name }}"
                                                    data-delete-url="{{ route('products.destroy', $product) }}"
                                                    onclick="showProductDeleteModal(this)">
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="products-empty">
                                        No products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </section>
        </main>
    </div>
<!-- DELETE PRODUCT CONFIRMATION MODAL -->
<div class="product-modal-overlay"
     id="productDeleteModal"
     hidden>

    <div class="product-modal-box"
         role="dialog"
         aria-modal="true"
         aria-labelledby="productDeleteTitle">

        <h2 id="productDeleteTitle">
            Delete Product?
        </h2>

        <p id="productDeleteMessage">
            Are you sure you want to delete this product?
        </p>

        <form method="POST"
              id="deleteProductForm">

            @csrf
            @method('DELETE')

            <div class="product-modal-actions">

                <button type="button"
                        class="product-modal-cancel"
                        onclick="closeProductDeleteModal()">
                    Cancel
                </button>

                <button type="submit"
                        class="product-modal-confirm">
                    Delete
                </button>

            </div>
        </form>

    </div>
</div>

</body>
</html>
