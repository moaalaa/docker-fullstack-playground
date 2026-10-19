<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component {
    public function render()
    {
        return $this->view()->title(trans('main.home'));
    }
};
?>

<div class="mx-auto max-w-2xl">
    <h1 class="font-display text-4xl font-semibold tracking-tight">@lang('main.todos')</h1>
    <div class="mt-3 flex items-center gap-4">
        <div class="bg-base-300 h-2.5 flex-1 overflow-hidden rounded-full" role="progressbar" id="progress-track"
            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" aria-label="Completed">
            <div id="progress-bar" class="bg-primary h-full rounded-full transition-all duration-500"
                style="width: 25%"></div>
        </div>
        <p class="text-base-content/60 shrink-0 text-sm"><span id="progress-done"
                class="text-base-content font-semibold">1</span> of <span id="progress-total">4</span> done
        </p>
    </div>

    <!-- Search box lives on the page, not in the header -->
    <label class="input mt-6 w-full rounded-full">
        <i class="fa-solid fa-magnifying-glass text-base-content/40"></i>
        <input id="search" type="search" placeholder="Search todos" aria-label="Search todos" />
    </label>

    <form id="add-form"
        class="border-base-300 bg-base-100 focus-within:ring-primary/30 mt-4 flex flex-col gap-2 rounded-2xl border p-2 shadow-sm focus-within:ring-2 sm:flex-row sm:items-center"
        onsubmit="return submitAddTodo(event)">
        <div class="flex grow items-center gap-3 pl-3">
            <i class="fa-regular fa-circle text-base-content/35 shrink-0" aria-hidden="true"></i>
            <input name="text"
                class="placeholder:text-base-content/40 w-full bg-transparent py-2 text-lg outline-none" maxlength="120"
                required autocomplete="off" placeholder="Add a todo" aria-label="Add a todo" />
        </div>
        <button class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add</button>
    </form>

    <div class="mt-6 flex flex-wrap items-center justify-between gap-3">
        <div class="border-base-300 bg-base-100 inline-flex rounded-full border p-1" role="group"
            aria-label="Filter todos">
            <button data-filter="all" aria-pressed="true"
                class="filter-btn bg-neutral text-neutral-content rounded-full px-4 py-1.5 text-sm font-medium"
                onclick="setFilter('all')">All <span class="text-neutral-content/70" id="count-all">4</span></button>
            <button data-filter="active" aria-pressed="false"
                class="filter-btn text-base-content/65 hover:text-base-content rounded-full px-4 py-1.5 text-sm font-medium transition-colors"
                onclick="setFilter('active')">Active <span class="text-base-content/45"
                    id="count-active">3</span></button>
            <button data-filter="done" aria-pressed="false"
                class="filter-btn text-base-content/65 hover:text-base-content rounded-full px-4 py-1.5 text-sm font-medium transition-colors"
                onclick="setFilter('done')">Done <span class="text-base-content/45" id="count-done">1</span></button>
        </div>
        <button id="clear-done-btn" class="btn btn-ghost btn-sm text-base-content/70"
            onclick="confirmClearCompleted()"><i class="fa-solid fa-broom"></i>Clear completed</button>
    </div>

    <!-- ========================= TODO LIST (real markup, one <li> per todo) ========================= -->
    <ul id="list" class="mt-4 space-y-3">
        <li id="todo-t1"
            class="todo-item border-base-300 bg-base-100 group flex flex-wrap items-center gap-3 rounded-2xl border py-3 pl-4 pr-3 shadow-sm"
            data-done="false" data-text="Review pull requests">
            <input type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-full"
                aria-label="Mark &quot;Review pull requests&quot; as done" onchange="toggleTodo('t1')" />
            <span class="todo-text min-w-0 flex-1 break-words text-lg" ondblclick="editTodo('t1')"
                title="Double-click to edit">Review pull requests</span>
            <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                <button class="btn btn-ghost btn-sm btn-circle" aria-label="Edit todo" onclick="editTodo('t1')"><i
                        class="fa-solid fa-pen"></i></button>
                <button class="btn btn-ghost btn-sm btn-circle text-error" aria-label="Delete todo"
                    onclick="confirmDeleteTodo('t1', 'Review pull requests')"><i class="fa-solid fa-trash"></i></button>
            </div>
        </li>

        <li id="todo-t2"
            class="todo-item border-base-300 bg-base-100 group flex flex-wrap items-center gap-3 rounded-2xl border py-3 pl-4 pr-3 shadow-sm"
            data-done="true" data-text="Write the release notes">
            <input type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-full" checked
                aria-label="Mark &quot;Write the release notes&quot; as not done" onchange="toggleTodo('t2')" />
            <span class="todo-text text-base-content/40 min-w-0 flex-1 break-words text-lg line-through"
                ondblclick="editTodo('t2')" title="Double-click to edit">Write the release notes</span>
            <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                <button class="btn btn-ghost btn-sm btn-circle" aria-label="Edit todo" onclick="editTodo('t2')"><i
                        class="fa-solid fa-pen"></i></button>
                <button class="btn btn-ghost btn-sm btn-circle text-error" aria-label="Delete todo"
                    onclick="confirmDeleteTodo('t2', 'Write the release notes')"><i
                        class="fa-solid fa-trash"></i></button>
            </div>
        </li>

        <li id="todo-t3"
            class="todo-item border-base-300 bg-base-100 group flex flex-wrap items-center gap-3 rounded-2xl border py-3 pl-4 pr-3 shadow-sm"
            data-done="false" data-text="Buy groceries">
            <input type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-full"
                aria-label="Mark &quot;Buy groceries&quot; as done" onchange="toggleTodo('t3')" />
            <span class="todo-text min-w-0 flex-1 break-words text-lg" ondblclick="editTodo('t3')"
                title="Double-click to edit">Buy groceries</span>
            <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                <button class="btn btn-ghost btn-sm btn-circle" aria-label="Edit todo" onclick="editTodo('t3')"><i
                        class="fa-solid fa-pen"></i></button>
                <button class="btn btn-ghost btn-sm btn-circle text-error" aria-label="Delete todo"
                    onclick="confirmDeleteTodo('t3', 'Buy groceries')"><i class="fa-solid fa-trash"></i></button>
            </div>
        </li>

        <li id="todo-t4"
            class="todo-item border-base-300 bg-base-100 group flex flex-wrap items-center gap-3 rounded-2xl border py-3 pl-4 pr-3 shadow-sm"
            data-done="false" data-text="Read the daisyUI docs for the modal component">
            <input type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-full"
                aria-label="Mark &quot;Read the daisyUI docs for the modal component&quot; as done"
                onchange="toggleTodo('t4')" />
            <span class="todo-text min-w-0 flex-1 break-words text-lg" ondblclick="editTodo('t4')"
                title="Double-click to edit">Read the daisyUI docs for the modal component</span>
            <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                <button class="btn btn-ghost btn-sm btn-circle" aria-label="Edit todo" onclick="editTodo('t4')"><i
                        class="fa-solid fa-pen"></i></button>
                <button class="btn btn-ghost btn-sm btn-circle text-error" aria-label="Delete todo"
                    onclick="confirmDeleteTodo('t4', 'Read the daisyUI docs for the modal component')"><i
                        class="fa-solid fa-trash"></i></button>
            </div>
        </li>
    </ul>

    <div id="list-empty"
        class="border-base-300 bg-base-100/60 hidden rounded-3xl border-2 border-dashed px-6 py-14 text-center">
        <span class="bg-primary/10 text-primary mx-auto grid size-14 place-items-center rounded-2xl text-xl"><i
                id="list-empty-icon" class="fa-solid fa-clipboard-check"></i></span>
        <h3 id="list-empty-title" class="font-display mt-4 text-xl font-semibold">No todos yet</h3>
        <p id="list-empty-text" class="text-base-content/60 mt-1">Add your first one above.</p>
    </div>
</div>
