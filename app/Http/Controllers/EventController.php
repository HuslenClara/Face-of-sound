<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('date','desc')->paginate(5);//->get();
        return view('home')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'date' => 'date'
        ]);

        $event = new Event;

        
        $event->user_id = auth()->user()->id;
        $event->description = $request->input('description');
        $event->date = $request->input('date');
        $event->time = $request->input('time');
        $event->save();

        return redirect('/home')->with('success', 'Эвэнт амжилттай нийтлэгдлээ!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $events = Event::orderBy('date','desc')->paginate(10);//->get();
        return view('home')->with('events', $events);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'description' => 'required',
            'date' => 'date'
        ]);

        $event = Event::find($event->id);

        
        $event->user_id = auth()->user()->id;
        $event->description = $request->input('description');
        $event->date = $request->input('date');

        $event->save();

        return redirect('/home')->with('success', 'Эвэнт амжилттай шинэчлэгдлээ!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event->delete();

        return redirect()->route('home')
            ->with('success', 'Эвэнт амжилттай устгагдлаа!');
    }

}
