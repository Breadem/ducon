<?php

namespace App\Http\Controllers;

use App\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{

    public function index()
    {
        //
    }


    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:15',
            'content' => 'required|min:10',
        ]);


        $info = Info::create([
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'user_id' => Auth::id(),
                'topic_id' => '1',
        ]);

        return redirect()->intended('/');

    }

    public function infoDetail(Info $info)
    {
        //
    }

    
}
