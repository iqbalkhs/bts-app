<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = Checklist::all();
        return response()->json($checklists);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $checklist = Checklist::create([
            'name' => $request->input('name'),
        ]);

        return response()->json($checklist, 201);
    }

    public function destroy($checklistId)
    {
        $checklist = Checklist::findOrFail($checklistId);
        $checklist->delete();
        return response()->json(null, 204);
    }
}
