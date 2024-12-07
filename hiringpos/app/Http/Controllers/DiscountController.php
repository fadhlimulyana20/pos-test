<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function calculateTotalDiscount(Request $request) 
    {
        // Validasi input
        $validatedData = $request->validate([
            'total_sebelum_diskon' => 'required|numeric|min:0',
            'discounts' => 'required|array',
            'discounts.*.diskon' => 'required|numeric|min:0|max:100'
        ]);

        // Ambil Data
        $total_sebelum_diskon = $validatedData['total_sebelum_diskon'];
        $discounts = $validatedData['discounts'];


        // Hitung total setelah diskon
        $total_after_discounts = $total_sebelum_diskon;

        foreach ($discounts as $discount) {
            $diskon = $discount['diskon'];
            $total_after_discounts -= ($total_after_discounts * ($diskon / 100));
        }

        // Kembalikan JSON response
        return response()->json([
            'total_sebelum_diskon' => round($total_sebelum_diskon, 2),  // Dibulatkan ke 2 desimal
            'total_after_discounts' => round($total_after_discounts, 2)
        ]);
    }
}
