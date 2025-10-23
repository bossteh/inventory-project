<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('product')->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:in,out'
        ]);

        $product = Product::find($request->product_id);
        $total_price = $product->price * $request->quantity;

        // Update product quantity
        if ($request->type === 'in') {
            $product->quantity += $request->quantity;
        } else {
            if ($request->quantity > $product->quantity) {
                return back()->withErrors(['quantity' => 'Not enough stock!']);
            }
            $product->quantity -= $request->quantity;
        }
        $product->save();

        Transaction::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'type' => $request->type
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded!');
    }

    public function edit(Transaction $transaction)
    {
        $products = Product::all();
        return view('transactions.edit', compact('transaction', 'products'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:in,out'
        ]);

        $product = Product::find($request->product_id);

        // Revert old transaction stock
        if ($transaction->type === 'in') {
            $transaction->product->quantity -= $transaction->quantity;
        } else {
            $transaction->product->quantity += $transaction->quantity;
        }
        $transaction->product->save();

        // Apply new transaction stock
        if ($request->type === 'in') {
            $product->quantity += $request->quantity;
        } else {
            if ($request->quantity > $product->quantity) {
                return back()->withErrors(['quantity' => 'Not enough stock!']);
            }
            $product->quantity -= $request->quantity;
        }
        $product->save();

        $transaction->update([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $product->price * $request->quantity,
            'type' => $request->type
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated!');
    }

    public function destroy(Transaction $transaction)
    {
        // Revert stock if deleting transaction
        if ($transaction->type === 'in') {
            $transaction->product->quantity -= $transaction->quantity;
        } else {
            $transaction->product->quantity += $transaction->quantity;
        }
        $transaction->product->save();

        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted!');
    }

    // <-- Add this show() method
    public function show(Transaction $transaction)
    {
        $transaction->load('product'); // load related product
        return view('transactions.show', compact('transaction'));
    }
}
