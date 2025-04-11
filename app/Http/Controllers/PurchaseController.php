<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function showForm()
    {
        $items = [
            'Pensil'     => 2000,
            'Pulpen'     => 5000,
            'Buku'       => 10000,
            'Penghapus'  => 1500,
        ];

        return view('purchase.form', compact('items'));
    }

    public function processForm(Request $request)
    {
        $request->validate([
            'item_name'     => 'required|string',
            'price'         => 'required|numeric|min:0',
            'quantity'      => 'required|integer|min:1',
            'discount'      => 'nullable|numeric|min:0|max:100',
            'tax'           => 'nullable|numeric|min:0|max:100',
            'payment'       => 'required|numeric|min:0',
        ]);

        $itemName  = $request->item_name;
        $price     = $request->price;
        $quantity  = $request->quantity;
        $discount  = $request->discount ?? 0;
        $tax       = $request->tax ?? 0;
        $payment   = $request->payment;

        $subtotal     = $price * $quantity;
        $discountAmt  = ($discount / 100) * $subtotal;
        $taxAmt       = ($tax / 100) * ($subtotal - $discountAmt);
        $total        = ($subtotal - $discountAmt) + $taxAmt;
        $change       = $payment - $total;

        return view('purchase.result', compact(
            'itemName', 'price', 'quantity', 'subtotal',
            'discount', 'discountAmt', 'tax', 'taxAmt',
            'total', 'payment', 'change'
        ));
    }
}
