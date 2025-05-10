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
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email', 'password'));

        $user->hobbies()->delete();
        foreach ($request->hobbies as $hobby) {
            $user->hobbies()->create(['name' => $hobby]);
        }

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}

