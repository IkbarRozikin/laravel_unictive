<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Register</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password"
                   class="form-control"
                   id="password"
                   name="password"
                   required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password"
                   class="form-control"
                   id="password_confirmation"
                   name="password_confirmation"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
        <a href="{{ url
