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

        $event = Event::first();

        $withEvents = $dates->map(function ($date) use ($event) {
            if (($date >= $event->from) && ($date <= $event->to) && (in_array($date->format('D'), $event->days))){
                $a = [
                    'date' => $date->format('d'),
                    'day' => $date->format('D'),
                    'name' => $event->name
                ];
                return json_encode($a);
            }else{
                $a = [
                    'date' => $date->format('d'),
                    'day' => $date->format('D'),
                    'name' => ''
                ];
                return json_encode($a);
            }
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
