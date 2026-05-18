<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('costumer.keranjang', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $book = Books::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "judul" => $book->judul,
                "quantity" => 1,
                "price" => $book->harga,
                "sampul" => $book->sampul,
                "penulis" => $book->penulis
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Keranjang berhasil diperbarui');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Buku dihapus dari keranjang');
        }
    }
}
