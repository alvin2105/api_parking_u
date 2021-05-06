<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Parkir;
use App\Models\Booking;
use Illuminate\Http\Request;
use Xendit\Xendit;

class BookingController extends Controller
{
    private $token = 'xnd_development_peZMVIMqLihgBGv5YCvPXVUAlCcXIhgnUe0tQvnGsWozMAwsydUVLgLBOsLF';

    public function getVA(){
        Xendit::setApiKey('secretKey');
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();
        return response()->json([
            $getVABanks
        ])->setStatusCode(200);
    }


    public function createBooking(Request $request)
    {
        //get data parkir
        $parkir = Parkir::find($id_parkir);
        //post data
        $parkir->nama_parkir = $request->nama_parkir;
        $parkir->lokasi_parkir = $request->lokasi_parkir;
        $parkir->harga = $request->harga;
        $parkir->jarak = $request->jarak;
        $parkir->jam = $request->jam;
        $parkir->total_lahan = $request->total_lahan;
        $parkir->lahan_tersedia = $request->lahan_tersedia;
        $parkir->lahan_tidak_tersedia = $request->lahan_tidak_tersedia;
        
        $parkir->image_parkir = $request->image_parkir;
        $parkir->save();
    }
    
}



    