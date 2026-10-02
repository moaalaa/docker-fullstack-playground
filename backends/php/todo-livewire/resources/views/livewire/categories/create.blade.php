<div class="mb-2 flex items-center justify-between px-6">
    <h2 class="text-pine-muted text-sm font-semibold">@lang('main.categories')</h2>
    <button class="btn btn-ghost btn-xs btn-circle text-pine-text hover:bg-white/10" aria-label="@lang('main.add_category')"
        title="@lang('main.add_category')" onclick="category_modal.showModal()">
        <i class="fa-solid fa-plus"></i>
    </button>

    <dialog wire:ignore.self id="category_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md rounded-2xl p-0">
            <form id="category-form" class="p-6" wire:submit="create">
                <h3 id="category-modal-title" class="font-display text-xl font-semibold">@lang('main.new_category')</h3>

                <label class="mt-5 block">
                    <span class="mb-1.5 block text-sm font-medium">@lang('main.name')</span>
                    <input wire:model="name" name="name" class="input @error('name') input-error @enderror w-full"
                        maxlength="24" required placeholder="@lang('main.category_name_placeholder')" />


                    @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                </label>

                <fieldset class="mt-5">
                    <legend class="mb-2 text-sm font-medium">@lang('main.color')</legend>
                    <div class="flex flex-wrap gap-3">
                        <label class="group cursor-pointer">
                            <input type="radio" wire:model="color" name="color" value="#2f9e8f" class="peer sr-only"
                                checked />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#2f9e8f"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                        <label class="group cursor-pointer">
                            <input type="radio" wire:model="color" name="color" value="#3e8ede"
                                class="peer sr-only" />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#3e8ede"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                        <label class="group cursor-pointer">
                            <input type="radio" wire:model="color" name="color" value="#7c6bd6"
                                class="peer sr-only" />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#7c6bd6"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                        <label class="group cursor-pointer">
                            <input type="radio" wire:model="color" name="color" value="#e5677d"
                                class="peer sr-only" />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#e5677d"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                        <label class="group cursor-pointer">
                            <input type="radio" wire:model="color" name="color" value="#e9a23b"
                                class="peer sr-only" />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#e9a23b"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                        <label class="group cursor-pointer">
                            <input type="radio" wire:model="color" name="color" value="#8baa3d"
                                class="peer sr-only" />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#8baa3d"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                    </div>
                    @error('color')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </fieldset>

                <div class="mt-7 flex justify-end gap-2">
                    <button type="button" class="btn btn-ghost" onclick="category_modal.close()">
                        @lang('main.cancel')
                    </button>
                    <button id="category-submit-btn" class="btn btn-primary">
                        <span wire:loading.remove>
                            <i class="fa-solid fa-check"></i>@lang('main.add_category')
                        </span>
                        <span wire:loading>
                            <span class="loading loading-spinner loading-md"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button aria-label="@lang('main.close')">@lang('main.close')</button>
        </form>
    </dialog>
</div>
