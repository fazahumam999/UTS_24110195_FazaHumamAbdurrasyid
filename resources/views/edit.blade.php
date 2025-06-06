<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Tamu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        :root {
            --primary: #007bff;
            --success: #28a745;
            --danger: #dc3545;
            --bg: #eef2f5;
            --card: #fff;
            --text: #333;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 40px;
            background-color: var(--bg);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background: var(--card);
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 1.8em;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #444;
        }

        input[type="text"],
        input[type="date"],
        .datepicker {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
            outline: none;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.9em;
            margin-top: -6px;
            margin-bottom: 10px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            background: var(--success);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .spinner {
            display: inline-block;
            width: 24px;
            height: 24px;
            border: 3px solid rgba(0, 123, 255, 0.3);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 12px;
            vertical-align: middle;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>

</head>
<body>

<div class="container">
    <h1>Edit Data Tamu</h1>

    <form action="{{ route('update', $tamu->id) }}" method="POST">
        @csrf
        @method('PUT')
        

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $tamu->nama) }}" required>
        @error('nama')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <label for="nomor_identitas">Nomor Identitas</label>
        <input type="text" id="nomor_identitas" name="nomor_identitas" value="{{ old('nomor_identitas', $tamu->nomor_identitas) }}" required>
        @error('nomor_identitas')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $tamu->alamat) }}" required>
        @error('alamat')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <label for="telepon">Telepon</label>
        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $tamu->telepon) }}" required>
        @error('telepon')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <label for="tanggal_checkin">Tanggal Check In</label>
        <input type="text" id="tanggal_checkin" name="tanggal_checkin" class="datepicker"
               value="{{ old('tanggal_checkin', \Carbon\Carbon::parse($tamu->tanggal_checkin)->format('Y-m-d')) }}" required>
        @error('tanggal_checkin')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <label for="tanggal_checkout">Tanggal Check Out</label>
        <input type="text" id="tanggal_checkout" name="tanggal_checkout" class="datepicker"
               value="{{ old('tanggal_checkout', \Carbon\Carbon::parse($tamu->tanggal_checkout)->format('Y-m-d')) }}" required>
        @error('tanggal_checkout')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="button-group">
            <button type="submit" class="submit-btn" id="submitBtn">Update</button>
            <div id="spinner" class="spinner" style="display:none;"></div>
</div>

    </form>

    <a href="{{ route('tamu') }}" class="back-link">← Kembali ke Daftar Tamu</a>
</div>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr(".datepicker", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        minDate: "today"
    });
</script>

<script>
  const form = document.querySelector('form');
  const submitBtn = document.getElementById('submitBtn');
  const spinner = document.getElementById('spinner');

  form.addEventListener('submit', function() {
    submitBtn.style.display = 'none';  
    spinner.style.display = 'inline-block'; 
  });
</script>

</body>
</html>
