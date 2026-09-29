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

<div>
    <div class="mx-auto max-w-2xl">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="font-display flex items-center gap-3 text-4xl font-semibold tracking-tight">@lang('main.all_posts')</h1>
                <p id="feed-count" class="text-base-content/60 mt-1">3 @lang('main.posts')</p>
            </div>
            <button class="btn btn-primary" onclick="post_modal.showModal()"><i class="fa-solid fa-plus"></i>@lang('main.new_post')</button>
        </div>

        <!-- ========================= POST FEED (real markup, one <article> per post) ========================= -->
        <div id="feed" class="mt-8 space-y-8">

            <!-- ---------- Post 1 ---------- -->
            <article id="post-p1" class="border-base-300 bg-base-100 overflow-hidden rounded-3xl border shadow-sm"
                data-category="work" data-title="Shipped the first version of the dashboard"
                data-body="Two weeks of small steps and it finally feels solid. The biggest lesson: ship the boring version first, then polish it.">
                <div class="relative aspect-[16/7] overflow-hidden"
                    style="background:linear-gradient(135deg, #3e8ede, color-mix(in oklab, #3e8ede 50%, black))">
                    <div class="cover-pattern absolute inset-0"></div>
                    <i
                        class="fa-solid fa-feather-pointed absolute -bottom-8 right-6 -rotate-12 text-[9rem] text-white/15"></i>

                    <div class="absolute left-4 top-4 rounded-full bg-white shadow-sm">
                        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium"
                            style="background:color-mix(in oklab, #3e8ede 16%, white); color:color-mix(in oklab, #3e8ede 62%, black)">
                            <span class="size-2 rounded-full" style="background:#3e8ede"></span>@lang('main.work')
                        </span>
                    </div>
                    <div class="absolute right-4 top-4 flex gap-2">
                        <button
                            class="btn btn-circle btn-sm text-base-content border-0 bg-white/90 shadow-sm hover:bg-white"
                            aria-label="@lang('main.edit_post')" onclick="editPost('p1')"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-circle btn-sm text-error border-0 bg-white/90 shadow-sm hover:bg-white"
                            aria-label="@lang('main.delete_post')"
                            onclick="confirmDeletePost('p1', 'Shipped the first version of the dashboard')"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                </div>

                <div class="px-6 pb-5 pt-6">
                    <h2 class="font-display text-2xl font-semibold leading-tight">Shipped the first version of the
                        dashboard
                    </h2>
                    <p class="text-base-content/75 mt-2 whitespace-pre-line leading-relaxed">Two weeks of small steps
                        and it
                        finally feels solid. The biggest lesson: ship the boring version first, then polish it.</p>

                    <div class="mt-6 flex items-center justify-between gap-3">
                        <div class="flex min-w-0 items-center gap-3">
                            <span
                                class="inline-flex size-9 shrink-0 items-center justify-center rounded-full text-sm font-semibold text-white"
                                style="background:#6f8f2a">D</span>
                            <div class="min-w-0 leading-tight">
                                <p class="truncate text-sm font-medium">@lang('main.app_name')</p>
                                <p class="text-base-content/55 text-xs">5h ago</p>
                            </div>
                        </div>
                        <button class="btn btn-neutral btn-sm rounded-full" onclick="toggleComments('p1')">
                            <i class="fa-regular fa-comment"></i>@lang('main.comments')
                            <span id="p1-comment-count"
                                class="badge badge-sm text-neutral-content border-0 bg-white/20">2</span>
                        </button>
                    </div>
                </div>

                <div id="p1-comments" class="comments">
                    <div inert>
                        <div class="border-base-300 bg-base-200/60 border-t px-6 py-5">
                            <ul id="p1-comment-list" class="mb-5 space-y-4">
                                <li class="group flex gap-3" data-comment-id="c1">
                                    <span
                                        class="inline-flex size-8 shrink-0 items-center justify-center rounded-full text-xs font-semibold text-white"
                                        style="background:#7c6bd6">M</span>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-baseline gap-2">
                                            <span class="text-sm font-semibold">Maya</span>
                                            <span class="text-base-content/55 text-xs">3h ago</span>
                                        </div>
                                        <p
                                            class="comment-text text-base-content/85 whitespace-pre-line break-words text-sm leading-relaxed">
                                            Congrats! The loading states look great.</p>
                                    </div>
                                    <div
                                        class="flex shrink-0 gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                                        <button class="btn btn-ghost btn-xs btn-circle" aria-label="@lang('main.edit_comment')"
                                            onclick="editComment('c1')"><i class="fa-solid fa-pen"></i></button>
                                        <button class="btn btn-ghost btn-xs btn-circle text-error"
                                            aria-label="@lang('main.delete_comment')" onclick="deleteComment('p1', 'c1')"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </div>
                                </li>
                                <li class="group flex gap-3" data-comment-id="c2">
                                    <span
                                        class="inline-flex size-8 shrink-0 items-center justify-center rounded-full text-xs font-semibold text-white"
                                        style="background:#e5677d">O</span>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-baseline gap-2">
                                            <span class="text-sm font-semibold">Omar</span>
                                            <span class="text-base-content/55 text-xs">45m ago</span>
                                        </div>
                                        <p
                                            class="comment-text text-base-content/85 whitespace-pre-line break-words text-sm leading-relaxed">
                                            Would love to hear how you handled caching.</p>
                                    </div>
                                    <div
                                        class="flex shrink-0 gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
                                        <button class="btn btn-ghost btn-xs btn-circle" aria-label="@lang('main.edit_comment')"
                                            onclick="editComment('c2')"><i class="fa-solid fa-pen"></i></button>
                                        <button class="btn btn-ghost btn-xs btn-circle text-error"
                                            aria-label="@lang('main.delete_comment')" onclick="deleteComment('p1', 'c2')"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </div>
                                </li>
                            </ul>
                            <form class="comment-form flex items-center gap-3" data-post-id="p1"
                                onsubmit="return submitComment(event, 'p1')">
                                <span
                                    class="current-user-avatar inline-flex size-9 shrink-0 items-center justify-center rounded-full text-sm font-semibold text-white">?</span>
                                <input name="text" class="input grow rounded-full" maxlength="500" required
                                    autocomplete="off" placeholder="@lang('main.write_comment')" aria-label="@lang('main.write_comment')" />
                                <button class="btn btn-primary btn-circle" aria-label="@lang('main.send_comment')"><i
                                        class="fa-solid fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>

            <!-- ---------- Post 2 ---------- -->
            <article id="post-p2" class="border-base-300 bg-base-100 overflow-hidden rounded-3xl border shadow-sm"
                data-category="learning" data-title="Learning Tailwind: what finally clicked"
                data-body="Stop reading the docs top to bottom. Build one small card, look up only the classes you need, and repeat. Utilities stick faster when you use them.">
                <div class="relative aspect-[16/7] overflow-hidden"
                    style="background:linear-gradient(135deg, #7c6bd6, color-mix(in oklab, #7c6bd6 50%, black))">
                    <div class="cover-pattern absolute inset-0"></div>
                    <i
                        class="fa-solid fa-feather-pointed absolute -bottom-8 right-6 -rotate-12 text-[9rem] text-white/15"></i>

                    <div class="absolute left-4 top-4 rounded-full bg-white shadow-sm">
                        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium"
                            style="background:color-mix(in oklab, #7c6bd6 16%, white); color:color-mix(in oklab, #7c6bd6 62%, black)">
                            <span class="size-2 rounded-full" style="background:#7c6bd6"></span>@lang('main.learning')
                        </span>
                    </div>
                    <div class="absolute right-4 top-4 flex gap-2">
                        <button
                            class="btn btn-circle btn-sm text-base-content border-0 bg-white/90 shadow-sm hover:bg-white"
                            aria-label="@lang('main.edit_post')" onclick="editPost('p2')"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-circle btn-sm text-error border-0 bg-white/90 shadow-sm hover:bg-white"
                            aria-label="@lang('main.delete_post')"
                            onclick="confirmDeletePost('p2', 'Learning Tailwind: what finally clicked')"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                </div>

                <div class="px-6 pb-5 pt-6">
                    <h2 class="font-display text-2xl font-semibold leading-tight">Learning Tailwind: what finally
                        clicked
                    </h2>
                    <p class="text-base-content/75 mt-2 whitespace-pre-line leading-relaxed">Stop reading the docs top
                        to
                        bottom. Build one small card, look up only the classes you need, and repeat. Utilities stick
                        faster
                        when you use them.</p>

                    <div class="mt-6 flex items-center justify-between gap-3">
                        <div class="flex min-w-0 items-center gap-3">
                            <span
                                class="inline-flex size-9 shrink-0 items-center justify-center rounded-full text-sm font-semibold text-white"
                                style="background:#6f8f2a">D</span>
                            <div class="min-w-0 leading-tight">
                                <p class="truncate text-sm font-medium">@lang('main.app_name')</p>
                                <p class="text-base-content/55 text-xs">1d ago</p>
                            </div>
                        </div>
                        <button class="btn btn-neutral btn-sm rounded-full" onclick="toggleComments('p2')">
                            <i class="fa-regular fa-comment"></i>@lang('main.comments')
                            <span id="p2-comment-count"
                                class="badge badge-sm text-neutral-content border-0 bg-white/20">0</span>
                        </button>
                    </div>
                </div>

                <div id="p2-comments" class="comments">
                    <div inert>
                        <div class="border-base-300 bg-base-200/60 border-t px-6 py-5">
                            <p id="p2-no-comments" class="text-base-content/60 mb-4 text-sm">@lang('main.no_comments_yet')</p>
                            <ul id="p2-comment-list" class="mb-5 hidden space-y-4"></ul>
                            <form class="comment-form flex items-center gap-3" data-post-id="p2"
                                onsubmit="return submitComment(event, 'p2')">
                                <span
                                    class="current-user-avatar inline-flex size-9 shrink-0 items-center justify-center rounded-full text-sm font-semibold text-white">?</span>
                                <input name="text" class="input grow rounded-full" maxlength="500" required
                                    autocomplete="off" placeholder="@lang('main.write_comment')" aria-label="@lang('main.write_comment')" />
                                <button class="btn btn-primary btn-circle" aria-label="@lang('main.send_comment')"><i
                                        class="fa-solid fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>

            <!-- ---------- Post 3 ---------- -->
            <article id="post-p3" class="border-base-300 bg-base-100 overflow-hidden rounded-3xl border shadow-sm"
                data-category="personal" data-title="Sunday reset"
                data-body="Groceries, laundry, a long walk. Planning the week on paper before opening any screens made Monday feel lighter.">
                <div class="relative aspect-[16/7] overflow-hidden"
                    style="background:linear-gradient(135deg, #e5677d, color-mix(in oklab, #e5677d 50%, black))">
                    <div class="cover-pattern absolute inset-0"></div>
                    <i
                        class="fa-solid fa-feather-pointed absolute -bottom-8 right-6 -rotate-12 text-[9rem] text-white/15"></i>

                    <div class="absolute left-4 top-4 rounded-full bg-white shadow-sm">
                        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium"
                            style="background:color-mix(in oklab, #e5677d 16%, white); color:color-mix(in oklab, #e5677d 62%, black)">
                            <span class="size-2 rounded-full" style="background:#e5677d"></span>@lang('main.personal')
                        </span>
                    </div>
                    <div class="absolute right-4 top-4 flex gap-2">
                        <button
                            class="btn btn-circle btn-sm text-base-content border-0 bg-white/90 shadow-sm hover:bg-white"
                            aria-label="@lang('main.edit_post')" onclick="editPost('p3')"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-circle btn-sm text-error border-0 bg-white/90 shadow-sm hover:bg-white"
                            aria-label="@lang('main.delete_post')" onclick="confirmDeletePost('p3', 'Sunday reset')"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                </div>

                <div class="px-6 pb-5 pt-6">
                    <h2 class="font-display text-2xl font-semibold leading-tight">Sunday reset</h2>
                    <p class="text-base-content/75 mt-2 whitespace-pre-line leading-relaxed">Groceries, laundry, a long
                        walk. Planning the week on paper before opening any screens made Monday feel lighter.</p>

                    <div class="mt-6 flex items-center justify-between gap-3">
                        <div class="flex min-w-0 items-center gap-3">
                            <span
                                class="inline-flex size-9 shrink-0 items-center justify-center rounded-full text-sm font-semibold text-white"
                                style="background:#6f8f2a">D</span>
                            <div class="min-w-0 leading-tight">
                                <p class="truncate text-sm font-medium">@lang('main.app_name')</p>
                                <p class="text-base-content/55 text-xs">2d ago</p>
                            </div>
                        </div>
                        <button class="btn btn-neutral btn-sm rounded-full" onclick="toggleComments('p3')">
                            <i class="fa-regular fa-comment"></i>@lang('main.comments')
                            <span id="p3-comment-count"
                                class="badge badge-sm text-neutral-content border-0 bg-white/20">0</span>
                        </button>
                    </div>
                </div>

                <div id="p3-comments" class="comments">
                    <div inert>
                        <div class="border-base-300 bg-base-200/60 border-t px-6 py-5">
                            <p id="p3-no-comments" class="text-base-content/60 mb-4 text-sm">@lang('main.no_comments_yet')</p>
                            <ul id="p3-comment-list" class="mb-5 hidden space-y-4"></ul>
                            <form class="comment-form flex items-center gap-3" data-post-id="p3"
                                onsubmit="return submitComment(event, 'p3')">
                                <span
                                    class="current-user-avatar inline-flex size-9 shrink-0 items-center justify-center rounded-full text-sm font-semibold text-white">?</span>
                                <input name="text" class="input grow rounded-full" maxlength="500" required
                                    autocomplete="off" placeholder="@lang('main.write_comment')" aria-label="@lang('main.write_comment')" />
                                <button class="btn btn-primary btn-circle" aria-label="@lang('main.send_comment')"><i
                                        class="fa-solid fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>

        </div>

        <!-- Empty state: hidden by default, shown by app.js only when a filter/search leaves nothing -->
        <div id="feed-empty"
            class="border-base-300 bg-base-100/60 hidden rounded-3xl border-2 border-dashed px-6 py-16 text-center">
            <span class="bg-primary/10 text-primary mx-auto grid size-14 place-items-center rounded-2xl text-xl"><i
                    id="feed-empty-icon" class="fa-solid fa-pen-nib"></i></span>
            <h3 id="feed-empty-title" class="font-display mt-4 text-xl font-semibold">@lang('main.no_posts_yet')</h3>
            <p id="feed-empty-text" class="text-base-content/60 mt-1">@lang('main.write_first_post')</p>
        </div>
    </div>


    <!-- New / edit post -->
    <dialog id="post_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-lg rounded-2xl p-0">
            <form id="post-form" class="p-6" onsubmit="return submitPost(event)">
                <div class="flex items-start justify-between">
                    <h3 id="post-modal-title" class="font-display text-2xl font-semibold">@lang('main.write_a_post')</h3>
                    <button type="button" class="btn btn-ghost btn-sm btn-circle -mr-2 -mt-1" aria-label="@lang('main.close')"
                        onclick="post_modal.close()"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <input type="hidden" name="postId" value="" />

                <label class="mt-5 block">
                    <span class="mb-1.5 block text-sm font-medium">@lang('main.title')</span>
                    <input name="title" class="input w-full" maxlength="90" required
                        placeholder="@lang('main.post_title_placeholder')" />
                </label>

                <label class="mt-4 block">
                    <span class="mb-1.5 block text-sm font-medium">@lang('main.story')</span>
                    <textarea name="body" class="textarea min-h-32 w-full" maxlength="1000" placeholder="@lang('main.story_placeholder')"></textarea>
                </label>

                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <label class="block">
                        <span class="mb-1.5 block text-sm font-medium">@lang('main.category')</span>
                        <select name="categoryId" class="select w-full">
                            <option value="">@lang('main.uncategorized')</option>
                            <option value="work">@lang('main.work')</option>
                            <option value="personal">@lang('main.personal')</option>
                            <option value="learning">@lang('main.learning')</option>
                        </select>
                    </label>
                    <label class="block">
                        <span class="mb-1.5 block text-sm font-medium">@lang('main.cover_color')</span>
                        <select name="color" class="select w-full">
                            <option value="#3e8ede">@lang('main.blue')</option>
                            <option value="#e5677d">@lang('main.rose')</option>
                            <option value="#7c6bd6">@lang('main.violet')</option>
                            <option value="#e9a23b">@lang('main.amber')</option>
                            <option value="#8baa3d">@lang('main.olive')</option>
                            <option value="#2f9e8f">@lang('main.teal')</option>
                        </select>
                    </label>
                </div>

                <div class="mt-7 flex justify-end gap-2">
                    <button type="button" class="btn btn-ghost" onclick="post_modal.close()">@lang('main.cancel')</button>
                    <button id="post-submit-btn" class="btn btn-primary"><i
                            class="fa-solid fa-paper-plane"></i>@lang('main.publish')</button>
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

    <!-- Edit comment -->
    <dialog id="comment_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-md rounded-2xl p-0">
            <form id="comment-form" class="p-6" onsubmit="return submitCommentEdit(event)">
                <h3 class="font-display text-xl font-semibold">@lang('main.edit_comment')</h3>
                <input type="hidden" name="commentId" value="" />
                <label class="mt-5 block">
                    <textarea name="text" class="textarea min-h-24 w-full" maxlength="500" required></textarea>
                </label>
                <div class="mt-7 flex justify-end gap-2">
                    <button type="button" class="btn btn-ghost" onclick="comment_modal.close()">@lang('main.cancel')</button>
                    <button class="btn btn-primary"><i class="fa-solid fa-check"></i>@lang('main.save')</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop"><button aria-label="@lang('main.close')">@lang('main.close')</button></form>
    </dialog>

    <!-- Confirm delete (post / category / comment / todo — reused via confirm-title/confirm-message/pendingDelete) -->
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
