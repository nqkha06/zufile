import { i as z, a as L, f as j } from "./BzwGfqBb.js";
import { T as A } from "./D547OYeC.js";
const s = location.pathname.split("/")
const x = document.getElementById("filemanager")
const V = document.getElementById("loading");
const u = document.getElementById("folders");
const f = document.getElementById("files");
const C = document.getElementById("tool-share");
const k = { folder: !1, file: !1 };
let n = null,
    h = s[3],
    m = "root";
s[2] == "drive" && typeof s[4] == "string" && s[4] !== "home" && (m = s[4]);
s[2] == "drive" && s[3] != "search" && localStorage.setItem("last_drive", s[3]);
let P = localStorage.getItem("layout");
x.classList.add(P ?? "list");
if (location.hash == "#nav_to_upload") {
    const e = document.querySelector('label[for="file"]'),
        t = A.getInstance('label[for="file"]');
        console.log(t);
    window.setTimeout(() => {
        // e.classList.add("transition-all", "outline"), t.show()
        e.classList.add("transition-all", "outline");
    }, 800)
}
const R = new URLSearchParams(window.location.search),
    i = R.get("q");
if (i && s[3] == "search") {
    let e = document.createElement("p");
    e.classList.add("text-center", "text-xs", "text-gray-400", "p-4"), e.innerText = `Showing search results for "${i}"`, x.prepend(e)
}

function v() {
    if (!(!k.folder || !k.file)) {
        if (u.children.length < 1 && f.children.length < 1)
            if (i && s[3] == "search") {
                const e = document.createElement("div");
                e.classList.add("col-span-6", "text-center", "text-gray-400"), e.innerText = `Files with the name "${i}" were not found.`, f.appendChild(e)
            } else document.getElementById("empty").classList.remove("hidden");
        else document.getElementById("empty").classList.add("hidden");
        V.classList.add("hidden"), x.classList.remove("hidden")
    }
}

function $(e) {
    let t = 25 * e,
        l = {
            offset: t
        };
    i && s[3] == "search" ? l.name = i : l = {
        ...l,
        dir: m,
        d: h
    }, http.get("/u/folders", {
        params: l,
        headers: {
            Accept: "application/json"
        }
    }).then(({
        data: r
    }) => {
        if (r.items.forEach(a => {
                u.appendChild(L(a))
            }), u.nextElementSibling.role == "alert" && u.nextElementSibling.remove(), t + 25 < r.total) {
            const a = document.createElement("button");
            a.innerText = "Show more", a.classList.add("text-center", "text-sm", "w-full"), a.onclick = d => {
                d.currentTarget.replaceWith(loadingElement()), $(++e)
            }, u.after(a)
        }
        k.folder = !0, v()
    }).catch(r => errorHandler(r, "007"))
}
$(0);

function D(e) {
    let t = 25 * e,
        l = {
            offset: t
        };
    i && s[3] == "search" ? l.name = i : l = {
        ...l,
        dir: m,
        d: h
    };

    function r() {
        window.innerHeight + window.scrollY >= document.body.offsetHeight - 100 && (window.removeEventListener("scroll", r), f.after(loadingElement()), D(++e))
    }
    http.get("/u/files", {
        params: l,
        headers: {
            Accept: "application/json"
        }
    }).then(({
        data: a
    }) => {
        a.items.forEach(d => {
            f.appendChild(j(d))
        }), f.nextElementSibling.role == "alert" && f.nextElementSibling.remove(), t + 25 < a.total && window.addEventListener("scroll", r), k.file = !0, v()
    }).catch(a => errorHandler(a, "006"))
}
D(0);
z(["layout"]);
const w = (e, t = null) => {
    document.getElementById("tools").querySelectorAll("button").forEach(r => {
        if (r.disabled = !0, r.id == "tool-move" && t) {
            let a = t.type;
            if (a == "folder" && L < 2 || a == "file" && L < 1 && m == "root") return
        }(r.id == "tool-share" || r.id == "tool-download") && t && t.type == "folder" || (r.disabled = !e)
    })
};
document.body.addEventListener("click", (e) => {
     const btn = e.target.closest("button.upld-share");
    if (btn) {
        let keyyy = btn.dataset.key;
        let inputttt = document.querySelector(`input[name="item"][value="${keyyy}"]`);

        if (!inputttt) return;
        n = {
            key: inputttt.value,
            element: inputttt.parentElement,
            type: inputttt.dataset.type,
            name: inputttt.dataset.name,
            private: inputttt.dataset.private === "true"
        }
    }

    if (e.target.name === "item") {
        // Tạo object chứa thông tin item
        n = {
            key: e.target.value,
            element: e.target.parentElement,
            type: e.target.dataset.type,
            name: e.target.dataset.name,
            private: e.target.dataset.private === "true"
        };

        // Nếu là file thì thêm đuôi file
        if (n.type === "file") {
            n.ext = e.target.dataset.ext;
        }

        // Gán key và private vào element C
        C.dataset.key = e.target.value;
        C.dataset.private = e.target.dataset.private === "true";

        // Kích hoạt xử lý với item đã chọn
        w(true, n);

    } else {

        // Nếu click trong #tools hoặc đang mở modal thì bỏ qua
        if (e.target.closest("#tools") || document.body.querySelector(".modal-backdrop.fade.show")) {
            return;
        }

        // Nếu đang có item được chọn thì bỏ chọn nó
        if (n) {
            const selectedItem = document.querySelector('[name="item"]:checked');
            if (selectedItem) selectedItem.checked = false;

            w(false); // Hủy xử lý
            n = null; // Reset
        }
    }
});

