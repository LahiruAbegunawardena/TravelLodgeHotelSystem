<?php

namespace App\Http\Controllers\Api;

use Auth;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\BO\Models\InvoiceModel;
use App\BO\Services\HotelService;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use App\BO\Models\IndividualHotelRoomModel;
use App\BO\Transformations\HotelTransformable;

class ReservationApiController extends Controller{
    use HotelTransformable;
    protected $hotelService;
    public function __construct(HotelService $hotelService) {
        $this->hotelService = $hotelService;
    }

    public function getHotelDetails() {
        $hotelsData = $this->hotelService->getAllHotels();
        $hotels = [];
        foreach ($hotelsData as $key => $hotel) {
            $hotels[] = $this->transformHotelDet($hotel);
        }
        return response()->json([
            'status' => true,
            'message' => 'Hotel List Recieved..',
            'data' => $hotels
        ]);
    }

    public function reserveRooms(Request $request) {
        $rooms = $request["rooms"];
        $checkin = $request["checkin"]." 12:00:00";
        $checkout = $request["checkout"]." 12:00:00";
        $duration = date_diff(date_create($checkin), date_create($checkout));
        
        $user = Auth::guard('api')->user();
        
        $invoice = InvoiceModel::create([
            'total_price' => null, 
            'is_paid' => 0,
            'admins_id' => null
        ]);
        $total_payment = 0;

        foreach ($rooms as $room_id) {
            $room = IndividualHotelRoomModel::find($room_id);
            $payment = ($room->price_per_night) * ($duration->days);
            $total_payment += $payment;
            $user->reserve()->attach($room_id, [
                'invoice_id' => $invoice->id,
                'checkin_date_time' => $checkin,
                'checkout_date_time' => $checkout,
                // 'reserved_date_time' => date('Y-m-d H:i:s'),
                'reserved_date_time' => Carbon::now(),
                'price' => (double)$payment
            ]);
        }

        $curInvoice = InvoiceModel::find($invoice->id);
        $curInvoice->update([
            'total_price' => (double)$total_payment 
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Reservation completed..',
            // 'data' => $hotels
        ]);
    }

    public function myReservations() {
        $user = Auth::guard('api')->user();
        return response()->json([
            'status' => true,
            'message' => 'Reservation data retrieved..',
            'reservation_data' => $user->reserve
        ]);
    }
}
