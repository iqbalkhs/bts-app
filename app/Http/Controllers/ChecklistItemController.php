<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Http\Request;

class ChecklistItemController extends Controller
{
    public function index($checklistId)
    {
        $checklistItems = ChecklistItem::where('checklist_id', $checklistId)->get();
        return response()->json($checklistItems);
    }

    public function store(Request $request, $checklistId)
    {
        $request->validate([
            'itemName' => 'required|string|max:255',
        ]);

        $checklist = Checklist::findOrFail($checklistId);

        $checklistItem = $checklist->items()->create([
            'name' => $request->input('itemName'),
        ]);

        return response()->json($checklistItem, 201);
    }

    public function show($checklistId, $checklistItemId)
    {
        $checklistItem = ChecklistItem::findOrFail($checklistItemId);
        return response()->json($checklistItem);
    }

    public function update(Request $request, $checklistId, $checklistItemId)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $checklistItem = ChecklistItem::findOrFail($checklistItemId);
        $checklistItem->update([
            'status' => $request->input('status'),
        ]);

        return response()->json($checklistItem);
    }

    public function destroy($checklistId, $checklistItemId)
    {
        $checklistItem = ChecklistItem::findOrFail($checklistItemId);
        $checklistItem->delete();
        return response()->json(null, 204);
    }

    public function rename(Request $request, $checklistId, $checklistItemId)
    {
        $request->validate([
            'itemName' => 'required|string|max:255',
        ]);

        $checklistItem = ChecklistItem::findOrFail($checklistItemId);
        $checklistItem->update([
            'name' => $request->input('itemName'),
        ]);

        return response()->json($checklistItem);
    }
}
