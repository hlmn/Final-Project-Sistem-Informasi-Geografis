<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shape;
use Uuid;
use Auth;

class GCDController extends Controller
{
    public function index()
    {
    	$this->setActive('gcd');
    	$this->setTitle('gcd');
        // dd(Auth::check());
        // dd(Auth::user()->getShape());
    	return view('gcd.index', $this->data);
    }

    public function submit(Request $request)
    {
    	// dd($request->all());
    	$shape = new Shape;
    	$shape->id = Uuid::generate(4);
    	$shape->path = $request->path;
    	$shape->tipe = 'gcd';
    	$shape->lat = $request->lat;
    	$shape->lng = $request->lng;
        $shape->zoom = $request->zoom;
        $shape->user_id = Auth::id();
    	$shape->save();

    	return redirect(route('view.gcd', ['shape' => $shape->id]));
    }

    public function view(Shape $shape, Request $request)
    {
    	$this->setActive('gcd');
    	$this->setTitle($shape->id);
    	$this->data['shape'] = $shape;

    	return view('gcd.viewGcd', $this->data);
    }
    public function update(Shape $shape, Request $request)
    {
    	$shape->path = $request->path;
    	$shape->tipe = 'gcd';
    	$shape->lat = $request->lat;
        $shape->zoom = $request->zoom;
    	$shape->lng = $request->lng;
    	$shape->save();

    	return back();
    }
}
