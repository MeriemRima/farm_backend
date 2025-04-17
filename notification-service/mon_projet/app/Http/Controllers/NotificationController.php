<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{   // Get all notifications
    public function index()
    {
        return response()->json(Notification::all());
    }
 
    // Create a new notification
    public function store(Request $request)
{
    try {
        $data = $request->all();
 
        // Normalize single notification into an array
        $notifications = isset($data[0]) ? $data : [$data];
 
        $validated = [];
 
        foreach ($notifications as $notification) {
            $validated[] = validator($notification, [
                'user_id' => 'required',
                'message' => 'required|string',
                'type' => 'required|in:order,general',
                'is_read' => 'boolean'
            ])->validate();
        }
 
        $created = [];
 
        foreach ($validated as $item) {
            $created[] = \App\Models\Notification::create($item);
        }
 
        return response()->json([
            'message' => 'Notifications created successfully.',
            'data' => $created
        ], 201);
 
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed.',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while creating notifications.',
            'error' => $e->getMessage()
        ], 500);
    }
}
 
    // Show a specific notification
    public function show($id)
    {
        $notification = Notification::find($id);
 
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }
 
        return response()->json($notification);
    }
 
    // Update a notification
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);
 
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }
 
        $validated = $request->validate([
            'message' => 'sometimes|required|string',
            'type' => 'sometimes|required|in:order,general',
            'is_read' => 'sometimes|required|boolean'
        ]);
 
        $notification->update($validated);
 
        return response()->json($notification);
    }
 
    // Delete a notification
    public function destroy($id)
    {
        $notification = Notification::find($id);
 
        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }
 
        $notification->delete();
 
        return response()->json(['message' => 'Notification deleted']);
    }
}