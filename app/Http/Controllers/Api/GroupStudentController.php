<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GroupStudentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($validated['user_id']);

        if (!$user) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $user->groups()->attach($validated['group_id']);

        return response()->json(['message' => 'Add group'], 201);
    }

    public function update(Request $request,string $id)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $user->groups()->sync([$validated['group_id']]);

        return response()->json(['message' => 'Update success']);
    }
    public function destroy(Request $request,string $id)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $user->groups()->detach($validated['group_id']);

        return response()->json(['message' => 'Delete success']);
    }
}
