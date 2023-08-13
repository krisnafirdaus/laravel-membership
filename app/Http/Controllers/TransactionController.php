<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('transactions.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'No_Transaksi' => 'required|string',
            'Nama_Customer' => 'required|integer|exists:customers,id',
            'Tgl_Transaksi' => 'required|date',
            'discount' => 'required|numeric',
        ]);

        $transaction = Transaction::create($data);

        foreach ($request->details as $detail) {
            $transaction->details()->create($detail);
        }

        return redirect()->route('transactions.index');
    }

}
