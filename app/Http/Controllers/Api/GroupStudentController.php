<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyGroupStudentRequest;
use App\Http\Requests\StoreGroupStudentRequest;
use App\Http\Requests\UpdateGroupStudentRequest;
use App\Models\User;

class GroupStudentController extends Controller
{
    public function store(StoreGroupStudentRequest $request)
    {
        $validated = $request->validated();

        $user = User::find($validated['user_id']);

        if (!$user) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $user->groups()->attach($validated['group_id']);

        return response()->json(['message' => 'Add group'], 201);
    }

    public function update(UpdateGroupStudentRequest $request,string $id)
    {
        $validated = $request->validated();

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $user->groups()->sync([$validated['group_id']]);

        return response()->json(['message' => 'Update success']);
    }
    public function destroy(DestroyGroupStudentRequest $request,string $id)
    {
        $validated = $request->validated();

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $user->groups()->detach($validated['group_id']);

        return response()->json(['message' => 'Delete success']);
    }
}
