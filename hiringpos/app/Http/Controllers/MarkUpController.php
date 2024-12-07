<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarkUpController extends Controller
{
    public function markupPriceForDeliveryMerchant(Request $request)
    {
        // Validasi Input
        $validatedData = $request->validate([
            'harga_sebelum_markup' => 'required|numeric|min:0',
            'markup_persen' => 'required|numeric|min:0|max:100',
            'share_persen' => 'required|numeric|min:0|max:100',
        ]);

        // Ambil Input
        $harga_sebelum_markup = $validatedData['harga_sebelum_markup'];
        $markup_persen = $validatedData['markup_persen'];
        $share_persen = $validatedData['share_persen'];

        // Hitung
        $markup = $harga_sebelum_markup * ($markup_persen / 100);
        $harga_setelah_markup = $harga_sebelum_markup + $markup;
        $share = $harga_setelah_markup * ($share_persen / 100);
        $net = $harga_setelah_markup - $share;

        return response()->json([
            'net_untuk_resto' => $net,
            'share_untuk_ojol' => $share
        ]);
    }
}
