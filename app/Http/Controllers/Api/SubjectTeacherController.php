<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroySubjectTeacherRequest;
use App\Http\Requests\StoreSubjectTeacherRequest;
use App\Http\Requests\UpdateSubjectTeacherRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectTeacherController extends Controller
{
    public function store(StoreSubjectTeacherRequest $request)
    {
        $validated = $request->validated();
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
    public function update(UpdateSubjectTeacherRequest $request,string $id)
    {
        if (!$request->has('subject_id')) {
            return response()->json(['error' => 'subject_id is required'], 400);
        }

        $validated = $request->validated();
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
    public function destroy(DestroySubjectTeacherRequest $request,string $id)
    {
        $validated = $request->validated();
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
