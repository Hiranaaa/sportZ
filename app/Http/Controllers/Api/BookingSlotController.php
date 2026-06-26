<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingSlotResource;
use App\Models\BookingSlot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingSlotController extends Controller
{
    public function getSlots(Request $request): JsonResponse
    {
        $request->validate(['court_id' => 'required|uuid|exists:courts,id', 'date' => 'required|date']);
        $slots = BookingSlot::where('court_id', $request->court_id)->where('slot_date', $request->date)->orderBy('start_time')->get();
        return response()->json(['data' => BookingSlotResource::collection($slots)]);
    }
}
