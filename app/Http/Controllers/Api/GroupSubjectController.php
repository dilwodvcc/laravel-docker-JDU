<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Http\Request;

class GroupSubjectController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $group = Group::query()
            ->find($validated['group_id']);
        $group->subjects()->attach($validated['subject_id']);
        return response()->json([
            'message' => 'success'
        ]);
    }

    public function update(Request $request,string $id)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
        ]);
        $group = Group::query()
            ->find($id);
        $group->subjects()->sync($validated['subject_id']);
        return response()->json([
            'message' => 'Update success'
        ]);
    }
    public function destroy(Request $request, string $id)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
        ]);
        $group = Group::query()
            ->find($id);
        $group->subjects()->detach($validated['subject_id']);
        return response()->json([
            'message' => 'Delete success'
        ]);
    }
}
