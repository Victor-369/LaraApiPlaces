<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;


class PlaceApiController extends Controller
{
    public function index() {

        $places = Place::orderBy('id', 'DESC')->get();

        return [
                'status' => 'OK',
                'total' => count($places),
                'results' => $places
                ];
    }

    public function show($id) {
        $place = Place::find($id);        

        return $place ? 
                        ['status' => 'OK', 'results' => [$place]]:
                        response(['status' => 'NOT FOUND'], 404);
    }

    public function search($field = 'place', $value = '') {
        $place = Place::where($field, 'like', "%$value%")->get();

        return [
                'status' => 'OK',
                'total' => count($place),
                'results' => $place
                ];
    }

    public function store(Request $request) {
        $data = $request->json()->all();

        $place = Place::create($data);

        return $place ? 
                        response(['status' => 'OK', 'results' => $place], 201):
                        response(['status' => 'ERROR', 'message' => 'Not able to save data.'], 400);
    }
}
