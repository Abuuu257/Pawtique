<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\Url;

class ProductListing extends Component
{
    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $category = 'all';

    #[Url(history: true)]
    public $favorites = false;

    public function toggleFavorite($productId)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        if ($user->favoriteProducts()->where('product_id', $productId)->exists()) {
            $user->favoriteProducts()->detach($productId);
            $this->dispatch('notify', ['message' => 'Removed from favorites.', 'type' => 'info']);
        } else {
            $user->favoriteProducts()->attach($productId);
            $this->dispatch('notify', ['message' => 'Added to favorites!', 'type' => 'success']);
        }
    }

    public function clearFilters()
    {
        $this->reset(['search', 'category', 'favorites']);
    }

    public function render()
    {
        $query = Product::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('subtitle', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        if ($this->category !== 'all') {
            $query->where('subtitle', $this->category);
        }

        if ($this->favorites && auth()->check()) {
            $query->whereIn('id', auth()->user()->favoriteProducts->pluck('id'));
        }

        $products = $query->latest()->get();
        $categories = ['Food', 'Accessories', 'Grooming', 'Toys', 'Organic'];
        $favoriteIds = auth()->check() ? auth()->user()->favoriteProducts()->pluck('product_id')->toArray() : [];

        return view('livewire.product-listing', [
            'products' => $products,
            'categories' => $categories,
            'favoriteIds' => $favoriteIds,
        ]);
    }
}
