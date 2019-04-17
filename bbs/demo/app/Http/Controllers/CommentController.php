<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class CommentController
 * @package App\Http\Controllers 评论相关Controller
 */
class CommentController extends Controller
{
    public function publishComment(Request $request){
        $data = json_decode($request->getContent(),true);
        $pid = $data['pid'];
        $info = $data['info'];

        $session = $request->session();
        $cur_uid = $session->get('uid');

        $cur_time = time();

    }

    public function replyComment(){

    }

    public function getComment(){

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReply(Request $request){
        $data = json_decode($request->getContent(),true);
        $cid = $data['cid'];


        $response = array(
            'status' => "200",
            'info' => $reply
        );
        return response()->json($response);
    }
}
