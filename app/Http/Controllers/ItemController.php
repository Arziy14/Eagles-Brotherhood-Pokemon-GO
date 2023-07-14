<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\CartItem;
use App\Mail\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ItemController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart_item = CartItem::where(['user_id' => Auth::user()['id'], 'item_id' => $request->item_id])->get();

        if ($cart_item->count() > 0) {
            $cart_item[0]->update([
                'quantity' => $cart_item[0]->quantity + 1
            ]);
        } else {
            $cart_item = CartItem::create([
                'item_id' => $request->item_id,
                'user_id' => Auth::user()['id'],
                'quantity' => 1
            ]);
        }

        return redirect('/cart');
    }

    public function deleteFromCart(Request $request)
    {
        $cart_item = CartItem::where(['user_id' => Auth::user()['id'], 'item_id' => $request->item_id])->get();
        $quantity = $cart_item[0]->quantity - 1;
        if ($quantity <= 0) {
            $cart_item[0]->delete();
        } else {
            $cart_item[0]->update([
                'quantity' => $cart_item[0]->quantity - 1
            ]);
        }

        return redirect('/cart');
    }

    public function checkoutFromCart(Request $request)
    {
        $cart_item = CartItem::where(['user_id' => Auth::user()['id'], 'item_id' => $request->item_id])->get()[0];

        $transaction_item = TransactionItem::create([
            'item_id' => $request->item_id,
            'user_id' => Auth::user()['id'],
            'quantity' => $cart_item->quantity
        ]);
        $item = Item::find($cart_item->item_id);

        $data = [
            'id' => $transaction_item->id,
            'name' => $item->name,
            'price' => $item->money_price,
            'quantity' => $transaction_item->quantity,
        ];
        $cart_item->delete();

        switch ($item->name) {
            case '600 PokéCoins':
                User::find(Auth::user()['id'])->update([
                    'poke_coins' => Auth::user()['poke_coins'] + (600 * $data['quantity'])
                ]);
                Auth::user()['poke_coins'] += (600 * $data['quantity']);
                break;

            case '1300 PokéCoins':
                User::find(Auth::user()['id'])->update([
                    'poke_coins' => Auth::user()['poke_coins'] + (1300 * $data['quantity'])
                ]);
                Auth::user()['poke_coins'] += (1300 * $data['quantity']);
                break;

            case '2700 PokéCoins':
                User::find(Auth::user()['id'])->update([
                    'poke_coins' => Auth::user()['poke_coins'] + (2700 * $data['quantity'])
                ]);
                Auth::user()['poke_coins'] += (2700 * $data['quantity']);
                break;

            case '5600 PokéCoins':
                User::find(Auth::user()['id'])->update([
                    'poke_coins' => Auth::user()['poke_coins'] + (5600 * $data['quantity'])
                ]);
                Auth::user()['poke_coins'] += (5600 * $data['quantity']);
                break;

            case '15500 PokéCoins':
                User::find(Auth::user()['id'])->update([
                    'poke_coins' => Auth::user()['poke_coins'] + (15500 * $data['quantity'])
                ]);
                Auth::user()['poke_coins'] += (15500 * $data['quantity']);
                break;
        }

        Mail::to(Auth::user()['email'])->send(new Transaction($data));

        return redirect('/cart');
    }

    public function cart()
    {
        $cart_items = CartItem::where(['user_id' => Auth::user()['id']])->get();
        $cart = array();
        foreach ($cart_items as $cart_item) {
            $item = Item::find($cart_item->item_id);
            $item->quantity = $cart_item->quantity;
            array_push($cart, $item);
        };

        return view('pages.cart', ['cart_items' => $cart, 'user' => Auth::user()]);
    }

    public function profile()
    {
        $transaction_items = TransactionItem::where(['user_id' => Auth::user()['id']])->get();
        $transactions = array();
        foreach ($transaction_items as $transaction_item) {
            $item = Item::find($transaction_item->item_id);
            $item->quantity = $transaction_item->quantity;
            array_push($transactions, $item);
        };

        return view('pages.profile', ['transaction_items' => $transactions, 'user' => Auth::user()]);
    }
    
    public function checkout(Request $request, $id)
    {
        $item = Item::find($id);
        $cart_item = CartItem::where(['user_id' => Auth::user()['id'], 'item_id' => $id])->get();
        $price = $item->money_price * $cart_item[0]->quantity;
        
        return view('pages.checkout', ['price' => $price]);
    }
}
