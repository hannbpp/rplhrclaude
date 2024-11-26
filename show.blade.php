<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Pelamar - Recoleta Recruitment System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #07799F;
            --primary-dark: #055d73;
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

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #eee;
            padding: 20px;
        }

        .card-header h3 {
            color: var(--primary-color);
            margin: 0;
        }

        .detail-section {
            background-color: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .detail-section h4 {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .detail-label {
            font-weight: 500;
            color: #64748b;
            margin-bottom: 4px;
            font-size: 0.9rem;
        }

        .detail-value {
            color: #1e293b;
            margin-bottom: 16px;
            font-size: 1rem;
            padding: 8px 0;
        }

        .status-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
            min-width: 120px;
            text-align: center;
        }

        .status-diterima {
            background-color: #dcfce7;
            color: #16a34a;
            border: 1px solid #86efac;
        }

        .status-menunggu {
            background-color: #e0f2fe;
            color: #0284c7;
            border: 1px solid #7dd3fc;
        }

        .cv-preview {
            padding: 16px;
            background-color: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .cv-preview:hover {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
        }

        .cv-preview a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-edit {
            background-color: var(--primary-color);
            border: none;
            color: white;
        }

        .btn-edit:hover {
            background-color: var(--primary-dark);
            color: white;
        }

        .btn-back {
            background-color: #e2e8f0;
            border: none;
            color: #64748b;
        }

        .btn-back:hover {
            background-color: #cbd5e1;
            color: #475569;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--primary-color);
            color: white;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
        }

        .sidebar h2 {
            font-family: 'Recoleta', sans-serif;
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
            margin: 0;
        }

        .sidebar p {
            text-align: center;
            margin-bottom: 30px;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .sidebar nav {
            margin-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: var(--primary-dark);
        }

        .admin-section {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-section .rounded-circle {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Recoleta</h2>
        <p>Recruitment System</p>
        <nav>
            <a href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a>
            <a href="#">
                <i class="bi bi-folder"></i>Manage Data
            </a>
            <a href="{{ route('lowongans.index') }}">
                <i class="bi bi-briefcase"></i>Data Lowongan
            </a>
            <a href="{{ route('pelamars.index') }}" class="active">
                <i class="bi bi-people"></i>Data Pelamar
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

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Detail Pelamar</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('pelamars.edit', $pelamar->id) }}" class="btn btn-edit">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <a href="{{ route('pelamars.index') }}" class="btn btn-back">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-section">
                                <h4><i class="bi bi-person me-2"></i>Data Pribadi</h4>

                                <div class="detail-label">Nama Lengkap</div>
                                <div class="detail-value">{{ $pelamar->name }}</div>

                                <div class="detail-label">Email</div>
                                <div class="detail-value">{{ $pelamar->email }}</div>

                                <div class="detail-label">Nomor Telepon</div>
                                <div class="detail-value">{{ $pelamar->phone_number }}</div>

                                <div class="detail-label">Tanggal Lahir</div>
                                <div class="detail-value">{{ \Carbon\Carbon::parse($pelamar->birth_date)->format('d F Y') }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-section">
                                <h4><i class="bi bi-briefcase me-2"></i>Informasi Lamaran</h4>

                                <div class="detail-label">Posisi yang Dilamar</div>
                                <div class="detail-value">{{ $pelamar->lowongan->posisi }}</div>

                                <div class="detail-label">Status</div>
                                <div class="detail-value">
                                    <span class="status-badge {{ $pelamar->status === 'Diterima' ? 'status-diterima' : 'status-menunggu' }}">
                                        <i class="bi {{ $pelamar->status === 'Diterima' ? 'bi-check-circle' : 'bi-clock' }}"></i>
                                        {{ $pelamar->status }}
                                    </span>
                                </div>

                                <div class="detail-label">Jadwal Interview</div>
                                <div class="detail-value">
                                    @if($pelamar->jadwal_interview)
                                    <div class="interview-schedule">
                                        <i class="bi bi-calendar-event me-2"></i>
                                        {{ \Carbon\Carbon::parse($pelamar->jadwal_interview)->format('d F Y H:i') }}
                                    </div>
                                    @else
                                    <div class="no-schedule">Belum dijadwalkan</div>
                                    @endif
                                </div>

                                <div class="detail-label">CV</div>
                                <div class="detail-value">
                                    @if($pelamar->cv)
                                    <div class="cv-preview">
                                        <i class="bi bi-file-earmark-pdf text-danger"></i>
                                        <a href="{{ asset('storage/' . $pelamar->cv) }}" target="_blank">
                                            Lihat CV
                                        </a>
                                    </div>
                                    @else
                                    <span class="text-muted">Tidak ada CV</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>