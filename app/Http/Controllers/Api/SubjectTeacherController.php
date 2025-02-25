<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectTeacherController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $user = User::query()
            ->find($validated['user_id']);
        if(!$user)
        {
            return response()->json([
                'message' => 'User not found',
            ]);
        }
        $user->subjects()->attach($validated['subject_id']);
        return response()->json([
            'success' => true,
        ]);
    }
    public function update(Request $request,string $id)
    {
        if (!$request->has('subject_id')) {
            return response()->json(['error' => 'subject_id is required'], 400);
        }

        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
        ]);
        $user = User::query()
            ->find($id);
        if(!$user)
        {
            return response()->json([
                'message' => 'User not found',
            ]);
        }
        $user->subjects()->sync($validated['subject_id']);
        return response()->json([
            'message' => 'Student updated successfully',
        ]);
    }
    public function destroy(Request $request,string $id)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
        ]);
        $user = User::query()
            ->find($id);
        if(!$user)
        {
            return response()->json([
                'message' => 'User not found',
            ]);
        }
        $user->subjects()->detach($validated['subject_id']);
        return response()->json(['message' => 'Subject deleted successfully']);
    }
}
