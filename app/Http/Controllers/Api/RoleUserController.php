<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::query()
            ->find($validated['user_id']);
        $user->roles()->attach($validated['role_id']);

        return response()->json([
            'success' => true,
        ]);
    }
    public function destroy(Request $request,string $id)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);
        $user = User::query()
            ->find($id);
        $user->roles()->detach($validated['role_id']);
        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
    }
    public function update(Request $request,string $id)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);
        $user = User::query()
            ->find($id);
        $user->roles()->sync($validated['role_id']);

        return response()->json([
            'message' => 'Student updated successfully',
        ]);
    }
}