const q = document.getElementById("modal-move");
q.querySelector("form").addEventListener("submit", e => {
    e.preventDefault();
    const t = e.target.querySelector('[type="submit"]'),
        l = new FormData(e.target);
    t.disabled = !0, http.post(`/u/${n.type}s/${n.key}`, l).then(() => {
        n.element.remove(), n = null, w(!1), v()
    }).catch(r => errorHandler(r, "004")).finally(() => {
        t.disabled = !1, e.target.querySelector("[data-bs-dismiss]").click()
    })
});
q.addEventListener("show.bs.modal", e => {
    if (e.relatedTarget.disabled) {
        e.preventDefault();
        return
    }
    const t = e.target.querySelector("ul"),
        l = e.target.querySelector("form"),
        r = l.querySelector('button[type="submit"]'),
        a = document.getElementById("kkyp");
    let d = "root",
        g = [],
        _ = n.element.querySelector(".name").innerText,
        S = h;
    e.target.querySelector("[title]").innerText = `Move "${_}"`,
    e.target.querySelector("[loading]").classList.add("hidden"),
    a.classList.remove("hidden"), l.classList.remove("hidden");
    // l.querySelector('select[name="drive"]').addEventListener("change", y => {
    //     S = y.target.value, r.disabled = !0, t.innerHTML = "", a.classList.remove("hidden"), g = [], d = "root", p(0)
    // });
    console.log('l:',l, 'r:',r, 't:',t, 'a:',a);
    function p(y) {
        let H = 25 * y;
        http.get("/u/folders", {
            params: {
                d: S,
                dir: d,
                offset: H,
                count_nest: !0
            }
        }).then(({
            data: b
        }) => {
            if (g.length > 0) {
                const o = document.createElement("button");
                o.classList.add("flex", "items-center", "gap-1", "p-1.5", "text-left", "w-full", "text-zinc-600", "dark:text-zinc-300", "hover:bg-zinc-100", "hover:dark:bg-zinc-800", "rounded-md"), o.innerHTML = `<svg class="size-4" viewBox="0 0 24 24" fill="none">
                    <path d="M15.0001 19.9201L8.48009 13.4001C7.71009 12.6301 7.71009 11.3701 8.48009 10.6001L15.0001 4.08008" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Back</span>`, o.addEventListener("click", () => {
                    r.disabled = !0, t.innerHTML = "", a.classList.remove("hidden"), d = g.pop(), p(0)
                }), t.appendChild(o)
            }
            if ((m != "root" || S != h) && d == "root") {
                const o = document.createElement("li");
                o.innerHTML = `
                <label class="file small">
                    <input type="radio" name="location" class="peer" value="root"/>
                    <div class="peer-checked:!bg-blue-100 dark:peer-checked:!bg-blue-900">
                        <img src="https://cdn.safefileku.com/icons/folder_home.svg" alt="folder"/>
                        <div class="meta">
                            <div class="name" title="Home">Home</div>
                        </div>
                    </div>
                </label>
                `, t.appendChild(o)
            }
            if (b.items.forEach(o => {
                    if (n.type == "folder" && n.key == o.key) return;
                    const c = document.createElement("li");
                    if (c.innerHTML = `
                <label class="file small">
                    <input type="radio" name="location" class="peer" value="${o.key}" ${m == o.key ? "disabled" : ""}/>
                    <div class="peer-checked:!bg-blue-100 dark:peer-checked:!bg-blue-900">
                        <img src="https://cdn.safefileku.com/icons/folder.svg" alt="folder"/>
                        <div class="meta overflow-hidden">
                            <div class="name truncate" title="${o.name}">${o.name}</div>
                        </div>
                    </div>
                </label>
                `, o.total_folder > 0) {
                        const E = document.createElement("button");
                        E.classList.add("ml-auto"), E.innerHTML = `<svg class="size-6 sm:size-4" viewBox="0 0 24 24" fill="none">
                        <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.74 15.53L14.26 12L10.74 8.46997" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>`, E.addEventListener("click", F => {
                            F.preventDefault(), r.disabled = !0, t.innerHTML = "", g.push(d), d = o.key, a.classList.remove("hidden"), p(0)
                        }), c.children[0].children[1].appendChild(E)
                    }
                    t.appendChild(c)
                }), H + 25 < b.total) {
                const o = document.createElement("button");
                o.innerText = "Show more", o.classList.add("text-sm", "w-full", "text-gray-600"), o.addEventListener("click", c => {
                    c.currentTarget.remove(), a.classList.remove("hidden"), p(++y)
                }), t.appendChild(o)
            }
            t.querySelectorAll('input[name="location"]').forEach(o => {
                o.addEventListener("change", c => {
                    r.disabled = !1
                })
            }), a.classList.add("hidden")
        }).catch(b => errorHandler(b, "007"))
    }
    p(0)
});
q.addEventListener("hidden.bs.modal", e => {
    const t = e.target.querySelector("ul");
    t.innerHTML = "", e.target.querySelector("[loading]").classList.remove("hidden"), e.target.querySelector("form").classList.add("hidden")
});
const T = document.getElementById("modal-rename");
T.querySelector("form").addEventListener("submit", e => {
    e.preventDefault();
    const t = e.target.querySelector('[type="submit"]'),
        l = new FormData(e.target);
    t.disabled = !0, http.post(`/u/${n.type}s/${n.key}`, l).then(() => {
        const r = e.target.children[1].children[0].value;
        n.element.querySelector(".name").innerText = n.type == "file" ? r + "." + n.ext : r, n.element.querySelector('[name="item"]').dataset.name = r, n.name = r, e.target.querySelector("[data-bs-dismiss]").click()
    }).catch(r => errorHandler(r)).finally(() => {
        t.disabled = !1
    })
});
T.addEventListener("show.bs.modal", e => {
    if (e.relatedTarget.disabled) {
        e.preventDefault();
        return
    }
    const t = e.target.querySelector('[name="name"]');
    t.value = n.name, t.focus()
});
T.addEventListener("shown.bs.modal", e => {
    e.target.querySelector('[name="name"]').focus()
});
document.getElementById("tool-trash").addEventListener("click", e => {
    http.delete(`/u/${n.type}s/${n.key}`).then(t => {
        toast("File has been moved to trash."), n.element.remove(), n = null, w(!1), v()
    }).catch(t => errorHandler(null, "005"))
});
const B = document.getElementById("form-new-folder");
B.addEventListener("submit", e => {
    e.preventDefault();
    const t = e.target.querySelector('[type="submit"]'),
        l = new FormData(B);
    l.append("dir", m), l.append("drive", h), t.disabled = !0, http.post("/u/folders", l).then(r => {
        const a = r.data;
        u.prepend(L(a)), e.target.querySelector("[data-bs-dismiss]").click(), e.target.querySelector("input").value = "", v(), toast("Folder has been created.", "green")
    }).catch(r => errorHandler(r)).finally(() => {
        t.disabled = !1
    })
});
document.getElementById("tool-download").addEventListener("click", e => {
    window.open(`/u/files/${n.key}/download`)
});
var I;
(I = document.getElementById("set-private")) == null || I.addEventListener("click", e => {
    const t = e.currentTarget;
    t.disabled = !0, http.post(`/u/files/${n.key}`, {
        is_private: !0
    }).then(() => {
        n.private = !0, n.element.querySelector('[name="item"]').dataset.private = !0, document.getElementById("share-public").classList.add("hidden"), document.getElementById("share-private").classList.remove("hidden"), n.element.querySelector(".info").children[0].remove(), toast("File has been set to private.", "green")
    }).catch(() => errorHandler(null, "003")).finally(() => t.disabled = !1)
});
var M;
(M = document.getElementById("set-public")) == null || M.addEventListener("click", e => {
    const t = e.currentTarget;
    t.disabled = !0, http.post(`/u/files/${n.key}`, {
        is_private: !1
    }).then(() => {
        n.private = !1, n.element.querySelector('[name="item"]').dataset.private = !1, document.getElementById("share-public").classList.remove("hidden"), document.getElementById("share-private").classList.add("hidden");
        const l = document.createElement("div");
        l.innerHTML = `
        <svg class="text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"/>
            <path d="M7.99998 3H8.99998C7.04998 8.84 7.04998 15.16 8.99998 21H7.99998"/>
            <path d="M15 3C16.95 8.84 16.95 15.16 15 21"/>
            <path d="M3 16V15C8.84 16.95 15.16 16.95 21 15V16"/>
            <path d="M3 9.0001C8.84 7.0501 15.16 7.0501 21 9.0001"/>
        </svg>`, n.element.querySelector(".info").prepend(l), toast("File has been set to public.", "green")
    }).catch(() => errorHandler(null, "003")).finally(() => t.disabled = !1)
});
