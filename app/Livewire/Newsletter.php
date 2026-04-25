<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\NewsletterSubscriber;

class Newsletter extends Component
{
    public $email = '';
    public $subscribed = false;

    public function subscribe()
    {
        $this->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email'
        ], [
            'email.unique' => 'You are already subscribed to our newsletter!'
        ]);

        NewsletterSubscriber::create([
            'email' => $this->email
        ]);

        $this->subscribed = true;
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.newsletter');
    }
}
