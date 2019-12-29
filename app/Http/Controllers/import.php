<?php


namespace App\Http\Controllers;
use App\Ph;
use Illuminate\Http\Request;

class import extends Controller
{
    public function get(){
        return view('import');
    }

    public function post(Request $request){
        if (isset( $request->all ()['import-file'] )) {
            Ph::import(self::import_file($request));
            return view('import');
        }
        if ($request->get('operation') == 'drop-table') {
            Ph::drop_db();
            return ['data'=>'ok'];
        }
        if ($request->get('operation') == 'download-table') {
            Ph::download_db();
        }
    }


    private static function import_file(Request $request){
        $file_name = $request->file ( "import-file" )->getClientOriginalName ();
        $full_path = $request->file ( "import-file" )->storeAs ( "study", $file_name );
        $full_path = storage_path ( "app/" . $full_path );
        return json_decode(file_get_contents($full_path), true);
    }

}
