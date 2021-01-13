<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $period = now();
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

        $dates = collect();
        while ($start->lte($end)) {
            $dates->push($start->copy());
            $start->addDay();
        }
        //iterate days
        //for each day, loop through events and check if that day is with events, how? check if date is in between event dates and week days are included
        //if true, push the events for that day


        $events = Event::all();

        $withEvents = $dates->map(function ($date) use ($events) {
            $eee = $events->map(function($event) use ($date) {
                return [
                    'name' => $date >= $event->from && $date <= $event->to && in_array($date->format('D'), $event->days) ? $event->name : ''
                ];
            });

            return json_encode([
                'date' => $date->format('d'),
                'day' => $date->format('D'),
                'name' => $eee->flatten(2)
            ]);
        });

        return view('index', compact('dates', 'period', 'withEvents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::create([
            'name' => $request->name,
            'from' => $request->dateFrom,
            'to' => $request->dateTo,
            'days' => $request->includedDays
        ]);

        return $event;
    }
}
