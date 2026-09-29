<!-- Top bar -->
<header
    class="border-base-300 bg-base-100/85 sticky top-0 z-20 flex h-16 items-end justify-between border-b px-3 backdrop-blur sm:px-8">
    <div class="flex items-end">
        <label for="drawer" class="btn btn-ghost btn-square mb-1.5 mr-1 lg:hidden" aria-label="@lang('main.open_menu')">
            <i class="fa-solid fa-bars"></i>
        </label>
        <nav class="flex items-end" aria-label="@lang('main.pages')">

            <a href="/home" wire:navigate aria-current="page" @class([
                'flex items-center gap-2 border-b-[3px] px-3 pb-3.5 pt-2 font-medium sm:px-4',
                'border-marigold' => request()->is('home'),
                'text-base-content/55 hover:text-base-content  border-transparent  transition-colors' => !request()->is(
                    'home'),
            ])>
                <i class="fa-solid fa-newspaper"></i>@lang('main.posts')
            </a>
            <a href="/todos" wire:navigate @class([
                'flex items-center gap-2 border-b-[3px] px-3 pb-3.5 pt-2 font-medium sm:px-4',
                'border-marigold' => request()->is('todos'),
                'text-base-content/55 hover:text-base-content  border-transparent  transition-colors' => !request()->is(
                    'todos'),
            ])>
                <i class="fa-solid fa-list-check"></i>@lang('main.todos')
            </a>
        </nav>
    </div>

    <div class="mb-2 flex items-center">
        <div id="search-wrap" class="w-0 overflow-hidden transition-[width] duration-300" inert>
            <input id="search-input" type="search" class="input input-sm w-44 rounded-full sm:w-64"
                placeholder="@lang('main.search')" aria-label="@lang('main.search')" />
        </div>
        <button id="search-toggle" class="btn btn-ghost btn-circle" aria-label="@lang('main.search')"
            aria-expanded="false">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>
</header>
