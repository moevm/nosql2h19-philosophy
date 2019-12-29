<?php


namespace App\Http\Controllers;


use App\Ph;
use Illuminate\Http\Request;

class philosopher extends Controller
{
    public function get(Request $request)
    {
        $school = Ph::get_all_school();
        return view('philosopher', [
            'school' => $school,
        ]);
    }

    public function search_ph(Request $request){
        $data= $request->get('data');
        $result = Ph::get_philop($data);
        return view('ph',['result'=>$result,'school'=>$data['with_school'],'def'=>$data['with_defin']]) ;
    }

    public static function post(Request $request)
    {
        if ($request->get('operation') == 'add-ph') {
            $data = $request->get('data');
            Ph::add_philop($data['name'],$data['info'],$data['school']);
        }
        return null;
    }


}
