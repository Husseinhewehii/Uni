<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ajaxcontroller extends Controller
{
    public function ajax_form(){
        return view('ajax-form');
    }

    public function ajax(Request $request){

//        dd($request->file);

        return response()->json(['success'=>'Data Saved','data'=>'the Data']);
    }

}
