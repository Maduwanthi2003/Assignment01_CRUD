<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard | WebAdmin</title>

    <link rel="stylesheet"
          href="{{ asset('css/dashboard.css') }}">

    <script src="{{ asset('js/dashboard.js') }}" defer></script>

    <link rel="icon" type="image/svg+xml" href="{{ asset('laravel-icon.svg') }}">

</head>

<body>

<div class="app-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">
            <svg viewBox="0 0 24 24" aria-hidden="true">
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
                <svg viewBox="0 0 24 24" aria-hidden="true">
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

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper">

        <!-- PAGE HEADER -->
        <header class="page-header">

            <div class="header-title">
                <button type="button"
                        class="mobile-menu"
                        id="menuButton"
                        aria-label="Open navigation"
                        aria-expanded="false">
                    ☰
                </button>

                <div>
                    <h1>Dashboard</h1>
                    <p>
                        Welcome back! Here's what's happening
                        in your shop today.
                    </p>
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

        <!-- DASHBOARD CONTENT -->
        <main class="dashboard-content">

            <!-- STATISTICS CARDS -->
            <section class="stats-grid">

                <!-- TOTAL USERS -->
                <article class="stat-card">

                    <div class="stat-icon users-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="7" r="4"/>
                            <path d="M4 21a8 8 0 0 1 16 0"/>
                        </svg>
                    </div>

                    <h3>Total Users</h3>
                    <strong>{{ $totalUsers }}</strong>
                    <p>Staff with login access</p>

                </article>

                <!-- TOTAL CUSTOMERS -->
                <article class="stat-card">

                    <div class="stat-icon customers-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="9" cy="8" r="3"/>
                            <circle cx="17" cy="9" r="2"/>
                            <path d="M3 20a6 6 0 0 1 12 0"/>
                            <path d="M16 15a5 5 0 0 1 5 5"/>
                        </svg>
                    </div>

                    <h3>Total Customers</h3>
                    <strong>{{ $totalCustomers }}</strong>
                    <p>Registered customers</p>

                </article>

                <!-- TOTAL PRODUCTS -->
                <article class="stat-card">

                    <div class="stat-icon products-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="m12 2 9 5v10l-9 5-9-5V7z"/>
                            <path d="m3 7 9 5 9-5"/>
                            <path d="M12 12v10"/>
                        </svg>
                    </div>

                    <h3>Total Products</h3>
                    <strong>{{ $totalProducts }}</strong>
                    <p>Items in stock list</p>

                </article>

                <!-- STOCK VALUE -->
                <article class="stat-card">

                    <div class="stat-icon stock-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M9 9h4a2 2 0 0 1 0 4h-2a2 2 0 0 0 0 4h4"/>
                            <path d="M12 6v12"/>
                        </svg>
                    </div>

                    <h3>Stock Value</h3>
                    <strong>
                        Rs. {{ number_format($stockValue, 2) }}
                    </strong>
                    <p>Price × quantity</p>

                </article>

            </section>

            <!-- TABLES -->
            <section class="tables-grid">

                <!-- RECENT USERS -->
                <article class="table-card">

                    <h2>Recent Users</h2>

                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>JOINED</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($recentUsers as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            {{ $user->created_at->format('M d, Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="empty-row">
                                            No users found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </article>

                <!-- RECENT PRODUCTS -->
                <article class="table-card">

                    <h2>Recent Products</h2>

                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>PRICE</th>
                                    <th>QTY</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($recentProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            {{ number_format($product->price, 2) }}
                                        </td>
                                        <td>{{ $product->quantity }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="empty-row">
                                            No products found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </article>

            </section>

        </main>
    </div>
</div>

</body>
</html>
