<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hobby;


class UserClientController extends Controller
{
    public function index()
    {
        $users = User::with('hobbies')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->only('name', 'email', 'password'));
        foreach ($request->hobbies as $hobby) {
            $user->hobbies()->create(['name' => $hobby]);
        }
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::with('hobbies')->findOrFail($id);
        $this->authorize('edit', $user);
    
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'hobbies' => 'nullable|array',
            'hobbies.*' => 'string|nullable'
        ]);
    
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        $user->update($request->only('name', 'email', 'password'));
    
        // Hapus hobi lama dan tambahkan yang baru jika ada
        $user->hobbies()->delete();
    
        if ($request->filled('hobbies')) {
            foreach ($request->hobbies as $hobby) {
                if ($hobby) {
                    $user->hobbies()->create(['name' => $hobby]);
                }
            }
        }
    
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.index');
    }
}

