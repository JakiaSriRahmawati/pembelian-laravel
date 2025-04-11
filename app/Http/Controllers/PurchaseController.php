<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function showForm()
    {
        $items = [
            ['name' => 'Pensil', 'price' => 2000],
            ['name' => 'Pulpen', 'price' => 5000],
            ['name' => 'Buku', 'price' => 10000],
            ['name' => 'Penghapus', 'price' => 1500],
        ];

        return view('purchase.form', compact('items'));
    }


    public function processForm(Request $request)
    {
        $request->validate([
            'items'     => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'discount'  => 'nullable|numeric|min:0|max:100',
            'tax'       => 'nullable|numeric|min:0|max:100',
            'payment'   => 'required|numeric|min:0',
        ]);

        $itemPrices = [
            'Pensil'     => 2000,
            'Pulpen'     => 5000,
            'Buku'       => 10000,
            'Penghapus'  => 1500,
        ];

        $items = [];
        $subtotal = 0;

        foreach ($request->items as $item) {
            $name = $item['name'];
            $quantity = $item['quantity'];
            $price = $itemPrices[$name] ?? 0;
            $totalPerItem = $price * $quantity;

            $items[] = [
                'name'     => $name,
                'quantity' => $quantity,
                'price'    => $price,
                'total'    => $totalPerItem,
            ];

            $subtotal += $totalPerItem;
        }

        $discount    = $request->discount ?? 0;
        $tax         = $request->tax ?? 0;
        $discountAmt = ($discount / 100) * $subtotal;
        $taxAmt      = ($tax / 100) * ($subtotal - $discountAmt);
        $total       = ($subtotal - $discountAmt) + $taxAmt;
        $payment     = $request->payment;
        $change      = $payment - $total;

        return view('purchase.result', compact(
            'items', 'subtotal', 'discount', 'discountAmt',
            'tax', 'taxAmt', 'total', 'payment', 'change'
        ));
    }

}
