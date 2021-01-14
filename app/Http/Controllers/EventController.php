<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

        $dates = collect();
        while ($start->lte($end)) {
            $dates->push($start->copy());
            $start->addDay();
        }

        $event = Event::first();

        $withEvents = $dates->map(function ($date) use ($event) {
            return ([
                'date' => $date->format('d'),
                'day' => $date->format('D'),
                'name' => $date >= $event->from && $date <= $event->to && in_array($date->format('D'), $event->days) ? ucwords($event->name) : '',
            ]);
        });

        return ['events' => $withEvents, 'period' => now()->format('M Y')];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return Builder|Model
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::query()->updateOrCreate([
            'id' => 1,
        ],[
            'name' => $request->name,
            'from' => $request->dateFrom,
            'to' => $request->dateTo,
            'days' => $request->includedDays
        ]);

        return $event;
    }
}
