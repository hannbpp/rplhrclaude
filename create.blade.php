<!-- create.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Lowongan - Recoleta Recruitment System</title>
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

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(7, 121, 159, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-secondary {
            background-color: #e2e8f0;
            border: none;
            color: #64748b;
            padding: 10px 24px;
            border-radius: 8px;
        }

        .btn-secondary:hover {
            background-color: #cbd5e1;
            color: #475569;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Recoleta</h2>
        <p class="text-center">Recruitment System</p>
        <nav>
            <a href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
            <a href="#">
                <i class="bi bi-folder me-2"></i>Manage Data
            </a>
            <a href="{{ route('lowongans.index') }}" class="active">
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
            <div class="card">
                <div class="card-header">
                    <h3>Add Job</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('lowongans.store') }}" method="POST">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="posisi" class="form-label">Posisi/Jabatan</label>
                                    <input type="text" class="form-control @error('posisi') is-invalid @enderror"
                                        id="posisi" name="posisi" value="{{ old('posisi') }}" required>
                                    @error('posisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Gaji</label>
                                    <input type="number" class="form-control @error('salary') is-invalid @enderror"
                                        id="salary" name="salary" value="{{ old('salary') }}" required>
                                    @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Pekerjaan</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="requirements" class="form-label">Persyaratan</label>
                            <textarea class="form-control @error('requirements') is-invalid @enderror"
                                id="requirements" name="requirements" rows="4" required>{{ old('requirements') }}</textarea>
                            @error('requirements')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                id="location" name="location" value="{{ old('location') }}" required>
                            @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                id="status" name="status" required>
                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tutu[" {{ old('status') == 'Tutup' ? 'selected' : '' }}>Tutup</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('lowongans.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>