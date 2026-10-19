<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-base-200 text-base-content antialiased">


    <div class="flex min-h-dvh flex-col">
        <livewire:header />

        <!-- Page content -->
        <main class="flex-1 px-4 py-8 sm:px-8 sm:py-10">
            {{ $slot }}
        </main>
    </div>

    <livewire:auth-modal />
    <livewire:toast />
    @livewireScripts
</body>

{{-- <body class="bg-base-200 text-base-content antialiased"> --}}


<!-- ================================================================= -->
<!-- MODALS — real daisyUI <dialog class="modal"> elements -->
<!-- ================================================================= -->
{{-- 
    <!-- Edit todo -->
    <dialog id="todo_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md rounded-2xl p-0">
            <form id="todo-form" class="p-6" onsubmit="return submitTodoEdit(event)">
                <h3 class="font-display text-xl font-semibold">Edit todo</h3>
                <input type="hidden" name="todoId" value="" />
                <label class="mt-5 block">
                    <span class="mb-1.5 block text-sm font-medium">Text</span>
                    <input name="text" class="input w-full" maxlength="120" required />
                </label>
                <div class="mt-7 flex justify-end gap-2">
                    <button type="button" class="btn btn-ghost" onclick="todo_modal.close()">Cancel</button>
                    <button class="btn btn-primary"><i class="fa-solid fa-check"></i>Save</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button aria-label="Close">close</button></form>
    </dialog> --}}

{{-- <!-- Confirm delete -->
    <dialog id="confirm_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md rounded-2xl p-0">
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <span
                        class="bg-error/10 text-error flex size-11 shrink-0 items-center justify-center rounded-full"><i
                            class="fa-solid fa-triangle-exclamation"></i></span>
                    <div>
                        <h3 id="confirm-title" class="font-display text-xl font-semibold">Delete this?</h3>
                        <p id="confirm-message" class="text-base-content/70 mt-1">This can't be undone.</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" class="btn btn-ghost" onclick="confirm_modal.close()">Cancel</button>
                    <button id="confirm-btn" class="btn btn-error" onclick="runPendingDelete()"><i
                            class="fa-solid fa-trash"></i>Delete</button>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop"><button aria-label="Close">close</button></form>
    </dialog> --}}

{{-- </body> --}}

</html>
