<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hobi-group { margin-bottom: 10px; }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Edit User</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Hobi</label>
            <div id="hobi-container">
                @foreach($user->hobbies as $hobi)
                    <div class="input-group hobi-group">
                        <input type="text" name="hobbies[]" class="form-control" value="{{ $hobi->nama }}">
                        <button type="button" class="btn btn-danger remove-hobi">Hapus</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-hobi" class="btn btn-secondary mt-2">+ Tambah Hobi</button>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-link">Kembali</a>
    </form>
</div>

<script>
    document.getElementById('add-hobi').addEventListener('click', function () {
        const container = document.getElementById('hobi-container');
        const div = document.createElement('div');
        div.classList.add('input-group', 'hobi-group');
        div.innerHTML = `
            <input type="text" name="hobbies[]" class="form-control" placeholder="Nama Hobi">
            <button type="button" class="btn btn-danger remove-hobi">Hapus</button>
        `;
        container.appendChild(div);
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-hobi')) {
            e.target.closest('.hobi-group').remove();
        }
    });
</script>
</body>
</html>
