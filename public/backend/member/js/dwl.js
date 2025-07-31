var C = "top"
  , $ = "bottom"
  , k = "right"
  , R = "left"
  , Dt = "auto"
  , ct = [C, $, k, R]
  , Q = "start"
  , st = "end"
  , ge = "clippingParents"
  , te = "viewport"
  , at = "popper"
  , ye = "reference"
  , qt = ct.reduce(function(t, e) {
    return t.concat([e + "-" + Q, e + "-" + st])
}, [])
  , ee = [].concat(ct, [Dt]).reduce(function(t, e) {
    return t.concat([e, e + "-" + Q, e + "-" + st])
}, [])
  , be = "beforeRead"
  , we = "read"
  , xe = "afterRead"
  , Oe = "beforeMain"
  , Ee = "main"
  , Ae = "afterMain"
  , Te = "beforeWrite"
  , De = "write"
  , Pe = "afterWrite"
  , je = [be, we, xe, Oe, Ee, Ae, Te, De, Pe];
function N(t) {
    return t ? (t.nodeName || "").toLowerCase() : null
}
function L(t) {
    if (t == null)
        return window;
    if (t.toString() !== "[object Window]") {
        var e = t.ownerDocument;
        return e && e.defaultView || window
    }
    return t
}
function J(t) {
    var e = L(t).Element;
    return t instanceof e || t instanceof Element
}
function S(t) {
    var e = L(t).HTMLElement;
    return t instanceof e || t instanceof HTMLElement
}
function Pt(t) {
    if (typeof ShadowRoot > "u")
        return !1;
    var e = L(t).ShadowRoot;
    return t instanceof e || t instanceof ShadowRoot
}
function Ce(t) {
    var e = t.state;
    Object.keys(e.elements).forEach(function(r) {
        var n = e.styles[r] || {}
          , a = e.attributes[r] || {}
          , o = e.elements[r];
        !S(o) || !N(o) || (Object.assign(o.style, n),
        Object.keys(a).forEach(function(c) {
            var s = a[c];
            s === !1 ? o.removeAttribute(c) : o.setAttribute(c, s === !0 ? "" : s)
        }))
    })
}
function Re(t) {
    var e = t.state
      , r = {
        popper: {
            position: e.options.strategy,
            left: "0",
            top: "0",
            margin: "0"
        },
        arrow: {
            position: "absolute"
        },
        reference: {}
    };
    return Object.assign(e.elements.popper.style, r.popper),
    e.styles = r,
    e.elements.arrow && Object.assign(e.elements.arrow.style, r.arrow),
    function() {
        Object.keys(e.elements).forEach(function(n) {
            var a = e.elements[n]
              , o = e.attributes[n] || {}
              , c = Object.keys(e.styles.hasOwnProperty(n) ? e.styles[n] : r[n])
              , s = c.reduce(function(i, p) {
                return i[p] = "",
                i
            }, {});
            !S(a) || !N(a) || (Object.assign(a.style, s),
            Object.keys(o).forEach(function(i) {
                a.removeAttribute(i)
            }))
        })
    }
}
const Be = {
    name: "applyStyles",
    enabled: !0,
    phase: "write",
    fn: Ce,
    effect: Re,
    requires: ["computeStyles"]
};
function H(t) {
    return t.split("-")[0]
}
var _ = Math.max
  , yt = Math.min
  , Z = Math.round;
