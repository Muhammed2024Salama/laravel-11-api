<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request): User
    {
        return $request->user();
    }
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required'
        ]);

        $user = User::findOrFail($request->user()->id);

        $user->fill([
            'email' => $request->email,
            'name' => $request->name,
        ]);

        $user->save();

        return response()->json($user, 200);
    }
    public function delete(Request $request): JsonResponse
    {
        $user = User::findOrFail($request->user()->id);

        $user->delete();

        return response()->json($user, 200);
    }
}
