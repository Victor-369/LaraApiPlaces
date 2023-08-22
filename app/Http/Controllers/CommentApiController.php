<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;


class CommentApiController extends Controller
{
    public function index() {

        $comments = Comment::orderBy('id', 'DESC')->get();

        return [
                'status' => 'OK',
                'total' => count($comments),
                'results' => $comments
                ];
    }

    public function show($id) {
        $comment = Comment::find($id);        

        return $comment ? 
                        ['status' => 'OK', 
                            'results' => [$comment]
                        ]:
                        response(['status' => 'NOT FOUND'], 404);
    }
    
    public function search($field = 'comment', $value = '') {
        $comment = Comment::where($field, 'like', "%$value%")->get();

        return [
                'status' => 'OK',
                'total' => count($comment),
                'results' => $comment
                ];
    }

    public function store(Request $request) {
        $data = $request->json()->all();

        $comment = Comment::create($data);

        return $comment ? 
                        response(['status' => 'OK', 'results' => $comment], 201):
                        response(['status' => 'ERROR', 'message' => 'Not able to save data.'], 400);
    }
}
