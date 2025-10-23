<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory System</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* ===== Global Variables (Black, Brown, White Theme) ===== */
        :root {
            --bg-body: #f8f7f4;              /* soft white background */
            --bg-sidebar: #0f0f0f;           /* deep black sidebar */
            --accent-brown: #8B5E3C;         /* warm medium brown */
            --accent-brown-hover: #A47148;   /* lighter brown hover */
            --accent-brown-light: #e8dcd3;   /* pale brownish background */
            --text-dark: #1E1E1E;
            --text-light: #ffffff;
            --border-color: #dcdcdc;
        }

        /* ===== Base Styling ===== */
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        /* ===== Sidebar ===== */
        .sidebar {
            width: 240px;
            background: var(--bg-sidebar);
            color: var(--text-light);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 25px;
            box-shadow: 2px 0 8px rgba(0,0,0,0.4);
        }

        .sidebar h2 {
            text-align: center;
            color: var(--accent-brown);
            margin-bottom: 35px;
            font-size: 22px;
            font-weight: 700;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #cfcfcf;
            text-decoration: none;
            font-size: 15px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .sidebar a i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: var(--accent-brown);
            color: var(--text-light);
            border-left: 3px solid var(--accent-brown-hover);
        }

        /* ===== Main Content ===== */
        .main-content {
            flex: 1;
            margin-left: 240px;
            padding: 40px;
            background-color: var(--bg-body);
            animation: fadeIn 0.4s ease-in-out;
        }

        h1 {
            font-weight: 600;
            color: var(--accent-brown);
            margin-bottom: 25px;
        }

        /* ===== Buttons ===== */
        .btn {
            background-color: var(--accent-brown);
            color: var(--text-light);
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
        }

        .btn:hover {
            background-color: var(--accent-brown-hover);
            transform: translateY(-2px);
        }

        /* Special button spacing for top sections */
        .btn-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* ===== Tables ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: var(--text-light);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        table th, table td {
            border: 1px solid var(--border-color);
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: var(--accent-brown);
            color: var(--text-light);
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        tr:hover {
            background-color: var(--accent-brown-light);
            transition: background-color 0.2s;
        }

        /* ===== Forms ===== */
        input, select {
            padding: 8px;
            margin: 6px 0;
            width: 100%;
            background-color: #fff;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--accent-brown);
            box-shadow: 0 0 5px rgba(139, 94, 60, 0.3);
        }

        /* ===== Animations ===== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Inventory</h2>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}"><i class="fas fa-tags"></i> Categories</a>
        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}"><i class="fas fa-boxes"></i> Products</a>
        <a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions.*') ? 'active' : '' }}"><i class="fas fa-exchange-alt"></i> Transactions</a>
        <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Reports</a>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

</body>
</html>
