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
            'email' => 'email|unique:users,email',
        ]);

        $user = User::findOrFail($request->user()->id);

        $user->fill($request->all());

        $user->save();

        return response()->json($user, 200);
    }
    public function delete(Request $request): JsonResponse
    {
        $user = User::findOrFail($request->user()->id);

        $user->delete();

        return response()->json(['message' => 'Successfully deleted account'], 200);
    }
}
