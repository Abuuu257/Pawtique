<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\Product;
use App\Models\PetClubSubscription;



class PageController extends Controller
{
    public function home() { 
        $featuredProducts = Product::latest()->take(4)->get();
        return view('welcome', compact('featuredProducts')); 
    }
    public function products() { 
        return view('products'); 
    }

    public function toggleFavorite($id) {
        if(!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to favorite products!');
        }

        $user = auth()->user();
        if($user->favoriteProducts()->where('product_id', $id)->exists()) {
            $user->favoriteProducts()->detach($id);
            $msg = 'Removed from favorites.';
        } else {
            $user->favoriteProducts()->attach($id);
            $msg = 'Added to favorites!';
        }

        return back()->with('success', $msg);
    }
    
    public function productDetail($id) {
        $product = Product::findOrFail($id);
        
        // Ensure image key exists for cart compatibility if needed
        $product->image = $product->images[0];
        $isFavorite = auth()->check() ? auth()->user()->favoriteProducts()->where('product_id', $id)->exists() : false;

        return view('product-detail', compact('product', 'isFavorite'));
    }


    public function subscriptions() { return view('subscriptions'); }
    public function contact() { return view('contact'); }
    
    public function submitContact(Request $request) {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        ContactMessage::create($data);
        return back()->with('success', 'Thank you for reaching out! Your message sets our tails wagging. We will contact you soon.');
    }

    public function cart() { return view('cart'); }
    
    public function addToCart(Request $request) {
        $cart = session()->get('cart', []);
        $id = $request->id;
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => 1,
                'image' => $request->image,
                'subtitle' => $request->subtitle ?? 'Item'
            ];
        }
        session()->put('cart', $cart);
        return back()->with('success', 'Added to Cart successfully!');
    }

    public function updateCart(Request $request) {
        $cart = session()->get('cart');
        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            if($cart[$request->id]['quantity'] <= 0) {
                unset($cart[$request->id]);
            }
            session()->put('cart', $cart);
        }
        return back();
    }

    public function removeFromCart($id) {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Item removed correctly!');
    }

    public function checkout() {
        $cart = session()->get('cart', []);
        $user = auth()->user();

        foreach($cart as $id => $item) {
            // Check if item is a subscription (IDs starting with 's' from our subscriptions page)
            if(strpos($id, 's') === 0) {
                PetClubSubscription::create([
                    'user_id' => $user ? $user->id : null,
                    'plan_name' => $item['name'],
                    'price' => $item['price'],
                    'email' => $user ? $user->email : 'guest@example.com', // placeholder for guest logic
                    'status' => 'active'
                ]);
            }
        }

        session()->forget('cart');
        return back()->with('success', 'Order placed successfully! Thank you for spoiling your pet with us.');
    }


    public function adminDashboard() {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        $productCount = Product::count();
        $memberCount = PetClubSubscription::count();
        return view('admin', compact('messages', 'productCount', 'memberCount'));
    }

    public function adminProducts() {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.products-index', compact('products'));
    }

    public function createProduct() {
        return view('admin.products-create');
    }

    public function storeProduct(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'price' => 'required|numeric',
            'rating' => 'required|numeric|min:0|max:5',
            'reviews' => 'required|integer|min:0',
            'description' => 'required|string',
            'image1' => 'required|url',
            'image2' => 'nullable|url',
            'image3' => 'nullable|url',
        ]);

        $images = [$data['image1']];
        if(!empty($data['image2'])) $images[] = $data['image2'];
        if(!empty($data['image3'])) $images[] = $data['image3'];

        Product::create([
            'name' => $data['name'],
            'subtitle' => $data['subtitle'],
            'price' => $data['price'],
            'rating' => $data['rating'],
            'reviews' => $data['reviews'],
            'description' => $data['description'],
            'images' => $images,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }

    public function editProduct($id) {
        $product = Product::findOrFail($id);
        return view('admin.products-edit', compact('product'));
    }

    public function updateProduct(Request $request, $id) {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'price' => 'required|numeric',
            'rating' => 'required|numeric|min:0|max:5',
            'reviews' => 'required|integer|min:0',
            'description' => 'required|string',
            'image1' => 'required|url',
            'image2' => 'nullable|url',
            'image3' => 'nullable|url',
        ]);

        $images = [$data['image1']];
        if(!empty($data['image2'])) $images[] = $data['image2'];
        if(!empty($data['image3'])) $images[] = $data['image3'];

        $product->update([
            'name' => $data['name'],
            'subtitle' => $data['subtitle'],
            'price' => $data['price'],
            'rating' => $data['rating'],
            'reviews' => $data['reviews'],
            'description' => $data['description'],
            'images' => $images,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function deleteProduct($id) {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }

    public function updateMessageStatus(Request $request, $id) {
        $msg = ContactMessage::findOrFail($id);
        $msg->update(['status' => $request->status]);
        return back()->with('success', 'Inquiry status updated!');
    }

    public function deleteMessage($id) {
        $msg = ContactMessage::findOrFail($id);
        $msg->delete();
        return back()->with('success', 'Inquiry deleted permanently.');
    }


    public function adminMembers(Request $request) {
        $query = PetClubSubscription::with('user');
        
        if ($request->filled('plan') && $request->plan !== 'all') {
            $query->where('plan_name', $request->plan);
        }

        $members = $query->orderBy('created_at', 'desc')->get();
        $plans = ['The Snack Pack', 'The Full Feast', 'The Groomer'];
        
        return view('admin.members', compact('members', 'plans'));
    }

    public function deleteMember($id) {
        $member = PetClubSubscription::findOrFail($id);
        $member->delete();
        return back()->with('success', 'Member removed from the club.');
    }

    public function profile() {
        $user = auth()->user();
        $subscription = \App\Models\PetClubSubscription::where('user_id', $user->id)->first();
        return view('profile.user-profile', compact('user', 'subscription'));
    }
}
