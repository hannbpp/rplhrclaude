<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Pelamar - Recoleta Recruitment System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            background-color: #07799F;
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
            background-color: #055d73;
        }

        .content {
            flex: 1;
            margin-left: 250px;
            padding: 30px;
        }

        .content h1 {
            color: #07799F;
        }

        .table th {
            font-weight: 500;
            color: #333;
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .search-box input {
            padding-left: 40px;
            border-radius: 8px;
        }

        .status-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
            text-align: center;
            min-width: 100px;
        }

        .status-diterima {
            background-color: #dcf5e3;
            color: #16a34a;
            border: 1px solid #86efac;
        }

        .status-menunggu {
            background-color: #e0f2fe;
            color: #0284c7;
            border: 1px solid #7dd3fc;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-view {
            background-color: #fff3cd;
            color: #ffc107;
        }

        .btn-edit {
            background-color: #f3e8ff;
            color: #9333ea;
        }

        .btn-schedule {
            background-color: #fef3c7;
            color: #d97706;
        }

        .btn-delete {
            background-color: #ffe4e6;
            color: #e11d48;
        }

        .schedule-btn {
            background-color: #e2e8f0;
            color: #475569;
            border: none;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }

        .admin-section {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .search-section {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
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
            <a href="{{ route('lowongans.index') }}">
                <i class="bi bi-briefcase me-2"></i>Data Lowongan
            </a>
            <a href="{{ route('pelamars.index') }}" class="active">
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
        <div class="header-section">
            <h1>Data Pelamar</h1>
        </div>

        <div class="search-section">
            <div class="search-box flex-grow-1">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" id="searchInput" placeholder="Search...">
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="table-container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Posisi</th>
                            <th>Jadwal Interview</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelamars as $pelamar)
                        <tr>
                            <td>{{ $pelamar->name }}</td>
                            <td>{{ $pelamar->email }}</td>
                            <td>{{ $pelamar->phone_number }}</td>
                            <td>{{ $pelamar->lowongan->posisi }}</td>
                            <td>
                                @if($pelamar->jadwal_interview)
                                {{ \Carbon\Carbon::parse($pelamar->jadwal_interview)->format('d/m/Y H:i') }}
                                @else
                                <button type="button" class="schedule-btn" data-bs-toggle="modal"
                                    data-bs-target="#scheduleModal" data-pelamar-id="{{ $pelamar->id }}">
                                    Atur
                                </button>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge {{ $pelamar->status === 'Diterima' ? 'status-diterima' : 'status-menunggu' }}">
                                    {{ $pelamar->status }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center align-items-center">
                                    <a href="{{ route('pelamars.show', $pelamar->id) }}" class="action-btn btn-view d-flex align-items-center justify-content-center">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('pelamars.edit', $pelamar->id) }}" class="action-btn btn-edit d-flex align-items-center justify-content-center">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if(!$pelamar->jadwal_interview)
                                    <button type="button" class="action-btn btn-schedule d-flex align-items-center justify-content-center"
                                        data-bs-toggle="modal" data-bs-target="#scheduleModal"
                                        data-pelamar-id="{{ $pelamar->id }}">
                                        <i class="bi bi-calendar"></i>
                                    </button>
                                    @endif
                                    <form action="{{ route('pelamars.destroy', $pelamar->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-delete d-flex align-items-center justify-content-center">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pelamar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Schedule Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scheduleModalLabel">Atur Jadwal Interview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pelamars.schedule') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="pelamar_id" id="pelamarId">
                        <div class="mb-3">
                            <label for="jadwalInterview" class="form-label">Tanggal & Waktu</label>
                            <input type="datetime-local" name="jadwal_interview" id="jadwalInterview" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchQuery = this.value.toLowerCase();
            let tableBody = document.querySelector('.table tbody');
            let rows = tableBody.getElementsByTagName('tr');

            for (let row of rows) {
                let cells = row.getElementsByTagName('td');
                let found = false;

                for (let cell of cells) {
                    let text = cell.textContent || cell.innerText;
                    if (text.toLowerCase().indexOf(searchQuery) > -1) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle schedule modal
            var scheduleModal = document.getElementById('scheduleModal');
            if (scheduleModal) {
                scheduleModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var pelamarId = button.getAttribute('data-pelamar-id');
                    var modalPelamarIdInput = scheduleModal.querySelector('#pelamarId');
                    modalPelamarIdInput.value = pelamarId;
                });
            }
        });
    </script>
</body>

</html>