function At() {
    var t = navigator.userAgentData;
    return t != null && t.brands && Array.isArray(t.brands) ? t.brands.map(function(e) {
        return e.brand + "/" + e.version
    }).join(" ") : navigator.userAgent
}
function re() {
    return !/^((?!chrome|android).)*safari/i.test(At())
}
function tt(t, e, r) {
    e === void 0 && (e = !1),
    r === void 0 && (r = !1);
    var n = t.getBoundingClientRect()
      , a = 1
      , o = 1;
    e && S(t) && (a = t.offsetWidth > 0 && Z(n.width) / t.offsetWidth || 1,
    o = t.offsetHeight > 0 && Z(n.height) / t.offsetHeight || 1);
    var c = J(t) ? L(t) : window
      , s = c.visualViewport
      , i = !re() && r
      , p = (n.left + (i && s ? s.offsetLeft : 0)) / a
      , f = (n.top + (i && s ? s.offsetTop : 0)) / o
      , m = n.width / a
      , y = n.height / o;
    return {
        width: m,
        height: y,
        top: f,
        right: p + m,
        bottom: f + y,
        left: p,
        x: p,
        y: f
    }
}
function jt(t) {
    var e = tt(t)
      , r = t.offsetWidth
      , n = t.offsetHeight;
    return Math.abs(e.width - r) <= 1 && (r = e.width),
    Math.abs(e.height - n) <= 1 && (n = e.height),
    {
        x: t.offsetLeft,
        y: t.offsetTop,
        width: r,
        height: n
    }
}
function ne(t, e) {
    var r = e.getRootNode && e.getRootNode();
    if (t.contains(e))
        return !0;
    if (r && Pt(r)) {
        var n = e;
        do {
            if (n && t.isSameNode(n))
                return !0;
            n = n.parentNode || n.host
        } while (n)
    }
    return !1
}
function V(t) {
    return L(t).getComputedStyle(t)
}
function Le(t) {
    return ["table", "td", "th"].indexOf(N(t)) >= 0
}
function q(t) {
    return ((J(t) ? t.ownerDocument : t.document) || window.document).documentElement
}
function bt(t) {
    return N(t) === "html" ? t : t.assignedSlot || t.parentNode || (Pt(t) ? t.host : null) || q(t)
}
function Ft(t) {
    return !S(t) || V(t).position === "fixed" ? null : t.offsetParent
}
function Se(t) {
    var e = /firefox/i.test(At())
      , r = /Trident/i.test(At());
    if (r && S(t)) {
        var n = V(t);
        if (n.position === "fixed")
            return null
    }
    var a = bt(t);
    for (Pt(a) && (a = a.host); S(a) && ["html", "body"].indexOf(N(a)) < 0; ) {
        var o = V(a);
        if (o.transform !== "none" || o.perspective !== "none" || o.contain === "paint" || ["transform", "perspective"].indexOf(o.willChange) !== -1 || e && o.willChange === "filter" || e && o.filter && o.filter !== "none")
            return a;
        a = a.parentNode
    }
    return null
}
function pt(t) {
    for (var e = L(t), r = Ft(t); r && Le(r) && V(r).position === "static"; )
        r = Ft(r);
    return r && (N(r) === "html" || N(r) === "body" && V(r).position === "static") ? e : r || Se(t) || e
}
function Ct(t) {
    return ["top", "bottom"].indexOf(t) >= 0 ? "x" : "y"
}
function ot(t, e, r) {
    return _(t, yt(e, r))
}
function $e(t, e, r) {
    var n = ot(t, e, r);
    return n > r ? r : n
}
function ae() {
    return {
        top: 0,
        right: 0,
        bottom: 0,
        left: 0
    }
}
function oe(t) {
    return Object.assign({}, ae(), t)
}
function ie(t, e) {
    return e.reduce(function(r, n) {
        return r[n] = t,
        r
    }, {})
}
var ke = function(e, r) {
    return e = typeof e == "function" ? e(Object.assign({}, r.rects, {
        placement: r.placement
    })) : e,
    oe(typeof e != "number" ? e : ie(e, ct))
};
function Me(t) {
    var e, r = t.state, n = t.name, a = t.options, o = r.elements.arrow, c = r.modifiersData.popperOffsets, s = H(r.placement), i = Ct(s), p = [R, k].indexOf(s) >= 0, f = p ? "height" : "width";
    if (!(!o || !c)) {
        var m = ke(a.padding, r)
          , y = jt(o)
          , u = i === "y" ? C : R
          , w = i === "y" ? $ : k
          , v = r.rects.reference[f] + r.rects.reference[i] - c[i] - r.rects.popper[f]
          , d = c[i] - r.rects.reference[i]
          , b = pt(o)
          , O = b ? i === "y" ? b.clientHeight || 0 : b.clientWidth || 0 : 0
          , E = v / 2 - d / 2
          , l = m[u]
          , h = O - y[f] - m[w]
          , g = O / 2 - y[f] / 2 + E
          , x = ot(l, g, h)
          , D = i;
        r.modifiersData[n] = (e = {},
        e[D] = x,
        e.centerOffset = x - g,
        e)
    }
}
function We(t) {
    var e = t.state
      , r = t.options
      , n = r.element
      , a = n === void 0 ? "[data-popper-arrow]" : n;
    a != null && (typeof a == "string" && (a = e.elements.popper.querySelector(a),
    !a) || ne(e.elements.popper, a) && (e.elements.arrow = a))
}
const He = {
    name: "arrow",
    enabled: !0,
    phase: "main",
    fn: Me,
    effect: We,
    requires: ["popperOffsets"],
    requiresIfExists: ["preventOverflow"]
};
function et(t) {
    return t.split("-")[1]
}
var Ne = {
    top: "auto",
    right: "auto",
    bottom: "auto",
    left: "auto"
};
function Ve(t, e) {
    var r = t.x
      , n = t.y
      , a = e.devicePixelRatio || 1;
    return {
        x: Z(r * a) / a || 0,
        y: Z(n * a) / a || 0
    }
}
function Xt(t) {
    var e, r = t.popper, n = t.popperRect, a = t.placement, o = t.variation, c = t.offsets, s = t.position, i = t.gpuAcceleration, p = t.adaptive, f = t.roundOffsets, m = t.isFixed, y = c.x, u = y === void 0 ? 0 : y, w = c.y, v = w === void 0 ? 0 : w, d = typeof f == "function" ? f({
        x: u,
        y: v
    }) : {
        x: u,
        y: v
    };
    u = d.x,
    v = d.y;
    var b = c.hasOwnProperty("x")
      , O = c.hasOwnProperty("y")
      , E = R
      , l = C
      , h = window;
    if (p) {
        var g = pt(r)
          , x = "clientHeight"
          , D = "clientWidth";
        if (g === L(r) && (g = q(r),
        V(g).position !== "static" && s === "absolute" && (x = "scrollHeight",
        D = "scrollWidth")),
        g = g,
        a === C || (a === R || a === k) && o === st) {
            l = $;
            var T = m && g === h && h.visualViewport ? h.visualViewport.height : g[x];
            v -= T - n.height,
            v *= i ? 1 : -1
        }
        if (a === R || (a === C || a === $) && o === st) {
            E = k;
            var A = m && g === h && h.visualViewport ? h.visualViewport.width : g[D];
            u -= A - n.width,
            u *= i ? 1 : -1
        }
    }
    var P = Object.assign({
        position: s
    }, p && Ne)
      , M = f === !0 ? Ve({
        x: u,
        y: v
    }, L(r)) : {
        x: u,
        y: v
    };
    if (u = M.x,
    v = M.y,
    i) {
        var j;
        return Object.assign({}, P, (j = {},
        j[l] = O ? "0" : "",
        j[E] = b ? "0" : "",
        j.transform = (h.devicePixelRatio || 1) <= 1 ? "translate(" + u + "px, " + v + "px)" : "translate3d(" + u + "px, " + v + "px, 0)",
        j))
    }
    return Object.assign({}, P, (e = {},
    e[l] = O ? v + "px" : "",
    e[E] = b ? u + "px" : "",
    e.transform = "",
    e))
}
function Ie(t) {
    var e = t.state
      , r = t.options
      , n = r.gpuAcceleration
      , a = n === void 0 ? !0 : n
      , o = r.adaptive
      , c = o === void 0 ? !0 : o
      , s = r.roundOffsets
      , i = s === void 0 ? !0 : s
      , p = {
        placement: H(e.placement),
        variation: et(e.placement),
        popper: e.elements.popper,
        popperRect: e.rects.popper,
        gpuAcceleration: a,
        isFixed: e.options.strategy === "fixed"
    };
    e.modifiersData.popperOffsets != null && (e.styles.popper = Object.assign({}, e.styles.popper, Xt(Object.assign({}, p, {
        offsets: e.modifiersData.popperOffsets,
        position: e.options.strategy,
        adaptive: c,
        roundOffsets: i
    })))),
    e.modifiersData.arrow != null && (e.styles.arrow = Object.assign({}, e.styles.arrow, Xt(Object.assign({}, p, {
        offsets: e.modifiersData.arrow,
        position: "absolute",
        adaptive: !1,
        roundOffsets: i
    })))),
    e.attributes.popper = Object.assign({}, e.attributes.popper, {
        "data-popper-placement": e.placement
    })
}
const qe = {
    name: "computeStyles",
    enabled: !0,
    phase: "beforeWrite",
    fn: Ie,
    data: {}
};
var ht = {
    passive: !0
};
function Fe(t) {
    var e = t.state
      , r = t.instance
      , n = t.options
      , a = n.scroll
      , o = a === void 0 ? !0 : a
      , c = n.resize
      , s = c === void 0 ? !0 : c
      , i = L(e.elements.popper)
      , p = [].concat(e.scrollParents.reference, e.scrollParents.popper);
    return o && p.forEach(function(f) {
        f.addEventListener("scroll", r.update, ht)
    }),
    s && i.addEventListener("resize", r.update, ht),
    function() {
        o && p.forEach(function(f) {
            f.removeEventListener("scroll", r.update, ht)
        }),
        s && i.removeEventListener("resize", r.update, ht)
    }
}
const Xe = {
    name: "eventListeners",
    enabled: !0,
    phase: "write",
    fn: function() {},
    effect: Fe,
    data: {}
};
var Ye = {
    left: "right",
    right: "left",
    bottom: "top",
    top: "bottom"
};
function gt(t) {
    return t.replace(/left|right|bottom|top/g, function(e) {
        return Ye[e]
    })
}
var ze = {
    start: "end",
    end: "start"
};
function Yt(t) {
    return t.replace(/start|end/g, function(e) {
        return ze[e]
    })
}
function Rt(t) {
    var e = L(t)
      , r = e.pageXOffset
      , n = e.pageYOffset;
    return {
        scrollLeft: r,
        scrollTop: n
    }
}
function Bt(t) {
    return tt(q(t)).left + Rt(t).scrollLeft
}
function Ue(t, e) {
    var r = L(t)
      , n = q(t)
      , a = r.visualViewport
      , o = n.clientWidth
      , c = n.clientHeight
      , s = 0
      , i = 0;
    if (a) {
        o = a.width,
        c = a.height;
        var p = re();
        (p || !p && e === "fixed") && (s = a.offsetLeft,
        i = a.offsetTop)
    }
    return {
        width: o,
        height: c,
        x: s + Bt(t),
        y: i
    }
}
function _e(t) {
    var e, r = q(t), n = Rt(t), a = (e = t.ownerDocument) == null ? void 0 : e.body, o = _(r.scrollWidth, r.clientWidth, a ? a.scrollWidth : 0, a ? a.clientWidth : 0), c = _(r.scrollHeight, r.clientHeight, a ? a.scrollHeight : 0, a ? a.clientHeight : 0), s = -n.scrollLeft + Bt(t), i = -n.scrollTop;
    return V(a || r).direction === "rtl" && (s += _(r.clientWidth, a ? a.clientWidth : 0) - o),
    {
        width: o,
        height: c,
        x: s,
        y: i
    }
}
function Lt(t) {
    var e = V(t)
      , r = e.overflow
      , n = e.overflowX
      , a = e.overflowY;
    return /auto|scroll|overlay|hidden/.test(r + a + n)
}
function se(t) {
    return ["html", "body", "#document"].indexOf(N(t)) >= 0 ? t.ownerDocument.body : S(t) && Lt(t) ? t : se(bt(t))
}
function it(t, e) {
    var r;
    e === void 0 && (e = []);
    var n = se(t)
      , a = n === ((r = t.ownerDocument) == null ? void 0 : r.body)
      , o = L(n)
      , c = a ? [o].concat(o.visualViewport || [], Lt(n) ? n : []) : n
      , s = e.concat(c);
    return a ? s : s.concat(it(bt(c)))
}
function Tt(t) {
    return Object.assign({}, t, {
        left: t.x,
        top: t.y,
        right: t.x + t.width,
        bottom: t.y + t.height
    })
}
function Je(t, e) {
    var r = tt(t, !1, e === "fixed");
    return r.top = r.top + t.clientTop,
    r.left = r.left + t.clientLeft,
    r.bottom = r.top + t.clientHeight,
    r.right = r.left + t.clientWidth,
    r.width = t.clientWidth,
    r.height = t.clientHeight,
    r.x = r.left,
    r.y = r.top,
    r
}
function zt(t, e, r) {
    return e === te ? Tt(Ue(t, r)) : J(e) ? Je(e, r) : Tt(_e(q(t)))
}
function Ge(t) {
    var e = it(bt(t))
      , r = ["absolute", "fixed"].indexOf(V(t).position) >= 0
      , n = r && S(t) ? pt(t) : t;
    return J(n) ? e.filter(function(a) {
        return J(a) && ne(a, n) && N(a) !== "body"
    }) : []
}
function Ke(t, e, r, n) {
    var a = e === "clippingParents" ? Ge(t) : [].concat(e)
      , o = [].concat(a, [r])
      , c = o[0]
      , s = o.reduce(function(i, p) {
        var f = zt(t, p, n);
        return i.top = _(f.top, i.top),
        i.right = yt(f.right, i.right),
        i.bottom = yt(f.bottom, i.bottom),
        i.left = _(f.left, i.left),
        i
    }, zt(t, c, n));
    return s.width = s.right - s.left,
    s.height = s.bottom - s.top,
    s.x = s.left,
    s.y = s.top,
    s
}
function fe(t) {
    var e = t.reference, r = t.element, n = t.placement, a = n ? H(n) : null, o = n ? et(n) : null, c = e.x + e.width / 2 - r.width / 2, s = e.y + e.height / 2 - r.height / 2, i;
    switch (a) {
    case C:
        i = {
            x: c,
            y: e.y - r.height
        };
        break;
    case $:
        i = {
            x: c,
            y: e.y + e.height
        };
        break;
    case k:
        i = {
            x: e.x + e.width,
            y: s
        };
        break;
    case R:
        i = {
            x: e.x - r.width,
            y: s
        };
        break;
    default:
        i = {
            x: e.x,
            y: e.y
        }
    }
    var p = a ? Ct(a) : null;
    if (p != null) {
        var f = p === "y" ? "height" : "width";
        switch (o) {
        case Q:
            i[p] = i[p] - (e[f] / 2 - r[f] / 2);
            break;
        case st:
            i[p] = i[p] + (e[f] / 2 - r[f] / 2);
            break
        }
    }
    return i
}
function ft(t, e) {
    e === void 0 && (e = {});
    var r = e
      , n = r.placement
      , a = n === void 0 ? t.placement : n
      , o = r.strategy
      , c = o === void 0 ? t.strategy : o
      , s = r.boundary
      , i = s === void 0 ? ge : s
      , p = r.rootBoundary
      , f = p === void 0 ? te : p
      , m = r.elementContext
      , y = m === void 0 ? at : m
      , u = r.altBoundary
      , w = u === void 0 ? !1 : u
      , v = r.padding
      , d = v === void 0 ? 0 : v
      , b = oe(typeof d != "number" ? d : ie(d, ct))
      , O = y === at ? ye : at
      , E = t.rects.popper
      , l = t.elements[w ? O : y]
      , h = Ke(J(l) ? l : l.contextElement || q(t.elements.popper), i, f, c)
      , g = tt(t.elements.reference)
      , x = fe({
        reference: g,
        element: E,
        strategy: "absolute",
        placement: a
    })
      , D = Tt(Object.assign({}, E, x))
      , T = y === at ? D : g
      , A = {
        top: h.top - T.top + b.top,
        bottom: T.bottom - h.bottom + b.bottom,
        left: h.left - T.left + b.left,
        right: T.right - h.right + b.right
    }
      , P = t.modifiersData.offset;
    if (y === at && P) {
        var M = P[a];
        Object.keys(A).forEach(function(j) {
            var F = [k, $].indexOf(j) >= 0 ? 1 : -1
              , X = [C, $].indexOf(j) >= 0 ? "y" : "x";
            A[j] += M[X] * F
        })
    }
    return A
}
function Qe(t, e) {
    e === void 0 && (e = {});
    var r = e
      , n = r.placement
      , a = r.boundary
      , o = r.rootBoundary
      , c = r.padding
      , s = r.flipVariations
      , i = r.allowedAutoPlacements
      , p = i === void 0 ? ee : i
      , f = et(n)
      , m = f ? s ? qt : qt.filter(function(w) {
        return et(w) === f
    }) : ct
      , y = m.filter(function(w) {
        return p.indexOf(w) >= 0
    });
    y.length === 0 && (y = m);
    var u = y.reduce(function(w, v) {
        return w[v] = ft(t, {
            placement: v,
            boundary: a,
            rootBoundary: o,
            padding: c
        })[H(v)],
        w
    }, {});
    return Object.keys(u).sort(function(w, v) {
        return u[w] - u[v]
    })
}
function Ze(t) {
    if (H(t) === Dt)
        return [];
    var e = gt(t);
    return [Yt(t), e, Yt(e)]
}
function tr(t) {
    var e = t.state
      , r = t.options
      , n = t.name;
    if (!e.modifiersData[n]._skip) {
        for (var a = r.mainAxis, o = a === void 0 ? !0 : a, c = r.altAxis, s = c === void 0 ? !0 : c, i = r.fallbackPlacements, p = r.padding, f = r.boundary, m = r.rootBoundary, y = r.altBoundary, u = r.flipVariations, w = u === void 0 ? !0 : u, v = r.allowedAutoPlacements, d = e.options.placement, b = H(d), O = b === d, E = i || (O || !w ? [gt(d)] : Ze(d)), l = [d].concat(E).reduce(function(G, I) {
            return G.concat(H(I) === Dt ? Qe(e, {
                placement: I,
                boundary: f,
                rootBoundary: m,
                padding: p,
                flipVariations: w,
                allowedAutoPlacements: v
            }) : I)
        }, []), h = e.rects.reference, g = e.rects.popper, x = new Map, D = !0, T = l[0], A = 0; A < l.length; A++) {
            var P = l[A]
              , M = H(P)
              , j = et(P) === Q
              , F = [C, $].indexOf(M) >= 0
              , X = F ? "width" : "height"
              , B = ft(e, {
                placement: P,
                boundary: f,
                rootBoundary: m,
                altBoundary: y,
                padding: p
            })
              , W = F ? j ? k : R : j ? $ : C;
            h[X] > g[X] && (W = gt(W));
            var ut = gt(W)
              , Y = [];
            if (o && Y.push(B[M] <= 0),
            s && Y.push(B[W] <= 0, B[ut] <= 0),
            Y.every(function(G) {
                return G
            })) {
                T = P,
                D = !1;
                break
            }
            x.set(P, Y)
        }
        if (D)
            for (var lt = w ? 3 : 1, wt = function(I) {
                var nt = l.find(function(vt) {
                    var z = x.get(vt);
                    if (z)
                        return z.slice(0, I).every(function(xt) {
                            return xt
                        })
                });
                if (nt)
                    return T = nt,
                    "break"
            }, rt = lt; rt > 0; rt--) {
                var dt = wt(rt);
                if (dt === "break")
                    break
            }
        e.placement !== T && (e.modifiersData[n]._skip = !0,
        e.placement = T,
        e.reset = !0)
    }
}
const er = {
    name: "flip",
    enabled: !0,
    phase: "main",
    fn: tr,
    requiresIfExists: ["offset"],
    data: {
        _skip: !1
    }
};
function Ut(t, e, r) {
    return r === void 0 && (r = {
        x: 0,
        y: 0
    }),
    {
        top: t.top - e.height - r.y,
        right: t.right - e.width + r.x,
        bottom: t.bottom - e.height + r.y,
        left: t.left - e.width - r.x
    }
}
function Jt(t) {
    return [C, k, $, R].some(function(e) {
        return t[e] >= 0
    })
}
function rr(t) {
    var e = t.state
      , r = t.name
      , n = e.rects.reference
      , a = e.rects.popper
      , o = e.modifiersData.preventOverflow
      , c = ft(e, {
        elementContext: "reference"
    })
      , s = ft(e, {
        altBoundary: !0
    })
      , i = Ut(c, n)
      , p = Ut(s, a, o)
      , f = Jt(i)
      , m = Jt(p);
    e.modifiersData[r] = {
        referenceClippingOffsets: i,
        popperEscapeOffsets: p,
        isReferenceHidden: f,
        hasPopperEscaped: m
    },
    e.attributes.popper = Object.assign({}, e.attributes.popper, {
        "data-popper-reference-hidden": f,
        "data-popper-escaped": m
    })
}
const nr = {
    name: "hide",
    enabled: !0,
    phase: "main",
    requiresIfExists: ["preventOverflow"],
    fn: rr
};
function ar(t, e, r) {
    var n = H(t)
      , a = [R, C].indexOf(n) >= 0 ? -1 : 1
      , o = typeof r == "function" ? r(Object.assign({}, e, {
        placement: t
    })) : r
      , c = o[0]
      , s = o[1];
    return c = c || 0,
    s = (s || 0) * a,
    [R, k].indexOf(n) >= 0 ? {
        x: s,
        y: c
    } : {
        x: c,
        y: s
    }
}
function or(t) {
    var e = t.state
      , r = t.options
      , n = t.name
      , a = r.offset
      , o = a === void 0 ? [0, 0] : a
      , c = ee.reduce(function(f, m) {
        return f[m] = ar(m, e.rects, o),
        f
    }, {})
      , s = c[e.placement]
      , i = s.x
      , p = s.y;
    e.modifiersData.popperOffsets != null && (e.modifiersData.popperOffsets.x += i,
    e.modifiersData.popperOffsets.y += p),
    e.modifiersData[n] = c
}
const ir = {
    name: "offset",
    enabled: !0,
    phase: "main",
    requires: ["popperOffsets"],
    fn: or
};
function sr(t) {
    var e = t.state
      , r = t.name;
    e.modifiersData[r] = fe({
        reference: e.rects.reference,
        element: e.rects.popper,
        strategy: "absolute",
        placement: e.placement
    })
}
const fr = {
    name: "popperOffsets",
    enabled: !0,
    phase: "read",
    fn: sr,
    data: {}
};
function cr(t) {
    return t === "x" ? "y" : "x"
}
function pr(t) {
    var e = t.state
      , r = t.options
      , n = t.name
      , a = r.mainAxis
      , o = a === void 0 ? !0 : a
      , c = r.altAxis
      , s = c === void 0 ? !1 : c
      , i = r.boundary
      , p = r.rootBoundary
      , f = r.altBoundary
      , m = r.padding
      , y = r.tether
      , u = y === void 0 ? !0 : y
      , w = r.tetherOffset
      , v = w === void 0 ? 0 : w
      , d = ft(e, {
        boundary: i,
        rootBoundary: p,
        padding: m,
        altBoundary: f
    })
      , b = H(e.placement)
      , O = et(e.placement)
      , E = !O
      , l = Ct(b)
      , h = cr(l)
      , g = e.modifiersData.popperOffsets
      , x = e.rects.reference
      , D = e.rects.popper
      , T = typeof v == "function" ? v(Object.assign({}, e.rects, {
        placement: e.placement
    })) : v
      , A = typeof T == "number" ? {
        mainAxis: T,
        altAxis: T
    } : Object.assign({
        mainAxis: 0,
        altAxis: 0
    }, T)
      , P = e.modifiersData.offset ? e.modifiersData.offset[e.placement] : null
      , M = {
        x: 0,
        y: 0
    };
    if (g) {
        if (o) {
            var j, F = l === "y" ? C : R, X = l === "y" ? $ : k, B = l === "y" ? "height" : "width", W = g[l], ut = W + d[F], Y = W - d[X], lt = u ? -D[B] / 2 : 0, wt = O === Q ? x[B] : D[B], rt = O === Q ? -D[B] : -x[B], dt = e.elements.arrow, G = u && dt ? jt(dt) : {
                width: 0,
                height: 0
            }, I = e.modifiersData["arrow#persistent"] ? e.modifiersData["arrow#persistent"].padding : ae(), nt = I[F], vt = I[X], z = ot(0, x[B], G[B]), xt = E ? x[B] / 2 - lt - z - nt - A.mainAxis : wt - z - nt - A.mainAxis, ue = E ? -x[B] / 2 + lt + z + vt + A.mainAxis : rt + z + vt + A.mainAxis, Ot = e.elements.arrow && pt(e.elements.arrow), le = Ot ? l === "y" ? Ot.clientTop || 0 : Ot.clientLeft || 0 : 0, St = (j = P == null ? void 0 : P[l]) != null ? j : 0, de = W + xt - St - le, ve = W + ue - St, $t = ot(u ? yt(ut, de) : ut, W, u ? _(Y, ve) : Y);
            g[l] = $t,
            M[l] = $t - W
        }
        if (s) {
            var kt, me = l === "x" ? C : R, he = l === "x" ? $ : k, U = g[h], mt = h === "y" ? "height" : "width", Mt = U + d[me], Wt = U - d[he], Et = [C, R].indexOf(b) !== -1, Ht = (kt = P == null ? void 0 : P[h]) != null ? kt : 0, Nt = Et ? Mt : U - x[mt] - D[mt] - Ht + A.altAxis, Vt = Et ? U + x[mt] + D[mt] - Ht - A.altAxis : Wt, It = u && Et ? $e(Nt, U, Vt) : ot(u ? Nt : Mt, U, u ? Vt : Wt);
            g[h] = It,
            M[h] = It - U
        }
        e.modifiersData[n] = M
    }
}
const ur = {
    name: "preventOverflow",
    enabled: !0,
    phase: "main",
    fn: pr,
    requiresIfExists: ["offset"]
};
function lr(t) {
    return {
        scrollLeft: t.scrollLeft,
        scrollTop: t.scrollTop
    }
}
function dr(t) {
    return t === L(t) || !S(t) ? Rt(t) : lr(t)
}
function vr(t) {
    var e = t.getBoundingClientRect()
      , r = Z(e.width) / t.offsetWidth || 1
      , n = Z(e.height) / t.offsetHeight || 1;
    return r !== 1 || n !== 1
}
function mr(t, e, r) {
    r === void 0 && (r = !1);
    var n = S(e)
      , a = S(e) && vr(e)
      , o = q(e)
      , c = tt(t, a, r)
      , s = {
        scrollLeft: 0,
        scrollTop: 0
    }
      , i = {
        x: 0,
        y: 0
    };
    return (n || !n && !r) && ((N(e) !== "body" || Lt(o)) && (s = dr(e)),
    S(e) ? (i = tt(e, !0),
    i.x += e.clientLeft,
    i.y += e.clientTop) : o && (i.x = Bt(o))),
    {
        x: c.left + s.scrollLeft - i.x,
        y: c.top + s.scrollTop - i.y,
        width: c.width,
        height: c.height
    }
}
function hr(t) {
    var e = new Map
      , r = new Set
      , n = [];
    t.forEach(function(o) {
        e.set(o.name, o)
    });
    function a(o) {
        r.add(o.name);
        var c = [].concat(o.requires || [], o.requiresIfExists || []);
        c.forEach(function(s) {
            if (!r.has(s)) {
                var i = e.get(s);
                i && a(i)
            }
        }),
        n.push(o)
    }
    return t.forEach(function(o) {
        r.has(o.name) || a(o)
    }),
    n
}
function gr(t) {
    var e = hr(t);
    return je.reduce(function(r, n) {
        return r.concat(e.filter(function(a) {
            return a.phase === n
        }))
    }, [])
}
function yr(t) {
    var e;
    return function() {
        return e || (e = new Promise(function(r) {
            Promise.resolve().then(function() {
                e = void 0,
                r(t())
            })
        }
        )),
        e
    }
}
function br(t) {
    var e = t.reduce(function(r, n) {
        var a = r[n.name];
        return r[n.name] = a ? Object.assign({}, a, n, {
            options: Object.assign({}, a.options, n.options),
            data: Object.assign({}, a.data, n.data)
        }) : n,
        r
    }, {});
    return Object.keys(e).map(function(r) {
        return e[r]
    })
}
var Gt = {
    placement: "bottom",
    modifiers: [],
    strategy: "absolute"
};
function Kt() {
    for (var t = arguments.length, e = new Array(t), r = 0; r < t; r++)
        e[r] = arguments[r];
    return !e.some(function(n) {
        return !(n && typeof n.getBoundingClientRect == "function")
    })
}
function wr(t) {
    t === void 0 && (t = {});
    var e = t
      , r = e.defaultModifiers
      , n = r === void 0 ? [] : r
      , a = e.defaultOptions
      , o = a === void 0 ? Gt : a;
    return function(s, i, p) {
        p === void 0 && (p = o);
        var f = {
            placement: "bottom",
            orderedModifiers: [],
            options: Object.assign({}, Gt, o),
            modifiersData: {},
            elements: {
                reference: s,
                popper: i
            },
            attributes: {},
            styles: {}
        }
          , m = []
          , y = !1
          , u = {
            state: f,
            setOptions: function(b) {
                var O = typeof b == "function" ? b(f.options) : b;
                v(),
                f.options = Object.assign({}, o, f.options, O),
                f.scrollParents = {
                    reference: J(s) ? it(s) : s.contextElement ? it(s.contextElement) : [],
                    popper: it(i)
                };
                var E = gr(br([].concat(n, f.options.modifiers)));
                return f.orderedModifiers = E.filter(function(l) {
                    return l.enabled
                }),
                w(),
                u.update()
            },
            forceUpdate: function() {
                if (!y) {
                    var b = f.elements
                      , O = b.reference
                      , E = b.popper;
                    if (Kt(O, E)) {
                        f.rects = {
                            reference: mr(O, pt(E), f.options.strategy === "fixed"),
                            popper: jt(E)
                        },
                        f.reset = !1,
                        f.placement = f.options.placement,
                        f.orderedModifiers.forEach(function(A) {
                            return f.modifiersData[A.name] = Object.assign({}, A.data)
                        });
                        for (var l = 0; l < f.orderedModifiers.length; l++) {
                            if (f.reset === !0) {
                                f.reset = !1,
                                l = -1;
                                continue
                            }
                            var h = f.orderedModifiers[l]
                              , g = h.fn
                              , x = h.options
                              , D = x === void 0 ? {} : x
                              , T = h.name;
                            typeof g == "function" && (f = g({
                                state: f,
                                options: D,
                                name: T,
                                instance: u
                            }) || f)
                        }
                    }
                }
            },
            update: yr(function() {
                return new Promise(function(d) {
                    u.forceUpdate(),
                    d(f)
                }
                )
            }),
            destroy: function() {
                v(),
                y = !0
            }
        };
        if (!Kt(s, i))
            return u;
        u.setOptions(p).then(function(d) {
            !y && p.onFirstUpdate && p.onFirstUpdate(d)
        });
        function w() {
            f.orderedModifiers.forEach(function(d) {
                var b = d.name
                  , O = d.options
                  , E = O === void 0 ? {} : O
                  , l = d.effect;
                if (typeof l == "function") {
                    var h = l({
                        state: f,
                        name: b,
                        instance: u,
                        options: E
                    })
                      , g = function() {};
                    m.push(h || g)
                }
            })
        }
        function v() {
            m.forEach(function(d) {
                return d()
            }),
            m = []
        }
        return u
    }
}
var xr = [Xe, fr, qe, Be, ir, er, ur, He, nr]
  , Or = wr({
    defaultModifiers: xr
});
let ce, pe = !1;
const Er = new Date().getTime()
  , Ar = 10
  , K = document.getElementById("download")
  , Qt = () => {
    let e = new Date().getTime() - Er
      , r = ""
      , n = Ar - Math.floor(e / 1e3);
    if (n >= 0) {
        let a = Math.floor(n / 3600)
          , o = Math.floor((n - a * 3600) / 60);
        n -= o * 60,
        n < 10,
        r = r + "" + n,
        K.innerText = "Your file ready in " + r + "s"
    } else
        pe = !0,
        K.classList.remove("bg-blue-400"),
        K.classList.add("bg-green-600"),
        K.innerText = "Download file",
        clearInterval(ce)
}
;
(async function() {
    if (typeof __cau < "u" && __cau === 1) {
        const t = "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js";
        (await fetch(t, {
            method: "HEAD"
        })).url !== t && fetch(location.pathname + "/event", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                _token: _t,
                _a: uid,
                _b: 1
            })
        })
    }
}
)();
K && (Qt(),
ce = setInterval(Qt, 500),
K.addEventListener("click", t => {
    pe && (t.currentTarget.removeAttribute("onclick"),
    t.currentTarget.classList.remove("bg-green-600"),
    t.currentTarget.classList.add("bg-blue-400"),
    t.currentTarget.innerText = "Downloading...",
    t.currentTarget.disabled = !0,
    location.href = "/download/file/" + uid + "/" + location.pathname.split("/")[2])
}
));
const Tr = ["mouseenter", "focus"]
  , Dr = ["mouseleave", "blur"];
