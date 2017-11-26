<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shape;
use Uuid;

class PolygonController extends Controller
{
    public function index()
    {
    	$this->setActive('polygon');
    	$this->setTitle('polygon');

    	return view('polygon.index', $this->data);
    }

    public function submit(Request $request)
    {
    	// dd($request->all());
    	$shape = new Shape;
    	$shape->id = Uuid::generate(4);
    	$shape->path = $request->path;
    	$shape->tipe = 'Polygon';
    	$shape->lat = $request->lat;
    	$shape->lng = $request->lng;
        $shape->zoom = $request->zoom;
    	$shape->save();

    	return redirect(route('view.polygon', ['shape' => $shape->id]));
    }

    public function view(Shape $shape, Request $request)
    {
    	$this->setActive('polygon');
    	$this->setTitle($shape->id);
    	$this->data['shape'] = $shape;

    	return view('polygon.viewPolygon', $this->data);
    }
    public function update(Shape $shape, Request $request)
    {
    	$shape->path = $request->path;
    	$shape->tipe = 'Polygon';
    	$shape->lat = $request->lat;
        $shape->zoom = $request->zoom;
    	$shape->lng = $request->lng;
    	$shape->save();

    	return back();
    }
}
