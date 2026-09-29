<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class AuthModal extends Component
{
    public ?string $name = null;
    public ?string $password = null;
    public bool $showPass = false;

    public function mount()
    {
        if (auth()->guest()) {
            $this->openModal();
        }
    }

    #[On('auth:open-modal')]
    public function openModal()
    {
        $this->js('welcome_modal.showModal()');
    }

    public function process()
    {
        $this->showPass
            ? $this->checkPassword()
            : $this->checkUserName();
    }

    public function checkUserName()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:24'],
        ]);

        $this->showPass = true;
    }

    public function checkPassword()
    {
        $this->validate([
            'password' => ['required', 'string', 'min:3', 'max:24'],
        ]);

        $this->auth();
    }

    public function auth()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:24'],
            'password' => ['required', 'string', 'min:3', 'max:24'],
        ]);

        $user = User::where('name', $this->name)->first();

        if ($user) {
            if (!Hash::check($this->password, $user->password)) {

                $this->addError('password', trans('auth.failed'));

                return;
            }
        } else {
            $user = User::create([
                'name' => $this->name,
                'username' => $this->name,
                'email' => $this->name . '@example.com',
                'password' => Hash::make($this->password),
            ]);
        }


        auth()->login($user);

        session()->regenerate();

        $this->dispatch("toast", message: trans('main.signed_in'))->to(Toast::class);
        $this->js("welcome_modal.close()");

        $this->redirect('/home', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth-modal');
    }
}
