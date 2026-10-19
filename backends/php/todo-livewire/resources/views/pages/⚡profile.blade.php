<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component {
    public function render()
    {
        return $this->view()->title(trans('main.todos'));
    }
};
?>

<div>
    <div class="mx-auto max-w-2xl">
        <h1 class="font-display flex items-center gap-3 text-4xl font-semibold tracking-tight">@lang('main.all_todos')</h1>
        <div class="mt-3 flex items-center gap-4">
            <div class="bg-base-300 h-2.5 flex-1 overflow-hidden rounded-full" role="progressbar" id="progress-track"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" aria-label="@lang('main.completed')">
                <div id="progress-bar" class="bg-primary h-full rounded-full transition-all duration-500"
                    style="width: 25%"></div>
            </div>
            <p class="text-base-content/60 shrink-0 text-sm"><span id="progress-done"
                    class="text-base-content font-semibold">1</span> @lang('main.of') <span id="progress-total">4</span> @lang('main.done')</p>
        </div>

        <form id="add-form"
            class="border-base-300 bg-base-100 focus-within:ring-primary/30 mt-6 flex flex-col gap-2 rounded-2xl border p-2 shadow-sm focus-within:ring-2 sm:flex-row sm:items-center"
            onsubmit="return submitAddTodo(event)">
            <div class="flex grow items-center gap-3 pl-3">
                <i class="fa-regular fa-circle text-base-content/35 shrink-0" aria-hidden="true"></i>
                <input name="text"
                    class="placeholder:text-base-content/40 w-full bg-transparent py-2 text-lg outline-none"
                    maxlength="120" required autocomplete="off" placeholder="@lang('main.add_todo')" aria-label="@lang('main.add_todo')" />
            </div>
            <select name="categoryId" id="add-category-select" class="select select-sm w-full rounded-full sm:w-40"
                aria-label="@lang('main.category')">
                <option value="">@lang('main.uncategorized')</option>
                <option value="work">@lang('main.work')</option>
                <option value="personal">@lang('main.personal')</option>
                <option value="learning">@lang('main.learning')</option>
            </select>
            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i>@lang('main.add')</button>
        </form>

        <div class="mt-6 flex flex-wrap items-center justify-between gap-3">
            <div class="border-base-300 bg-base-100 inline-flex rounded-full border p-1" role="group"
                aria-label="@lang('main.filter_todos')">
                <button data-filter="all" aria-pressed="true"
                    class="filter-btn bg-neutral text-neutral-content rounded-full px-4 py-1.5 text-sm font-medium"
                    onclick="setFilter('all')">@lang('main.all') <span class="text-neutral-content/70"
                        id="count-all">4</span></button>
                <button data-filter="active" aria-pressed="false"
                    class="filter-btn text-base-content/65 hover:text-base-content rounded-full px-4 py-1.5 text-sm font-medium transition-colors"
                    onclick="setFilter('active')">@lang('main.active') <span class="text-base-content/45"
                        id="count-active">3</span></button>
                <button data-filter="done" aria-pressed="false"
                    class="filter-btn text-base-content/65 hover:text-base-content rounded-full px-4 py-1.5 text-sm font-medium transition-colors"
                    onclick="setFilter('done')">@lang('main.done') <span class="text-base-content/45"
                        id="count-done">1</span></button>
            </div>
            <button id="clear-done-btn" class="btn btn-ghost btn-sm text-base-content/70"
                onclick="confirmClearCompleted()"><i class="fa-solid fa-broom"></i>@lang('main.clear_completed')</button>
        </div>

        <!-- ========================= TODO LIST (real markup, one <li> per todo) ========================= -->
        <ul id="list" class="mt-4 space-y-3">
            <li id="todo-t1"
                class="todo-item border-base-300 bg-base-100 group flex flex-wrap items-center gap-3 rounded-2xl border border-l-[5px] py-3 pl-4 pr-3 shadow-sm"
                style="border-left-color:#3e8ede" data-category="work" data-done="false"
                data-text="Review pull requests">
                <input type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-full"
                    aria-label="Mark &quot;Review pull requests&quot; as done" onchange="toggleTodo('t1')" />
                <span class="todo-text min-w-0 flex-1 break-words text-lg" ondblclick="editTodo('t1')"
                    title="@lang('main.double_click_to_edit')">Review pull requests</span>
                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium"
                    style="background:color-mix(in oklab, #3e8ede 16%, white); color:color-mix(in oklab, #3e8ede 62%, black)">
                    <span class="size-2 rounded-full" style="background:#3e8ede"></span>@lang('main.work')
                </span>
                <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                    <button class="btn btn-ghost btn-sm btn-circle" aria-label="@lang('main.edit_todo')" onclick="editTodo('t1')"><i
                            class="fa-solid fa-pen"></i></button>
                    <button class="btn btn-ghost btn-sm btn-circle text-error" aria-label="@lang('main.delete_todo')"
                        onclick="confirmDeleteTodo('t1', 'Review pull requests')"><i
                            class="fa-solid fa-trash"></i></button>
                </div>
            </li>

            <li id="todo-t2"
                class="todo-item border-base-300 bg-base-100 group flex flex-wrap items-center gap-3 rounded-2xl border border-l-[5px] py-3 pl-4 pr-3 shadow-sm"
                style="border-left-color:#3e8ede" data-category="work" data-done="true"
                data-text="Write the release notes">
                <input type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-full" checked
                    aria-label="Mark &quot;Write the release notes&quot; as not done" onchange="toggleTodo('t2')" />
                <span class="todo-text text-base-content/40 min-w-0 flex-1 break-words text-lg line-through"
                    ondblclick="editTodo('t2')" title="@lang('main.double_click_to_edit')">Write the release notes</span>
                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium"
                    style="background:color-mix(in oklab, #3e8ede 16%, white); color:color-mix(in oklab, #3e8ede 62%, black)">
                    <span class="size-2 rounded-full" style="background:#3e8ede"></span>@lang('main.work')
                </span>
                <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                    <button class="btn btn-ghost btn-sm btn-circle" aria-label="@lang('main.edit_todo')"
                        onclick="editTodo('t2')"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn btn-ghost btn-sm btn-circle text-error" aria-label="@lang('main.delete_todo')"
                        onclick="confirmDeleteTodo('t2', 'Write the release notes')"><i
                            class="fa-solid fa-trash"></i></button>
                </div>
            </li>

            <li id="todo-t3"
                class="todo-item border-base-300 bg-base-100 group flex flex-wrap items-center gap-3 rounded-2xl border border-l-[5px] py-3 pl-4 pr-3 shadow-sm"
                style="border-left-color:#e5677d" data-category="personal" data-done="false"
                data-text="Buy groceries">
                <input type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-full"
                    aria-label="Mark &quot;Buy groceries&quot; as done" onchange="toggleTodo('t3')" />
                <span class="todo-text min-w-0 flex-1 break-words text-lg" ondblclick="editTodo('t3')"
                    title="@lang('main.double_click_to_edit')">Buy groceries</span>
                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium"
                    style="background:color-mix(in oklab, #e5677d 16%, white); color:color-mix(in oklab, #e5677d 62%, black)">
                    <span class="size-2 rounded-full" style="background:#e5677d"></span>@lang('main.personal')
                </span>
                <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                    <button class="btn btn-ghost btn-sm btn-circle" aria-label="@lang('main.edit_todo')"
                        onclick="editTodo('t3')"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn btn-ghost btn-sm btn-circle text-error" aria-label="@lang('main.delete_todo')"
                        onclick="confirmDeleteTodo('t3', 'Buy groceries')"><i class="fa-solid fa-trash"></i></button>
                </div>
            </li>

            <li id="todo-t4"
                class="todo-item border-base-300 bg-base-100 group flex flex-wrap items-center gap-3 rounded-2xl border border-l-[5px] py-3 pl-4 pr-3 shadow-sm"
                style="border-left-color:#7c6bd6" data-category="learning" data-done="false"
                data-text="Read the daisyUI docs for the modal component">
                <input type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-full"
                    aria-label="Mark &quot;Read the daisyUI docs for the modal component&quot; as done"
                    onchange="toggleTodo('t4')" />
                <span class="todo-text min-w-0 flex-1 break-words text-lg" ondblclick="editTodo('t4')"
                    title="@lang('main.double_click_to_edit')">Read the daisyUI docs for the modal component</span>
                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium"
                    style="background:color-mix(in oklab, #7c6bd6 16%, white); color:color-mix(in oklab, #7c6bd6 62%, black)">
                    <span class="size-2 rounded-full" style="background:#7c6bd6"></span>@lang('main.learning')
                </span>
                <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                    <button class="btn btn-ghost btn-sm btn-circle" aria-label="@lang('main.edit_todo')"
                        onclick="editTodo('t4')"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn btn-ghost btn-sm btn-circle text-error" aria-label="@lang('main.delete_todo')"
                        onclick="confirmDeleteTodo('t4', 'Read the daisyUI docs for the modal component')"><i
                            class="fa-solid fa-trash"></i></button>
                </div>
            </li>
        </ul>

        <div id="list-empty"
            class="border-base-300 bg-base-100/60 hidden rounded-3xl border-2 border-dashed px-6 py-14 text-center">
            <span class="bg-primary/10 text-primary mx-auto grid size-14 place-items-center rounded-2xl text-xl"><i
                    id="list-empty-icon" class="fa-solid fa-clipboard-check"></i></span>
            <h3 id="list-empty-title" class="font-display mt-4 text-xl font-semibold">@lang('main.no_todos_yet')</h3>
            <p id="list-empty-text" class="text-base-content/60 mt-1">@lang('main.add_first_todo')</p>
        </div>
    </div>


    <!-- Edit todo -->
    <dialog id="todo_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md rounded-2xl p-0">
            <form id="todo-form" class="p-6" onsubmit="return submitTodoEdit(event)">
                <h3 class="font-display text-xl font-semibold">@lang('main.edit_todo')</h3>
                <input type="hidden" name="todoId" value="" />
                <label class="mt-5 block">
                    <span class="mb-1.5 block text-sm font-medium">@lang('main.text')</span>
                    <input name="text" class="input w-full" maxlength="120" required />
                </label>
                <label class="mt-4 block">
                    <span class="mb-1.5 block text-sm font-medium">@lang('main.category')</span>
                    <select name="categoryId" class="select w-full">
                        <option value="">@lang('main.uncategorized')</option>
                        <option value="work">@lang('main.work')</option>
                        <option value="personal">@lang('main.personal')</option>
                        <option value="learning">@lang('main.learning')</option>
                    </select>
                </label>
                <div class="mt-7 flex justify-end gap-2">
                    <button type="button" class="btn btn-ghost" onclick="todo_modal.close()">@lang('main.cancel')</button>
                    <button class="btn btn-primary"><i class="fa-solid fa-check"></i>@lang('main.save')</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button aria-label="@lang('main.close')">@lang('main.close')</button></form>
    </dialog>

    <!-- New / edit category -->
    <dialog id="category_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md rounded-2xl p-0">
            <form id="category-form" class="p-6" onsubmit="return submitCategory(event)">
                <h3 id="category-modal-title" class="font-display text-xl font-semibold">@lang('main.new_category')</h3>

                <input type="hidden" name="categoryId" value="" />

                <label class="mt-5 block">
                    <span class="mb-1.5 block text-sm font-medium">@lang('main.name')</span>
                    <input name="name" class="input w-full" maxlength="24" required placeholder="@lang('main.category_name_placeholder')" />
                </label>

                <fieldset class="mt-5">
                    <legend class="mb-2 text-sm font-medium">@lang('main.color')</legend>
                    <div class="flex flex-wrap gap-3">
                        <label class="group cursor-pointer">
                            <input type="radio" name="color" value="#2f9e8f" class="peer sr-only" checked />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#2f9e8f"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                        <label class="group cursor-pointer">
                            <input type="radio" name="color" value="#3e8ede" class="peer sr-only" />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#3e8ede"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                        <label class="group cursor-pointer">
                            <input type="radio" name="color" value="#7c6bd6" class="peer sr-only" />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#7c6bd6"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                        <label class="group cursor-pointer">
                            <input type="radio" name="color" value="#e5677d" class="peer sr-only" />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#e5677d"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                        <label class="group cursor-pointer">
                            <input type="radio" name="color" value="#e9a23b" class="peer sr-only" />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#e9a23b"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                        <label class="group cursor-pointer">
                            <input type="radio" name="color" value="#8baa3d" class="peer sr-only" />
                            <span
                                class="peer-checked:ring-base-content grid size-9 place-items-center rounded-full ring-offset-2 transition peer-checked:ring-2"
                                style="background:#8baa3d"><i
                                    class="fa-solid fa-check text-sm text-white opacity-0 group-has-[:checked]:opacity-100"></i></span>
                        </label>
                    </div>
                </fieldset>

                <div class="mt-7 flex justify-end gap-2">
                    <button type="button" class="btn btn-ghost" onclick="category_modal.close()">@lang('main.cancel')</button>
                    <button id="category-submit-btn" class="btn btn-primary"><i class="fa-solid fa-check"></i>@lang('main.add_category')</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button aria-label="@lang('main.close')">@lang('main.close')</button></form>
    </dialog>

    <!-- Confirm delete -->
    <dialog id="confirm_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md rounded-2xl p-0">
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <span
                        class="bg-error/10 text-error flex size-11 shrink-0 items-center justify-center rounded-full"><i
                            class="fa-solid fa-triangle-exclamation"></i></span>
                    <div>
                        <h3 id="confirm-title" class="font-display text-xl font-semibold">@lang('main.delete_confirm_title')</h3>
                        <p id="confirm-message" class="text-base-content/70 mt-1">@lang('main.delete_confirm_message')</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" class="btn btn-ghost" onclick="confirm_modal.close()">@lang('main.cancel')</button>
                    <button id="confirm-btn" class="btn btn-error" onclick="runPendingDelete()"><i
                            class="fa-solid fa-trash"></i>@lang('main.delete')</button>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop"><button aria-label="@lang('main.close')">@lang('main.close')</button></form>
    </dialog>

</div>
