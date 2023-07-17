<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCompleted;

class Products extends Controller
{
    public function getProducts(Request $request){
            $products = Product::all();
            return response()->json($products);
    }
    
    public function getProductById(Request $request){
        $product = Product::where('id', $request->product_id)->get();
        return Inertia::render('ProductDetail', [
            'product' => $product
        ]);
    }
    public function getCartItems(Request $request){
        $userId = Auth::id();
        $mostRecent = Cart::where('user_id', $userId)->orderBy('created_at', 'desc')->limit(1)->get();
        $userCart = CartItem::where('cart_id', $mostRecent[0]->id)->get();
        $products = $userCart->load(['product', 'cart']);
        return response()->json([
            "products" => $products
        ]);
    }

    protected function createCart($userId, $product, $quantity){
         $cart = new Cart();
         $cart->user_id = $userId;
         $cart->save();
         $cartId = $cart->id;
         $cartItem = CartItem::create([
            "cart_id" => $cartId,
            "product_id" => $product->id,
            "quantity" => $quantity,
            "price_per_item" => $product->price,
            "total_price" => $product->price * $quantity,
         ]);

        return [
            "cartId" => $cart->id,
            "cartItem" => $cartItem->id
        ];
    }
    public function addProductToCart(Request $request){
         $user = User::find($request->user()->id);
         // if user is not authneticated redirect
         if(!Auth::check()) return redirect('/');
         $productId = $request->product_id;
         $product = Product::find($productId);
         $quantity = !isset($request->quantity) ?  1 : $request->quantity;
         $cartItem = null;
         $products = null;   
        // If cart is non-existent create it 
        // Get the cart for a user
        $cart = Cart::where('user_id', $user->id)->get();
        if($cart->isEmpty()){
        $createdCart = $this->createCart($user->id, $product, $quantity);
        $cartItem = CartItem::find($createdCart['cartId']);
        $products = $cartItem->product;
        } 
        else {
           // Get the cart and update it
           // check if the product exists on the cart
            $cartItems = CartItem::where('cart_id', $cart[0]->id)->where('product_id', $product->id)->get();
            if($cartItems->isEmpty()){
                // if products does not exist in the cart add it
                        CartItem::create([
                        "cart_id" =>  $cart[0]->id,
                        "product_id" => $product->id,
                        "quantity" => $quantity,
                        "price_per_item" => $product->price,
                        "total_price" => $product->price * $quantity,
               ]);
            } else {
                // if it does update quantity
                $productQuantity = $cartItems[0]->quantity + 1;
                $totalPrice = $productQuantity * $product->price;
                $updatedCart = CartItem::where('cart_id', $cart[0]->id)->where('product_id', $product->id)->update(['quantity' => $productQuantity, 'total_price' => $totalPrice]);
            }
           $cartItem = CartItem::find($cart[0]->id);
           $userCart = CartItem::where('cart_id', $cart[0]->id)->get();
           $products = $userCart->load(['product', 'cart']); 
        }
       
        return response()->json(["response" => "Item Added", "items" => $products]);
    }

    public function removeProducFromCart(Request $request){
        $user = User::find($request->user()->id);
        $productId = $request->product_id;
        $product = Product::find($productId);
        $cart = Cart::where('user_id', $user->id)->get();
        $cartItem = CartItem::where('cart_id', $cart[0]->id)->where('product_id', $productId);
        $cartItem->delete();
        return response()->json(["response" => "Item Removed"]);
    }

    public function checkOut(Request $request){
       
        $user = User::find($request->user()->id);
        $cart = Cart::where('user_id', $user->id)->get();
        $cartItem = CartItem::where('cart_id', $cart[0]->id);
        // Call the order complete and Reset app
        $cartItem->delete();
        Mail::to("fake@mail.com")->send(new OrderCompleted());
        return redirect('/dashboard');
    }



}
