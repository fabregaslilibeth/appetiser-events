<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Cast\Object_;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
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

        $events = Event::all();

        $withEvents = $dates->map(function ($date) use ($events) {
            $eee = $events->filter(function($event) use ($date) {
                return $date >= $event->from && $date <= $event->to && in_array($date->format('D'), $event->days);
            })->map(function ($event) use ($date) {
                return $event->name;
            });

            return ([
                'date' => $date->format('d'),
                'day' => $date->format('D'),
                'name' => $eee->flatten()
            ]);
        });

        return ['events' => $withEvents, 'period' => $period->format('M Y')];
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
