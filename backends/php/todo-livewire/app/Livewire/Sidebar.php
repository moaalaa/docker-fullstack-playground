<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public function logout()
    {
        auth()->logout();
        session()->regenerate();
        $this->dispatch('toast', message: trans('main.signed_out'))->to(Toast::class);
        $this->dispatch('auth:open-modal')->to(AuthModal::class);
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
