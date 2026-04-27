<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        \App\Models\Review::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Optional: Update product rating/count
        $product = \App\Models\Product::find($request->product_id);
        $product->increment('reviews');
        
        // Recalculate average rating
        $avg = \App\Models\Review::where('product_id', $product->id)->avg('rating');
        $product->update(['rating' => $avg]);

        return back()->with('success', 'Thank you for your feedback! Your review has been published.');
    }
}
