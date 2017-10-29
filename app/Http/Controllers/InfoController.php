<?php

namespace App\Http\Controllers;

use App\Info;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{

    public function index()
    {
        $infos = Info::all();
        return view('info.index',['infos'=>$infos]);
    }


    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:15',
            'content' => 'required|min:10',
        ]);

        $infoId = DB::table('info')->insertGetId([
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'user_id' => Auth::id(),
                'topic_id' => '1',
                'ctime' =>  Carbon::now()->toDateTimeString(),
        ]);

        return response()->json([
            'code' => 200,
            'url' => url('/bbs')
        ]);
    }

    public function update(Request $request,$id)
    {   
        $this->validate($request, [
            'title' => 'required|max:15',
            'content' => 'required|min:10',
        ]);
        $info = Info::find($id);
        $info->title = $request->input('title');
        $info->content = $request->input('content');
        $info->save();
        return response()->json([
            'code' => 200,
            'url' => url('/bbs')
        ]);
    }

    public function infoDetail(Request $request, $id)
    {
        $info = Info::find($id);
        return view('info.show',['info'=>$info]);
    }

    
}
