<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return response()->json($todos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string|in:Pending,InProgress,Completed',
            'due_date' => 'nullable|date'
        ]);

        $date = $request->due_date ? $request->due_date : Carbon::now();

        $todo = Todo::create([
            'title' => $request->title,
            'status' => $request->status,
            'due_date' => $date,
        ]);

        return response()->json($todo, 201);
    }


    public function update(Todo $todo)
    {
        $data = array_filter(request()->only(['title', 'status', 'due_date']), function ($value) {
            return !is_null($value);
        });

        $todo->update($data);

        return response()->json($todo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(null, 204); // Return no content (204)
    }
}
