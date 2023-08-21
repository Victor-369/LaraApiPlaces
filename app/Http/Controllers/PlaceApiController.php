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
}
