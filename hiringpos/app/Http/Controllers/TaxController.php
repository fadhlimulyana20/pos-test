<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function calculateTax(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'total' => 'required|numeric|min:0',
            'persen_pajak' => 'required|numeric|min:0|max:100',
        ]);

        // Ambil input
        $total = $validatedData['total'];
        $persen_pajak = $validatedData['persen_pajak'];

        // Hitung Net Sales dan Pajak
        $net_sales = $total / (1 + ($persen_pajak / 100));
        $pajak_rp = $total - $net_sales;

        // Kembalikan JSON response
        return response()->json([
            'net_sales' => round($net_sales, 2), // Dibulatkan ke 2 desimal
            'pajak_rp' => round($pajak_rp, 2),
        ]);
    }
}
