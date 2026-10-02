

const STORAGE_KEY = "daybook:v2";


function readStorage() {
  try {
    return JSON.parse(localStorage.getItem(STORAGE_KEY));
  } catch {
    return null;
  }
}


// -----------------------------------------------------------------
// Confirm dialog (shared by post/category/comment/todo deletes)
// -----------------------------------------------------------------
function showConfirm({ title, message, confirmLabel, run }) {
  $("#confirm-title").textContent = title;
  $("#confirm-message").textContent = message;
  $("#confirm-btn").lastChild.textContent = confirmLabel;
  pendingDelete = run;
  confirm_modal.showModal();
}
window.runPendingDelete = function () {
  confirm_modal.close();
  if (pendingDelete) pendingDelete();
  pendingDelete = null;
};

// -----------------------------------------------------------------
// Welcome / user
// -----------------------------------------------------------------

function renderUser() {
  const avatar = $("#user-avatar");
  const nameEl = $("#user-name");
  if (!avatar || !currentUser) return;
  avatar.textContent = currentUser[0].toUpperCase();
  avatar.style.background = avatarColor(currentUser);
  nameEl.textContent = currentUser;
  $$(".current-user-avatar").forEach((el) => {
    el.textContent = currentUser[0].toUpperCase();
    el.style.background = avatarColor(currentUser);
  });
}

window.logout = function () {
  currentUser = null;
  saveToStorage();
  $("#user-avatar") && (($("#user-avatar").textContent = "?"), ($("#user-avatar").style.background = "#5b7a74"));
  $("#user-name") && ($("#user-name").textContent = "Guest");
  toast("You're logged out", { icon: "fa-hand" });
  welcome_modal.showModal();
};

// ===================================================================
// POSTS PAGE
// ===================================================================
function postsMatchingFilters() {
  return $$("#feed article").filter((article) => {
    const inCategory = activeCategory === "all" || article.dataset.category === activeCategory;
    const q = searchQuery;
    const inSearch = !q || article.dataset.title.toLowerCase().includes(q) || article.dataset.body.toLowerCase().includes(q);
    return inCategory && inSearch;
  });
}

function refreshFeed() {
  const all = $$("#feed article");
  const visible = postsMatchingFilters();
  all.forEach((a) => a.classList.toggle("hidden", !visible.includes(a)));

  const empty = $("#feed-empty");
  empty.classList.toggle("hidden", visible.length > 0);
  if (visible.length === 0) {
    $("#feed-empty-icon").className = `fa-solid ${searchQuery ? "fa-magnifying-glass" : "fa-pen-nib"}`;
    $("#feed-empty-title").textContent = searchQuery ? "Nothing matches your search" : "No posts here yet";
    $("#feed-empty-text").textContent = searchQuery ? "Try a different word." : "Write the first one for this category.";
  }

  const count = visible.length;
  $("#feed-count").textContent = `${count} ${count === 1 ? "post" : "posts"}${searchQuery ? ` matching "${searchQuery}"` : ""}`;
  refreshCategoryCounts();
}

window.editPost = function (id) {
  const article = $(`#post-${id}`);
  const form = post_modal.querySelector("form");
  form.postId.value = id;
  form.title.value = article.dataset.title;
  form.body.value = article.dataset.body;
  form.categoryId.value = article.dataset.category || "";
  form.color.value = article.dataset.color || "#3e8ede";
  $("#post-modal-title").textContent = "Edit post";
  $("#post-submit-btn").lastChild.textContent = "Save changes";
  post_modal.showModal();
};