[...document.querySelectorAll("[data-tooltip]")].map(t => {
    const e = document.createElement("div");
    e.setAttribute("data-popper-arrow", "");
    const r = document.createElement("div");
    r.setAttribute("role", "tooltip"),
    r.innerHTML = t.getAttribute("data-tooltip"),
    r.appendChild(e);
    const n = Or(t, r, {
        placement: "top",
        modifiers: [{
            name: "offset",
            options: {
                offset: [0, 8]
            }
        }]
    });
    Tr.forEach(a => {
        t.addEventListener(a, () => {
            t.insertAdjacentElement("afterend", r),
            n.update()
        }
        )
    }
    ),
    Dr.forEach(a => {
        t.addEventListener(a, () => {
            r.remove()
        }
        )
    }
    )
}
);
function Zt(t) {
    fetch(location.pathname + "/event", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            _token: _t,
            _a: uid,
            _b: t
        })
    })
}
document.addEventListener("DOMContentLoaded", function() {
    window.focus();
    let t;
    window.addEventListener("blur", () => {
        clearTimeout(t),
        t = setTimeout( () => {
            const e = document.activeElement;
            e.tagName === "IFRAME" && e.closest(".cHNI") && (Zt(2),
            window.focus())
        }
        , 100)
    }
    ),
    setTimeout( () => {
        var e, r;
        (r = (e = document.getElementById("download")) == null ? void 0 : e.nextElementSibling.querySelector("a")) == null || r.addEventListener("click", function() {
            Zt(3)
        })
    }
    , 100)
});
_cv && setTimeout( () => {
    fetch(location.pathname + "/event", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            _token: _t,
            _b: 4
        })
    })
}
, 5e3);
