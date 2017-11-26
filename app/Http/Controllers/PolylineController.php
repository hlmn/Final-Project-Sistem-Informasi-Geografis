<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uuid;
use App\Shape;

class PolylineController extends Controller
{
    public function index()
    {
    	$this->setActive('polyline');
    	$this->setTitle('polyline');

    	return view('polyline.index', $this->data);
    }

    public function submit(Request $request)
    {
    	// dd($request->all());
    	$shape = new Shape;
    	$shape->id = Uuid::generate(4);
    	$shape->path = $request->path;
    	$shape->tipe = 'Polyline';
    	$shape->lat = $request->lat;
        $shape->zoom = $request->zoom;
    	$shape->lng = $request->lng;
    	$shape->save();

    	return redirect(route('view.polyline', ['shape' => $shape->id]));
    }

    public function view(Shape $shape, Request $request)
    {
    	$this->setActive('polyline');
    	$this->setTitle($shape->id);
    	$this->data['shape'] = $shape;

    	return view('polyline.viewPolyline', $this->data);
    }
    public function update(Shape $shape, Request $request)
    {
    	$shape->path = $request->path;
    	$shape->tipe = 'Polyline';
    	$shape->lat = $request->lat;
        $shape->zoom = $request->zoom;
    	$shape->lng = $request->lng;
    	$shape->save();
        
    	return back();
    }
}
