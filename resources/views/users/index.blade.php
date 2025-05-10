<!DOCTYPE html>
<html>
<head>
    <title>Daftar User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar User</h2>
        <a href="{{ route('users.create') }}" class="btn btn-success">+ Tambah User</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Hobi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <ul class="mb-0">
                    @foreach($user->hobbies as $hobi)
                        <li>{{ $hobi->name }}</li>
                    @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>

                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data user.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
</body>
</html>
