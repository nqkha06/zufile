import {
    M as r
} from "./D547OYeC.js";
[...document.querySelectorAll("form.account")].map(t => t.addEventListener("submit", e => {
    e.preventDefault();
    const a = t.querySelector('button[type="submit"]');
    a.disabled = !0, http.post("/u/account", new FormData(t)).then(n => {
        toast("Account has been updated.")
    }).catch(n => errorHandler(n)).then(() => {
        a.disabled = !1
    })
}));
const o = document.getElementById("change-password");
o.addEventListener("submit", t => {
    t.preventDefault();
    const e = o.querySelector('button[type="submit"]');
    e.disabled = !0, http.post("/u/account/change-password", new FormData(o)).then(a => {
        o.querySelector("#current-password") || location.reload(), o.reset(), toast("Password has been updated.")
    }).catch(a => errorHandler(a)).then(() => {
        e.disabled = !1
    })
});
const c = document.getElementById("delete-account");
c.addEventListener("click", t => {
    http.delete("/u/account").then(e => {
        location.reload()
    }).catch(e => errorHandler(e))
});
document.getElementById("IEiLQL").onclick = t => {
    const e = t.currentTarget,
        a = document.getElementById("IiYFab");
    e.disabled = !0, http.post("/api/v1/user/change-email").then(n => {
        n.status == 204 ? (a.classList.remove("left-0"), a.classList.add("-left-full")) : toast(n.data.message)
    }).catch(n => errorHandler(n)).then(() => {
        e.disabled = !1
    })
};
const s = document.getElementById("HLutDb");
if (s) {
    const t = new r(s, {
        backdrop: "static"
    });
    t.show(), s.querySelector("form").addEventListener("submit", e => {
        e.preventDefault();
        const a = s.querySelector('button[type="submit"]');
        a.disabled = !0, http.post("/u/account", new FormData(e.target)).then(n => {
            toast("Account has been updated."), document.getElementById("email").value = document.getElementById("new-email").value, t.hide(), setTimeout(() => {
                s.remove()
            }, 3e3)
        }).catch(n => errorHandler(n)).then(() => {
            a.disabled = !1
        })
    })
}
