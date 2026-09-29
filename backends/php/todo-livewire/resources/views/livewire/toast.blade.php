<div>
    @script
        <script>
            function toast(message, {
                undo,
                icon = "fa-circle-check"
            } = {}) {
                let host = document.getElementById("toast-host");
                if (!host) {
                    host = document.createElement("div");
                    host.id = "toast-host";
                    host.className = "fixed bottom-4 right-4 z-[100] flex flex-col items-end gap-2";
                    host.setAttribute("aria-live", "polite");
                    document.body.append(host);
                }
                const el = document.createElement("div");
                el.className = "flex items-center gap-3 rounded-xl bg-neutral px-4 py-3 text-sm text-neutral-content shadow-lg";
                el.innerHTML = `<i class="fa-solid ${icon} text-secondary"></i><span></span>`;
                el.querySelector("span").textContent = message; // textContent, never innerHTML, for user-provided text
                if (undo) {
                    const btn = document.createElement("button");
                    btn.className = "ml-1 font-semibold text-secondary underline-offset-2 hover:underline";
                    btn.textContent = "Undo";
                    btn.addEventListener("click", () => {
                        undo();
                        el.remove();
                    });
                    el.append(btn);
                }
                host.append(el);
                setTimeout(() => el.remove(), undo ? 6000 : 3000);
            }
            $wire.on('toast', (event) => {
                toast(event.message, event.options);
            });
        </script>
    @endscript
</div>
