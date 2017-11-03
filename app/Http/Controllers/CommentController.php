<?php

namespace App\Http\Controllers;

use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
	public function save(Request $request,$id)
    {
        $this->validate($request, [
            'comment' => 'required|min:5'
        ]);

        $commentId = DB::table('comment')->insertGetId([
                'comment' => $request->get('comment'),
                'user_id' => Auth::user()->user->id,
                'info_id' => $id,
        ]);

        return response()->json([
            'code' => 200,
            'url' => url('/bbs')
        ]);
    }
}
