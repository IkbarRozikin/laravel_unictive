<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api'); // <-- JWT middleware
    }

    public function index()
    {
        return response()->json(User::with('hobbies')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'hobbies'  => 'array'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        foreach ($request->hobbies as $hobby) {
            $user->hobbies()->create(['name' => $hobby]);
        }

        return response()->json($user->load('hobbies'), 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update($request->only('name', 'email', 'password'));

        $user->hobbies()->delete();
        foreach ($request->hobbies as $hobby) {
            $user->hobbies()->create(['name' => $hobby]);
        }

        return response()->json($user->load('hobbies'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'User deleted']);
    }
}
