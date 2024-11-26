<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Recoleta Recruitment System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #07799F;
            --primary-dark: #055d73;
            --primary-light: #9ED0E6;
            --sidebar-width: 250px;
        }

        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary-color);
            color: white;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
        }

        .sidebar h2 {
            font-family: 'Recoleta', sans-serif;
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
            margin: 0;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: var(--primary-dark);
        }

        .content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 30px;
        }

        .admin-section {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stats-card {
            background-color: var(--primary-light);
            border-radius: 12px;
            padding: 20px;
            height: 100%;
            transition: transform 0.3s ease;
            border: none;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card h5 {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 15px;
        }

        .stats-card p {
            color: #2c3e50;
            font-size: 1.1rem;
            margin-bottom: 0;
        }

        .stats-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .welcome-section {
            margin-bottom: 30px;
        }

        .welcome-section h1 {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 10px;
        }

        .welcome-section p {
            color: #6c757d;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Recoleta</h2>
        <p class="text-center">Recruitment System</p>
        <nav>
            <a href="{{ route('dashboard') }}" class="active">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
            <a href="#" class="d-flex align-items-center">
                <i class="bi bi-folder me-2"></i>Manage Data
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <a href="{{ route('lowongans.index') }}">
                <i class="bi bi-briefcase me-2"></i>Data Lowongan
            </a>
            <a href="{{ route('pelamars.index') }}">
                <i class="bi bi-people me-2"></i>Data Pelamar
            </a>
        </nav>
        <div class="admin-section">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded-circle p-2 me-2 text-primary">
                        <i class="bi bi-person"></i>
                    </div>
                    <span>Admin</span>
                </div>
                <a href="{{ route('logout') }}" class="text-white"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h1>Selamat Datang di Dashboard</h1>
                <p>Pantau dan kelola proses rekrutmen Anda</p>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <i class="bi bi-briefcase stats-icon"></i>
                        <h5>Lowongan</h5>
                        <p>{{ $jumlahLowongan }} lowongan tersedia</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <i class="bi bi-file-earmark-text stats-icon"></i>
                        <h5>Lamaran Masuk</h5>
                        <p>{{ $jumlahLamaranMasuk }} lamaran baru</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card text-center">
                        <i class="bi bi-person-check stats-icon"></i>
                        <h5>Pelamar Diterima</h5>
                        <p>{{ $jumlahPelamarDiterima }} pelamar diterima</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>