<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class Create extends Component
{
    public string $name;
    public string $color;

    public function create()
    {
        $this->validate([
            'name' => ['required'],
            'color' => ['required'],
        ]);

        Category::create([
            ...$this->all(),
            'user_id' => auth()->id(),
            'sort' => Category::max('sort') + 1,
        ]);

        $this->dispatch('category-created');
        $this->js('category_modal.close()');
    }

    public function render()
    {
        return view('livewire.categories.create');
    }
}
