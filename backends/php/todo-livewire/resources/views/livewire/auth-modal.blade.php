<div>

    @guest
        <!-- Welcome / name prompt -->
        <dialog wire:ignore.self id="welcome_modal" class="modal">
            <div class="modal-box max-w-sm rounded-2xl p-0">
                <form class="p-8 text-center" wire:submit="process" method="post">
                    <span class="bg-marigold text-pine-950 mx-auto grid size-14 place-items-center rounded-2xl text-2xl"><i
                            class="fa-solid fa-book-open"></i></span>
                    <h3 class="font-display mt-5 text-2xl font-semibold">@lang('main.welcome_to_daybook')</h3>
                    <p class="text-base-content/70 mt-2">@lang('main.welcome_subtitle')</p>

                    <input wire:model="name" class="input @error('name') input-error @enderror mt-6 w-full text-center"
                        maxlength="24" required placeholder="@lang('main.your_name')" aria-label="@lang('main.your_name')" />

                    @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror


                    <div wire:show="showPass" wire:transition>
                        <input wire:model="password" type="password"
                            class="input @error('password') input-error @enderror mt-6 w-full text-center" maxlength="24"
                            @if ($showPass) required autofocus @endif placeholder="@lang('main.your_password')"
                            aria-label="@lang('main.your_password')" />

                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                    <button type="submit" class="btn btn-primary mt-4 w-full">
                        <span wire:loading.remove>
                            @lang('main.get_started')
                        </span>
                        <span wire:loading>
                            <span class="loading loading-spinner loading-md"></span> </span>
                    </button>
                </form>
            </div>
        </dialog>
    @endguest
</div>
