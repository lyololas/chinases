<?php

namespace App\Http\Controllers\User;

use App\Helper\Cart;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $carts = $request->carts;
        $products = $request->products;

        $mergedData = [];

       
        foreach ($carts as $cartItem) {
            foreach ($products as $product) {
                if ($cartItem["product_id"] == $product["id"]) {
                    $mergedData[] = array_merge($cartItem, ["title" => $product["title"], 'price' => $product['price']]);
                }
            }
        }

  
        $totalPrice = $request->total;

        // Handle user address
        $newAddress = $request->address;
        if ($newAddress['address1'] != null) {
            $addressCount = UserAddress::where('isMain', 1)->count();
            if ($addressCount > 0) {
                UserAddress::where('isMain', 1)->update(['isMain' => 0]);
            }
            $address = new UserAddress();
            $address->address1 = $newAddress['address1'];
            $address->state = $newAddress['state'];
            $address->zipcode = $newAddress['zipcode'];
            $address->city = $newAddress['city'];
            $address->country_code = $newAddress['country_code'];
            $address->type = $newAddress['type'];
            $address->user_id = Auth::user()->id;
            $address->save();
        }

        $mainAddress = $user->user_address()->where('isMain', 1)->first();
        if ($mainAddress) {
            $order = new Order();
            $order->status = 'pending'; 
            $order->total_price = $totalPrice;
            $order->created_by = $user->id;
            $order->user_address_id = $mainAddress->id;
            $order->save();

            foreach ($mergedData as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'], 
                ]);
            }

            // Clear the cart items after order is created
            CartItem::where(['user_id' => $user->id])->delete();
            Cart::setCookieCartItems([]);

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalPrice,
                'status' => 'pending',
                'type' => 'manual', 
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);
        }

        // Redirect or return a response indicating success
        return Inertia::location(route('checkout.success'));
    }

    public function success(Request $request)
    {

        return redirect()->route('dashboard');
    }
}