window.submitPost = function (event) {
  event.preventDefault();
  const form = event.target;
  const title = form.title.value.trim();
  if (!title) return false;

  const id = form.postId.value;
  const data = {
    title,
    body: form.body.value.trim(),
    category: form.categoryId.value,
    color: form.color.value,
    author: currentUser ?? "Guest",
    time: "just now",
  };

  if (id) {
    updatePostArticle(id, data);
    toast("Post updated");
  } else {
    const newId = `p${nextId++}`;
    data.comments = [];
    const article = insertPostArticle({ id: newId, ...data });
    $("#feed").prepend(article);
    toast("Post published");
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  form.reset();
  form.postId.value = "";
  $("#post-modal-title").textContent = "Write a post";
  $("#post-submit-btn").lastChild.textContent = "Publish";

  refreshFeed();
  saveToStorage();
  post_modal.close();
  return false;
};

window.confirmDeletePost = function (id, title) {
  const article = $(`#post-${id}`);
  const commentCount = $$(`#${id}-comment-list li`).length;
  showConfirm({
    title: "Delete this post?",
    message: `"${title}" and its ${commentCount} comment${commentCount === 1 ? "" : "s"} will be gone for good.`,
    confirmLabel: "Delete post",
    run: () => {
      article.remove();
      refreshFeed();
      saveToStorage();
      toast("Post deleted");
    },
  });
};

function updatePostArticle(id, data) {
  const article = $(`#post-${id}`);
  article.dataset.title = data.title;
  article.dataset.body = data.body;
  article.dataset.category = data.category;
  article.dataset.color = data.color;

  article.querySelector("h2").textContent = data.title;
  article.querySelector("h2 + p").textContent = data.body;

  const cover = article.querySelector(".relative.aspect-\\[16\\/7\\]");
  cover.style.background = `linear-gradient(135deg, ${data.color}, color-mix(in oklab, ${data.color} 50%, black))`;

  const chip = article.querySelector(".absolute.left-4 span");
  chip.style.background = `color-mix(in oklab, ${data.color} 16%, white)`;
  chip.style.color = `color-mix(in oklab, ${data.color} 62%, black)`;
  chip.querySelector("span").style.background = data.color;
  chip.lastChild.textContent = categoryLabel(data.category);
}

/** Builds one <article> from data and returns it (used both for new posts and for loading from storage). */
function insertPostArticle(p) {
  const color = p.color || categoryColor(p.category) || "#5b7a74";
  const article = document.createElement("article");
  article.id = `post-${p.id}`;
  article.className = "overflow-hidden rounded-3xl border border-base-300 bg-base-100 shadow-sm";
  article.dataset.category = p.category || "";
  article.dataset.title = p.title;
  article.dataset.body = p.body;
  article.dataset.color = p.color || "";

  article.innerHTML = `
    <div class="relative aspect-[16/7] overflow-hidden" style="background:linear-gradient(135deg, ${color}, color-mix(in oklab, ${color} 50%, black))">
      <div class="cover-pattern absolute inset-0"></div>
      <i class="fa-solid fa-feather-pointed absolute -bottom-8 right-6 -rotate-12 text-[9rem] text-white/15"></i>
      <div class="absolute left-4 top-4 rounded-full bg-white shadow-sm">
        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium" style="background:color-mix(in oklab, ${color} 16%, white); color:color-mix(in oklab, ${color} 62%, black)">
          <span class="size-2 rounded-full" style="background:${color}"></span><span></span>
        </span>
      </div>
      <div class="absolute right-4 top-4 flex gap-2">
        <button class="btn btn-circle btn-sm border-0 bg-white/90 text-base-content shadow-sm hover:bg-white" aria-label="Edit post"><i class="fa-solid fa-pen"></i></button>
        <button class="btn btn-circle btn-sm border-0 bg-white/90 text-error shadow-sm hover:bg-white" aria-label="Delete post"><i class="fa-solid fa-trash"></i></button>
      </div>
    </div>
    <div class="px-6 pb-5 pt-6">
      <h2 class="font-display text-2xl font-semibold leading-tight"></h2>
      <p class="mt-2 whitespace-pre-line leading-relaxed text-base-content/75"></p>
      <div class="mt-6 flex items-center justify-between gap-3">
        <div class="flex min-w-0 items-center gap-3">
          <span class="inline-flex size-9 shrink-0 items-center justify-center rounded-full text-sm font-semibold text-white"></span>
          <div class="min-w-0 leading-tight">
            <p class="truncate text-sm font-medium"></p>
            <p class="text-xs text-base-content/55"></p>
          </div>
        </div>
        <button class="btn btn-neutral btn-sm rounded-full">
          <i class="fa-regular fa-comment"></i>Comments
          <span class="badge badge-sm border-0 bg-white/20 text-neutral-content">0</span>
        </button>
      </div>
    </div>
    <div id="${p.id}-comments" class="comments">
      <div inert>
        <div class="border-t border-base-300 bg-base-200/60 px-6 py-5">
          <p class="mb-4 text-sm text-base-content/60">No comments yet. Start the conversation.</p>
          <ul id="${p.id}-comment-list" class="mb-5 hidden space-y-4"></ul>
          <form class="comment-form flex items-center gap-3" data-post-id="${p.id}">
            <span class="inline-flex size-9 shrink-0 items-center justify-center rounded-full text-sm font-semibold text-white current-user-avatar">?</span>
            <input name="text" class="input grow rounded-full" maxlength="500" required autocomplete="off" placeholder="Write a comment" aria-label="Write a comment" />
            <button class="btn btn-primary btn-circle" aria-label="Send comment"><i class="fa-solid fa-paper-plane"></i></button>
          </form>
        </div>
      </div>
    </div>`;

  article.querySelector("h2").textContent = p.title;
  article.querySelector("h2 + p").textContent = p.body;
  article.querySelector(".absolute.left-4 span span:last-child").textContent = categoryLabel(p.category);
  const avatar = article.querySelector(".mt-6 span.inline-flex");
  avatar.textContent = (p.author || "D")[0].toUpperCase();
  avatar.style.background = avatarColor(p.author || "Daybook");
  article.querySelector(".truncate.text-sm.font-medium").textContent = p.author || "Daybook";
  article.querySelector(".text-xs.text-base-content\\/55").textContent = p.time || "just now";

  const editBtn = article.querySelectorAll(".absolute.right-4 button")[0];
  const delBtn = article.querySelectorAll(".absolute.right-4 button")[1];
  editBtn.addEventListener("click", () => window.editPost(p.id));
  delBtn.addEventListener("click", () => window.confirmDeletePost(p.id, article.dataset.title));

  const commentsBtn = article.querySelector(".btn-neutral");
  const countBadge = commentsBtn.querySelector(".badge");
  commentsBtn.addEventListener("click", () => window.toggleComments(p.id));

  article.querySelector(".comment-form").addEventListener("submit", (e) => window.submitComment(e, p.id));

  if (p.comments && p.comments.length) {
    const list = article.querySelector(`#${p.id}-comment-list`);
    p.comments.forEach((c) => list.append(buildCommentLi(p.id, c)));
    list.classList.remove("hidden");
    article.querySelector(".mb-4.text-sm.text-base-content\\/60").classList.add("hidden");
    countBadge.textContent = p.comments.length;
  }

  if (!document.getElementById(`post-${p.id}`)) $("#feed").append(article);
  return article;
}

// ---- Comments ----
window.toggleComments = function (postId) {
  const panel = $(`#${postId}-comments`);
  const inner = panel.querySelector(":scope > div");
  const willOpen = !panel.classList.contains("open");
  panel.classList.toggle("open", willOpen);
  inner.inert = !willOpen;
  const btn = $(`#post-${postId} .btn-neutral`);
  btn.setAttribute("aria-expanded", String(willOpen));
  if (willOpen) panel.querySelector('input[name="text"]').focus({ preventScroll: true });
};

window.submitComment = function (event, postId) {
  event.preventDefault();
  const form = event.target;
  const text = form.text.value.trim();
  if (!text) return false;

  const list = $(`#${postId}-comment-list`);
  const emptyMsg = $(`#post-${postId} .mb-4.text-sm.text-base-content\\/60`);
  const id = `c${nextId++}`;
  const li = buildCommentLi(postId, { id, author: currentUser ?? "Guest", text });
  list.append(li);
  list.classList.remove("hidden");
  emptyMsg && emptyMsg.classList.add("hidden");

  const badge = $(`#post-${postId} .btn-neutral .badge`);
  badge.textContent = list.children.length;

  form.reset();
  form.querySelector('input[name="text"]').focus({ preventScroll: true });
  saveToStorage();
  return false;
};

function buildCommentLi(postId, comment) {
  const li = document.createElement("li");
  li.className = "group flex gap-3";
  li.dataset.commentId = comment.id;
  li.innerHTML = `
    <span class="inline-flex size-8 shrink-0 items-center justify-center rounded-full text-xs font-semibold text-white"></span>
    <div class="min-w-0 flex-1">
      <div class="flex items-baseline gap-2">
        <span class="text-sm font-semibold"></span>
        <span class="text-xs text-base-content/55">just now</span>
      </div>
      <p class="comment-text whitespace-pre-line break-words text-sm leading-relaxed text-base-content/85"></p>
    </div>
    <div class="flex shrink-0 gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
      <button class="btn btn-ghost btn-xs btn-circle" aria-label="Edit comment"><i class="fa-solid fa-pen"></i></button>
      <button class="btn btn-ghost btn-xs btn-circle text-error" aria-label="Delete comment"><i class="fa-solid fa-trash"></i></button>
    </div>`;
  const avatar = li.querySelector("span.inline-flex");
  avatar.textContent = comment.author[0].toUpperCase();
  avatar.style.background = avatarColor(comment.author);
  li.querySelector(".font-semibold").textContent = comment.author;
  li.querySelector(".comment-text").textContent = comment.text;

  const [editBtn, delBtn] = li.querySelectorAll("button");
  editBtn.addEventListener("click", () => window.editComment(comment.id));
  delBtn.addEventListener("click", () => window.deleteComment(postId, comment.id));
  return li;
}

window.editComment = function (commentId) {
  const li = document.querySelector(`[data-comment-id="${commentId}"]`);
  comment_modal.querySelector('[name="commentId"]').value = commentId;
  comment_modal.querySelector('[name="text"]').value = li.querySelector(".comment-text").textContent;
  comment_modal.showModal();
};

window.submitCommentEdit = function (event) {
  event.preventDefault();
  const form = event.target;
  const id = form.commentId.value;
  const text = form.text.value.trim();
  if (!text) return false;

  const li = document.querySelector(`[data-comment-id="${id}"]`);
  li.querySelector(".comment-text").textContent = text;
  let timeEl = li.querySelector(".text-xs.text-base-content\\/55");
  if (!timeEl.textContent.includes("(edited)")) timeEl.textContent += " (edited)";

  saveToStorage();
  toast("Comment updated");
  comment_modal.close();
  return false;
};

window.deleteComment = function (postId, commentId) {
  const li = document.querySelector(`[data-comment-id="${commentId}"]`);
  const list = $(`#${postId}-comment-list`);
  const next = li.nextSibling;
  const removed = li;
  li.remove();

  const badge = $(`#post-${postId} .btn-neutral .badge`);
  badge.textContent = list.children.length;
  if (list.children.length === 0) {
    list.classList.add("hidden");
    $(`#post-${postId} .mb-4.text-sm.text-base-content\\/60`)?.classList.remove("hidden");
  }
  saveToStorage();

  toast("Comment deleted", {
    icon: "fa-trash",
    undo: () => {
      list.insertBefore(removed, next);
      list.classList.remove("hidden");
      $(`#post-${postId} .mb-4.text-sm.text-base-content\\/60`)?.classList.add("hidden");
      badge.textContent = list.children.length;
      saveToStorage();
    },
  });
};

// ===================================================================
// TODO PAGE
// ===================================================================
function todosMatchingFilters() {
  return $$("#list .todo-item").filter((li) => {
    const inCategory = activeCategory === "all" || li.dataset.category === activeCategory;
    const done = li.dataset.done === "true";
    const inFilter = currentFilter === "all" || (currentFilter === "done" ? done : !done);
    const q = searchQuery;
    const inSearch = !q || li.dataset.text.toLowerCase().includes(q);
    return inCategory && inFilter && inSearch;
  });
}

function todosInCategory(id) {
  return $$("#list .todo-item").filter((li) => id === "all" || li.dataset.category === id);
}

function refreshTodoList() {
  const all = $$("#list .todo-item");
  const visible = todosMatchingFilters();
  all.forEach((li) => li.classList.toggle("hidden", !visible.includes(li)));

  const empty = $("#list-empty");
  empty.classList.toggle("hidden", visible.length > 0);
  if (visible.length === 0) {
    const inCat = todosInCategory(activeCategory);
    let icon = "fa-clipboard-check", title = "No todos yet", text = "Add your first one above.";
    if (searchQuery) [icon, title, text] = ["fa-magnifying-glass", "Nothing matches your search", "Try a different word."];
    else if (inCat.length && currentFilter === "active") [icon, title, text] = ["fa-circle-check", "You're all caught up", "Every todo here is done."];
    else if (inCat.length && currentFilter === "done") [icon, title, text] = ["fa-hourglass-half", "Nothing completed yet", "Check a todo off and it shows up here."];
    $("#list-empty-icon").className = `fa-solid ${icon}`;
    $("#list-empty-title").textContent = title;
    $("#list-empty-text").textContent = text;
  }

  // header + progress
  const inCategory = todosInCategory(activeCategory);
  const done = inCategory.filter((li) => li.dataset.done === "true").length;
  const percent = inCategory.length ? Math.round((done / inCategory.length) * 100) : 0;
  $("#progress-bar").style.width = `${percent}%`;
  $("#progress-track").setAttribute("aria-valuenow", percent);
  $("#progress-done").textContent = done;
  $("#progress-total").textContent = inCategory.length;

  // filter tab counts
  $("#count-all").textContent = inCategory.length;
  $("#count-active").textContent = inCategory.filter((li) => li.dataset.done !== "true").length;
  $("#count-done").textContent = done;
  $("#clear-done-btn").classList.toggle("hidden", done === 0);

  // add-form category select follows active category
  const addSelect = $("#add-category-select");
  if (addSelect) addSelect.parentElement.classList.toggle("hidden", activeCategory !== "all" && false); // always visible; value set on submit if needed

  refreshCategoryCounts();
}

window.setFilter = function (filter) {
  currentFilter = filter;
  $$(".filter-btn").forEach((btn) => {
    const active = btn.dataset.filter === filter;
    btn.setAttribute("aria-pressed", String(active));
    btn.classList.toggle("bg-neutral", active);
    btn.classList.toggle("text-neutral-content", active);
    btn.classList.toggle("text-base-content/65", !active);
    const span = btn.querySelector("span");
    span.classList.toggle("text-neutral-content/70", active);
    span.classList.toggle("text-base-content/45", !active);
  });
  refreshTodoList();
};

window.submitAddTodo = function (event) {
  event.preventDefault();
  const form = event.target;
  const text = form.text.value.trim();
  if (!text) return false;

  const category = activeCategory !== "all" ? activeCategory : form.categoryId.value;
  const id = `t${nextId++}`;
  const li = insertTodoRow({ id, text, category, done: false });
  $("#list").prepend(li);
  if (currentFilter === "done") window.setFilter("all");

  form.reset();
  form.text.focus();
  refreshTodoList();
  saveToStorage();
  toast("Todo added");
  return false;
};

window.toggleTodo = function (id) {
  const li = $(`#todo-${id}`);
  const done = li.dataset.done !== "true";
  li.dataset.done = String(done);
  li.querySelector('input[type="checkbox"]').checked = done;
  const text = li.querySelector(".todo-text");
  text.classList.toggle("text-base-content/40", done);
  text.classList.toggle("line-through", done);
  li.querySelector('input[type="checkbox"]').setAttribute("aria-label", `Mark "${li.dataset.text}" as ${done ? "not done" : "done"}`);
  refreshTodoList();
  saveToStorage();
};

window.editTodo = function (id) {
  const li = $(`#todo-${id}`);
  const form = todo_modal.querySelector("form");
  form.todoId.value = id;
  form.text.value = li.dataset.text;
  form.categoryId.value = li.dataset.category || "";
  todo_modal.showModal();
};

window.submitTodoEdit = function (event) {
  event.preventDefault();
  const form = event.target;
  const id = form.todoId.value;
  const text = form.text.value.trim();
  if (!text) return false;

  const li = $(`#todo-${id}`);
  const category = form.categoryId.value;
  const color = categoryColor(category) ?? "#b8c4c0";

  li.dataset.text = text;
  li.dataset.category = category;
  li.style.borderLeftColor = color;
  li.querySelector(".todo-text").textContent = text;

  let chip = li.querySelector(".rounded-full.px-2\\.5");
  if (category) {
    if (!chip) {
      chip = document.createElement("span");
      chip.className = "inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium";
      chip.innerHTML = '<span class="size-2 rounded-full"></span><span></span>';
      li.querySelector(".todo-text").after(chip);
    }
    chip.style.background = `color-mix(in oklab, ${color} 16%, white)`;
    chip.style.color = `color-mix(in oklab, ${color} 62%, black)`;
    chip.querySelector("span").style.background = color;
    chip.lastChild.textContent = categoryLabel(category);
  } else if (chip) {
    chip.remove();
  }

  refreshTodoList();
  saveToStorage();
  toast("Todo updated");
  todo_modal.close();
  return false;
};

window.confirmDeleteTodo = function (id, text) {
  showConfirm({
    title: "Delete this todo?",
    message: `"${text}" will be deleted.`,
    confirmLabel: "Delete todo",
    run: () => {
      const li = $(`#todo-${id}`);
      const next = li.nextSibling;
      const parent = li.parentElement;
      li.remove();
      refreshTodoList();
      saveToStorage();
      toast("Todo deleted", {
        icon: "fa-trash",
        undo: () => {
          parent.insertBefore(li, next);
          refreshTodoList();
          saveToStorage();
        },
      });
    },
  });
};

window.confirmClearCompleted = function () {
  const inCategory = todosInCategory(activeCategory);
  const doneCount = inCategory.filter((li) => li.dataset.done === "true").length;
  if (doneCount === 0) return;
  showConfirm({
    title: "Clear completed todos?",
    message: `${doneCount} finished todo${doneCount === 1 ? "" : "s"} will be deleted.`,
    confirmLabel: "Clear completed",
    run: () => {
      inCategory.filter((li) => li.dataset.done === "true").forEach((li) => li.remove());
      refreshTodoList();
      saveToStorage();
      toast("Cleared completed todos");
    },
  });
};

/** Builds one <li> from data, wires its events, appends it to #list unless it already exists. Returns the element. */
function insertTodoRow(t) {
  const color = categoryColor(t.category) ?? "#b8c4c0";
  const li = document.createElement("li");
  li.id = `todo-${t.id}`;
  li.className = "todo-item group flex flex-wrap items-center gap-3 rounded-2xl border border-l-[5px] border-base-300 bg-base-100 py-3 pl-4 pr-3 shadow-sm";
  li.style.borderLeftColor = color;
  li.dataset.category = t.category || "";
  li.dataset.done = String(Boolean(t.done));
  li.dataset.text = t.text;

  li.innerHTML = `
    <input type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-full" ${t.done ? "checked" : ""} />
    <span class="min-w-0 flex-1 break-words text-lg todo-text ${t.done ? "text-base-content/40 line-through" : ""}" title="Double-click to edit"></span>
    ${t.category ? `<span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium" style="background:color-mix(in oklab, ${color} 16%, white); color:color-mix(in oklab, ${color} 62%, black)"><span class="size-2 rounded-full" style="background:${color}"></span><span></span></span>` : ""}
    <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
      <button class="btn btn-ghost btn-sm btn-circle" aria-label="Edit todo"><i class="fa-solid fa-pen"></i></button>
      <button class="btn btn-ghost btn-sm btn-circle text-error" aria-label="Delete todo"><i class="fa-solid fa-trash"></i></button>
    </div>`;

  li.querySelector(".todo-text").textContent = t.text;
  const chipName = li.querySelector(".rounded-full.px-2\\.5 span:last-child");
  if (chipName) chipName.textContent = categoryLabel(t.category);

  li.querySelector('input[type="checkbox"]').addEventListener("change", () => window.toggleTodo(t.id));
  li.querySelector(".todo-text").addEventListener("dblclick", () => window.editTodo(t.id));
  const [editBtn, delBtn] = li.querySelectorAll(".flex.gap-0\\.5 button");
  editBtn.addEventListener("click", () => window.editTodo(t.id));
  delBtn.addEventListener("click", () => window.confirmDeleteTodo(t.id, t.text));

  if (!document.getElementById(`todo-${t.id}`)) $("#list").append(li);
  return li;
}
