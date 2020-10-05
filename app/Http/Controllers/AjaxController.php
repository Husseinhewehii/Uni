<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function ajaxForm()
    {
        return (view('ajax.ajax-form'));
    }

    public function ajaxImplement(Request $request)
    {
        return response()->json(['success'=>'Successful submission','data'=>$request->file]);
    }

    public function lander(Request $request)
    {
        $country_list = DB::table('country_city')->where('parent_id',null)->get();
        return view('ajax.country_cities')->with('country_list',$country_list);
    }

    public function fetch(Request $request)
    {
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data =  DB::table('country_city')
            ->where('parent_id',$value)->get();
        $output = '<option value = "">'.ucfirst($dependent).'</option>';

        foreach($data as $row)
        {
            $output .= '<option value = "'.$row->name.'">'.$row->name.'</option>';
        }

        echo $output;
    }
}
