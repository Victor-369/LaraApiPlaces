<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\ApiCreateCommentRequest;
use App\Http\Requests\ApiUpdateCommentRequest;


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

    public function store(/* Request */ ApiCreateCommentRequest $request) {
        $data = $request->json()->all();

        $comment = Comment::create($data);

        return $comment ? 
                        response(['status' => 'OK', 'results' => $comment], 201):
                        response(['status' => 'ERROR', 'message' => 'Not able to save data.'], 400);
    }

    public function update(/* Request */ ApiUpdateCommentRequest $request, $id) {
        $comment = Comment::find($id);

        if(!$comment) {
            return response(['status' => 'Not found'], 404);
        }

        $data = $request->json()->all();

        return $comment->update($data) ?
                                    response(['status' => 'OK', 'results' => [$comment]], 200):
                                    response(['status' => 'ERROR', 'message' => 'Not able to save data.'], 400);
    }

    public function delete($id) {
        $comment = Comment::find($id);

        if(!$comment) {
            return response(['status' => 'NOT FOUND'], 404);
        }

        return $comment->delete() ?
                                response(['status' => 'OK']):
                                response(['status' => 'ERROR', 'message' => 'Not able to delete it.'], 400);
    }
}
