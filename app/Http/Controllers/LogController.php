<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use App\Invoice;
use App\Exports\LogExport;
use App\Imports\LogImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LogController extends Controller
{
    public function index()
    {

        $exclude = [];
        $id = Invoice::where('status', '<>', 'Selesai')->get();

        foreach($id as $userId) {
            $exclude[] = $userId->user_id;
        }


        $getUser = User::where('id', '<>', Auth::user()->id)->whereNotIn('id', $exclude)->get();


        $getRoom = Room::where('stok', '<>', 0)->get();

        $data = [
            'getUser' => $getUser,
            'getRoom' => $getRoom,
            'script' => 'components.scripts.admin.log'
        ];

        return view('pages.admin.log', $data);
    }

    public function export() 
    {
        return Excel::download(new LogExport, 'users.xlsx');
    }
}
