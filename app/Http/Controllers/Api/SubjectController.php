<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $orderBy = $request->get('order_by', 'id');
        $orderDirection = $request->get('order_direction', 'asc');
        $search = $request->get('search');

        $query = Subject::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $subjects = $query->orderBy($orderBy, $orderDirection)->paginate($perPage);

        return response()->json($subjects);
    }

    public function show(Subject $subject)
    {
        return response()->json($subject);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject = Subject::create($validated);

        return response()->json([
            'message' => 'Subject created successfully',
            'subject' => $subject
        ], 201);
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject->update($validated);

        return response()->json([
            'message' => 'Subject updated successfully',
            'subject' => $subject
        ]);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully']);
    }
}
