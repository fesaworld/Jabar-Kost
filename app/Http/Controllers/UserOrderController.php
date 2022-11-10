<?php

namespace App\Http\Controllers;

use App\Room;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use DateTime;


class UserOrderController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $status = Auth::user()->detail->status;
        $inv = Invoice::with('toUser', 'toRoom')->where('user_id', $id)->where('status', '<>', 'Selesai')->first();
        if($inv == null){
            $room = Room::where('stok', '<>', '0')->get();

            $data = [
                'room'   => $room,
                'inv'    => $inv,
                'status' => $status,
                'script' => 'components.scripts.user.userOrder'
            ];
        }else{
            $data = [
                'inv'    => $inv,
                'status'    => $status,
                'script' => 'components.scripts.user.userOrder'
            ];
        }

        return view('pages.user.userOrder', $data);
    }

    public function store(Request $request)
    {
        if($request->orderStart == NULL) {
                $json = [
                    'msg'       => 'Mohon pilih waktu mulai sewa',
                    'status'    => false
                ];
        } elseif($request->orderEnd == NULL) {
            $json = [
                'msg'       => 'Mohon pilih waktu akhir sewa',
                'status'    => false
            ];
        } elseif($request->orderStart == $request->orderEnd) {
            $json = [
                'msg'       => 'Waktu mulai sewa dan akhir sewa tidak boleh sama',
                'status'    => false
            ];
        } else {
            $getRoom = Room::where('id', $request->orderRoomID)->first();
            $start = new DateTime(date('d-m-Y', strtotime($request->orderStart)));
            $end = new DateTime(date('d-m-Y', strtotime($request->orderEnd)));
            $datediff = $end->diff($start);
            $totalBulan = $datediff->days / 31;
            $totalHarga = $getRoom->price * ceil($totalBulan);

            try{
                Invoice::create([
                    'user_id' => Auth::user()->id,
                    'room_id' => $request->orderRoomID,
                    'start' => date('Y-m-d H-i-s', strtotime($request->orderStart)),
                    'end' => date('Y-m-d H-i-s', strtotime($request->orderEnd)),
                    'discount' => 0,
                    'total_price' => $totalHarga,
                    'trf_image' => null,
                    'status' => 'Non-Aktif',
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                $json = [
                    'msg' => 'Booking anda berhasil dibuat, Lengkapi data pembayaran Untuk mulai Sewa',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }
        }

        return Response::json($json);
    }
}
