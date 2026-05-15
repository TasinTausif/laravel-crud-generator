<!DOCTYPE html>
<html>
<head>
    <title>App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1a1a2e;
            color: #e0e0e0;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #16213e;
            border-bottom: 1px solid #0f3460;
        }
        .navbar-brand {
            color: #e94560 !important;
            font-weight: bold;
            font-size: 1.4rem;
        }
        .card {
            background-color: #16213e;
            border: 1px solid #0f3460;
            border-radius: 12px;
        }
        .card-header {
            background-color: #0f3460;
            border-bottom: 1px solid #e94560;
            border-radius: 12px 12px 0 0 !important;
        }
        .table {
            color: #e0e0e0;
            margin-bottom: 0;
        }
        .table thead th {
            background-color: #0f3460;
            color: #a0c4ff;
            border-color: #1a1a2e;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .table tbody tr {
            border-color: #0f3460;
            transition: background-color 0.2s;
        }
        .table tbody tr:hover {
            background-color: #0f3460;
        }
        .table td {
            vertical-align: middle;
            border-color: #0f3460;
        }
        .btn-create {
            background-color: #4361ee;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
        }
        .btn-create:hover { background-color: #3a0ca3; color: white; }
        .btn-view   { background-color: #4cc9f0; color: #1a1a2e; border: none; border-radius: 6px; }
        .btn-view:hover { background-color: #4361ee; color: white; }
        .btn-edit   { background-color: #f4a261; color: #1a1a2e; border: none; border-radius: 6px; }
        .btn-edit:hover { background-color: #e76f51; color: white; }
        .btn-delete { background-color: #e63946; color: white; border: none; border-radius: 6px; }
        .btn-delete:hover { background-color: #9d0208; }
        .form-control, .form-select {
            background-color: #0f3460;
            border: 1px solid #4361ee;
            color: #e0e0e0;
            border-radius: 8px;
        }
        .form-control:focus, .form-select:focus {
            background-color: #0f3460;
            border-color: #4cc9f0;
            color: #e0e0e0;
            box-shadow: 0 0 0 0.2rem rgba(76, 201, 240, 0.25);
        }
        .form-label { color: #a0c4ff; font-weight: 500; }
        .alert-success {
            background-color: #1b4332;
            border-color: #2d6a4f;
            color: #95d5b2;
            border-radius: 8px;
        }
        .badge-id {
            background-color: #0f3460;
            color: #4cc9f0;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <div class='container mt-4'>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>