<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $orderBy = $request->get('order_by', 'id');
        $orderDirection = $request->get('order_direction', 'asc');
        $search = $request->get('search');

        $query = Group::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $group = $query->orderBy($orderBy, $orderDirection)->paginate($perPage);

        return response()->json($group);
    }

    public function show(Group $group)
    {
        return response()->json($group);
    }

    public function store(StoreGroupRequest $request)
    {
        $validator = $request->validated();

        $group = Group::query()->create($validator);

        return response()->json([
            'message' => 'Group created successfully',
            'group' => $group
        ], 201);
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $validated = $request->validated();

        $group->update($validated);

        return response()->json([
            'message' => 'Group updated successfully',
            'group' => $group
        ]);
    }

    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json(['message' => 'Group deleted successfully']);
    }
}
