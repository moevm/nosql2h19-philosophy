<?php


namespace App\Http\Controllers;


use App\Ph;
use Illuminate\Http\Request;

class definitions extends Controller
{
    public function get()
    {
        $result = Ph::get_all_def();
        return view('definitions',['result'=>$result]);
    }

    public function post(Request $request)
    {
        if (isset($request->all()['import-file'])) {
            Ph::import_def(self::import_file($request));
            return view('definitions');
        }

    }

    private static function import_file(Request $request){
        $file_name = $request->file ( "import-file" )->getClientOriginalName ();
        $full_path = $request->file ( "import-file" )->storeAs ( "study", $file_name );
        $full_path = storage_path ( "app/" . $full_path );
        return json_decode(file_get_contents($full_path), true);
    }}
