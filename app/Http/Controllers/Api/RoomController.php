<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $orderBy = $request->get('order_by', 'id');
        $orderDirection = $request->get('order_direction', 'asc');
        $search = $request->get('search');

        $query = Room::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $room = $query->orderBy($orderBy, $orderDirection)->paginate($perPage);

        return response()->json($room);
    }

    public function show(Room $room)
    {
        return response()->json($room);
    }

    public function store(StoreRoomRequest $request)
    {
        $validated = $request->validated();

        $room = Room::query()->create($validated);

        return response()->json([
            'message' => 'Room created successfully',
            'room' => $room
        ], 201);
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $validated = $request->validated();

        $room->update($validated);

        return response()->json([
            'message' => 'Room updated successfully',
            'room' => $room
        ]);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json(['message' => 'Room deleted successfully']);
    }
}
