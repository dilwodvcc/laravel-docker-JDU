<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyRoleUserRequest;
use App\Http\Requests\StoreRoleUserRequest;
use App\Http\Requests\UpdateRoleUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function store(StoreRoleUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()
            ->find($validated['user_id']);
        $user->roles()->attach($validated['role_id']);

        return response()->json([
            'success' => true,
        ]);
    }
    public function destroy(DestroyRoleUserRequest $request,string $id)
    {
        $validated = $request->validated();
        $user = User::query()
            ->find($id);
        $user->roles()->detach($validated['role_id']);
        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
    }
    public function update(UpdateRoleUserRequest $request,string $id)
    {
        $validated = $request->validated();
        $user = User::query()
            ->find($id);
        $user->roles()->sync($validated['role_id']);

        return response()->json([
            'message' => 'Student updated successfully',
        ]);
    }
}
