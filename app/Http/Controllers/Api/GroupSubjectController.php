<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyGroupSubjectRequest;
use App\Http\Requests\StoreGroupSubjectRequest;
use App\Http\Requests\UpdateGroupSubjectRequest;
use App\Models\Group;
use App\Models\Subject;
use Illuminate\Http\Request;

class GroupSubjectController extends Controller
{
    public function store(StoreGroupSubjectRequest $request)
    {
        $validated = $request->validated();

        $group = Group::query()
            ->find($validated['group_id']);
        $group->subjects()->attach($validated['subject_id']);
        return response()->json([
            'message' => 'success'
        ]);
    }

    public function update(UpdateGroupSubjectRequest $request,string $id)
    {
        $validated = $request->validated();
        $group = Group::query()
            ->find($id);
        $group->subjects()->sync($validated['subject_id']);
        return response()->json([
            'message' => 'Update success'
        ]);
    }
    public function destroy(DestroyGroupSubjectRequest $request, string $id)
    {
        $validated = $request->validated();
        $group = Group::query()
            ->find($id);
        $group->subjects()->detach($validated['subject_id']);
        return response()->json([
            'message' => 'Delete success'
        ]);
    }
}
