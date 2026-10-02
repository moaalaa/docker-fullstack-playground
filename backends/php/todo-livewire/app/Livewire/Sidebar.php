<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Sidebar extends Component
{

    public string $selectedCategory = 'all';
    public string $search = '';

    #[On('category-created')]
    public function categoryCreated() {}

    #[On('category-deleted')]
    public function categoryDeleted() {}

    #[On('category-updated')]
    public function categoryUpdated() {}

    #[Computed]
    public function categories()
    {
        return Category::query()
            ->where('user_id', auth()->id())
            ->when(filled($this->search), fn(Builder $builder) => $builder->whereLike('name', "%{$this->search}%"))
            ->oldest('sort')
            ->get();
    }

    public function handleSort($id, $position)
    {
        Category::where('id', $id)->update(['sort' => $position + 2]);
    }

    public function selectCategory(string $categoryId)
    {
        if ($categoryId === 'all') {
            $this->reset(['search']);
        }
        $this->selectedCategory = $categoryId;
    }
    public function deleteCategory(string $categoryId)
    {
        Category::where('id', $categoryId)->delete();
    }

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
