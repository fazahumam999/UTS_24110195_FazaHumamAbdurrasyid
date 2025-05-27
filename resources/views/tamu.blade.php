<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tamu Hotel</title>
    <style>
        :root {
            --primary: #007BFF;
            --danger: #dc3545;
            --bg: #f4f6f8;
            --card-bg: #fff;
            --text: #333;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 30px;
            background-color: var(--bg);
            color: var(--text);
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .btn {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--danger);
        }

        .btn-danger:hover {
            background-color: #bd2130;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead {
            background-color: var(--primary);
            color: white;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        tr:hover {
            background-color: #f1f8ff;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .search-input {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .text-center {
            text-align: center;
        }

        .fade-in {
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .top-bar {
                flex-direction: column;
                gap: 10px;
            }
            .search-input {
                width: 100%;
            }
            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container fade-in">
        <h1>Daftar Tamu Hotel</h1>

        <div class="top-bar">
            <input type="text" class="search-input" id="search" placeholder="Cari nama tamu...">
            <a href="{{ route('create') }}" class="btn">+ Tambah Tamu</a>
        </div>

        <table id="tamuTable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nomor Identitas</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tamus as $tamu)
                    <tr>
                        <td>{{ $tamu->nama }}</td>
                        <td>{{ $tamu->nomor_identitas }}</td>
                        <td>{{ $tamu->alamat }}</td>
                        <td>{{ $tamu->telepon }}</td>
                        <td>{{ $tamu->tanggal_checkin }}</td>
                        <td>{{ $tamu->tanggal_checkout }}</td>
                        <td class="actions">
                            <a href="{{ route('edit', $tamu->id) }}" class="btn">Edit</a>
                            <form action="{{ route('destroy', $tamu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data tamu belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        // Fitur pencarian nama tamu
        const searchInput = document.getElementById("search");
        searchInput.addEventListener("keyup", function () {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll("#tamuTable tbody tr");

            rows.forEach(row => {
                const nama = row.cells[0].textContent.toLowerCase();
                row.style.display = nama.includes(keyword) ? "" : "none";
            });
        });

        // Konfirmasi Hapus Custom
        function confirmDelete() {
            return confirm("Yakin ingin menghapus data tamu ini?");
        }
    </script>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(button) {
        // Ambil form terdekat dari tombol yang diklik
        const form = button.closest('form');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data tamu akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // submit form hapus
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        timer: 2500,
        showConfirmButton: false
    });
</script>
@endif


</html>
