<?php


namespace App\Http\Controllers;


use App\Ph;
use Illuminate\Http\Request;

class school extends Controller
{
    public function get(Request $request)
    {
        $philosopher = Ph::get_all_philop();
        $school = Ph::get_all_school();
        return view('school', [
            'school'=> $school,
            'philosopher' => $philosopher,
        ]);
    }

    public function search_sch(Request $request){
        $data= $request->get('data');
        $result = Ph::get_sch($data);
        return view('sch',['result'=>$result,'oper'=>$data['oper']]) ;
    }

    public static function post(Request $request)
    {
        if ($request->get('operation') == 'add-sch') {
            $data = $request->get('data');
            $philops = isset($data['philops'])?$data['philops']:[];
            Ph::add_school($data['name'],$data['info'],$philops);
        }
        return null;
    }
}
