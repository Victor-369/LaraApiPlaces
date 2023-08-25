<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Http\Requests\ApiCreatePlaceRequest;
use App\Http\Requests\ApiUpdatePlaceRequest;


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

    public function store(/*Request*/ ApiCreatePlaceRequest $request) {
        $data = $request->json()->all();

        $place = Place::create($data);

        return $place ? 
                        response(['status' => 'OK', 'results' => $place], 201):
                        response(['status' => 'ERROR', 'message' => 'Not able to save data.'], 400);
    }

    public function update(/*Request*/ ApiUpdatePlaceRequest $request, $id) {
        $place = Place::find($id);

        if(!$place) {
            return response(['status' => 'Not found'], 404);
        }

        $data = $request->json()->all();

        return $place->update($data) ?
                                    response(['status' => 'OK', 'results' => [$place]], 200):
                                    response(['status' => 'ERROR', 'message' => 'Not able to save data.'], 400);
    }

    public function delete($id) {
        $place = Place::find($id);

        if(!$place) {
            return response(['status' => 'NOT FOUND'], 404);
        }

        return $place->delete() ?
                                response(['status' => 'OK']):
                                response(['status' => 'ERROR', 'message' => 'Not able to delete it.'], 400);
    }
}
