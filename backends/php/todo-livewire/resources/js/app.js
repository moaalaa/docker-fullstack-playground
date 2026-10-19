import "@fortawesome/fontawesome-free/css/all.min.css";
import "@fontsource-variable/bricolage-grotesque";
import "@fontsource-variable/figtree";


// ===================================================================
// PROFILE PAGE
// ===================================================================
function renderProfileForm() {
  const avatar = $("#profile-avatar");
  const subtitle = $("#profile-subtitle");
  const form = $("#profile-form");

  if (!currentUser) {
    avatar.textContent = "?";
    avatar.style.background = "#5b7a74";
    subtitle.textContent = "Not logged in";
    form.classList.add("opacity-50", "pointer-events-none");
    $("#profile-status").textContent = "Log in from the header to edit your profile.";
    return;
  }

  form.classList.remove("opacity-50", "pointer-events-none");
  avatar.textContent = currentUser.username[0].toUpperCase();
  avatar.style.background = avatarColor(currentUser.username);
  subtitle.textContent = currentUser.email;
  $("#profile-username").value = currentUser.username;
  $("#profile-email").value = currentUser.email;
  $("#profile-password").value = "";
  $("#profile-status").textContent = "";
};

window.submitProfile = function (event) {
  event.preventDefault();
  if (!currentUser) return false;
  const form = event.target;
  const username = form.username.value.trim();
  const email = form.email.value.trim();
  const password = form.password.value;

  if (!username || !email) return false;

  currentUser = {
    username,
    email,
    password: password ? password : currentUser.password,
  };
  saveToStorage();
  renderHeaderAuth();
  renderProfileForm();
  $("#profile-status").textContent = `Saved just now`;
  toast("Profile updated");
  return false;
};

// ===================================================================
// TODO PAGE (home page)
// ===================================================================
function visibleTodos() {
  const q = searchQuery;
  return $$("#list .todo-item").filter((li) => {
    const done = li.dataset.done === "true";
    const inFilter = currentFilter === "all" || (currentFilter === "done" ? done : !done);
    const inSearch = !q || li.dataset.text.toLowerCase().includes(q);
    return inFilter && inSearch;
  });
}

function wireSearch() {
  const input = $("#search");
  if (!input) return;
  input.addEventListener("input", () => {
    searchQuery = input.value.trim().toLowerCase();
    refreshTodoList();
  });
  input.addEventListener("keydown", (e) => {
    if (e.key !== "Escape") return;
    input.value = "";
    searchQuery = "";
    refreshTodoList();
  });
}

function refreshTodoList() {
  const all = $$("#list .todo-item");
  const visible = visibleTodos();
  all.forEach((li) => li.classList.toggle("hidden", !visible.includes(li)));

  const empty = $("#list-empty");
  empty.classList.toggle("hidden", visible.length > 0);
  if (visible.length === 0) {
    let icon = "fa-clipboard-check", title = "No todos yet", text = "Add your first one above.";
    if (searchQuery) [icon, title, text] = ["fa-magnifying-glass", "Nothing matches your search", "Try a different word."];
    else if (all.length && currentFilter === "active") [icon, title, text] = ["fa-circle-check", "You're all caught up", "Every todo here is done."];
    else if (all.length && currentFilter === "done") [icon, title, text] = ["fa-hourglass-half", "Nothing completed yet", "Check a todo off and it shows up here."];
    $("#list-empty-icon").className = `fa-solid ${icon}`;
    $("#list-empty-title").textContent = title;
    $("#list-empty-text").textContent = text;
  }

  const done = all.filter((li) => li.dataset.done === "true").length;
  const percent = all.length ? Math.round((done / all.length) * 100) : 0;
  $("#progress-bar").style.width = `${percent}%`;
  $("#progress-track").setAttribute("aria-valuenow", percent);
  $("#progress-done").textContent = done;
  $("#progress-total").textContent = all.length;

  $("#count-all").textContent = all.length;
  $("#count-active").textContent = all.length - done;
  $("#count-done").textContent = done;
  $("#clear-done-btn").classList.toggle("hidden", done === 0);
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

  const id = `t${nextId++}`;
  const li = insertTodoRow({ id, text, done: false });
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
  todo_modal.showModal();
};

window.submitTodoEdit = function (event) {
  event.preventDefault();
  const form = event.target;
  const id = form.todoId.value;
  const text = form.text.value.trim();
  if (!text) return false;

  const li = $(`#todo-${id}`);
  li.dataset.text = text;
  li.querySelector(".todo-text").textContent = text;

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
  const doneCount = $$("#list .todo-item").filter((li) => li.dataset.done === "true").length;
  if (doneCount === 0) return;
  showConfirm({
    title: "Clear completed todos?",
    message: `${doneCount} finished todo${doneCount === 1 ? "" : "s"} will be deleted.`,
    confirmLabel: "Clear completed",
    run: () => {
      $$("#list .todo-item")
        .filter((li) => li.dataset.done === "true")
        .forEach((li) => li.remove());
      refreshTodoList();
      saveToStorage();
      toast("Cleared completed todos");
    },
  });
};

/** Builds one <li> from data, wires its events, appends it to #list unless it already exists. Returns the element. */
function insertTodoRow(t) {
  const li = document.createElement("li");
  li.id = `todo-${t.id}`;
  li.className = "todo-item group flex flex-wrap items-center gap-3 rounded-2xl border border-base-300 bg-base-100 py-3 pl-4 pr-3 shadow-sm";
  li.dataset.done = String(Boolean(t.done));
  li.dataset.text = t.text;

  li.innerHTML = `
    <input type="checkbox" class="checkbox checkbox-primary checkbox-sm rounded-full" ${t.done ? "checked" : ""} />
    <span class="min-w-0 flex-1 break-words text-lg todo-text ${t.done ? "text-base-content/40 line-through" : ""}" title="Double-click to edit"></span>
    <div class="flex gap-0.5 opacity-0 transition-opacity group-hover:opacity-100">
      <button class="btn btn-ghost btn-sm btn-circle" aria-label="Edit todo"><i class="fa-solid fa-pen"></i></button>
      <button class="btn btn-ghost btn-sm btn-circle text-error" aria-label="Delete todo"><i class="fa-solid fa-trash"></i></button>
    </div>`;

  li.querySelector(".todo-text").textContent = t.text;
  li.querySelector('input[type="checkbox"]').addEventListener("change", () => window.toggleTodo(t.id));
  li.querySelector(".todo-text").addEventListener("dblclick", () => window.editTodo(t.id));
  const [editBtn, delBtn] = li.querySelectorAll(".flex.gap-0\\.5 button");
  editBtn.addEventListener("click", () => window.editTodo(t.id));
  delBtn.addEventListener("click", () => window.confirmDeleteTodo(t.id, t.text));

  if (!document.getElementById(`todo-${t.id}`)) $("#list").append(li);
  return li;
}
