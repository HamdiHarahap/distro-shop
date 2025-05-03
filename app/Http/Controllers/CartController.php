<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ProductStock; 
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []); 
        return view('pages.cart', compact('cart'));
    }


    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $productId = $request->product_id;
        $size = $request->size;
        $key = $productId . '-' . $size; 

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += 1;
        } else {
            $cart[$key] = [
                'product_id' => $productId,
                'name' => $request->name,
                'price' => $request->price,
                'size' => $size,
                'quantity' => 1,
                'image' => $request->image,
            ];
        }

        session()->put('cart', $cart);

        Alert::success('Berhasil', 'Berhasil Menambahkan Barang Ke Keranjang');
        return redirect()->route('cart');
    }

    public function remove($key)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]); 
            session()->put('cart', $cart); 
        }

        Alert::success('Berhasil', 'Berhasil Menghapus Barang');
        return redirect()->route('cart');
    }




    public function processCheckout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Keranjang kamu masih kosong!');
        }

        $request->validate([
            'alamat' => 'required',
            'payment_method' => 'required|in:cod,bni,bri',
            'payment_proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if (in_array($request->payment_method, ['bni', 'bri'])) {
            if (!$request->hasFile('payment_proof')) {
                return back()->withErrors(['payment_proof' => 'Bukti pembayaran wajib diupload untuk transfer bank.']);
            }
        }

        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $paymentProofPath = $request->file('payment_proof')->store('bukti', 'public');
        }

        $metode = $request->payment_method == 'cod' ? 'COD' : 'Transfer';
        $status = $metode == 'COD' ? 'Dibayar' : 'Belum Bayar';

        foreach ($cart as $item) {
            Transaction::create([
                'customer_id' => Auth::id(),
                'product_id' => $item['product_id'],
                'alamat' => $request->alamat,
                'metode' => $metode,
                'status' => $status,
                'bukti' => $paymentProofPath,
            ]);

            $stock = ProductStock::where('product_id', $item['product_id'])
                                ->where('size', $item['size'])
                                ->first();

            if ($stock) {
                $stock->stock -= $item['quantity'];
                if ($stock->stock < 0) {
                    $stock->stock = 0;
                }
                $stock->save();
            }
        }
        session()->forget('cart');
        
        Alert::success('Berhasil', 'Pesanan anda akan kami proses');
        return redirect()->route('home');
    }





}
