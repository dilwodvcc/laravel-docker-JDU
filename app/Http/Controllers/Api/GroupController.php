<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $group = Group::query()->create($validated);

        return response()->json([
            'message' => 'Group created successfully',
            'group' => $group
        ], 201);
    }

    public function update(Request $request, Group $group)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

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
