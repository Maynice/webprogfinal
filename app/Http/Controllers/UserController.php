<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes',
            'password' => 'sometimes|min:6',
        ]);

        $user = $request->user();
        $user->update($validated);
        return response()->json($user);
    }
}
