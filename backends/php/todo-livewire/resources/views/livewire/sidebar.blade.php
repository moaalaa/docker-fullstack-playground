<!-- ========================= SIDEBAR ========================= -->
<div class="drawer-side z-30">
    <label for="drawer" aria-label="@lang('main.close_menu')" class="drawer-overlay"></label>
    <aside class="bg-pine-950 text-pine-text flex h-full w-72 flex-col">
        <a href="/" wire:navigate class="flex items-center gap-3 px-6 pb-4 pt-6">
            <span class="bg-marigold text-pine-950 grid size-10 place-items-center rounded-xl"><i
                    class="fa-solid fa-book-open"></i></span>
            <span class="font-display text-2xl font-semibold text-white">@lang('main.app_name')</span>
        </a>

        <div class="px-6">
            <label
                class="input focus-within:border-marigold w-full rounded-xl border-white/10 bg-white/10 text-white focus-within:outline-none">
                <i class="fa-solid fa-magnifying-glass text-pine-muted"></i>
                <input id="cat-search" wire:model.live="search" type="search" class="placeholder:text-pine-muted"
                    placeholder="@lang('main.search_categories')" aria-label="@lang('main.search_categories')" />
            </label>
        </div>

        <div class="mx-6 my-5 h-px bg-white/10"></div>

        <livewire:categories.create />

        <!-- ========================= CATEGORY LIST (real markup, one <li> per category) ========================= -->
        <ul wire:sort="handleSort" id="cat-list" class="flex-1 space-y-1 overflow-y-auto pr-4" x-data="{ selectedCategory: @entangle('selectedCategory') }">
            <li>
                <button @class([
                    'cursor-pointer cat-btn flex w-full items-center gap-3 rounded-r-xl border-l-4 py-2.5 pl-5 pr-3 text-left',
                    'border-marigold bg-white/10 font-medium text-white' =>
                        $selectedCategory === 'all',
                    'border-transparent transition-colors hover:bg-white/5' =>
                        $selectedCategory !== 'all',
                ]) wire:click="selectCategory('all')">
                    <i class="fa-solid fa-layer-group text-pine-muted w-2.5 text-center"></i>
                    <span class="flex-1 truncate">@lang('main.all')</span>
                    <span class="text-pine-muted text-xs tabular-nums">{{ $this->categories->count() }}</span>
                </button>
            </li>

            @foreach ($this->categories as $category)
                <li wire:key="{{ $category->id }}" wire:sort:item="{{ $category->id }}">
                    <div class="group relative">
                        <button @class([
                            'cursor-pointer cat-btn flex w-full items-center gap-3 rounded-r-xl border-l-4 py-2.5 pl-5 pr-3 text-left',
                            'border-marigold bg-white/10 font-medium text-white' =>
                                $selectedCategory === $category->id,
                            'border-transparent transition-colors hover:bg-white/5' =>
                                $selectedCategory !== $category->id,
                        ])
                            class="cat-btn flex w-full items-center gap-3 rounded-r-xl border-l-4 py-2.5 pl-5 pr-3 text-left"
                            wire:click="selectCategory('{{ $category->id }}')">
                            <span class="size-2.5 shrink-0 rounded-full"
                                style="background:{{ $category->color }}"></span>
                            <span class="flex-1 truncate">{{ $category->name }}</span>
                        </button>
                        <div
                            class="absolute right-2 top-1/2 flex -translate-y-1/2 gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                            <button
                                class="btn btn-ghost btn-xs btn-circle text-pine-text hover:bg-error/40 hover:text-white"
                                aria-label="@lang('main.delete_work')" wire:click="deleteCategory('{{ $category->id }}')">


                                <span wire:loading.remove>
                                    <i class="fa-solid fa-trash"></i>
                                </span>
                                <span wire:loading>
                                    <span class="loading loading-spinner loading-md"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </li>
            @endforeach

        </ul>

        @auth
            <div class="m-4 flex items-center gap-3 rounded-2xl bg-white/5 p-3">
                <span id="user-avatar"
                    class="current-user-avatar inline-flex size-10 shrink-0 items-center justify-center rounded-full text-sm font-semibold text-white">

                    {{ auth()->user()->initials() }}

                </span>
                <div class="min-w-0 flex-1">

                    <p class="text-pine-muted text-xs">@lang('main.signed_in')</p>
                    <p id="user-name" class="truncate font-medium text-white">{{ auth()->user()->username }}</p>

                </div>

                <button class="btn btn-ghost btn-sm btn-square text-pine-text hover:bg-white/10"
                    aria-label="@lang('main.log_out')" title="@lang('main.log_out')" wire:click="logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>

            </div>
        @endauth
    </aside>



</div>
