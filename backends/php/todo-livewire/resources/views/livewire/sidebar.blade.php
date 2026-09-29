<!-- ========================= SIDEBAR ========================= -->
<div class="drawer-side z-30">
    <label for="drawer" aria-label="@lang('main.close_menu')" class="drawer-overlay"></label>
    <aside class="bg-pine-950 text-pine-text flex h-full w-72 flex-col">
        <a href="/" class="flex items-center gap-3 px-6 pb-4 pt-6">
            <span class="bg-marigold text-pine-950 grid size-10 place-items-center rounded-xl"><i
                    class="fa-solid fa-book-open"></i></span>
            <span class="font-display text-2xl font-semibold text-white">@lang('main.app_name')</span>
        </a>

        <div class="px-6">
            <label
                class="input focus-within:border-marigold w-full rounded-xl border-white/10 bg-white/10 text-white focus-within:outline-none">
                <i class="fa-solid fa-magnifying-glass text-pine-muted"></i>
                <input id="cat-search" type="search" class="placeholder:text-pine-muted"
                    placeholder="@lang('main.search_categories')" aria-label="@lang('main.search_categories')" />
            </label>
        </div>

        <div class="mx-6 my-5 h-px bg-white/10"></div>

        <div class="mb-2 flex items-center justify-between px-6">
            <h2 class="text-pine-muted text-sm font-semibold">@lang('main.categories')</h2>
            <button class="btn btn-ghost btn-xs btn-circle text-pine-text hover:bg-white/10"
                aria-label="@lang('main.add_category')" title="@lang('main.add_category')" onclick="category_modal.showModal()">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>

        <!-- ========================= CATEGORY LIST (real markup, one <li> per category) ========================= -->
        <ul id="cat-list" class="flex-1 space-y-1 overflow-y-auto pr-4">
            <li data-cat-row="all">
                <button data-cat="all" aria-current="true"
                    class="cat-btn border-marigold flex w-full items-center gap-3 rounded-r-xl border-l-4 bg-white/10 py-2.5 pl-5 pr-3 text-left font-medium text-white"
                    onclick="selectCategory('all')">
                    <i class="fa-solid fa-layer-group text-pine-muted w-2.5 text-center"></i>
                    <span class="flex-1 truncate">@lang('main.all')</span>
                    <span data-count="all" class="text-pine-muted text-xs tabular-nums">3</span>
                </button>
            </li>

            <li data-cat-row="work" data-cat-name="work">
                <div class="group relative">
                    <button data-cat="work"
                        class="cat-btn flex w-full items-center gap-3 rounded-r-xl border-l-4 border-transparent py-2.5 pl-5 pr-3 text-left transition-colors hover:bg-white/5"
                        onclick="selectCategory('work')">
                        <span class="size-2.5 shrink-0 rounded-full" style="background:#3e8ede"></span>
                        <span class="flex-1 truncate">@lang('main.work')</span>
                        <span data-count="work"
                            class="text-pine-muted text-xs tabular-nums transition-opacity group-hover:opacity-0">1</span>
                    </button>
                    <div
                        class="absolute right-2 top-1/2 flex -translate-y-1/2 gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                        <button class="btn btn-ghost btn-xs btn-circle text-pine-text hover:bg-white/10"
                            aria-label="@lang('main.rename_work')" onclick="editCategory('work', 'Work', '#3e8ede')"><i
                                class="fa-solid fa-pen"></i></button>
                        <button
                            class="btn btn-ghost btn-xs btn-circle text-pine-text hover:bg-error/40 hover:text-white"
                            aria-label="@lang('main.delete_work')" onclick="confirmDeleteCategory('work', 'Work')"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            </li>

            <li data-cat-row="personal" data-cat-name="personal">
                <div class="group relative">
                    <button data-cat="personal"
                        class="cat-btn flex w-full items-center gap-3 rounded-r-xl border-l-4 border-transparent py-2.5 pl-5 pr-3 text-left transition-colors hover:bg-white/5"
                        onclick="selectCategory('personal')">
                        <span class="size-2.5 shrink-0 rounded-full" style="background:#e5677d"></span>
                        <span class="flex-1 truncate">@lang('main.personal')</span>
                        <span data-count="personal"
                            class="text-pine-muted text-xs tabular-nums transition-opacity group-hover:opacity-0">1</span>
                    </button>
                    <div
                        class="absolute right-2 top-1/2 flex -translate-y-1/2 gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                        <button class="btn btn-ghost btn-xs btn-circle text-pine-text hover:bg-white/10"
                            aria-label="@lang('main.rename_personal')" onclick="editCategory('personal', 'Personal', '#e5677d')"><i
                                class="fa-solid fa-pen"></i></button>
                        <button
                            class="btn btn-ghost btn-xs btn-circle text-pine-text hover:bg-error/40 hover:text-white"
                            aria-label="@lang('main.delete_personal')" onclick="confirmDeleteCategory('personal', 'Personal')"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            </li>

            <li data-cat-row="learning" data-cat-name="learning">
                <div class="group relative">
                    <button data-cat="learning"
                        class="cat-btn flex w-full items-center gap-3 rounded-r-xl border-l-4 border-transparent py-2.5 pl-5 pr-3 text-left transition-colors hover:bg-white/5"
                        onclick="selectCategory('learning')">
                        <span class="size-2.5 shrink-0 rounded-full" style="background:#7c6bd6"></span>
                        <span class="flex-1 truncate">@lang('main.learning')</span>
                        <span data-count="learning"
                            class="text-pine-muted text-xs tabular-nums transition-opacity group-hover:opacity-0">1</span>
                    </button>
                    <div
                        class="absolute right-2 top-1/2 flex -translate-y-1/2 gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                        <button class="btn btn-ghost btn-xs btn-circle text-pine-text hover:bg-white/10"
                            aria-label="@lang('main.rename_learning')" onclick="editCategory('learning', 'Learning', '#7c6bd6')"><i
                                class="fa-solid fa-pen"></i></button>
                        <button
                            class="btn btn-ghost btn-xs btn-circle text-pine-text hover:bg-error/40 hover:text-white"
                            aria-label="@lang('main.delete_learning')" onclick="confirmDeleteCategory('learning', 'Learning')"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
            </li>
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
