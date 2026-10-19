<header
    class="border-base-300 bg-base-100/85 sticky top-0 z-20 flex h-16 items-center justify-between border-b px-4 backdrop-blur sm:px-8">
    <a href="/home" class="flex items-center gap-2.5">
        <span class="bg-marigold text-primary-content grid size-9 place-items-center rounded-xl"><i
                class="fa-solid fa-book-open text-neutral"></i></span>
        <span class="font-display text-xl font-semibold">Daybook</span>
    </a>

    <!-- Logged out: Log in button. Logged in: avatar + name -> Profile. -->
    @auth
        <div id="header-auth" class="flex items-center">

            <a href="/profile" wire:navigate
                class="hover:bg-base-200 flex items-center gap-2.5 rounded-full py-1 pl-1 pr-3 transition-colors">
                <span
                    class="inline-flex size-8 shrink-0 items-center justify-center rounded-full text-sm font-semibold text-white">{{ auth()->user()->initials() }}</span>
                <span class="hidden text-sm font-medium sm:inline">{{ auth()->user()->name }}</span>
            </a>
            <button class="btn btn-ghost btn-sm btn-square ml-1" aria-label="Log out" title="Log out" wire:click="logout">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </div>
    @else
        <div id="header-auth">
            <button class="btn btn-primary btn-sm" onclick="welcome_modal.showModal()">
                <i class="fa-solid fa-right-to-bracket"></i>@lang('main.get_started')
            </button>
        </div>
    @endauth
</header>
