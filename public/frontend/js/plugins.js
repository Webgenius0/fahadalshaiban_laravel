/*!
 * Bootstrap v5.3.2 (https://getbootstrap.com/)
 * Copyright 2011-2023 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 */
!(function (t, e) {
    "object" == typeof exports && "undefined" != typeof module
        ? (module.exports = e(require("@popperjs/core")))
        : "function" == typeof define && define.amd
        ? define(["@popperjs/core"], e)
        : ((t =
              "undefined" != typeof globalThis
                  ? globalThis
                  : t || self).bootstrap = e(t.Popper));
})(this, function (t) {
    "use strict";
    function e(t) {
        const e = Object.create(null, {
            [Symbol.toStringTag]: { value: "Module" },
        });
        if (t)
            for (const i in t)
                if ("default" !== i) {
                    const s = Object.getOwnPropertyDescriptor(t, i);
                    Object.defineProperty(
                        e,
                        i,
                        s.get ? s : { enumerable: !0, get: () => t[i] }
                    );
                }
        return (e.default = t), Object.freeze(e);
    }
    const i = e(t),
        s = new Map(),
        n = {
            set(t, e, i) {
                s.has(t) || s.set(t, new Map());
                const n = s.get(t);
                n.has(e) || 0 === n.size
                    ? n.set(e, i)
                    : console.error(
                          `Bootstrap doesn't allow more than one instance per element. Bound instance: ${
                              Array.from(n.keys())[0]
                          }.`
                      );
            },
            get: (t, e) => (s.has(t) && s.get(t).get(e)) || null,
            remove(t, e) {
                if (!s.has(t)) return;
                const i = s.get(t);
                i.delete(e), 0 === i.size && s.delete(t);
            },
        },
        o = "transitionend",
        r = (t) => (
            t &&
                window.CSS &&
                window.CSS.escape &&
                (t = t.replace(/#([^\s"#']+)/g, (t, e) => `#${CSS.escape(e)}`)),
            t
        ),
        a = (t) => {
            t.dispatchEvent(new Event(o));
        },
        l = (t) =>
            !(!t || "object" != typeof t) &&
            (void 0 !== t.jquery && (t = t[0]), void 0 !== t.nodeType),
        c = (t) =>
            l(t)
                ? t.jquery
                    ? t[0]
                    : t
                : "string" == typeof t && t.length > 0
                ? document.querySelector(r(t))
                : null,
        h = (t) => {
            if (!l(t) || 0 === t.getClientRects().length) return !1;
            const e =
                    "visible" ===
                    getComputedStyle(t).getPropertyValue("visibility"),
                i = t.closest("details:not([open])");
            if (!i) return e;
            if (i !== t) {
                const e = t.closest("summary");
                if (e && e.parentNode !== i) return !1;
                if (null === e) return !1;
            }
            return e;
        },
        d = (t) =>
            !t ||
            t.nodeType !== Node.ELEMENT_NODE ||
            !!t.classList.contains("disabled") ||
            (void 0 !== t.disabled
                ? t.disabled
                : t.hasAttribute("disabled") &&
                  "false" !== t.getAttribute("disabled")),
        u = (t) => {
            if (!document.documentElement.attachShadow) return null;
            if ("function" == typeof t.getRootNode) {
                const e = t.getRootNode();
                return e instanceof ShadowRoot ? e : null;
            }
            return t instanceof ShadowRoot
                ? t
                : t.parentNode
                ? u(t.parentNode)
                : null;
        },
        _ = () => {},
        g = (t) => {
            t.offsetHeight;
        },
        f = () =>
            window.jQuery && !document.body.hasAttribute("data-bs-no-jquery")
                ? window.jQuery
                : null,
        m = [],
        p = () => "rtl" === document.documentElement.dir,
        b = (t) => {
            var e;
            (e = () => {
                const e = f();
                if (e) {
                    const i = t.NAME,
                        s = e.fn[i];
                    (e.fn[i] = t.jQueryInterface),
                        (e.fn[i].Constructor = t),
                        (e.fn[i].noConflict = () => (
                            (e.fn[i] = s), t.jQueryInterface
                        ));
                }
            }),
                "loading" === document.readyState
                    ? (m.length ||
                          document.addEventListener("DOMContentLoaded", () => {
                              for (const t of m) t();
                          }),
                      m.push(e))
                    : e();
        },
        v = (t, e = [], i = t) => ("function" == typeof t ? t(...e) : i),
        y = (t, e, i = !0) => {
            if (!i) return void v(t);
            const s =
                ((t) => {
                    if (!t) return 0;
                    let { transitionDuration: e, transitionDelay: i } =
                        window.getComputedStyle(t);
                    const s = Number.parseFloat(e),
                        n = Number.parseFloat(i);
                    return s || n
                        ? ((e = e.split(",")[0]),
                          (i = i.split(",")[0]),
                          1e3 * (Number.parseFloat(e) + Number.parseFloat(i)))
                        : 0;
                })(e) + 5;
            let n = !1;
            const r = ({ target: i }) => {
                i === e && ((n = !0), e.removeEventListener(o, r), v(t));
            };
            e.addEventListener(o, r),
                setTimeout(() => {
                    n || a(e);
                }, s);
        },
        w = (t, e, i, s) => {
            const n = t.length;
            let o = t.indexOf(e);
            return -1 === o
                ? !i && s
                    ? t[n - 1]
                    : t[0]
                : ((o += i ? 1 : -1),
                  s && (o = (o + n) % n),
                  t[Math.max(0, Math.min(o, n - 1))]);
        },
        A = /[^.]*(?=\..*)\.|.*/,
        E = /\..*/,
        C = /::\d+$/,
        T = {};
    let k = 1;
    const $ = { mouseenter: "mouseover", mouseleave: "mouseout" },
        S = new Set([
            "click",
            "dblclick",
            "mouseup",
            "mousedown",
            "contextmenu",
            "mousewheel",
            "DOMMouseScroll",
            "mouseover",
            "mouseout",
            "mousemove",
            "selectstart",
            "selectend",
            "keydown",
            "keypress",
            "keyup",
            "orientationchange",
            "touchstart",
            "touchmove",
            "touchend",
            "touchcancel",
            "pointerdown",
            "pointermove",
            "pointerup",
            "pointerleave",
            "pointercancel",
            "gesturestart",
            "gesturechange",
            "gestureend",
            "focus",
            "blur",
            "change",
            "reset",
            "select",
            "submit",
            "focusin",
            "focusout",
            "load",
            "unload",
            "beforeunload",
            "resize",
            "move",
            "DOMContentLoaded",
            "readystatechange",
            "error",
            "abort",
            "scroll",
        ]);
    function L(t, e) {
        return (e && `${e}::${k++}`) || t.uidEvent || k++;
    }
    function O(t) {
        const e = L(t);
        return (t.uidEvent = e), (T[e] = T[e] || {}), T[e];
    }
    function I(t, e, i = null) {
        return Object.values(t).find(
            (t) => t.callable === e && t.delegationSelector === i
        );
    }
    function D(t, e, i) {
        const s = "string" == typeof e,
            n = s ? i : e || i;
        let o = M(t);
        return S.has(o) || (o = t), [s, n, o];
    }
    function N(t, e, i, s, n) {
        if ("string" != typeof e || !t) return;
        let [o, r, a] = D(e, i, s);
        if (e in $) {
            const t = (t) =>
                function (e) {
                    if (
                        !e.relatedTarget ||
                        (e.relatedTarget !== e.delegateTarget &&
                            !e.delegateTarget.contains(e.relatedTarget))
                    )
                        return t.call(this, e);
                };
            r = t(r);
        }
        const l = O(t),
            c = l[a] || (l[a] = {}),
            h = I(c, r, o ? i : null);
        if (h) return void (h.oneOff = h.oneOff && n);
        const d = L(r, e.replace(A, "")),
            u = o
                ? (function (t, e, i) {
                      return function s(n) {
                          const o = t.querySelectorAll(e);
                          for (
                              let { target: r } = n;
                              r && r !== this;
                              r = r.parentNode
                          )
                              for (const a of o)
                                  if (a === r)
                                      return (
                                          F(n, { delegateTarget: r }),
                                          s.oneOff && j.off(t, n.type, e, i),
                                          i.apply(r, [n])
                                      );
                      };
                  })(t, i, r)
                : (function (t, e) {
                      return function i(s) {
                          return (
                              F(s, { delegateTarget: t }),
                              i.oneOff && j.off(t, s.type, e),
                              e.apply(t, [s])
                          );
                      };
                  })(t, r);
        (u.delegationSelector = o ? i : null),
            (u.callable = r),
            (u.oneOff = n),
            (u.uidEvent = d),
            (c[d] = u),
            t.addEventListener(a, u, o);
    }
    function P(t, e, i, s, n) {
        const o = I(e[i], s, n);
        o && (t.removeEventListener(i, o, Boolean(n)), delete e[i][o.uidEvent]);
    }
    function x(t, e, i, s) {
        const n = e[i] || {};
        for (const [o, r] of Object.entries(n))
            o.includes(s) && P(t, e, i, r.callable, r.delegationSelector);
    }
    function M(t) {
        return (t = t.replace(E, "")), $[t] || t;
    }
    const j = {
        on(t, e, i, s) {
            N(t, e, i, s, !1);
        },
        one(t, e, i, s) {
            N(t, e, i, s, !0);
        },
        off(t, e, i, s) {
            if ("string" != typeof e || !t) return;
            const [n, o, r] = D(e, i, s),
                a = r !== e,
                l = O(t),
                c = l[r] || {},
                h = e.startsWith(".");
            if (void 0 === o) {
                if (h) for (const i of Object.keys(l)) x(t, l, i, e.slice(1));
                for (const [i, s] of Object.entries(c)) {
                    const n = i.replace(C, "");
                    (a && !e.includes(n)) ||
                        P(t, l, r, s.callable, s.delegationSelector);
                }
            } else {
                if (!Object.keys(c).length) return;
                P(t, l, r, o, n ? i : null);
            }
        },
        trigger(t, e, i) {
            if ("string" != typeof e || !t) return null;
            const s = f();
            let n = null,
                o = !0,
                r = !0,
                a = !1;
            e !== M(e) &&
                s &&
                ((n = s.Event(e, i)),
                s(t).trigger(n),
                (o = !n.isPropagationStopped()),
                (r = !n.isImmediatePropagationStopped()),
                (a = n.isDefaultPrevented()));
            const l = F(new Event(e, { bubbles: o, cancelable: !0 }), i);
            return (
                a && l.preventDefault(),
                r && t.dispatchEvent(l),
                l.defaultPrevented && n && n.preventDefault(),
                l
            );
        },
    };
    function F(t, e = {}) {
        for (const [i, s] of Object.entries(e))
            try {
                t[i] = s;
            } catch (e) {
                Object.defineProperty(t, i, { configurable: !0, get: () => s });
            }
        return t;
    }
    function z(t) {
        if ("true" === t) return !0;
        if ("false" === t) return !1;
        if (t === Number(t).toString()) return Number(t);
        if ("" === t || "null" === t) return null;
        if ("string" != typeof t) return t;
        try {
            return JSON.parse(decodeURIComponent(t));
        } catch (e) {
            return t;
        }
    }
    function H(t) {
        return t.replace(/[A-Z]/g, (t) => `-${t.toLowerCase()}`);
    }
    const B = {
        setDataAttribute(t, e, i) {
            t.setAttribute(`data-bs-${H(e)}`, i);
        },
        removeDataAttribute(t, e) {
            t.removeAttribute(`data-bs-${H(e)}`);
        },
        getDataAttributes(t) {
            if (!t) return {};
            const e = {},
                i = Object.keys(t.dataset).filter(
                    (t) => t.startsWith("bs") && !t.startsWith("bsConfig")
                );
            for (const s of i) {
                let i = s.replace(/^bs/, "");
                (i = i.charAt(0).toLowerCase() + i.slice(1, i.length)),
                    (e[i] = z(t.dataset[s]));
            }
            return e;
        },
        getDataAttribute: (t, e) => z(t.getAttribute(`data-bs-${H(e)}`)),
    };
    class q {
        static get Default() {
            return {};
        }
        static get DefaultType() {
            return {};
        }
        static get NAME() {
            throw new Error(
                'You have to implement the static method "NAME", for each component!'
            );
        }
        _getConfig(t) {
            return (
                (t = this._mergeConfigObj(t)),
                (t = this._configAfterMerge(t)),
                this._typeCheckConfig(t),
                t
            );
        }
        _configAfterMerge(t) {
            return t;
        }
        _mergeConfigObj(t, e) {
            const i = l(e) ? B.getDataAttribute(e, "config") : {};
            return {
                ...this.constructor.Default,
                ...("object" == typeof i ? i : {}),
                ...(l(e) ? B.getDataAttributes(e) : {}),
                ...("object" == typeof t ? t : {}),
            };
        }
        _typeCheckConfig(t, e = this.constructor.DefaultType) {
            for (const [s, n] of Object.entries(e)) {
                const e = t[s],
                    o = l(e)
                        ? "element"
                        : null == (i = e)
                        ? `${i}`
                        : Object.prototype.toString
                              .call(i)
                              .match(/\s([a-z]+)/i)[1]
                              .toLowerCase();
                if (!new RegExp(n).test(o))
                    throw new TypeError(
                        `${this.constructor.NAME.toUpperCase()}: Option "${s}" provided type "${o}" but expected type "${n}".`
                    );
            }
            var i;
        }
    }
    class W extends q {
        constructor(t, e) {
            super(),
                (t = c(t)) &&
                    ((this._element = t),
                    (this._config = this._getConfig(e)),
                    n.set(this._element, this.constructor.DATA_KEY, this));
        }
        dispose() {
            n.remove(this._element, this.constructor.DATA_KEY),
                j.off(this._element, this.constructor.EVENT_KEY);
            for (const t of Object.getOwnPropertyNames(this)) this[t] = null;
        }
        _queueCallback(t, e, i = !0) {
            y(t, e, i);
        }
        _getConfig(t) {
            return (
                (t = this._mergeConfigObj(t, this._element)),
                (t = this._configAfterMerge(t)),
                this._typeCheckConfig(t),
                t
            );
        }
        static getInstance(t) {
            return n.get(c(t), this.DATA_KEY);
        }
        static getOrCreateInstance(t, e = {}) {
            return (
                this.getInstance(t) ||
                new this(t, "object" == typeof e ? e : null)
            );
        }
        static get VERSION() {
            return "5.3.2";
        }
        static get DATA_KEY() {
            return `bs.${this.NAME}`;
        }
        static get EVENT_KEY() {
            return `.${this.DATA_KEY}`;
        }
        static eventName(t) {
            return `${t}${this.EVENT_KEY}`;
        }
    }
    const R = (t) => {
            let e = t.getAttribute("data-bs-target");
            if (!e || "#" === e) {
                let i = t.getAttribute("href");
                if (!i || (!i.includes("#") && !i.startsWith("."))) return null;
                i.includes("#") &&
                    !i.startsWith("#") &&
                    (i = `#${i.split("#")[1]}`),
                    (e = i && "#" !== i ? r(i.trim()) : null);
            }
            return e;
        },
        K = {
            find: (t, e = document.documentElement) =>
                [].concat(...Element.prototype.querySelectorAll.call(e, t)),
            findOne: (t, e = document.documentElement) =>
                Element.prototype.querySelector.call(e, t),
            children: (t, e) =>
                [].concat(...t.children).filter((t) => t.matches(e)),
            parents(t, e) {
                const i = [];
                let s = t.parentNode.closest(e);
                for (; s; ) i.push(s), (s = s.parentNode.closest(e));
                return i;
            },
            prev(t, e) {
                let i = t.previousElementSibling;
                for (; i; ) {
                    if (i.matches(e)) return [i];
                    i = i.previousElementSibling;
                }
                return [];
            },
            next(t, e) {
                let i = t.nextElementSibling;
                for (; i; ) {
                    if (i.matches(e)) return [i];
                    i = i.nextElementSibling;
                }
                return [];
            },
            focusableChildren(t) {
                const e = [
                    "a",
                    "button",
                    "input",
                    "textarea",
                    "select",
                    "details",
                    "[tabindex]",
                    '[contenteditable="true"]',
                ]
                    .map((t) => `${t}:not([tabindex^="-"])`)
                    .join(",");
                return this.find(e, t).filter((t) => !d(t) && h(t));
            },
            getSelectorFromElement(t) {
                const e = R(t);
                return e && K.findOne(e) ? e : null;
            },
            getElementFromSelector(t) {
                const e = R(t);
                return e ? K.findOne(e) : null;
            },
            getMultipleElementsFromSelector(t) {
                const e = R(t);
                return e ? K.find(e) : [];
            },
        },
        V = (t, e = "hide") => {
            const i = `click.dismiss${t.EVENT_KEY}`,
                s = t.NAME;
            j.on(document, i, `[data-bs-dismiss="${s}"]`, function (i) {
                if (
                    (["A", "AREA"].includes(this.tagName) && i.preventDefault(),
                    d(this))
                )
                    return;
                const n =
                    K.getElementFromSelector(this) || this.closest(`.${s}`);
                t.getOrCreateInstance(n)[e]();
            });
        },
        Q = ".bs.alert",
        X = `close${Q}`,
        Y = `closed${Q}`;
    class U extends W {
        static get NAME() {
            return "alert";
        }
        close() {
            if (j.trigger(this._element, X).defaultPrevented) return;
            this._element.classList.remove("show");
            const t = this._element.classList.contains("fade");
            this._queueCallback(() => this._destroyElement(), this._element, t);
        }
        _destroyElement() {
            this._element.remove(), j.trigger(this._element, Y), this.dispose();
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = U.getOrCreateInstance(this);
                if ("string" == typeof t) {
                    if (
                        void 0 === e[t] ||
                        t.startsWith("_") ||
                        "constructor" === t
                    )
                        throw new TypeError(`No method named "${t}"`);
                    e[t](this);
                }
            });
        }
    }
    V(U, "close"), b(U);
    const G = '[data-bs-toggle="button"]';
    class J extends W {
        static get NAME() {
            return "button";
        }
        toggle() {
            this._element.setAttribute(
                "aria-pressed",
                this._element.classList.toggle("active")
            );
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = J.getOrCreateInstance(this);
                "toggle" === t && e[t]();
            });
        }
    }
    j.on(document, "click.bs.button.data-api", G, (t) => {
        t.preventDefault();
        const e = t.target.closest(G);
        J.getOrCreateInstance(e).toggle();
    }),
        b(J);
    const Z = ".bs.swipe",
        tt = `touchstart${Z}`,
        et = `touchmove${Z}`,
        it = `touchend${Z}`,
        st = `pointerdown${Z}`,
        nt = `pointerup${Z}`,
        ot = { endCallback: null, leftCallback: null, rightCallback: null },
        rt = {
            endCallback: "(function|null)",
            leftCallback: "(function|null)",
            rightCallback: "(function|null)",
        };
    class at extends q {
        constructor(t, e) {
            super(),
                (this._element = t),
                t &&
                    at.isSupported() &&
                    ((this._config = this._getConfig(e)),
                    (this._deltaX = 0),
                    (this._supportPointerEvents = Boolean(window.PointerEvent)),
                    this._initEvents());
        }
        static get Default() {
            return ot;
        }
        static get DefaultType() {
            return rt;
        }
        static get NAME() {
            return "swipe";
        }
        dispose() {
            j.off(this._element, Z);
        }
        _start(t) {
            this._supportPointerEvents
                ? this._eventIsPointerPenTouch(t) && (this._deltaX = t.clientX)
                : (this._deltaX = t.touches[0].clientX);
        }
        _end(t) {
            this._eventIsPointerPenTouch(t) &&
                (this._deltaX = t.clientX - this._deltaX),
                this._handleSwipe(),
                v(this._config.endCallback);
        }
        _move(t) {
            this._deltaX =
                t.touches && t.touches.length > 1
                    ? 0
                    : t.touches[0].clientX - this._deltaX;
        }
        _handleSwipe() {
            const t = Math.abs(this._deltaX);
            if (t <= 40) return;
            const e = t / this._deltaX;
            (this._deltaX = 0),
                e &&
                    v(
                        e > 0
                            ? this._config.rightCallback
                            : this._config.leftCallback
                    );
        }
        _initEvents() {
            this._supportPointerEvents
                ? (j.on(this._element, st, (t) => this._start(t)),
                  j.on(this._element, nt, (t) => this._end(t)),
                  this._element.classList.add("pointer-event"))
                : (j.on(this._element, tt, (t) => this._start(t)),
                  j.on(this._element, et, (t) => this._move(t)),
                  j.on(this._element, it, (t) => this._end(t)));
        }
        _eventIsPointerPenTouch(t) {
            return (
                this._supportPointerEvents &&
                ("pen" === t.pointerType || "touch" === t.pointerType)
            );
        }
        static isSupported() {
            return (
                "ontouchstart" in document.documentElement ||
                navigator.maxTouchPoints > 0
            );
        }
    }
    const lt = ".bs.carousel",
        ct = ".data-api",
        ht = "next",
        dt = "prev",
        ut = "left",
        _t = "right",
        gt = `slide${lt}`,
        ft = `slid${lt}`,
        mt = `keydown${lt}`,
        pt = `mouseenter${lt}`,
        bt = `mouseleave${lt}`,
        vt = `dragstart${lt}`,
        yt = `load${lt}${ct}`,
        wt = `click${lt}${ct}`,
        At = "carousel",
        Et = "active",
        Ct = ".active",
        Tt = ".carousel-item",
        kt = Ct + Tt,
        $t = { ArrowLeft: _t, ArrowRight: ut },
        St = {
            interval: 5e3,
            keyboard: !0,
            pause: "hover",
            ride: !1,
            touch: !0,
            wrap: !0,
        },
        Lt = {
            interval: "(number|boolean)",
            keyboard: "boolean",
            pause: "(string|boolean)",
            ride: "(boolean|string)",
            touch: "boolean",
            wrap: "boolean",
        };
    class Ot extends W {
        constructor(t, e) {
            super(t, e),
                (this._interval = null),
                (this._activeElement = null),
                (this._isSliding = !1),
                (this.touchTimeout = null),
                (this._swipeHelper = null),
                (this._indicatorsElement = K.findOne(
                    ".carousel-indicators",
                    this._element
                )),
                this._addEventListeners(),
                this._config.ride === At && this.cycle();
        }
        static get Default() {
            return St;
        }
        static get DefaultType() {
            return Lt;
        }
        static get NAME() {
            return "carousel";
        }
        next() {
            this._slide(ht);
        }
        nextWhenVisible() {
            !document.hidden && h(this._element) && this.next();
        }
        prev() {
            this._slide(dt);
        }
        pause() {
            this._isSliding && a(this._element), this._clearInterval();
        }
        cycle() {
            this._clearInterval(),
                this._updateInterval(),
                (this._interval = setInterval(
                    () => this.nextWhenVisible(),
                    this._config.interval
                ));
        }
        _maybeEnableCycle() {
            this._config.ride &&
                (this._isSliding
                    ? j.one(this._element, ft, () => this.cycle())
                    : this.cycle());
        }
        to(t) {
            const e = this._getItems();
            if (t > e.length - 1 || t < 0) return;
            if (this._isSliding)
                return void j.one(this._element, ft, () => this.to(t));
            const i = this._getItemIndex(this._getActive());
            if (i === t) return;
            const s = t > i ? ht : dt;
            this._slide(s, e[t]);
        }
        dispose() {
            this._swipeHelper && this._swipeHelper.dispose(), super.dispose();
        }
        _configAfterMerge(t) {
            return (t.defaultInterval = t.interval), t;
        }
        _addEventListeners() {
            this._config.keyboard &&
                j.on(this._element, mt, (t) => this._keydown(t)),
                "hover" === this._config.pause &&
                    (j.on(this._element, pt, () => this.pause()),
                    j.on(this._element, bt, () => this._maybeEnableCycle())),
                this._config.touch &&
                    at.isSupported() &&
                    this._addTouchEventListeners();
        }
        _addTouchEventListeners() {
            for (const t of K.find(".carousel-item img", this._element))
                j.on(t, vt, (t) => t.preventDefault());
            const t = {
                leftCallback: () => this._slide(this._directionToOrder(ut)),
                rightCallback: () => this._slide(this._directionToOrder(_t)),
                endCallback: () => {
                    "hover" === this._config.pause &&
                        (this.pause(),
                        this.touchTimeout && clearTimeout(this.touchTimeout),
                        (this.touchTimeout = setTimeout(
                            () => this._maybeEnableCycle(),
                            500 + this._config.interval
                        )));
                },
            };
            this._swipeHelper = new at(this._element, t);
        }
        _keydown(t) {
            if (/input|textarea/i.test(t.target.tagName)) return;
            const e = $t[t.key];
            e && (t.preventDefault(), this._slide(this._directionToOrder(e)));
        }
        _getItemIndex(t) {
            return this._getItems().indexOf(t);
        }
        _setActiveIndicatorElement(t) {
            if (!this._indicatorsElement) return;
            const e = K.findOne(Ct, this._indicatorsElement);
            e.classList.remove(Et), e.removeAttribute("aria-current");
            const i = K.findOne(
                `[data-bs-slide-to="${t}"]`,
                this._indicatorsElement
            );
            i && (i.classList.add(Et), i.setAttribute("aria-current", "true"));
        }
        _updateInterval() {
            const t = this._activeElement || this._getActive();
            if (!t) return;
            const e = Number.parseInt(t.getAttribute("data-bs-interval"), 10);
            this._config.interval = e || this._config.defaultInterval;
        }
        _slide(t, e = null) {
            if (this._isSliding) return;
            const i = this._getActive(),
                s = t === ht,
                n = e || w(this._getItems(), i, s, this._config.wrap);
            if (n === i) return;
            const o = this._getItemIndex(n),
                r = (e) =>
                    j.trigger(this._element, e, {
                        relatedTarget: n,
                        direction: this._orderToDirection(t),
                        from: this._getItemIndex(i),
                        to: o,
                    });
            if (r(gt).defaultPrevented) return;
            if (!i || !n) return;
            const a = Boolean(this._interval);
            this.pause(),
                (this._isSliding = !0),
                this._setActiveIndicatorElement(o),
                (this._activeElement = n);
            const l = s ? "carousel-item-start" : "carousel-item-end",
                c = s ? "carousel-item-next" : "carousel-item-prev";
            n.classList.add(c),
                g(n),
                i.classList.add(l),
                n.classList.add(l),
                this._queueCallback(
                    () => {
                        n.classList.remove(l, c),
                            n.classList.add(Et),
                            i.classList.remove(Et, c, l),
                            (this._isSliding = !1),
                            r(ft);
                    },
                    i,
                    this._isAnimated()
                ),
                a && this.cycle();
        }
        _isAnimated() {
            return this._element.classList.contains("slide");
        }
        _getActive() {
            return K.findOne(kt, this._element);
        }
        _getItems() {
            return K.find(Tt, this._element);
        }
        _clearInterval() {
            this._interval &&
                (clearInterval(this._interval), (this._interval = null));
        }
        _directionToOrder(t) {
            return p() ? (t === ut ? dt : ht) : t === ut ? ht : dt;
        }
        _orderToDirection(t) {
            return p() ? (t === dt ? ut : _t) : t === dt ? _t : ut;
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = Ot.getOrCreateInstance(this, t);
                if ("number" != typeof t) {
                    if ("string" == typeof t) {
                        if (
                            void 0 === e[t] ||
                            t.startsWith("_") ||
                            "constructor" === t
                        )
                            throw new TypeError(`No method named "${t}"`);
                        e[t]();
                    }
                } else e.to(t);
            });
        }
    }
    j.on(document, wt, "[data-bs-slide], [data-bs-slide-to]", function (t) {
        const e = K.getElementFromSelector(this);
        if (!e || !e.classList.contains(At)) return;
        t.preventDefault();
        const i = Ot.getOrCreateInstance(e),
            s = this.getAttribute("data-bs-slide-to");
        return s
            ? (i.to(s), void i._maybeEnableCycle())
            : "next" === B.getDataAttribute(this, "slide")
            ? (i.next(), void i._maybeEnableCycle())
            : (i.prev(), void i._maybeEnableCycle());
    }),
        j.on(window, yt, () => {
            const t = K.find('[data-bs-ride="carousel"]');
            for (const e of t) Ot.getOrCreateInstance(e);
        }),
        b(Ot);
    const It = ".bs.collapse",
        Dt = `show${It}`,
        Nt = `shown${It}`,
        Pt = `hide${It}`,
        xt = `hidden${It}`,
        Mt = `click${It}.data-api`,
        jt = "show",
        Ft = "collapse",
        zt = "collapsing",
        Ht = `:scope .${Ft} .${Ft}`,
        Bt = '[data-bs-toggle="collapse"]',
        qt = { parent: null, toggle: !0 },
        Wt = { parent: "(null|element)", toggle: "boolean" };
    class Rt extends W {
        constructor(t, e) {
            super(t, e),
                (this._isTransitioning = !1),
                (this._triggerArray = []);
            const i = K.find(Bt);
            for (const t of i) {
                const e = K.getSelectorFromElement(t),
                    i = K.find(e).filter((t) => t === this._element);
                null !== e && i.length && this._triggerArray.push(t);
            }
            this._initializeChildren(),
                this._config.parent ||
                    this._addAriaAndCollapsedClass(
                        this._triggerArray,
                        this._isShown()
                    ),
                this._config.toggle && this.toggle();
        }
        static get Default() {
            return qt;
        }
        static get DefaultType() {
            return Wt;
        }
        static get NAME() {
            return "collapse";
        }
        toggle() {
            this._isShown() ? this.hide() : this.show();
        }
        show() {
            if (this._isTransitioning || this._isShown()) return;
            let t = [];
            if (
                (this._config.parent &&
                    (t = this._getFirstLevelChildren(
                        ".collapse.show, .collapse.collapsing"
                    )
                        .filter((t) => t !== this._element)
                        .map((t) => Rt.getOrCreateInstance(t, { toggle: !1 }))),
                t.length && t[0]._isTransitioning)
            )
                return;
            if (j.trigger(this._element, Dt).defaultPrevented) return;
            for (const e of t) e.hide();
            const e = this._getDimension();
            this._element.classList.remove(Ft),
                this._element.classList.add(zt),
                (this._element.style[e] = 0),
                this._addAriaAndCollapsedClass(this._triggerArray, !0),
                (this._isTransitioning = !0);
            const i = `scroll${e[0].toUpperCase() + e.slice(1)}`;
            this._queueCallback(
                () => {
                    (this._isTransitioning = !1),
                        this._element.classList.remove(zt),
                        this._element.classList.add(Ft, jt),
                        (this._element.style[e] = ""),
                        j.trigger(this._element, Nt);
                },
                this._element,
                !0
            ),
                (this._element.style[e] = `${this._element[i]}px`);
        }
        hide() {
            if (this._isTransitioning || !this._isShown()) return;
            if (j.trigger(this._element, Pt).defaultPrevented) return;
            const t = this._getDimension();
            (this._element.style[t] = `${
                this._element.getBoundingClientRect()[t]
            }px`),
                g(this._element),
                this._element.classList.add(zt),
                this._element.classList.remove(Ft, jt);
            for (const t of this._triggerArray) {
                const e = K.getElementFromSelector(t);
                e &&
                    !this._isShown(e) &&
                    this._addAriaAndCollapsedClass([t], !1);
            }
            (this._isTransitioning = !0),
                (this._element.style[t] = ""),
                this._queueCallback(
                    () => {
                        (this._isTransitioning = !1),
                            this._element.classList.remove(zt),
                            this._element.classList.add(Ft),
                            j.trigger(this._element, xt);
                    },
                    this._element,
                    !0
                );
        }
        _isShown(t = this._element) {
            return t.classList.contains(jt);
        }
        _configAfterMerge(t) {
            return (t.toggle = Boolean(t.toggle)), (t.parent = c(t.parent)), t;
        }
        _getDimension() {
            return this._element.classList.contains("collapse-horizontal")
                ? "width"
                : "height";
        }
        _initializeChildren() {
            if (!this._config.parent) return;
            const t = this._getFirstLevelChildren(Bt);
            for (const e of t) {
                const t = K.getElementFromSelector(e);
                t && this._addAriaAndCollapsedClass([e], this._isShown(t));
            }
        }
        _getFirstLevelChildren(t) {
            const e = K.find(Ht, this._config.parent);
            return K.find(t, this._config.parent).filter((t) => !e.includes(t));
        }
        _addAriaAndCollapsedClass(t, e) {
            if (t.length)
                for (const i of t)
                    i.classList.toggle("collapsed", !e),
                        i.setAttribute("aria-expanded", e);
        }
        static jQueryInterface(t) {
            const e = {};
            return (
                "string" == typeof t && /show|hide/.test(t) && (e.toggle = !1),
                this.each(function () {
                    const i = Rt.getOrCreateInstance(this, e);
                    if ("string" == typeof t) {
                        if (void 0 === i[t])
                            throw new TypeError(`No method named "${t}"`);
                        i[t]();
                    }
                })
            );
        }
    }
    j.on(document, Mt, Bt, function (t) {
        ("A" === t.target.tagName ||
            (t.delegateTarget && "A" === t.delegateTarget.tagName)) &&
            t.preventDefault();
        for (const t of K.getMultipleElementsFromSelector(this))
            Rt.getOrCreateInstance(t, { toggle: !1 }).toggle();
    }),
        b(Rt);
    const Kt = "dropdown",
        Vt = ".bs.dropdown",
        Qt = ".data-api",
        Xt = "ArrowUp",
        Yt = "ArrowDown",
        Ut = `hide${Vt}`,
        Gt = `hidden${Vt}`,
        Jt = `show${Vt}`,
        Zt = `shown${Vt}`,
        te = `click${Vt}${Qt}`,
        ee = `keydown${Vt}${Qt}`,
        ie = `keyup${Vt}${Qt}`,
        se = "show",
        ne = '[data-bs-toggle="dropdown"]:not(.disabled):not(:disabled)',
        oe = `${ne}.${se}`,
        re = ".dropdown-menu",
        ae = p() ? "top-end" : "top-start",
        le = p() ? "top-start" : "top-end",
        ce = p() ? "bottom-end" : "bottom-start",
        he = p() ? "bottom-start" : "bottom-end",
        de = p() ? "left-start" : "right-start",
        ue = p() ? "right-start" : "left-start",
        _e = {
            autoClose: !0,
            boundary: "clippingParents",
            display: "dynamic",
            offset: [0, 2],
            popperConfig: null,
            reference: "toggle",
        },
        ge = {
            autoClose: "(boolean|string)",
            boundary: "(string|element)",
            display: "string",
            offset: "(array|string|function)",
            popperConfig: "(null|object|function)",
            reference: "(string|element|object)",
        };
    class fe extends W {
        constructor(t, e) {
            super(t, e),
                (this._popper = null),
                (this._parent = this._element.parentNode),
                (this._menu =
                    K.next(this._element, re)[0] ||
                    K.prev(this._element, re)[0] ||
                    K.findOne(re, this._parent)),
                (this._inNavbar = this._detectNavbar());
        }
        static get Default() {
            return _e;
        }
        static get DefaultType() {
            return ge;
        }
        static get NAME() {
            return Kt;
        }
        toggle() {
            return this._isShown() ? this.hide() : this.show();
        }
        show() {
            if (d(this._element) || this._isShown()) return;
            const t = { relatedTarget: this._element };
            if (!j.trigger(this._element, Jt, t).defaultPrevented) {
                if (
                    (this._createPopper(),
                    "ontouchstart" in document.documentElement &&
                        !this._parent.closest(".navbar-nav"))
                )
                    for (const t of [].concat(...document.body.children))
                        j.on(t, "mouseover", _);
                this._element.focus(),
                    this._element.setAttribute("aria-expanded", !0),
                    this._menu.classList.add(se),
                    this._element.classList.add(se),
                    j.trigger(this._element, Zt, t);
            }
        }
        hide() {
            if (d(this._element) || !this._isShown()) return;
            const t = { relatedTarget: this._element };
            this._completeHide(t);
        }
        dispose() {
            this._popper && this._popper.destroy(), super.dispose();
        }
        update() {
            (this._inNavbar = this._detectNavbar()),
                this._popper && this._popper.update();
        }
        _completeHide(t) {
            if (!j.trigger(this._element, Ut, t).defaultPrevented) {
                if ("ontouchstart" in document.documentElement)
                    for (const t of [].concat(...document.body.children))
                        j.off(t, "mouseover", _);
                this._popper && this._popper.destroy(),
                    this._menu.classList.remove(se),
                    this._element.classList.remove(se),
                    this._element.setAttribute("aria-expanded", "false"),
                    B.removeDataAttribute(this._menu, "popper"),
                    j.trigger(this._element, Gt, t);
            }
        }
        _getConfig(t) {
            if (
                "object" == typeof (t = super._getConfig(t)).reference &&
                !l(t.reference) &&
                "function" != typeof t.reference.getBoundingClientRect
            )
                throw new TypeError(
                    `${Kt.toUpperCase()}: Option "reference" provided type "object" without a required "getBoundingClientRect" method.`
                );
            return t;
        }
        _createPopper() {
            if (void 0 === i)
                throw new TypeError(
                    "Bootstrap's dropdowns require Popper (https://popper.js.org)"
                );
            let t = this._element;
            "parent" === this._config.reference
                ? (t = this._parent)
                : l(this._config.reference)
                ? (t = c(this._config.reference))
                : "object" == typeof this._config.reference &&
                  (t = this._config.reference);
            const e = this._getPopperConfig();
            this._popper = i.createPopper(t, this._menu, e);
        }
        _isShown() {
            return this._menu.classList.contains(se);
        }
        _getPlacement() {
            const t = this._parent;
            if (t.classList.contains("dropend")) return de;
            if (t.classList.contains("dropstart")) return ue;
            if (t.classList.contains("dropup-center")) return "top";
            if (t.classList.contains("dropdown-center")) return "bottom";
            const e =
                "end" ===
                getComputedStyle(this._menu)
                    .getPropertyValue("--bs-position")
                    .trim();
            return t.classList.contains("dropup") ? (e ? le : ae) : e ? he : ce;
        }
        _detectNavbar() {
            return null !== this._element.closest(".navbar");
        }
        _getOffset() {
            const { offset: t } = this._config;
            return "string" == typeof t
                ? t.split(",").map((t) => Number.parseInt(t, 10))
                : "function" == typeof t
                ? (e) => t(e, this._element)
                : t;
        }
        _getPopperConfig() {
            const t = {
                placement: this._getPlacement(),
                modifiers: [
                    {
                        name: "preventOverflow",
                        options: { boundary: this._config.boundary },
                    },
                    { name: "offset", options: { offset: this._getOffset() } },
                ],
            };
            return (
                (this._inNavbar || "static" === this._config.display) &&
                    (B.setDataAttribute(this._menu, "popper", "static"),
                    (t.modifiers = [{ name: "applyStyles", enabled: !1 }])),
                { ...t, ...v(this._config.popperConfig, [t]) }
            );
        }
        _selectMenuItem({ key: t, target: e }) {
            const i = K.find(
                ".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)",
                this._menu
            ).filter((t) => h(t));
            i.length && w(i, e, t === Yt, !i.includes(e)).focus();
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = fe.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (void 0 === e[t])
                        throw new TypeError(`No method named "${t}"`);
                    e[t]();
                }
            });
        }
        static clearMenus(t) {
            if (2 === t.button || ("keyup" === t.type && "Tab" !== t.key))
                return;
            const e = K.find(oe);
            for (const i of e) {
                const e = fe.getInstance(i);
                if (!e || !1 === e._config.autoClose) continue;
                const s = t.composedPath(),
                    n = s.includes(e._menu);
                if (
                    s.includes(e._element) ||
                    ("inside" === e._config.autoClose && !n) ||
                    ("outside" === e._config.autoClose && n)
                )
                    continue;
                if (
                    e._menu.contains(t.target) &&
                    (("keyup" === t.type && "Tab" === t.key) ||
                        /input|select|option|textarea|form/i.test(
                            t.target.tagName
                        ))
                )
                    continue;
                const o = { relatedTarget: e._element };
                "click" === t.type && (o.clickEvent = t), e._completeHide(o);
            }
        }
        static dataApiKeydownHandler(t) {
            const e = /input|textarea/i.test(t.target.tagName),
                i = "Escape" === t.key,
                s = [Xt, Yt].includes(t.key);
            if (!s && !i) return;
            if (e && !i) return;
            t.preventDefault();
            const n = this.matches(ne)
                    ? this
                    : K.prev(this, ne)[0] ||
                      K.next(this, ne)[0] ||
                      K.findOne(ne, t.delegateTarget.parentNode),
                o = fe.getOrCreateInstance(n);
            if (s)
                return t.stopPropagation(), o.show(), void o._selectMenuItem(t);
            o._isShown() && (t.stopPropagation(), o.hide(), n.focus());
        }
    }
    j.on(document, ee, ne, fe.dataApiKeydownHandler),
        j.on(document, ee, re, fe.dataApiKeydownHandler),
        j.on(document, te, fe.clearMenus),
        j.on(document, ie, fe.clearMenus),
        j.on(document, te, ne, function (t) {
            t.preventDefault(), fe.getOrCreateInstance(this).toggle();
        }),
        b(fe);
    const me = "backdrop",
        pe = "show",
        be = `mousedown.bs.${me}`,
        ve = {
            className: "modal-backdrop",
            clickCallback: null,
            isAnimated: !1,
            isVisible: !0,
            rootElement: "body",
        },
        ye = {
            className: "string",
            clickCallback: "(function|null)",
            isAnimated: "boolean",
            isVisible: "boolean",
            rootElement: "(element|string)",
        };
    class we extends q {
        constructor(t) {
            super(),
                (this._config = this._getConfig(t)),
                (this._isAppended = !1),
                (this._element = null);
        }
        static get Default() {
            return ve;
        }
        static get DefaultType() {
            return ye;
        }
        static get NAME() {
            return me;
        }
        show(t) {
            if (!this._config.isVisible) return void v(t);
            this._append();
            const e = this._getElement();
            this._config.isAnimated && g(e),
                e.classList.add(pe),
                this._emulateAnimation(() => {
                    v(t);
                });
        }
        hide(t) {
            this._config.isVisible
                ? (this._getElement().classList.remove(pe),
                  this._emulateAnimation(() => {
                      this.dispose(), v(t);
                  }))
                : v(t);
        }
        dispose() {
            this._isAppended &&
                (j.off(this._element, be),
                this._element.remove(),
                (this._isAppended = !1));
        }
        _getElement() {
            if (!this._element) {
                const t = document.createElement("div");
                (t.className = this._config.className),
                    this._config.isAnimated && t.classList.add("fade"),
                    (this._element = t);
            }
            return this._element;
        }
        _configAfterMerge(t) {
            return (t.rootElement = c(t.rootElement)), t;
        }
        _append() {
            if (this._isAppended) return;
            const t = this._getElement();
            this._config.rootElement.append(t),
                j.on(t, be, () => {
                    v(this._config.clickCallback);
                }),
                (this._isAppended = !0);
        }
        _emulateAnimation(t) {
            y(t, this._getElement(), this._config.isAnimated);
        }
    }
    const Ae = ".bs.focustrap",
        Ee = `focusin${Ae}`,
        Ce = `keydown.tab${Ae}`,
        Te = "backward",
        ke = { autofocus: !0, trapElement: null },
        $e = { autofocus: "boolean", trapElement: "element" };
    class Se extends q {
        constructor(t) {
            super(),
                (this._config = this._getConfig(t)),
                (this._isActive = !1),
                (this._lastTabNavDirection = null);
        }
        static get Default() {
            return ke;
        }
        static get DefaultType() {
            return $e;
        }
        static get NAME() {
            return "focustrap";
        }
        activate() {
            this._isActive ||
                (this._config.autofocus && this._config.trapElement.focus(),
                j.off(document, Ae),
                j.on(document, Ee, (t) => this._handleFocusin(t)),
                j.on(document, Ce, (t) => this._handleKeydown(t)),
                (this._isActive = !0));
        }
        deactivate() {
            this._isActive && ((this._isActive = !1), j.off(document, Ae));
        }
        _handleFocusin(t) {
            const { trapElement: e } = this._config;
            if (t.target === document || t.target === e || e.contains(t.target))
                return;
            const i = K.focusableChildren(e);
            0 === i.length
                ? e.focus()
                : this._lastTabNavDirection === Te
                ? i[i.length - 1].focus()
                : i[0].focus();
        }
        _handleKeydown(t) {
            "Tab" === t.key &&
                (this._lastTabNavDirection = t.shiftKey ? Te : "forward");
        }
    }
    const Le = ".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",
        Oe = ".sticky-top",
        Ie = "padding-right",
        De = "margin-right";
    class Ne {
        constructor() {
            this._element = document.body;
        }
        getWidth() {
            const t = document.documentElement.clientWidth;
            return Math.abs(window.innerWidth - t);
        }
        hide() {
            const t = this.getWidth();
            this._disableOverFlow(),
                this._setElementAttributes(this._element, Ie, (e) => e + t),
                this._setElementAttributes(Le, Ie, (e) => e + t),
                this._setElementAttributes(Oe, De, (e) => e - t);
        }
        reset() {
            this._resetElementAttributes(this._element, "overflow"),
                this._resetElementAttributes(this._element, Ie),
                this._resetElementAttributes(Le, Ie),
                this._resetElementAttributes(Oe, De);
        }
        isOverflowing() {
            return this.getWidth() > 0;
        }
        _disableOverFlow() {
            this._saveInitialAttribute(this._element, "overflow"),
                (this._element.style.overflow = "hidden");
        }
        _setElementAttributes(t, e, i) {
            const s = this.getWidth();
            this._applyManipulationCallback(t, (t) => {
                if (
                    t !== this._element &&
                    window.innerWidth > t.clientWidth + s
                )
                    return;
                this._saveInitialAttribute(t, e);
                const n = window.getComputedStyle(t).getPropertyValue(e);
                t.style.setProperty(e, `${i(Number.parseFloat(n))}px`);
            });
        }
        _saveInitialAttribute(t, e) {
            const i = t.style.getPropertyValue(e);
            i && B.setDataAttribute(t, e, i);
        }
        _resetElementAttributes(t, e) {
            this._applyManipulationCallback(t, (t) => {
                const i = B.getDataAttribute(t, e);
                null !== i
                    ? (B.removeDataAttribute(t, e), t.style.setProperty(e, i))
                    : t.style.removeProperty(e);
            });
        }
        _applyManipulationCallback(t, e) {
            if (l(t)) e(t);
            else for (const i of K.find(t, this._element)) e(i);
        }
    }
    const Pe = ".bs.modal",
        xe = `hide${Pe}`,
        Me = `hidePrevented${Pe}`,
        je = `hidden${Pe}`,
        Fe = `show${Pe}`,
        ze = `shown${Pe}`,
        He = `resize${Pe}`,
        Be = `click.dismiss${Pe}`,
        qe = `mousedown.dismiss${Pe}`,
        We = `keydown.dismiss${Pe}`,
        Re = `click${Pe}.data-api`,
        Ke = "modal-open",
        Ve = "show",
        Qe = "modal-static",
        Xe = { backdrop: !0, focus: !0, keyboard: !0 },
        Ye = {
            backdrop: "(boolean|string)",
            focus: "boolean",
            keyboard: "boolean",
        };
    class Ue extends W {
        constructor(t, e) {
            super(t, e),
                (this._dialog = K.findOne(".modal-dialog", this._element)),
                (this._backdrop = this._initializeBackDrop()),
                (this._focustrap = this._initializeFocusTrap()),
                (this._isShown = !1),
                (this._isTransitioning = !1),
                (this._scrollBar = new Ne()),
                this._addEventListeners();
        }
        static get Default() {
            return Xe;
        }
        static get DefaultType() {
            return Ye;
        }
        static get NAME() {
            return "modal";
        }
        toggle(t) {
            return this._isShown ? this.hide() : this.show(t);
        }
        show(t) {
            this._isShown ||
                this._isTransitioning ||
                j.trigger(this._element, Fe, { relatedTarget: t })
                    .defaultPrevented ||
                ((this._isShown = !0),
                (this._isTransitioning = !0),
                this._scrollBar.hide(),
                document.body.classList.add(Ke),
                this._adjustDialog(),
                this._backdrop.show(() => this._showElement(t)));
        }
        hide() {
            this._isShown &&
                !this._isTransitioning &&
                (j.trigger(this._element, xe).defaultPrevented ||
                    ((this._isShown = !1),
                    (this._isTransitioning = !0),
                    this._focustrap.deactivate(),
                    this._element.classList.remove(Ve),
                    this._queueCallback(
                        () => this._hideModal(),
                        this._element,
                        this._isAnimated()
                    )));
        }
        dispose() {
            j.off(window, Pe),
                j.off(this._dialog, Pe),
                this._backdrop.dispose(),
                this._focustrap.deactivate(),
                super.dispose();
        }
        handleUpdate() {
            this._adjustDialog();
        }
        _initializeBackDrop() {
            return new we({
                isVisible: Boolean(this._config.backdrop),
                isAnimated: this._isAnimated(),
            });
        }
        _initializeFocusTrap() {
            return new Se({ trapElement: this._element });
        }
        _showElement(t) {
            document.body.contains(this._element) ||
                document.body.append(this._element),
                (this._element.style.display = "block"),
                this._element.removeAttribute("aria-hidden"),
                this._element.setAttribute("aria-modal", !0),
                this._element.setAttribute("role", "dialog"),
                (this._element.scrollTop = 0);
            const e = K.findOne(".modal-body", this._dialog);
            e && (e.scrollTop = 0),
                g(this._element),
                this._element.classList.add(Ve),
                this._queueCallback(
                    () => {
                        this._config.focus && this._focustrap.activate(),
                            (this._isTransitioning = !1),
                            j.trigger(this._element, ze, { relatedTarget: t });
                    },
                    this._dialog,
                    this._isAnimated()
                );
        }
        _addEventListeners() {
            j.on(this._element, We, (t) => {
                "Escape" === t.key &&
                    (this._config.keyboard
                        ? this.hide()
                        : this._triggerBackdropTransition());
            }),
                j.on(window, He, () => {
                    this._isShown &&
                        !this._isTransitioning &&
                        this._adjustDialog();
                }),
                j.on(this._element, qe, (t) => {
                    j.one(this._element, Be, (e) => {
                        this._element === t.target &&
                            this._element === e.target &&
                            ("static" !== this._config.backdrop
                                ? this._config.backdrop && this.hide()
                                : this._triggerBackdropTransition());
                    });
                });
        }
        _hideModal() {
            (this._element.style.display = "none"),
                this._element.setAttribute("aria-hidden", !0),
                this._element.removeAttribute("aria-modal"),
                this._element.removeAttribute("role"),
                (this._isTransitioning = !1),
                this._backdrop.hide(() => {
                    document.body.classList.remove(Ke),
                        this._resetAdjustments(),
                        this._scrollBar.reset(),
                        j.trigger(this._element, je);
                });
        }
        _isAnimated() {
            return this._element.classList.contains("fade");
        }
        _triggerBackdropTransition() {
            if (j.trigger(this._element, Me).defaultPrevented) return;
            const t =
                    this._element.scrollHeight >
                    document.documentElement.clientHeight,
                e = this._element.style.overflowY;
            "hidden" === e ||
                this._element.classList.contains(Qe) ||
                (t || (this._element.style.overflowY = "hidden"),
                this._element.classList.add(Qe),
                this._queueCallback(() => {
                    this._element.classList.remove(Qe),
                        this._queueCallback(() => {
                            this._element.style.overflowY = e;
                        }, this._dialog);
                }, this._dialog),
                this._element.focus());
        }
        _adjustDialog() {
            const t =
                    this._element.scrollHeight >
                    document.documentElement.clientHeight,
                e = this._scrollBar.getWidth(),
                i = e > 0;
            if (i && !t) {
                const t = p() ? "paddingLeft" : "paddingRight";
                this._element.style[t] = `${e}px`;
            }
            if (!i && t) {
                const t = p() ? "paddingRight" : "paddingLeft";
                this._element.style[t] = `${e}px`;
            }
        }
        _resetAdjustments() {
            (this._element.style.paddingLeft = ""),
                (this._element.style.paddingRight = "");
        }
        static jQueryInterface(t, e) {
            return this.each(function () {
                const i = Ue.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (void 0 === i[t])
                        throw new TypeError(`No method named "${t}"`);
                    i[t](e);
                }
            });
        }
    }
    j.on(document, Re, '[data-bs-toggle="modal"]', function (t) {
        const e = K.getElementFromSelector(this);
        ["A", "AREA"].includes(this.tagName) && t.preventDefault(),
            j.one(e, Fe, (t) => {
                t.defaultPrevented ||
                    j.one(e, je, () => {
                        h(this) && this.focus();
                    });
            });
        const i = K.findOne(".modal.show");
        i && Ue.getInstance(i).hide(), Ue.getOrCreateInstance(e).toggle(this);
    }),
        V(Ue),
        b(Ue);
    const Ge = ".bs.offcanvas",
        Je = ".data-api",
        Ze = `load${Ge}${Je}`,
        ti = "show",
        ei = "showing",
        ii = "hiding",
        si = ".offcanvas.show",
        ni = `show${Ge}`,
        oi = `shown${Ge}`,
        ri = `hide${Ge}`,
        ai = `hidePrevented${Ge}`,
        li = `hidden${Ge}`,
        ci = `resize${Ge}`,
        hi = `click${Ge}${Je}`,
        di = `keydown.dismiss${Ge}`,
        ui = { backdrop: !0, keyboard: !0, scroll: !1 },
        _i = {
            backdrop: "(boolean|string)",
            keyboard: "boolean",
            scroll: "boolean",
        };
    class gi extends W {
        constructor(t, e) {
            super(t, e),
                (this._isShown = !1),
                (this._backdrop = this._initializeBackDrop()),
                (this._focustrap = this._initializeFocusTrap()),
                this._addEventListeners();
        }
        static get Default() {
            return ui;
        }
        static get DefaultType() {
            return _i;
        }
        static get NAME() {
            return "offcanvas";
        }
        toggle(t) {
            return this._isShown ? this.hide() : this.show(t);
        }
        show(t) {
            this._isShown ||
                j.trigger(this._element, ni, { relatedTarget: t })
                    .defaultPrevented ||
                ((this._isShown = !0),
                this._backdrop.show(),
                this._config.scroll || new Ne().hide(),
                this._element.setAttribute("aria-modal", !0),
                this._element.setAttribute("role", "dialog"),
                this._element.classList.add(ei),
                this._queueCallback(
                    () => {
                        (this._config.scroll && !this._config.backdrop) ||
                            this._focustrap.activate(),
                            this._element.classList.add(ti),
                            this._element.classList.remove(ei),
                            j.trigger(this._element, oi, { relatedTarget: t });
                    },
                    this._element,
                    !0
                ));
        }
        hide() {
            this._isShown &&
                (j.trigger(this._element, ri).defaultPrevented ||
                    (this._focustrap.deactivate(),
                    this._element.blur(),
                    (this._isShown = !1),
                    this._element.classList.add(ii),
                    this._backdrop.hide(),
                    this._queueCallback(
                        () => {
                            this._element.classList.remove(ti, ii),
                                this._element.removeAttribute("aria-modal"),
                                this._element.removeAttribute("role"),
                                this._config.scroll || new Ne().reset(),
                                j.trigger(this._element, li);
                        },
                        this._element,
                        !0
                    )));
        }
        dispose() {
            this._backdrop.dispose(),
                this._focustrap.deactivate(),
                super.dispose();
        }
        _initializeBackDrop() {
            const t = Boolean(this._config.backdrop);
            return new we({
                className: "offcanvas-backdrop",
                isVisible: t,
                isAnimated: !0,
                rootElement: this._element.parentNode,
                clickCallback: t
                    ? () => {
                          "static" !== this._config.backdrop
                              ? this.hide()
                              : j.trigger(this._element, ai);
                      }
                    : null,
            });
        }
        _initializeFocusTrap() {
            return new Se({ trapElement: this._element });
        }
        _addEventListeners() {
            j.on(this._element, di, (t) => {
                "Escape" === t.key &&
                    (this._config.keyboard
                        ? this.hide()
                        : j.trigger(this._element, ai));
            });
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = gi.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (
                        void 0 === e[t] ||
                        t.startsWith("_") ||
                        "constructor" === t
                    )
                        throw new TypeError(`No method named "${t}"`);
                    e[t](this);
                }
            });
        }
    }
    j.on(document, hi, '[data-bs-toggle="offcanvas"]', function (t) {
        const e = K.getElementFromSelector(this);
        if (
            (["A", "AREA"].includes(this.tagName) && t.preventDefault(),
            d(this))
        )
            return;
        j.one(e, li, () => {
            h(this) && this.focus();
        });
        const i = K.findOne(si);
        i && i !== e && gi.getInstance(i).hide(),
            gi.getOrCreateInstance(e).toggle(this);
    }),
        j.on(window, Ze, () => {
            for (const t of K.find(si)) gi.getOrCreateInstance(t).show();
        }),
        j.on(window, ci, () => {
            for (const t of K.find(
                "[aria-modal][class*=show][class*=offcanvas-]"
            ))
                "fixed" !== getComputedStyle(t).position &&
                    gi.getOrCreateInstance(t).hide();
        }),
        V(gi),
        b(gi);
    const fi = {
            "*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
            a: ["target", "href", "title", "rel"],
            area: [],
            b: [],
            br: [],
            col: [],
            code: [],
            div: [],
            em: [],
            hr: [],
            h1: [],
            h2: [],
            h3: [],
            h4: [],
            h5: [],
            h6: [],
            i: [],
            img: ["src", "srcset", "alt", "title", "width", "height"],
            li: [],
            ol: [],
            p: [],
            pre: [],
            s: [],
            small: [],
            span: [],
            sub: [],
            sup: [],
            strong: [],
            u: [],
            ul: [],
        },
        mi = new Set([
            "background",
            "cite",
            "href",
            "itemtype",
            "longdesc",
            "poster",
            "src",
            "xlink:href",
        ]),
        pi = /^(?!javascript:)(?:[a-z0-9+.-]+:|[^&:/?#]*(?:[/?#]|$))/i,
        bi = (t, e) => {
            const i = t.nodeName.toLowerCase();
            return e.includes(i)
                ? !mi.has(i) || Boolean(pi.test(t.nodeValue))
                : e.filter((t) => t instanceof RegExp).some((t) => t.test(i));
        },
        vi = {
            allowList: fi,
            content: {},
            extraClass: "",
            html: !1,
            sanitize: !0,
            sanitizeFn: null,
            template: "<div></div>",
        },
        yi = {
            allowList: "object",
            content: "object",
            extraClass: "(string|function)",
            html: "boolean",
            sanitize: "boolean",
            sanitizeFn: "(null|function)",
            template: "string",
        },
        wi = {
            entry: "(string|element|function|null)",
            selector: "(string|element)",
        };
    class Ai extends q {
        constructor(t) {
            super(), (this._config = this._getConfig(t));
        }
        static get Default() {
            return vi;
        }
        static get DefaultType() {
            return yi;
        }
        static get NAME() {
            return "TemplateFactory";
        }
        getContent() {
            return Object.values(this._config.content)
                .map((t) => this._resolvePossibleFunction(t))
                .filter(Boolean);
        }
        hasContent() {
            return this.getContent().length > 0;
        }
        changeContent(t) {
            return (
                this._checkContent(t),
                (this._config.content = { ...this._config.content, ...t }),
                this
            );
        }
        toHtml() {
            const t = document.createElement("div");
            t.innerHTML = this._maybeSanitize(this._config.template);
            for (const [e, i] of Object.entries(this._config.content))
                this._setContent(t, i, e);
            const e = t.children[0],
                i = this._resolvePossibleFunction(this._config.extraClass);
            return i && e.classList.add(...i.split(" ")), e;
        }
        _typeCheckConfig(t) {
            super._typeCheckConfig(t), this._checkContent(t.content);
        }
        _checkContent(t) {
            for (const [e, i] of Object.entries(t))
                super._typeCheckConfig({ selector: e, entry: i }, wi);
        }
        _setContent(t, e, i) {
            const s = K.findOne(i, t);
            s &&
                ((e = this._resolvePossibleFunction(e))
                    ? l(e)
                        ? this._putElementInTemplate(c(e), s)
                        : this._config.html
                        ? (s.innerHTML = this._maybeSanitize(e))
                        : (s.textContent = e)
                    : s.remove());
        }
        _maybeSanitize(t) {
            return this._config.sanitize
                ? (function (t, e, i) {
                      if (!t.length) return t;
                      if (i && "function" == typeof i) return i(t);
                      const s = new window.DOMParser().parseFromString(
                              t,
                              "text/html"
                          ),
                          n = [].concat(...s.body.querySelectorAll("*"));
                      for (const t of n) {
                          const i = t.nodeName.toLowerCase();
                          if (!Object.keys(e).includes(i)) {
                              t.remove();
                              continue;
                          }
                          const s = [].concat(...t.attributes),
                              n = [].concat(e["*"] || [], e[i] || []);
                          for (const e of s)
                              bi(e, n) || t.removeAttribute(e.nodeName);
                      }
                      return s.body.innerHTML;
                  })(t, this._config.allowList, this._config.sanitizeFn)
                : t;
        }
        _resolvePossibleFunction(t) {
            return v(t, [this]);
        }
        _putElementInTemplate(t, e) {
            if (this._config.html) return (e.innerHTML = ""), void e.append(t);
            e.textContent = t.textContent;
        }
    }
    const Ei = new Set(["sanitize", "allowList", "sanitizeFn"]),
        Ci = "fade",
        Ti = "show",
        ki = ".modal",
        $i = "hide.bs.modal",
        Si = "hover",
        Li = "focus",
        Oi = {
            AUTO: "auto",
            TOP: "top",
            RIGHT: p() ? "left" : "right",
            BOTTOM: "bottom",
            LEFT: p() ? "right" : "left",
        },
        Ii = {
            allowList: fi,
            animation: !0,
            boundary: "clippingParents",
            container: !1,
            customClass: "",
            delay: 0,
            fallbackPlacements: ["top", "right", "bottom", "left"],
            html: !1,
            offset: [0, 6],
            placement: "top",
            popperConfig: null,
            sanitize: !0,
            sanitizeFn: null,
            selector: !1,
            template:
                '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
            title: "",
            trigger: "hover focus",
        },
        Di = {
            allowList: "object",
            animation: "boolean",
            boundary: "(string|element)",
            container: "(string|element|boolean)",
            customClass: "(string|function)",
            delay: "(number|object)",
            fallbackPlacements: "array",
            html: "boolean",
            offset: "(array|string|function)",
            placement: "(string|function)",
            popperConfig: "(null|object|function)",
            sanitize: "boolean",
            sanitizeFn: "(null|function)",
            selector: "(string|boolean)",
            template: "string",
            title: "(string|element|function)",
            trigger: "string",
        };
    class Ni extends W {
        constructor(t, e) {
            if (void 0 === i)
                throw new TypeError(
                    "Bootstrap's tooltips require Popper (https://popper.js.org)"
                );
            super(t, e),
                (this._isEnabled = !0),
                (this._timeout = 0),
                (this._isHovered = null),
                (this._activeTrigger = {}),
                (this._popper = null),
                (this._templateFactory = null),
                (this._newContent = null),
                (this.tip = null),
                this._setListeners(),
                this._config.selector || this._fixTitle();
        }
        static get Default() {
            return Ii;
        }
        static get DefaultType() {
            return Di;
        }
        static get NAME() {
            return "tooltip";
        }
        enable() {
            this._isEnabled = !0;
        }
        disable() {
            this._isEnabled = !1;
        }
        toggleEnabled() {
            this._isEnabled = !this._isEnabled;
        }
        toggle() {
            this._isEnabled &&
                ((this._activeTrigger.click = !this._activeTrigger.click),
                this._isShown() ? this._leave() : this._enter());
        }
        dispose() {
            clearTimeout(this._timeout),
                j.off(this._element.closest(ki), $i, this._hideModalHandler),
                this._element.getAttribute("data-bs-original-title") &&
                    this._element.setAttribute(
                        "title",
                        this._element.getAttribute("data-bs-original-title")
                    ),
                this._disposePopper(),
                super.dispose();
        }
        show() {
            if ("none" === this._element.style.display)
                throw new Error("Please use show on visible elements");
            if (!this._isWithContent() || !this._isEnabled) return;
            const t = j.trigger(
                    this._element,
                    this.constructor.eventName("show")
                ),
                e = (
                    u(this._element) ||
                    this._element.ownerDocument.documentElement
                ).contains(this._element);
            if (t.defaultPrevented || !e) return;
            this._disposePopper();
            const i = this._getTipElement();
            this._element.setAttribute(
                "aria-describedby",
                i.getAttribute("id")
            );
            const { container: s } = this._config;
            if (
                (this._element.ownerDocument.documentElement.contains(
                    this.tip
                ) ||
                    (s.append(i),
                    j.trigger(
                        this._element,
                        this.constructor.eventName("inserted")
                    )),
                (this._popper = this._createPopper(i)),
                i.classList.add(Ti),
                "ontouchstart" in document.documentElement)
            )
                for (const t of [].concat(...document.body.children))
                    j.on(t, "mouseover", _);
            this._queueCallback(
                () => {
                    j.trigger(
                        this._element,
                        this.constructor.eventName("shown")
                    ),
                        !1 === this._isHovered && this._leave(),
                        (this._isHovered = !1);
                },
                this.tip,
                this._isAnimated()
            );
        }
        hide() {
            if (
                this._isShown() &&
                !j.trigger(this._element, this.constructor.eventName("hide"))
                    .defaultPrevented
            ) {
                if (
                    (this._getTipElement().classList.remove(Ti),
                    "ontouchstart" in document.documentElement)
                )
                    for (const t of [].concat(...document.body.children))
                        j.off(t, "mouseover", _);
                (this._activeTrigger.click = !1),
                    (this._activeTrigger[Li] = !1),
                    (this._activeTrigger[Si] = !1),
                    (this._isHovered = null),
                    this._queueCallback(
                        () => {
                            this._isWithActiveTrigger() ||
                                (this._isHovered || this._disposePopper(),
                                this._element.removeAttribute(
                                    "aria-describedby"
                                ),
                                j.trigger(
                                    this._element,
                                    this.constructor.eventName("hidden")
                                ));
                        },
                        this.tip,
                        this._isAnimated()
                    );
            }
        }
        update() {
            this._popper && this._popper.update();
        }
        _isWithContent() {
            return Boolean(this._getTitle());
        }
        _getTipElement() {
            return (
                this.tip ||
                    (this.tip = this._createTipElement(
                        this._newContent || this._getContentForTemplate()
                    )),
                this.tip
            );
        }
        _createTipElement(t) {
            const e = this._getTemplateFactory(t).toHtml();
            if (!e) return null;
            e.classList.remove(Ci, Ti),
                e.classList.add(`bs-${this.constructor.NAME}-auto`);
            const i = ((t) => {
                do {
                    t += Math.floor(1e6 * Math.random());
                } while (document.getElementById(t));
                return t;
            })(this.constructor.NAME).toString();
            return (
                e.setAttribute("id", i),
                this._isAnimated() && e.classList.add(Ci),
                e
            );
        }
        setContent(t) {
            (this._newContent = t),
                this._isShown() && (this._disposePopper(), this.show());
        }
        _getTemplateFactory(t) {
            return (
                this._templateFactory
                    ? this._templateFactory.changeContent(t)
                    : (this._templateFactory = new Ai({
                          ...this._config,
                          content: t,
                          extraClass: this._resolvePossibleFunction(
                              this._config.customClass
                          ),
                      })),
                this._templateFactory
            );
        }
        _getContentForTemplate() {
            return { ".tooltip-inner": this._getTitle() };
        }
        _getTitle() {
            return (
                this._resolvePossibleFunction(this._config.title) ||
                this._element.getAttribute("data-bs-original-title")
            );
        }
        _initializeOnDelegatedTarget(t) {
            return this.constructor.getOrCreateInstance(
                t.delegateTarget,
                this._getDelegateConfig()
            );
        }
        _isAnimated() {
            return (
                this._config.animation ||
                (this.tip && this.tip.classList.contains(Ci))
            );
        }
        _isShown() {
            return this.tip && this.tip.classList.contains(Ti);
        }
        _createPopper(t) {
            const e = v(this._config.placement, [this, t, this._element]),
                s = Oi[e.toUpperCase()];
            return i.createPopper(this._element, t, this._getPopperConfig(s));
        }
        _getOffset() {
            const { offset: t } = this._config;
            return "string" == typeof t
                ? t.split(",").map((t) => Number.parseInt(t, 10))
                : "function" == typeof t
                ? (e) => t(e, this._element)
                : t;
        }
        _resolvePossibleFunction(t) {
            return v(t, [this._element]);
        }
        _getPopperConfig(t) {
            const e = {
                placement: t,
                modifiers: [
                    {
                        name: "flip",
                        options: {
                            fallbackPlacements: this._config.fallbackPlacements,
                        },
                    },
                    { name: "offset", options: { offset: this._getOffset() } },
                    {
                        name: "preventOverflow",
                        options: { boundary: this._config.boundary },
                    },
                    {
                        name: "arrow",
                        options: { element: `.${this.constructor.NAME}-arrow` },
                    },
                    {
                        name: "preSetPlacement",
                        enabled: !0,
                        phase: "beforeMain",
                        fn: (t) => {
                            this._getTipElement().setAttribute(
                                "data-popper-placement",
                                t.state.placement
                            );
                        },
                    },
                ],
            };
            return { ...e, ...v(this._config.popperConfig, [e]) };
        }
        _setListeners() {
            const t = this._config.trigger.split(" ");
            for (const e of t)
                if ("click" === e)
                    j.on(
                        this._element,
                        this.constructor.eventName("click"),
                        this._config.selector,
                        (t) => {
                            this._initializeOnDelegatedTarget(t).toggle();
                        }
                    );
                else if ("manual" !== e) {
                    const t =
                            e === Si
                                ? this.constructor.eventName("mouseenter")
                                : this.constructor.eventName("focusin"),
                        i =
                            e === Si
                                ? this.constructor.eventName("mouseleave")
                                : this.constructor.eventName("focusout");
                    j.on(this._element, t, this._config.selector, (t) => {
                        const e = this._initializeOnDelegatedTarget(t);
                        (e._activeTrigger["focusin" === t.type ? Li : Si] = !0),
                            e._enter();
                    }),
                        j.on(this._element, i, this._config.selector, (t) => {
                            const e = this._initializeOnDelegatedTarget(t);
                            (e._activeTrigger["focusout" === t.type ? Li : Si] =
                                e._element.contains(t.relatedTarget)),
                                e._leave();
                        });
                }
            (this._hideModalHandler = () => {
                this._element && this.hide();
            }),
                j.on(this._element.closest(ki), $i, this._hideModalHandler);
        }
        _fixTitle() {
            const t = this._element.getAttribute("title");
            t &&
                (this._element.getAttribute("aria-label") ||
                    this._element.textContent.trim() ||
                    this._element.setAttribute("aria-label", t),
                this._element.setAttribute("data-bs-original-title", t),
                this._element.removeAttribute("title"));
        }
        _enter() {
            this._isShown() || this._isHovered
                ? (this._isHovered = !0)
                : ((this._isHovered = !0),
                  this._setTimeout(() => {
                      this._isHovered && this.show();
                  }, this._config.delay.show));
        }
        _leave() {
            this._isWithActiveTrigger() ||
                ((this._isHovered = !1),
                this._setTimeout(() => {
                    this._isHovered || this.hide();
                }, this._config.delay.hide));
        }
        _setTimeout(t, e) {
            clearTimeout(this._timeout), (this._timeout = setTimeout(t, e));
        }
        _isWithActiveTrigger() {
            return Object.values(this._activeTrigger).includes(!0);
        }
        _getConfig(t) {
            const e = B.getDataAttributes(this._element);
            for (const t of Object.keys(e)) Ei.has(t) && delete e[t];
            return (
                (t = { ...e, ...("object" == typeof t && t ? t : {}) }),
                (t = this._mergeConfigObj(t)),
                (t = this._configAfterMerge(t)),
                this._typeCheckConfig(t),
                t
            );
        }
        _configAfterMerge(t) {
            return (
                (t.container =
                    !1 === t.container ? document.body : c(t.container)),
                "number" == typeof t.delay &&
                    (t.delay = { show: t.delay, hide: t.delay }),
                "number" == typeof t.title && (t.title = t.title.toString()),
                "number" == typeof t.content &&
                    (t.content = t.content.toString()),
                t
            );
        }
        _getDelegateConfig() {
            const t = {};
            for (const [e, i] of Object.entries(this._config))
                this.constructor.Default[e] !== i && (t[e] = i);
            return (t.selector = !1), (t.trigger = "manual"), t;
        }
        _disposePopper() {
            this._popper && (this._popper.destroy(), (this._popper = null)),
                this.tip && (this.tip.remove(), (this.tip = null));
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = Ni.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (void 0 === e[t])
                        throw new TypeError(`No method named "${t}"`);
                    e[t]();
                }
            });
        }
    }
    b(Ni);
    const Pi = {
            ...Ni.Default,
            content: "",
            offset: [0, 8],
            placement: "right",
            template:
                '<div class="popover" role="tooltip"><div class="popover-arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
            trigger: "click",
        },
        xi = { ...Ni.DefaultType, content: "(null|string|element|function)" };
    class Mi extends Ni {
        static get Default() {
            return Pi;
        }
        static get DefaultType() {
            return xi;
        }
        static get NAME() {
            return "popover";
        }
        _isWithContent() {
            return this._getTitle() || this._getContent();
        }
        _getContentForTemplate() {
            return {
                ".popover-header": this._getTitle(),
                ".popover-body": this._getContent(),
            };
        }
        _getContent() {
            return this._resolvePossibleFunction(this._config.content);
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = Mi.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (void 0 === e[t])
                        throw new TypeError(`No method named "${t}"`);
                    e[t]();
                }
            });
        }
    }
    b(Mi);
    const ji = ".bs.scrollspy",
        Fi = `activate${ji}`,
        zi = `click${ji}`,
        Hi = `load${ji}.data-api`,
        Bi = "active",
        qi = "[href]",
        Wi = ".nav-link",
        Ri = `${Wi}, .nav-item > ${Wi}, .list-group-item`,
        Ki = {
            offset: null,
            rootMargin: "0px 0px -25%",
            smoothScroll: !1,
            target: null,
            threshold: [0.1, 0.5, 1],
        },
        Vi = {
            offset: "(number|null)",
            rootMargin: "string",
            smoothScroll: "boolean",
            target: "element",
            threshold: "array",
        };
    class Qi extends W {
        constructor(t, e) {
            super(t, e),
                (this._targetLinks = new Map()),
                (this._observableSections = new Map()),
                (this._rootElement =
                    "visible" === getComputedStyle(this._element).overflowY
                        ? null
                        : this._element),
                (this._activeTarget = null),
                (this._observer = null),
                (this._previousScrollData = {
                    visibleEntryTop: 0,
                    parentScrollTop: 0,
                }),
                this.refresh();
        }
        static get Default() {
            return Ki;
        }
        static get DefaultType() {
            return Vi;
        }
        static get NAME() {
            return "scrollspy";
        }
        refresh() {
            this._initializeTargetsAndObservables(),
                this._maybeEnableSmoothScroll(),
                this._observer
                    ? this._observer.disconnect()
                    : (this._observer = this._getNewObserver());
            for (const t of this._observableSections.values())
                this._observer.observe(t);
        }
        dispose() {
            this._observer.disconnect(), super.dispose();
        }
        _configAfterMerge(t) {
            return (
                (t.target = c(t.target) || document.body),
                (t.rootMargin = t.offset
                    ? `${t.offset}px 0px -30%`
                    : t.rootMargin),
                "string" == typeof t.threshold &&
                    (t.threshold = t.threshold
                        .split(",")
                        .map((t) => Number.parseFloat(t))),
                t
            );
        }
        _maybeEnableSmoothScroll() {
            this._config.smoothScroll &&
                (j.off(this._config.target, zi),
                j.on(this._config.target, zi, qi, (t) => {
                    const e = this._observableSections.get(t.target.hash);
                    if (e) {
                        t.preventDefault();
                        const i = this._rootElement || window,
                            s = e.offsetTop - this._element.offsetTop;
                        if (i.scrollTo)
                            return void i.scrollTo({
                                top: s,
                                behavior: "smooth",
                            });
                        i.scrollTop = s;
                    }
                }));
        }
        _getNewObserver() {
            const t = {
                root: this._rootElement,
                threshold: this._config.threshold,
                rootMargin: this._config.rootMargin,
            };
            return new IntersectionObserver(
                (t) => this._observerCallback(t),
                t
            );
        }
        _observerCallback(t) {
            const e = (t) => this._targetLinks.get(`#${t.target.id}`),
                i = (t) => {
                    (this._previousScrollData.visibleEntryTop =
                        t.target.offsetTop),
                        this._process(e(t));
                },
                s = (this._rootElement || document.documentElement).scrollTop,
                n = s >= this._previousScrollData.parentScrollTop;
            this._previousScrollData.parentScrollTop = s;
            for (const o of t) {
                if (!o.isIntersecting) {
                    (this._activeTarget = null), this._clearActiveClass(e(o));
                    continue;
                }
                const t =
                    o.target.offsetTop >=
                    this._previousScrollData.visibleEntryTop;
                if (n && t) {
                    if ((i(o), !s)) return;
                } else n || t || i(o);
            }
        }
        _initializeTargetsAndObservables() {
            (this._targetLinks = new Map()),
                (this._observableSections = new Map());
            const t = K.find(qi, this._config.target);
            for (const e of t) {
                if (!e.hash || d(e)) continue;
                const t = K.findOne(decodeURI(e.hash), this._element);
                h(t) &&
                    (this._targetLinks.set(decodeURI(e.hash), e),
                    this._observableSections.set(e.hash, t));
            }
        }
        _process(t) {
            this._activeTarget !== t &&
                (this._clearActiveClass(this._config.target),
                (this._activeTarget = t),
                t.classList.add(Bi),
                this._activateParents(t),
                j.trigger(this._element, Fi, { relatedTarget: t }));
        }
        _activateParents(t) {
            if (t.classList.contains("dropdown-item"))
                K.findOne(
                    ".dropdown-toggle",
                    t.closest(".dropdown")
                ).classList.add(Bi);
            else
                for (const e of K.parents(t, ".nav, .list-group"))
                    for (const t of K.prev(e, Ri)) t.classList.add(Bi);
        }
        _clearActiveClass(t) {
            t.classList.remove(Bi);
            const e = K.find(`${qi}.${Bi}`, t);
            for (const t of e) t.classList.remove(Bi);
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = Qi.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (
                        void 0 === e[t] ||
                        t.startsWith("_") ||
                        "constructor" === t
                    )
                        throw new TypeError(`No method named "${t}"`);
                    e[t]();
                }
            });
        }
    }
    j.on(window, Hi, () => {
        for (const t of K.find('[data-bs-spy="scroll"]'))
            Qi.getOrCreateInstance(t);
    }),
        b(Qi);
    const Xi = ".bs.tab",
        Yi = `hide${Xi}`,
        Ui = `hidden${Xi}`,
        Gi = `show${Xi}`,
        Ji = `shown${Xi}`,
        Zi = `click${Xi}`,
        ts = `keydown${Xi}`,
        es = `load${Xi}`,
        is = "ArrowLeft",
        ss = "ArrowRight",
        ns = "ArrowUp",
        os = "ArrowDown",
        rs = "Home",
        as = "End",
        ls = "active",
        cs = "fade",
        hs = "show",
        ds = ".dropdown-toggle",
        us = `:not(${ds})`,
        _s =
            '[data-bs-toggle="tab"], [data-bs-toggle="pill"], [data-bs-toggle="list"]',
        gs = `.nav-link${us}, .list-group-item${us}, [role="tab"]${us}, ${_s}`,
        fs = `.${ls}[data-bs-toggle="tab"], .${ls}[data-bs-toggle="pill"], .${ls}[data-bs-toggle="list"]`;
    class ms extends W {
        constructor(t) {
            super(t),
                (this._parent = this._element.closest(
                    '.list-group, .nav, [role="tablist"]'
                )),
                this._parent &&
                    (this._setInitialAttributes(
                        this._parent,
                        this._getChildren()
                    ),
                    j.on(this._element, ts, (t) => this._keydown(t)));
        }
        static get NAME() {
            return "tab";
        }
        show() {
            const t = this._element;
            if (this._elemIsActive(t)) return;
            const e = this._getActiveElem(),
                i = e ? j.trigger(e, Yi, { relatedTarget: t }) : null;
            j.trigger(t, Gi, { relatedTarget: e }).defaultPrevented ||
                (i && i.defaultPrevented) ||
                (this._deactivate(e, t), this._activate(t, e));
        }
        _activate(t, e) {
            t &&
                (t.classList.add(ls),
                this._activate(K.getElementFromSelector(t)),
                this._queueCallback(
                    () => {
                        "tab" === t.getAttribute("role")
                            ? (t.removeAttribute("tabindex"),
                              t.setAttribute("aria-selected", !0),
                              this._toggleDropDown(t, !0),
                              j.trigger(t, Ji, { relatedTarget: e }))
                            : t.classList.add(hs);
                    },
                    t,
                    t.classList.contains(cs)
                ));
        }
        _deactivate(t, e) {
            t &&
                (t.classList.remove(ls),
                t.blur(),
                this._deactivate(K.getElementFromSelector(t)),
                this._queueCallback(
                    () => {
                        "tab" === t.getAttribute("role")
                            ? (t.setAttribute("aria-selected", !1),
                              t.setAttribute("tabindex", "-1"),
                              this._toggleDropDown(t, !1),
                              j.trigger(t, Ui, { relatedTarget: e }))
                            : t.classList.remove(hs);
                    },
                    t,
                    t.classList.contains(cs)
                ));
        }
        _keydown(t) {
            if (![is, ss, ns, os, rs, as].includes(t.key)) return;
            t.stopPropagation(), t.preventDefault();
            const e = this._getChildren().filter((t) => !d(t));
            let i;
            if ([rs, as].includes(t.key))
                i = e[t.key === rs ? 0 : e.length - 1];
            else {
                const s = [ss, os].includes(t.key);
                i = w(e, t.target, s, !0);
            }
            i &&
                (i.focus({ preventScroll: !0 }),
                ms.getOrCreateInstance(i).show());
        }
        _getChildren() {
            return K.find(gs, this._parent);
        }
        _getActiveElem() {
            return (
                this._getChildren().find((t) => this._elemIsActive(t)) || null
            );
        }
        _setInitialAttributes(t, e) {
            this._setAttributeIfNotExists(t, "role", "tablist");
            for (const t of e) this._setInitialAttributesOnChild(t);
        }
        _setInitialAttributesOnChild(t) {
            t = this._getInnerElement(t);
            const e = this._elemIsActive(t),
                i = this._getOuterElement(t);
            t.setAttribute("aria-selected", e),
                i !== t &&
                    this._setAttributeIfNotExists(i, "role", "presentation"),
                e || t.setAttribute("tabindex", "-1"),
                this._setAttributeIfNotExists(t, "role", "tab"),
                this._setInitialAttributesOnTargetPanel(t);
        }
        _setInitialAttributesOnTargetPanel(t) {
            const e = K.getElementFromSelector(t);
            e &&
                (this._setAttributeIfNotExists(e, "role", "tabpanel"),
                t.id &&
                    this._setAttributeIfNotExists(
                        e,
                        "aria-labelledby",
                        `${t.id}`
                    ));
        }
        _toggleDropDown(t, e) {
            const i = this._getOuterElement(t);
            if (!i.classList.contains("dropdown")) return;
            const s = (t, s) => {
                const n = K.findOne(t, i);
                n && n.classList.toggle(s, e);
            };
            s(ds, ls),
                s(".dropdown-menu", hs),
                i.setAttribute("aria-expanded", e);
        }
        _setAttributeIfNotExists(t, e, i) {
            t.hasAttribute(e) || t.setAttribute(e, i);
        }
        _elemIsActive(t) {
            return t.classList.contains(ls);
        }
        _getInnerElement(t) {
            return t.matches(gs) ? t : K.findOne(gs, t);
        }
        _getOuterElement(t) {
            return t.closest(".nav-item, .list-group-item") || t;
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = ms.getOrCreateInstance(this);
                if ("string" == typeof t) {
                    if (
                        void 0 === e[t] ||
                        t.startsWith("_") ||
                        "constructor" === t
                    )
                        throw new TypeError(`No method named "${t}"`);
                    e[t]();
                }
            });
        }
    }
    j.on(document, Zi, _s, function (t) {
        ["A", "AREA"].includes(this.tagName) && t.preventDefault(),
            d(this) || ms.getOrCreateInstance(this).show();
    }),
        j.on(window, es, () => {
            for (const t of K.find(fs)) ms.getOrCreateInstance(t);
        }),
        b(ms);
    const ps = ".bs.toast",
        bs = `mouseover${ps}`,
        vs = `mouseout${ps}`,
        ys = `focusin${ps}`,
        ws = `focusout${ps}`,
        As = `hide${ps}`,
        Es = `hidden${ps}`,
        Cs = `show${ps}`,
        Ts = `shown${ps}`,
        ks = "hide",
        $s = "show",
        Ss = "showing",
        Ls = { animation: "boolean", autohide: "boolean", delay: "number" },
        Os = { animation: !0, autohide: !0, delay: 5e3 };
    class Is extends W {
        constructor(t, e) {
            super(t, e),
                (this._timeout = null),
                (this._hasMouseInteraction = !1),
                (this._hasKeyboardInteraction = !1),
                this._setListeners();
        }
        static get Default() {
            return Os;
        }
        static get DefaultType() {
            return Ls;
        }
        static get NAME() {
            return "toast";
        }
        show() {
            j.trigger(this._element, Cs).defaultPrevented ||
                (this._clearTimeout(),
                this._config.animation && this._element.classList.add("fade"),
                this._element.classList.remove(ks),
                g(this._element),
                this._element.classList.add($s, Ss),
                this._queueCallback(
                    () => {
                        this._element.classList.remove(Ss),
                            j.trigger(this._element, Ts),
                            this._maybeScheduleHide();
                    },
                    this._element,
                    this._config.animation
                ));
        }
        hide() {
            this.isShown() &&
                (j.trigger(this._element, As).defaultPrevented ||
                    (this._element.classList.add(Ss),
                    this._queueCallback(
                        () => {
                            this._element.classList.add(ks),
                                this._element.classList.remove(Ss, $s),
                                j.trigger(this._element, Es);
                        },
                        this._element,
                        this._config.animation
                    )));
        }
        dispose() {
            this._clearTimeout(),
                this.isShown() && this._element.classList.remove($s),
                super.dispose();
        }
        isShown() {
            return this._element.classList.contains($s);
        }
        _maybeScheduleHide() {
            this._config.autohide &&
                (this._hasMouseInteraction ||
                    this._hasKeyboardInteraction ||
                    (this._timeout = setTimeout(() => {
                        this.hide();
                    }, this._config.delay)));
        }
        _onInteraction(t, e) {
            switch (t.type) {
                case "mouseover":
                case "mouseout":
                    this._hasMouseInteraction = e;
                    break;
                case "focusin":
                case "focusout":
                    this._hasKeyboardInteraction = e;
            }
            if (e) return void this._clearTimeout();
            const i = t.relatedTarget;
            this._element === i ||
                this._element.contains(i) ||
                this._maybeScheduleHide();
        }
        _setListeners() {
            j.on(this._element, bs, (t) => this._onInteraction(t, !0)),
                j.on(this._element, vs, (t) => this._onInteraction(t, !1)),
                j.on(this._element, ys, (t) => this._onInteraction(t, !0)),
                j.on(this._element, ws, (t) => this._onInteraction(t, !1));
        }
        _clearTimeout() {
            clearTimeout(this._timeout), (this._timeout = null);
        }
        static jQueryInterface(t) {
            return this.each(function () {
                const e = Is.getOrCreateInstance(this, t);
                if ("string" == typeof t) {
                    if (void 0 === e[t])
                        throw new TypeError(`No method named "${t}"`);
                    e[t](this);
                }
            });
        }
    }
    return (
        V(Is),
        b(Is),
        {
            Alert: U,
            Button: J,
            Carousel: Ot,
            Collapse: Rt,
            Dropdown: fe,
            Modal: Ue,
            Offcanvas: gi,
            Popover: Mi,
            ScrollSpy: Qi,
            Tab: ms,
            Toast: Is,
            Tooltip: Ni,
        }
    );
});
//# sourceMappingURL=bootstrap.min.js.map

/**
 * Owl Carousel v2.3.4
 * Copyright 2013-2018 David Deutsch
 * Licensed under: SEE LICENSE IN https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE
 */
!(function (a, b, c, d) {
    function e(b, c) {
        (this.settings = null),
            (this.options = a.extend({}, e.Defaults, c)),
            (this.$element = a(b)),
            (this._handlers = {}),
            (this._plugins = {}),
            (this._supress = {}),
            (this._current = null),
            (this._speed = null),
            (this._coordinates = []),
            (this._breakpoint = null),
            (this._width = null),
            (this._items = []),
            (this._clones = []),
            (this._mergers = []),
            (this._widths = []),
            (this._invalidated = {}),
            (this._pipe = []),
            (this._drag = {
                time: null,
                target: null,
                pointer: null,
                stage: { start: null, current: null },
                direction: null,
            }),
            (this._states = {
                current: {},
                tags: {
                    initializing: ["busy"],
                    animating: ["busy"],
                    dragging: ["interacting"],
                },
            }),
            a.each(
                ["onResize", "onThrottledResize"],
                a.proxy(function (b, c) {
                    this._handlers[c] = a.proxy(this[c], this);
                }, this)
            ),
            a.each(
                e.Plugins,
                a.proxy(function (a, b) {
                    this._plugins[a.charAt(0).toLowerCase() + a.slice(1)] =
                        new b(this);
                }, this)
            ),
            a.each(
                e.Workers,
                a.proxy(function (b, c) {
                    this._pipe.push({
                        filter: c.filter,
                        run: a.proxy(c.run, this),
                    });
                }, this)
            ),
            this.setup(),
            this.initialize();
    }
    (e.Defaults = {
        items: 3,
        loop: !1,
        center: !1,
        rewind: !1,
        checkVisibility: !0,
        mouseDrag: !0,
        touchDrag: !0,
        pullDrag: !0,
        freeDrag: !1,
        margin: 0,
        stagePadding: 0,
        merge: !1,
        mergeFit: !0,
        autoWidth: !1,
        startPosition: 0,
        rtl: !1,
        smartSpeed: 250,
        fluidSpeed: !1,
        dragEndSpeed: !1,
        responsive: {},
        responsiveRefreshRate: 200,
        responsiveBaseElement: b,
        fallbackEasing: "swing",
        slideTransition: "",
        info: !1,
        nestedItemSelector: !1,
        itemElement: "div",
        stageElement: "div",
        refreshClass: "owl-refresh",
        loadedClass: "owl-loaded",
        loadingClass: "owl-loading",
        rtlClass: "owl-rtl",
        responsiveClass: "owl-responsive",
        dragClass: "owl-drag",
        itemClass: "owl-item",
        stageClass: "owl-stage",
        stageOuterClass: "owl-stage-outer",
        grabClass: "owl-grab",
    }),
        (e.Width = { Default: "default", Inner: "inner", Outer: "outer" }),
        (e.Type = { Event: "event", State: "state" }),
        (e.Plugins = {}),
        (e.Workers = [
            {
                filter: ["width", "settings"],
                run: function () {
                    this._width = this.$element.width();
                },
            },
            {
                filter: ["width", "items", "settings"],
                run: function (a) {
                    a.current =
                        this._items &&
                        this._items[this.relative(this._current)];
                },
            },
            {
                filter: ["items", "settings"],
                run: function () {
                    this.$stage.children(".cloned").remove();
                },
            },
            {
                filter: ["width", "items", "settings"],
                run: function (a) {
                    var b = this.settings.margin || "",
                        c = !this.settings.autoWidth,
                        d = this.settings.rtl,
                        e = {
                            width: "auto",
                            "margin-left": d ? b : "",
                            "margin-right": d ? "" : b,
                        };
                    !c && this.$stage.children().css(e), (a.css = e);
                },
            },
            {
                filter: ["width", "items", "settings"],
                run: function (a) {
                    var b =
                            (this.width() / this.settings.items).toFixed(3) -
                            this.settings.margin,
                        c = null,
                        d = this._items.length,
                        e = !this.settings.autoWidth,
                        f = [];
                    for (a.items = { merge: !1, width: b }; d--; )
                        (c = this._mergers[d]),
                            (c =
                                (this.settings.mergeFit &&
                                    Math.min(c, this.settings.items)) ||
                                c),
                            (a.items.merge = c > 1 || a.items.merge),
                            (f[d] = e ? b * c : this._items[d].width());
                    this._widths = f;
                },
            },
            {
                filter: ["items", "settings"],
                run: function () {
                    var b = [],
                        c = this._items,
                        d = this.settings,
                        e = Math.max(2 * d.items, 4),
                        f = 2 * Math.ceil(c.length / 2),
                        g =
                            d.loop && c.length
                                ? d.rewind
                                    ? e
                                    : Math.max(e, f)
                                : 0,
                        h = "",
                        i = "";
                    for (g /= 2; g > 0; )
                        b.push(this.normalize(b.length / 2, !0)),
                            (h += c[b[b.length - 1]][0].outerHTML),
                            b.push(
                                this.normalize(
                                    c.length - 1 - (b.length - 1) / 2,
                                    !0
                                )
                            ),
                            (i = c[b[b.length - 1]][0].outerHTML + i),
                            (g -= 1);
                    (this._clones = b),
                        a(h).addClass("cloned").appendTo(this.$stage),
                        a(i).addClass("cloned").prependTo(this.$stage);
                },
            },
            {
                filter: ["width", "items", "settings"],
                run: function () {
                    for (
                        var a = this.settings.rtl ? 1 : -1,
                            b = this._clones.length + this._items.length,
                            c = -1,
                            d = 0,
                            e = 0,
                            f = [];
                        ++c < b;

                    )
                        (d = f[c - 1] || 0),
                            (e =
                                this._widths[this.relative(c)] +
                                this.settings.margin),
                            f.push(d + e * a);
                    this._coordinates = f;
                },
            },
            {
                filter: ["width", "items", "settings"],
                run: function () {
                    var a = this.settings.stagePadding,
                        b = this._coordinates,
                        c = {
                            width: Math.ceil(Math.abs(b[b.length - 1])) + 2 * a,
                            "padding-left": a || "",
                            "padding-right": a || "",
                        };
                    this.$stage.css(c);
                },
            },
            {
                filter: ["width", "items", "settings"],
                run: function (a) {
                    var b = this._coordinates.length,
                        c = !this.settings.autoWidth,
                        d = this.$stage.children();
                    if (c && a.items.merge)
                        for (; b--; )
                            (a.css.width = this._widths[this.relative(b)]),
                                d.eq(b).css(a.css);
                    else c && ((a.css.width = a.items.width), d.css(a.css));
                },
            },
            {
                filter: ["items"],
                run: function () {
                    this._coordinates.length < 1 &&
                        this.$stage.removeAttr("style");
                },
            },
            {
                filter: ["width", "items", "settings"],
                run: function (a) {
                    (a.current = a.current
                        ? this.$stage.children().index(a.current)
                        : 0),
                        (a.current = Math.max(
                            this.minimum(),
                            Math.min(this.maximum(), a.current)
                        )),
                        this.reset(a.current);
                },
            },
            {
                filter: ["position"],
                run: function () {
                    this.animate(this.coordinates(this._current));
                },
            },
            {
                filter: ["width", "position", "items", "settings"],
                run: function () {
                    var a,
                        b,
                        c,
                        d,
                        e = this.settings.rtl ? 1 : -1,
                        f = 2 * this.settings.stagePadding,
                        g = this.coordinates(this.current()) + f,
                        h = g + this.width() * e,
                        i = [];
                    for (c = 0, d = this._coordinates.length; c < d; c++)
                        (a = this._coordinates[c - 1] || 0),
                            (b = Math.abs(this._coordinates[c]) + f * e),
                            ((this.op(a, "<=", g) && this.op(a, ">", h)) ||
                                (this.op(b, "<", g) && this.op(b, ">", h))) &&
                                i.push(c);
                    this.$stage.children(".active").removeClass("active"),
                        this.$stage
                            .children(":eq(" + i.join("), :eq(") + ")")
                            .addClass("active"),
                        this.$stage.children(".center").removeClass("center"),
                        this.settings.center &&
                            this.$stage
                                .children()
                                .eq(this.current())
                                .addClass("center");
                },
            },
        ]),
        (e.prototype.initializeStage = function () {
            (this.$stage = this.$element.find("." + this.settings.stageClass)),
                this.$stage.length ||
                    (this.$element.addClass(this.options.loadingClass),
                    (this.$stage = a("<" + this.settings.stageElement + ">", {
                        class: this.settings.stageClass,
                    }).wrap(
                        a("<div/>", { class: this.settings.stageOuterClass })
                    )),
                    this.$element.append(this.$stage.parent()));
        }),
        (e.prototype.initializeItems = function () {
            var b = this.$element.find(".owl-item");
            if (b.length)
                return (
                    (this._items = b.get().map(function (b) {
                        return a(b);
                    })),
                    (this._mergers = this._items.map(function () {
                        return 1;
                    })),
                    void this.refresh()
                );
            this.replace(this.$element.children().not(this.$stage.parent())),
                this.isVisible() ? this.refresh() : this.invalidate("width"),
                this.$element
                    .removeClass(this.options.loadingClass)
                    .addClass(this.options.loadedClass);
        }),
        (e.prototype.initialize = function () {
            if (
                (this.enter("initializing"),
                this.trigger("initialize"),
                this.$element.toggleClass(
                    this.settings.rtlClass,
                    this.settings.rtl
                ),
                this.settings.autoWidth && !this.is("pre-loading"))
            ) {
                var a, b, c;
                (a = this.$element.find("img")),
                    (b = this.settings.nestedItemSelector
                        ? "." + this.settings.nestedItemSelector
                        : d),
                    (c = this.$element.children(b).width()),
                    a.length && c <= 0 && this.preloadAutoWidthImages(a);
            }
            this.initializeStage(),
                this.initializeItems(),
                this.registerEventHandlers(),
                this.leave("initializing"),
                this.trigger("initialized");
        }),
        (e.prototype.isVisible = function () {
            return (
                !this.settings.checkVisibility || this.$element.is(":visible")
            );
        }),
        (e.prototype.setup = function () {
            var b = this.viewport(),
                c = this.options.responsive,
                d = -1,
                e = null;
            c
                ? (a.each(c, function (a) {
                      a <= b && a > d && (d = Number(a));
                  }),
                  (e = a.extend({}, this.options, c[d])),
                  "function" == typeof e.stagePadding &&
                      (e.stagePadding = e.stagePadding()),
                  delete e.responsive,
                  e.responsiveClass &&
                      this.$element.attr(
                          "class",
                          this.$element
                              .attr("class")
                              .replace(
                                  new RegExp(
                                      "(" +
                                          this.options.responsiveClass +
                                          "-)\\S+\\s",
                                      "g"
                                  ),
                                  "$1" + d
                              )
                      ))
                : (e = a.extend({}, this.options)),
                this.trigger("change", {
                    property: { name: "settings", value: e },
                }),
                (this._breakpoint = d),
                (this.settings = e),
                this.invalidate("settings"),
                this.trigger("changed", {
                    property: { name: "settings", value: this.settings },
                });
        }),
        (e.prototype.optionsLogic = function () {
            this.settings.autoWidth &&
                ((this.settings.stagePadding = !1), (this.settings.merge = !1));
        }),
        (e.prototype.prepare = function (b) {
            var c = this.trigger("prepare", { content: b });
            return (
                c.data ||
                    (c.data = a("<" + this.settings.itemElement + "/>")
                        .addClass(this.options.itemClass)
                        .append(b)),
                this.trigger("prepared", { content: c.data }),
                c.data
            );
        }),
        (e.prototype.update = function () {
            for (
                var b = 0,
                    c = this._pipe.length,
                    d = a.proxy(function (a) {
                        return this[a];
                    }, this._invalidated),
                    e = {};
                b < c;

            )
                (this._invalidated.all ||
                    a.grep(this._pipe[b].filter, d).length > 0) &&
                    this._pipe[b].run(e),
                    b++;
            (this._invalidated = {}), !this.is("valid") && this.enter("valid");
        }),
        (e.prototype.width = function (a) {
            switch ((a = a || e.Width.Default)) {
                case e.Width.Inner:
                case e.Width.Outer:
                    return this._width;
                default:
                    return (
                        this._width -
                        2 * this.settings.stagePadding +
                        this.settings.margin
                    );
            }
        }),
        (e.prototype.refresh = function () {
            this.enter("refreshing"),
                this.trigger("refresh"),
                this.setup(),
                this.optionsLogic(),
                this.$element.addClass(this.options.refreshClass),
                this.update(),
                this.$element.removeClass(this.options.refreshClass),
                this.leave("refreshing"),
                this.trigger("refreshed");
        }),
        (e.prototype.onThrottledResize = function () {
            b.clearTimeout(this.resizeTimer),
                (this.resizeTimer = b.setTimeout(
                    this._handlers.onResize,
                    this.settings.responsiveRefreshRate
                ));
        }),
        (e.prototype.onResize = function () {
            return (
                !!this._items.length &&
                this._width !== this.$element.width() &&
                !!this.isVisible() &&
                (this.enter("resizing"),
                this.trigger("resize").isDefaultPrevented()
                    ? (this.leave("resizing"), !1)
                    : (this.invalidate("width"),
                      this.refresh(),
                      this.leave("resizing"),
                      void this.trigger("resized")))
            );
        }),
        (e.prototype.registerEventHandlers = function () {
            a.support.transition &&
                this.$stage.on(
                    a.support.transition.end + ".owl.core",
                    a.proxy(this.onTransitionEnd, this)
                ),
                !1 !== this.settings.responsive &&
                    this.on(b, "resize", this._handlers.onThrottledResize),
                this.settings.mouseDrag &&
                    (this.$element.addClass(this.options.dragClass),
                    this.$stage.on(
                        "mousedown.owl.core",
                        a.proxy(this.onDragStart, this)
                    ),
                    this.$stage.on(
                        "dragstart.owl.core selectstart.owl.core",
                        function () {
                            return !1;
                        }
                    )),
                this.settings.touchDrag &&
                    (this.$stage.on(
                        "touchstart.owl.core",
                        a.proxy(this.onDragStart, this)
                    ),
                    this.$stage.on(
                        "touchcancel.owl.core",
                        a.proxy(this.onDragEnd, this)
                    ));
        }),
        (e.prototype.onDragStart = function (b) {
            var d = null;
            3 !== b.which &&
                (a.support.transform
                    ? ((d = this.$stage
                          .css("transform")
                          .replace(/.*\(|\)| /g, "")
                          .split(",")),
                      (d = {
                          x: d[16 === d.length ? 12 : 4],
                          y: d[16 === d.length ? 13 : 5],
                      }))
                    : ((d = this.$stage.position()),
                      (d = {
                          x: this.settings.rtl
                              ? d.left +
                                this.$stage.width() -
                                this.width() +
                                this.settings.margin
                              : d.left,
                          y: d.top,
                      })),
                this.is("animating") &&
                    (a.support.transform
                        ? this.animate(d.x)
                        : this.$stage.stop(),
                    this.invalidate("position")),
                this.$element.toggleClass(
                    this.options.grabClass,
                    "mousedown" === b.type
                ),
                this.speed(0),
                (this._drag.time = new Date().getTime()),
                (this._drag.target = a(b.target)),
                (this._drag.stage.start = d),
                (this._drag.stage.current = d),
                (this._drag.pointer = this.pointer(b)),
                a(c).on(
                    "mouseup.owl.core touchend.owl.core",
                    a.proxy(this.onDragEnd, this)
                ),
                a(c).one(
                    "mousemove.owl.core touchmove.owl.core",
                    a.proxy(function (b) {
                        var d = this.difference(
                            this._drag.pointer,
                            this.pointer(b)
                        );
                        a(c).on(
                            "mousemove.owl.core touchmove.owl.core",
                            a.proxy(this.onDragMove, this)
                        ),
                            (Math.abs(d.x) < Math.abs(d.y) &&
                                this.is("valid")) ||
                                (b.preventDefault(),
                                this.enter("dragging"),
                                this.trigger("drag"));
                    }, this)
                ));
        }),
        (e.prototype.onDragMove = function (a) {
            var b = null,
                c = null,
                d = null,
                e = this.difference(this._drag.pointer, this.pointer(a)),
                f = this.difference(this._drag.stage.start, e);
            this.is("dragging") &&
                (a.preventDefault(),
                this.settings.loop
                    ? ((b = this.coordinates(this.minimum())),
                      (c = this.coordinates(this.maximum() + 1) - b),
                      (f.x = ((((f.x - b) % c) + c) % c) + b))
                    : ((b = this.settings.rtl
                          ? this.coordinates(this.maximum())
                          : this.coordinates(this.minimum())),
                      (c = this.settings.rtl
                          ? this.coordinates(this.minimum())
                          : this.coordinates(this.maximum())),
                      (d = this.settings.pullDrag ? (-1 * e.x) / 5 : 0),
                      (f.x = Math.max(Math.min(f.x, b + d), c + d))),
                (this._drag.stage.current = f),
                this.animate(f.x));
        }),
        (e.prototype.onDragEnd = function (b) {
            var d = this.difference(this._drag.pointer, this.pointer(b)),
                e = this._drag.stage.current,
                f = (d.x > 0) ^ this.settings.rtl ? "left" : "right";
            a(c).off(".owl.core"),
                this.$element.removeClass(this.options.grabClass),
                ((0 !== d.x && this.is("dragging")) || !this.is("valid")) &&
                    (this.speed(
                        this.settings.dragEndSpeed || this.settings.smartSpeed
                    ),
                    this.current(
                        this.closest(e.x, 0 !== d.x ? f : this._drag.direction)
                    ),
                    this.invalidate("position"),
                    this.update(),
                    (this._drag.direction = f),
                    (Math.abs(d.x) > 3 ||
                        new Date().getTime() - this._drag.time > 300) &&
                        this._drag.target.one("click.owl.core", function () {
                            return !1;
                        })),
                this.is("dragging") &&
                    (this.leave("dragging"), this.trigger("dragged"));
        }),
        (e.prototype.closest = function (b, c) {
            var e = -1,
                f = 30,
                g = this.width(),
                h = this.coordinates();
            return (
                this.settings.freeDrag ||
                    a.each(
                        h,
                        a.proxy(function (a, i) {
                            return (
                                "left" === c && b > i - f && b < i + f
                                    ? (e = a)
                                    : "right" === c &&
                                      b > i - g - f &&
                                      b < i - g + f
                                    ? (e = a + 1)
                                    : this.op(b, "<", i) &&
                                      this.op(
                                          b,
                                          ">",
                                          h[a + 1] !== d ? h[a + 1] : i - g
                                      ) &&
                                      (e = "left" === c ? a + 1 : a),
                                -1 === e
                            );
                        }, this)
                    ),
                this.settings.loop ||
                    (this.op(b, ">", h[this.minimum()])
                        ? (e = b = this.minimum())
                        : this.op(b, "<", h[this.maximum()]) &&
                          (e = b = this.maximum())),
                e
            );
        }),
        (e.prototype.animate = function (b) {
            var c = this.speed() > 0;
            this.is("animating") && this.onTransitionEnd(),
                c && (this.enter("animating"), this.trigger("translate")),
                a.support.transform3d && a.support.transition
                    ? this.$stage.css({
                          transform: "translate3d(" + b + "px,0px,0px)",
                          transition:
                              this.speed() / 1e3 +
                              "s" +
                              (this.settings.slideTransition
                                  ? " " + this.settings.slideTransition
                                  : ""),
                      })
                    : c
                    ? this.$stage.animate(
                          { left: b + "px" },
                          this.speed(),
                          this.settings.fallbackEasing,
                          a.proxy(this.onTransitionEnd, this)
                      )
                    : this.$stage.css({ left: b + "px" });
        }),
        (e.prototype.is = function (a) {
            return this._states.current[a] && this._states.current[a] > 0;
        }),
        (e.prototype.current = function (a) {
            if (a === d) return this._current;
            if (0 === this._items.length) return d;
            if (((a = this.normalize(a)), this._current !== a)) {
                var b = this.trigger("change", {
                    property: { name: "position", value: a },
                });
                b.data !== d && (a = this.normalize(b.data)),
                    (this._current = a),
                    this.invalidate("position"),
                    this.trigger("changed", {
                        property: { name: "position", value: this._current },
                    });
            }
            return this._current;
        }),
        (e.prototype.invalidate = function (b) {
            return (
                "string" === a.type(b) &&
                    ((this._invalidated[b] = !0),
                    this.is("valid") && this.leave("valid")),
                a.map(this._invalidated, function (a, b) {
                    return b;
                })
            );
        }),
        (e.prototype.reset = function (a) {
            (a = this.normalize(a)) !== d &&
                ((this._speed = 0),
                (this._current = a),
                this.suppress(["translate", "translated"]),
                this.animate(this.coordinates(a)),
                this.release(["translate", "translated"]));
        }),
        (e.prototype.normalize = function (a, b) {
            var c = this._items.length,
                e = b ? 0 : this._clones.length;
            return (
                !this.isNumeric(a) || c < 1
                    ? (a = d)
                    : (a < 0 || a >= c + e) &&
                      (a = ((((a - e / 2) % c) + c) % c) + e / 2),
                a
            );
        }),
        (e.prototype.relative = function (a) {
            return (a -= this._clones.length / 2), this.normalize(a, !0);
        }),
        (e.prototype.maximum = function (a) {
            var b,
                c,
                d,
                e = this.settings,
                f = this._coordinates.length;
            if (e.loop) f = this._clones.length / 2 + this._items.length - 1;
            else if (e.autoWidth || e.merge) {
                if ((b = this._items.length))
                    for (
                        c = this._items[--b].width(), d = this.$element.width();
                        b-- &&
                        !(
                            (c +=
                                this._items[b].width() + this.settings.margin) >
                            d
                        );

                    );
                f = b + 1;
            } else
                f = e.center
                    ? this._items.length - 1
                    : this._items.length - e.items;
            return a && (f -= this._clones.length / 2), Math.max(f, 0);
        }),
        (e.prototype.minimum = function (a) {
            return a ? 0 : this._clones.length / 2;
        }),
        (e.prototype.items = function (a) {
            return a === d
                ? this._items.slice()
                : ((a = this.normalize(a, !0)), this._items[a]);
        }),
        (e.prototype.mergers = function (a) {
            return a === d
                ? this._mergers.slice()
                : ((a = this.normalize(a, !0)), this._mergers[a]);
        }),
        (e.prototype.clones = function (b) {
            var c = this._clones.length / 2,
                e = c + this._items.length,
                f = function (a) {
                    return a % 2 == 0 ? e + a / 2 : c - (a + 1) / 2;
                };
            return b === d
                ? a.map(this._clones, function (a, b) {
                      return f(b);
                  })
                : a.map(this._clones, function (a, c) {
                      return a === b ? f(c) : null;
                  });
        }),
        (e.prototype.speed = function (a) {
            return a !== d && (this._speed = a), this._speed;
        }),
        (e.prototype.coordinates = function (b) {
            var c,
                e = 1,
                f = b - 1;
            return b === d
                ? a.map(
                      this._coordinates,
                      a.proxy(function (a, b) {
                          return this.coordinates(b);
                      }, this)
                  )
                : (this.settings.center
                      ? (this.settings.rtl && ((e = -1), (f = b + 1)),
                        (c = this._coordinates[b]),
                        (c +=
                            ((this.width() - c + (this._coordinates[f] || 0)) /
                                2) *
                            e))
                      : (c = this._coordinates[f] || 0),
                  (c = Math.ceil(c)));
        }),
        (e.prototype.duration = function (a, b, c) {
            return 0 === c
                ? 0
                : Math.min(Math.max(Math.abs(b - a), 1), 6) *
                      Math.abs(c || this.settings.smartSpeed);
        }),
        (e.prototype.to = function (a, b) {
            var c = this.current(),
                d = null,
                e = a - this.relative(c),
                f = (e > 0) - (e < 0),
                g = this._items.length,
                h = this.minimum(),
                i = this.maximum();
            this.settings.loop
                ? (!this.settings.rewind &&
                      Math.abs(e) > g / 2 &&
                      (e += -1 * f * g),
                  (a = c + e),
                  (d = ((((a - h) % g) + g) % g) + h) !== a &&
                      d - e <= i &&
                      d - e > 0 &&
                      ((c = d - e), (a = d), this.reset(c)))
                : this.settings.rewind
                ? ((i += 1), (a = ((a % i) + i) % i))
                : (a = Math.max(h, Math.min(i, a))),
                this.speed(this.duration(c, a, b)),
                this.current(a),
                this.isVisible() && this.update();
        }),
        (e.prototype.next = function (a) {
            (a = a || !1), this.to(this.relative(this.current()) + 1, a);
        }),
        (e.prototype.prev = function (a) {
            (a = a || !1), this.to(this.relative(this.current()) - 1, a);
        }),
        (e.prototype.onTransitionEnd = function (a) {
            if (
                a !== d &&
                (a.stopPropagation(),
                (a.target || a.srcElement || a.originalTarget) !==
                    this.$stage.get(0))
            )
                return !1;
            this.leave("animating"), this.trigger("translated");
        }),
        (e.prototype.viewport = function () {
            var d;
            return (
                this.options.responsiveBaseElement !== b
                    ? (d = a(this.options.responsiveBaseElement).width())
                    : b.innerWidth
                    ? (d = b.innerWidth)
                    : c.documentElement && c.documentElement.clientWidth
                    ? (d = c.documentElement.clientWidth)
                    : console.warn("Can not detect viewport width."),
                d
            );
        }),
        (e.prototype.replace = function (b) {
            this.$stage.empty(),
                (this._items = []),
                b && (b = b instanceof jQuery ? b : a(b)),
                this.settings.nestedItemSelector &&
                    (b = b.find("." + this.settings.nestedItemSelector)),
                b
                    .filter(function () {
                        return 1 === this.nodeType;
                    })
                    .each(
                        a.proxy(function (a, b) {
                            (b = this.prepare(b)),
                                this.$stage.append(b),
                                this._items.push(b),
                                this._mergers.push(
                                    1 *
                                        b
                                            .find("[data-merge]")
                                            .addBack("[data-merge]")
                                            .attr("data-merge") || 1
                                );
                        }, this)
                    ),
                this.reset(
                    this.isNumeric(this.settings.startPosition)
                        ? this.settings.startPosition
                        : 0
                ),
                this.invalidate("items");
        }),
        (e.prototype.add = function (b, c) {
            var e = this.relative(this._current);
            (c = c === d ? this._items.length : this.normalize(c, !0)),
                (b = b instanceof jQuery ? b : a(b)),
                this.trigger("add", { content: b, position: c }),
                (b = this.prepare(b)),
                0 === this._items.length || c === this._items.length
                    ? (0 === this._items.length && this.$stage.append(b),
                      0 !== this._items.length && this._items[c - 1].after(b),
                      this._items.push(b),
                      this._mergers.push(
                          1 *
                              b
                                  .find("[data-merge]")
                                  .addBack("[data-merge]")
                                  .attr("data-merge") || 1
                      ))
                    : (this._items[c].before(b),
                      this._items.splice(c, 0, b),
                      this._mergers.splice(
                          c,
                          0,
                          1 *
                              b
                                  .find("[data-merge]")
                                  .addBack("[data-merge]")
                                  .attr("data-merge") || 1
                      )),
                this._items[e] && this.reset(this._items[e].index()),
                this.invalidate("items"),
                this.trigger("added", { content: b, position: c });
        }),
        (e.prototype.remove = function (a) {
            (a = this.normalize(a, !0)) !== d &&
                (this.trigger("remove", {
                    content: this._items[a],
                    position: a,
                }),
                this._items[a].remove(),
                this._items.splice(a, 1),
                this._mergers.splice(a, 1),
                this.invalidate("items"),
                this.trigger("removed", { content: null, position: a }));
        }),
        (e.prototype.preloadAutoWidthImages = function (b) {
            b.each(
                a.proxy(function (b, c) {
                    this.enter("pre-loading"),
                        (c = a(c)),
                        a(new Image())
                            .one(
                                "load",
                                a.proxy(function (a) {
                                    c.attr("src", a.target.src),
                                        c.css("opacity", 1),
                                        this.leave("pre-loading"),
                                        !this.is("pre-loading") &&
                                            !this.is("initializing") &&
                                            this.refresh();
                                }, this)
                            )
                            .attr(
                                "src",
                                c.attr("src") ||
                                    c.attr("data-src") ||
                                    c.attr("data-src-retina")
                            );
                }, this)
            );
        }),
        (e.prototype.destroy = function () {
            this.$element.off(".owl.core"),
                this.$stage.off(".owl.core"),
                a(c).off(".owl.core"),
                !1 !== this.settings.responsive &&
                    (b.clearTimeout(this.resizeTimer),
                    this.off(b, "resize", this._handlers.onThrottledResize));
            for (var d in this._plugins) this._plugins[d].destroy();
            this.$stage.children(".cloned").remove(),
                this.$stage.unwrap(),
                this.$stage.children().contents().unwrap(),
                this.$stage.children().unwrap(),
                this.$stage.remove(),
                this.$element
                    .removeClass(this.options.refreshClass)
                    .removeClass(this.options.loadingClass)
                    .removeClass(this.options.loadedClass)
                    .removeClass(this.options.rtlClass)
                    .removeClass(this.options.dragClass)
                    .removeClass(this.options.grabClass)
                    .attr(
                        "class",
                        this.$element
                            .attr("class")
                            .replace(
                                new RegExp(
                                    this.options.responsiveClass + "-\\S+\\s",
                                    "g"
                                ),
                                ""
                            )
                    )
                    .removeData("owl.carousel");
        }),
        (e.prototype.op = function (a, b, c) {
            var d = this.settings.rtl;
            switch (b) {
                case "<":
                    return d ? a > c : a < c;
                case ">":
                    return d ? a < c : a > c;
                case ">=":
                    return d ? a <= c : a >= c;
                case "<=":
                    return d ? a >= c : a <= c;
            }
        }),
        (e.prototype.on = function (a, b, c, d) {
            a.addEventListener
                ? a.addEventListener(b, c, d)
                : a.attachEvent && a.attachEvent("on" + b, c);
        }),
        (e.prototype.off = function (a, b, c, d) {
            a.removeEventListener
                ? a.removeEventListener(b, c, d)
                : a.detachEvent && a.detachEvent("on" + b, c);
        }),
        (e.prototype.trigger = function (b, c, d, f, g) {
            var h = {
                    item: { count: this._items.length, index: this.current() },
                },
                i = a.camelCase(
                    a
                        .grep(["on", b, d], function (a) {
                            return a;
                        })
                        .join("-")
                        .toLowerCase()
                ),
                j = a.Event(
                    [b, "owl", d || "carousel"].join(".").toLowerCase(),
                    a.extend({ relatedTarget: this }, h, c)
                );
            return (
                this._supress[b] ||
                    (a.each(this._plugins, function (a, b) {
                        b.onTrigger && b.onTrigger(j);
                    }),
                    this.register({ type: e.Type.Event, name: b }),
                    this.$element.trigger(j),
                    this.settings &&
                        "function" == typeof this.settings[i] &&
                        this.settings[i].call(this, j)),
                j
            );
        }),
        (e.prototype.enter = function (b) {
            a.each(
                [b].concat(this._states.tags[b] || []),
                a.proxy(function (a, b) {
                    this._states.current[b] === d &&
                        (this._states.current[b] = 0),
                        this._states.current[b]++;
                }, this)
            );
        }),
        (e.prototype.leave = function (b) {
            a.each(
                [b].concat(this._states.tags[b] || []),
                a.proxy(function (a, b) {
                    this._states.current[b]--;
                }, this)
            );
        }),
        (e.prototype.register = function (b) {
            if (b.type === e.Type.Event) {
                if (
                    (a.event.special[b.name] || (a.event.special[b.name] = {}),
                    !a.event.special[b.name].owl)
                ) {
                    var c = a.event.special[b.name]._default;
                    (a.event.special[b.name]._default = function (a) {
                        return !c ||
                            !c.apply ||
                            (a.namespace && -1 !== a.namespace.indexOf("owl"))
                            ? a.namespace && a.namespace.indexOf("owl") > -1
                            : c.apply(this, arguments);
                    }),
                        (a.event.special[b.name].owl = !0);
                }
            } else
                b.type === e.Type.State &&
                    (this._states.tags[b.name]
                        ? (this._states.tags[b.name] = this._states.tags[
                              b.name
                          ].concat(b.tags))
                        : (this._states.tags[b.name] = b.tags),
                    (this._states.tags[b.name] = a.grep(
                        this._states.tags[b.name],
                        a.proxy(function (c, d) {
                            return (
                                a.inArray(c, this._states.tags[b.name]) === d
                            );
                        }, this)
                    )));
        }),
        (e.prototype.suppress = function (b) {
            a.each(
                b,
                a.proxy(function (a, b) {
                    this._supress[b] = !0;
                }, this)
            );
        }),
        (e.prototype.release = function (b) {
            a.each(
                b,
                a.proxy(function (a, b) {
                    delete this._supress[b];
                }, this)
            );
        }),
        (e.prototype.pointer = function (a) {
            var c = { x: null, y: null };
            return (
                (a = a.originalEvent || a || b.event),
                (a =
                    a.touches && a.touches.length
                        ? a.touches[0]
                        : a.changedTouches && a.changedTouches.length
                        ? a.changedTouches[0]
                        : a),
                a.pageX
                    ? ((c.x = a.pageX), (c.y = a.pageY))
                    : ((c.x = a.clientX), (c.y = a.clientY)),
                c
            );
        }),
        (e.prototype.isNumeric = function (a) {
            return !isNaN(parseFloat(a));
        }),
        (e.prototype.difference = function (a, b) {
            return { x: a.x - b.x, y: a.y - b.y };
        }),
        (a.fn.owlCarousel = function (b) {
            var c = Array.prototype.slice.call(arguments, 1);
            return this.each(function () {
                var d = a(this),
                    f = d.data("owl.carousel");
                f ||
                    ((f = new e(this, "object" == typeof b && b)),
                    d.data("owl.carousel", f),
                    a.each(
                        [
                            "next",
                            "prev",
                            "to",
                            "destroy",
                            "refresh",
                            "replace",
                            "add",
                            "remove",
                        ],
                        function (b, c) {
                            f.register({ type: e.Type.Event, name: c }),
                                f.$element.on(
                                    c + ".owl.carousel.core",
                                    a.proxy(function (a) {
                                        a.namespace &&
                                            a.relatedTarget !== this &&
                                            (this.suppress([c]),
                                            f[c].apply(
                                                this,
                                                [].slice.call(arguments, 1)
                                            ),
                                            this.release([c]));
                                    }, f)
                                );
                        }
                    )),
                    "string" == typeof b &&
                        "_" !== b.charAt(0) &&
                        f[b].apply(f, c);
            });
        }),
        (a.fn.owlCarousel.Constructor = e);
})(window.Zepto || window.jQuery, window, document),
    (function (a, b, c, d) {
        var e = function (b) {
            (this._core = b),
                (this._interval = null),
                (this._visible = null),
                (this._handlers = {
                    "initialized.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            this._core.settings.autoRefresh &&
                            this.watch();
                    }, this),
                }),
                (this._core.options = a.extend(
                    {},
                    e.Defaults,
                    this._core.options
                )),
                this._core.$element.on(this._handlers);
        };
        (e.Defaults = { autoRefresh: !0, autoRefreshInterval: 500 }),
            (e.prototype.watch = function () {
                this._interval ||
                    ((this._visible = this._core.isVisible()),
                    (this._interval = b.setInterval(
                        a.proxy(this.refresh, this),
                        this._core.settings.autoRefreshInterval
                    )));
            }),
            (e.prototype.refresh = function () {
                this._core.isVisible() !== this._visible &&
                    ((this._visible = !this._visible),
                    this._core.$element.toggleClass(
                        "owl-hidden",
                        !this._visible
                    ),
                    this._visible &&
                        this._core.invalidate("width") &&
                        this._core.refresh());
            }),
            (e.prototype.destroy = function () {
                var a, c;
                b.clearInterval(this._interval);
                for (a in this._handlers)
                    this._core.$element.off(a, this._handlers[a]);
                for (c in Object.getOwnPropertyNames(this))
                    "function" != typeof this[c] && (this[c] = null);
            }),
            (a.fn.owlCarousel.Constructor.Plugins.AutoRefresh = e);
    })(window.Zepto || window.jQuery, window, document),
    (function (a, b, c, d) {
        var e = function (b) {
            (this._core = b),
                (this._loaded = []),
                (this._handlers = {
                    "initialized.owl.carousel change.owl.carousel resized.owl.carousel":
                        a.proxy(function (b) {
                            if (
                                b.namespace &&
                                this._core.settings &&
                                this._core.settings.lazyLoad &&
                                ((b.property &&
                                    "position" == b.property.name) ||
                                    "initialized" == b.type)
                            ) {
                                var c = this._core.settings,
                                    e =
                                        (c.center && Math.ceil(c.items / 2)) ||
                                        c.items,
                                    f = (c.center && -1 * e) || 0,
                                    g =
                                        (b.property && b.property.value !== d
                                            ? b.property.value
                                            : this._core.current()) + f,
                                    h = this._core.clones().length,
                                    i = a.proxy(function (a, b) {
                                        this.load(b);
                                    }, this);
                                for (
                                    c.lazyLoadEager > 0 &&
                                    ((e += c.lazyLoadEager),
                                    c.loop && ((g -= c.lazyLoadEager), e++));
                                    f++ < e;

                                )
                                    this.load(h / 2 + this._core.relative(g)),
                                        h &&
                                            a.each(
                                                this._core.clones(
                                                    this._core.relative(g)
                                                ),
                                                i
                                            ),
                                        g++;
                            }
                        }, this),
                }),
                (this._core.options = a.extend(
                    {},
                    e.Defaults,
                    this._core.options
                )),
                this._core.$element.on(this._handlers);
        };
        (e.Defaults = { lazyLoad: !1, lazyLoadEager: 0 }),
            (e.prototype.load = function (c) {
                var d = this._core.$stage.children().eq(c),
                    e = d && d.find(".owl-lazy");
                !e ||
                    a.inArray(d.get(0), this._loaded) > -1 ||
                    (e.each(
                        a.proxy(function (c, d) {
                            var e,
                                f = a(d),
                                g =
                                    (b.devicePixelRatio > 1 &&
                                        f.attr("data-src-retina")) ||
                                    f.attr("data-src") ||
                                    f.attr("data-srcset");
                            this._core.trigger(
                                "load",
                                { element: f, url: g },
                                "lazy"
                            ),
                                f.is("img")
                                    ? f
                                          .one(
                                              "load.owl.lazy",
                                              a.proxy(function () {
                                                  f.css("opacity", 1),
                                                      this._core.trigger(
                                                          "loaded",
                                                          {
                                                              element: f,
                                                              url: g,
                                                          },
                                                          "lazy"
                                                      );
                                              }, this)
                                          )
                                          .attr("src", g)
                                    : f.is("source")
                                    ? f
                                          .one(
                                              "load.owl.lazy",
                                              a.proxy(function () {
                                                  this._core.trigger(
                                                      "loaded",
                                                      { element: f, url: g },
                                                      "lazy"
                                                  );
                                              }, this)
                                          )
                                          .attr("srcset", g)
                                    : ((e = new Image()),
                                      (e.onload = a.proxy(function () {
                                          f.css({
                                              "background-image":
                                                  'url("' + g + '")',
                                              opacity: "1",
                                          }),
                                              this._core.trigger(
                                                  "loaded",
                                                  { element: f, url: g },
                                                  "lazy"
                                              );
                                      }, this)),
                                      (e.src = g));
                        }, this)
                    ),
                    this._loaded.push(d.get(0)));
            }),
            (e.prototype.destroy = function () {
                var a, b;
                for (a in this.handlers)
                    this._core.$element.off(a, this.handlers[a]);
                for (b in Object.getOwnPropertyNames(this))
                    "function" != typeof this[b] && (this[b] = null);
            }),
            (a.fn.owlCarousel.Constructor.Plugins.Lazy = e);
    })(window.Zepto || window.jQuery, window, document),
    (function (a, b, c, d) {
        var e = function (c) {
            (this._core = c),
                (this._previousHeight = null),
                (this._handlers = {
                    "initialized.owl.carousel refreshed.owl.carousel": a.proxy(
                        function (a) {
                            a.namespace &&
                                this._core.settings.autoHeight &&
                                this.update();
                        },
                        this
                    ),
                    "changed.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            this._core.settings.autoHeight &&
                            "position" === a.property.name &&
                            this.update();
                    }, this),
                    "loaded.owl.lazy": a.proxy(function (a) {
                        a.namespace &&
                            this._core.settings.autoHeight &&
                            a.element
                                .closest("." + this._core.settings.itemClass)
                                .index() === this._core.current() &&
                            this.update();
                    }, this),
                }),
                (this._core.options = a.extend(
                    {},
                    e.Defaults,
                    this._core.options
                )),
                this._core.$element.on(this._handlers),
                (this._intervalId = null);
            var d = this;
            a(b).on("load", function () {
                d._core.settings.autoHeight && d.update();
            }),
                a(b).resize(function () {
                    d._core.settings.autoHeight &&
                        (null != d._intervalId && clearTimeout(d._intervalId),
                        (d._intervalId = setTimeout(function () {
                            d.update();
                        }, 250)));
                });
        };
        (e.Defaults = { autoHeight: !1, autoHeightClass: "owl-height" }),
            (e.prototype.update = function () {
                var b = this._core._current,
                    c = b + this._core.settings.items,
                    d = this._core.settings.lazyLoad,
                    e = this._core.$stage.children().toArray().slice(b, c),
                    f = [],
                    g = 0;
                a.each(e, function (b, c) {
                    f.push(a(c).height());
                }),
                    (g = Math.max.apply(null, f)),
                    g <= 1 &&
                        d &&
                        this._previousHeight &&
                        (g = this._previousHeight),
                    (this._previousHeight = g),
                    this._core.$stage
                        .parent()
                        .height(g)
                        .addClass(this._core.settings.autoHeightClass);
            }),
            (e.prototype.destroy = function () {
                var a, b;
                for (a in this._handlers)
                    this._core.$element.off(a, this._handlers[a]);
                for (b in Object.getOwnPropertyNames(this))
                    "function" != typeof this[b] && (this[b] = null);
            }),
            (a.fn.owlCarousel.Constructor.Plugins.AutoHeight = e);
    })(window.Zepto || window.jQuery, window, document),
    (function (a, b, c, d) {
        var e = function (b) {
            (this._core = b),
                (this._videos = {}),
                (this._playing = null),
                (this._handlers = {
                    "initialized.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            this._core.register({
                                type: "state",
                                name: "playing",
                                tags: ["interacting"],
                            });
                    }, this),
                    "resize.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            this._core.settings.video &&
                            this.isInFullScreen() &&
                            a.preventDefault();
                    }, this),
                    "refreshed.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            this._core.is("resizing") &&
                            this._core.$stage
                                .find(".cloned .owl-video-frame")
                                .remove();
                    }, this),
                    "changed.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            "position" === a.property.name &&
                            this._playing &&
                            this.stop();
                    }, this),
                    "prepared.owl.carousel": a.proxy(function (b) {
                        if (b.namespace) {
                            var c = a(b.content).find(".owl-video");
                            c.length &&
                                (c.css("display", "none"),
                                this.fetch(c, a(b.content)));
                        }
                    }, this),
                }),
                (this._core.options = a.extend(
                    {},
                    e.Defaults,
                    this._core.options
                )),
                this._core.$element.on(this._handlers),
                this._core.$element.on(
                    "click.owl.video",
                    ".owl-video-play-icon",
                    a.proxy(function (a) {
                        this.play(a);
                    }, this)
                );
        };
        (e.Defaults = { video: !1, videoHeight: !1, videoWidth: !1 }),
            (e.prototype.fetch = function (a, b) {
                var c = (function () {
                        return a.attr("data-vimeo-id")
                            ? "vimeo"
                            : a.attr("data-vzaar-id")
                            ? "vzaar"
                            : "youtube";
                    })(),
                    d =
                        a.attr("data-vimeo-id") ||
                        a.attr("data-youtube-id") ||
                        a.attr("data-vzaar-id"),
                    e = a.attr("data-width") || this._core.settings.videoWidth,
                    f =
                        a.attr("data-height") ||
                        this._core.settings.videoHeight,
                    g = a.attr("href");
                if (!g) throw new Error("Missing video URL.");
                if (
                    ((d = g.match(
                        /(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com|be\-nocookie\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/
                    )),
                    d[3].indexOf("youtu") > -1)
                )
                    c = "youtube";
                else if (d[3].indexOf("vimeo") > -1) c = "vimeo";
                else {
                    if (!(d[3].indexOf("vzaar") > -1))
                        throw new Error("Video URL not supported.");
                    c = "vzaar";
                }
                (d = d[6]),
                    (this._videos[g] = { type: c, id: d, width: e, height: f }),
                    b.attr("data-video", g),
                    this.thumbnail(a, this._videos[g]);
            }),
            (e.prototype.thumbnail = function (b, c) {
                var d,
                    e,
                    f,
                    g =
                        c.width && c.height
                            ? "width:" +
                              c.width +
                              "px;height:" +
                              c.height +
                              "px;"
                            : "",
                    h = b.find("img"),
                    i = "src",
                    j = "",
                    k = this._core.settings,
                    l = function (c) {
                        (e = '<div class="owl-video-play-icon"></div>'),
                            (d = k.lazyLoad
                                ? a("<div/>", {
                                      class: "owl-video-tn " + j,
                                      srcType: c,
                                  })
                                : a("<div/>", {
                                      class: "owl-video-tn",
                                      style:
                                          "opacity:1;background-image:url(" +
                                          c +
                                          ")",
                                  })),
                            b.after(d),
                            b.after(e);
                    };
                if (
                    (b.wrap(
                        a("<div/>", { class: "owl-video-wrapper", style: g })
                    ),
                    this._core.settings.lazyLoad &&
                        ((i = "data-src"), (j = "owl-lazy")),
                    h.length)
                )
                    return l(h.attr(i)), h.remove(), !1;
                "youtube" === c.type
                    ? ((f = "//img.youtube.com/vi/" + c.id + "/hqdefault.jpg"),
                      l(f))
                    : "vimeo" === c.type
                    ? a.ajax({
                          type: "GET",
                          url: "//vimeo.com/api/v2/video/" + c.id + ".json",
                          jsonp: "callback",
                          dataType: "jsonp",
                          success: function (a) {
                              (f = a[0].thumbnail_large), l(f);
                          },
                      })
                    : "vzaar" === c.type &&
                      a.ajax({
                          type: "GET",
                          url: "//vzaar.com/api/videos/" + c.id + ".json",
                          jsonp: "callback",
                          dataType: "jsonp",
                          success: function (a) {
                              (f = a.framegrab_url), l(f);
                          },
                      });
            }),
            (e.prototype.stop = function () {
                this._core.trigger("stop", null, "video"),
                    this._playing.find(".owl-video-frame").remove(),
                    this._playing.removeClass("owl-video-playing"),
                    (this._playing = null),
                    this._core.leave("playing"),
                    this._core.trigger("stopped", null, "video");
            }),
            (e.prototype.play = function (b) {
                var c,
                    d = a(b.target),
                    e = d.closest("." + this._core.settings.itemClass),
                    f = this._videos[e.attr("data-video")],
                    g = f.width || "100%",
                    h = f.height || this._core.$stage.height();
                this._playing ||
                    (this._core.enter("playing"),
                    this._core.trigger("play", null, "video"),
                    (e = this._core.items(this._core.relative(e.index()))),
                    this._core.reset(e.index()),
                    (c = a(
                        '<iframe frameborder="0" allowfullscreen mozallowfullscreen webkitAllowFullScreen ></iframe>'
                    )),
                    c.attr("height", h),
                    c.attr("width", g),
                    "youtube" === f.type
                        ? c.attr(
                              "src",
                              "//www.youtube.com/embed/" +
                                  f.id +
                                  "?autoplay=1&rel=0&v=" +
                                  f.id
                          )
                        : "vimeo" === f.type
                        ? c.attr(
                              "src",
                              "//player.vimeo.com/video/" + f.id + "?autoplay=1"
                          )
                        : "vzaar" === f.type &&
                          c.attr(
                              "src",
                              "//view.vzaar.com/" +
                                  f.id +
                                  "/player?autoplay=true"
                          ),
                    a(c)
                        .wrap('<div class="owl-video-frame" />')
                        .insertAfter(e.find(".owl-video")),
                    (this._playing = e.addClass("owl-video-playing")));
            }),
            (e.prototype.isInFullScreen = function () {
                var b =
                    c.fullscreenElement ||
                    c.mozFullScreenElement ||
                    c.webkitFullscreenElement;
                return b && a(b).parent().hasClass("owl-video-frame");
            }),
            (e.prototype.destroy = function () {
                var a, b;
                this._core.$element.off("click.owl.video");
                for (a in this._handlers)
                    this._core.$element.off(a, this._handlers[a]);
                for (b in Object.getOwnPropertyNames(this))
                    "function" != typeof this[b] && (this[b] = null);
            }),
            (a.fn.owlCarousel.Constructor.Plugins.Video = e);
    })(window.Zepto || window.jQuery, window, document),
    (function (a, b, c, d) {
        var e = function (b) {
            (this.core = b),
                (this.core.options = a.extend(
                    {},
                    e.Defaults,
                    this.core.options
                )),
                (this.swapping = !0),
                (this.previous = d),
                (this.next = d),
                (this.handlers = {
                    "change.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            "position" == a.property.name &&
                            ((this.previous = this.core.current()),
                            (this.next = a.property.value));
                    }, this),
                    "drag.owl.carousel dragged.owl.carousel translated.owl.carousel":
                        a.proxy(function (a) {
                            a.namespace &&
                                (this.swapping = "translated" == a.type);
                        }, this),
                    "translate.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            this.swapping &&
                            (this.core.options.animateOut ||
                                this.core.options.animateIn) &&
                            this.swap();
                    }, this),
                }),
                this.core.$element.on(this.handlers);
        };
        (e.Defaults = { animateOut: !1, animateIn: !1 }),
            (e.prototype.swap = function () {
                if (
                    1 === this.core.settings.items &&
                    a.support.animation &&
                    a.support.transition
                ) {
                    this.core.speed(0);
                    var b,
                        c = a.proxy(this.clear, this),
                        d = this.core.$stage.children().eq(this.previous),
                        e = this.core.$stage.children().eq(this.next),
                        f = this.core.settings.animateIn,
                        g = this.core.settings.animateOut;
                    this.core.current() !== this.previous &&
                        (g &&
                            ((b =
                                this.core.coordinates(this.previous) -
                                this.core.coordinates(this.next)),
                            d
                                .one(a.support.animation.end, c)
                                .css({ left: b + "px" })
                                .addClass("animated owl-animated-out")
                                .addClass(g)),
                        f &&
                            e
                                .one(a.support.animation.end, c)
                                .addClass("animated owl-animated-in")
                                .addClass(f));
                }
            }),
            (e.prototype.clear = function (b) {
                a(b.target)
                    .css({ left: "" })
                    .removeClass("animated owl-animated-out owl-animated-in")
                    .removeClass(this.core.settings.animateIn)
                    .removeClass(this.core.settings.animateOut),
                    this.core.onTransitionEnd();
            }),
            (e.prototype.destroy = function () {
                var a, b;
                for (a in this.handlers)
                    this.core.$element.off(a, this.handlers[a]);
                for (b in Object.getOwnPropertyNames(this))
                    "function" != typeof this[b] && (this[b] = null);
            }),
            (a.fn.owlCarousel.Constructor.Plugins.Animate = e);
    })(window.Zepto || window.jQuery, window, document),
    (function (a, b, c, d) {
        var e = function (b) {
            (this._core = b),
                (this._call = null),
                (this._time = 0),
                (this._timeout = 0),
                (this._paused = !0),
                (this._handlers = {
                    "changed.owl.carousel": a.proxy(function (a) {
                        a.namespace && "settings" === a.property.name
                            ? this._core.settings.autoplay
                                ? this.play()
                                : this.stop()
                            : a.namespace &&
                              "position" === a.property.name &&
                              this._paused &&
                              (this._time = 0);
                    }, this),
                    "initialized.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            this._core.settings.autoplay &&
                            this.play();
                    }, this),
                    "play.owl.autoplay": a.proxy(function (a, b, c) {
                        a.namespace && this.play(b, c);
                    }, this),
                    "stop.owl.autoplay": a.proxy(function (a) {
                        a.namespace && this.stop();
                    }, this),
                    "mouseover.owl.autoplay": a.proxy(function () {
                        this._core.settings.autoplayHoverPause &&
                            this._core.is("rotating") &&
                            this.pause();
                    }, this),
                    "mouseleave.owl.autoplay": a.proxy(function () {
                        this._core.settings.autoplayHoverPause &&
                            this._core.is("rotating") &&
                            this.play();
                    }, this),
                    "touchstart.owl.core": a.proxy(function () {
                        this._core.settings.autoplayHoverPause &&
                            this._core.is("rotating") &&
                            this.pause();
                    }, this),
                    "touchend.owl.core": a.proxy(function () {
                        this._core.settings.autoplayHoverPause && this.play();
                    }, this),
                }),
                this._core.$element.on(this._handlers),
                (this._core.options = a.extend(
                    {},
                    e.Defaults,
                    this._core.options
                ));
        };
        (e.Defaults = {
            autoplay: !1,
            autoplayTimeout: 5e3,
            autoplayHoverPause: !1,
            autoplaySpeed: !1,
        }),
            (e.prototype._next = function (d) {
                (this._call = b.setTimeout(
                    a.proxy(this._next, this, d),
                    this._timeout *
                        (Math.round(this.read() / this._timeout) + 1) -
                        this.read()
                )),
                    this._core.is("interacting") ||
                        c.hidden ||
                        this._core.next(d || this._core.settings.autoplaySpeed);
            }),
            (e.prototype.read = function () {
                return new Date().getTime() - this._time;
            }),
            (e.prototype.play = function (c, d) {
                var e;
                this._core.is("rotating") || this._core.enter("rotating"),
                    (c = c || this._core.settings.autoplayTimeout),
                    (e = Math.min(this._time % (this._timeout || c), c)),
                    this._paused
                        ? ((this._time = this.read()), (this._paused = !1))
                        : b.clearTimeout(this._call),
                    (this._time += (this.read() % c) - e),
                    (this._timeout = c),
                    (this._call = b.setTimeout(
                        a.proxy(this._next, this, d),
                        c - e
                    ));
            }),
            (e.prototype.stop = function () {
                this._core.is("rotating") &&
                    ((this._time = 0),
                    (this._paused = !0),
                    b.clearTimeout(this._call),
                    this._core.leave("rotating"));
            }),
            (e.prototype.pause = function () {
                this._core.is("rotating") &&
                    !this._paused &&
                    ((this._time = this.read()),
                    (this._paused = !0),
                    b.clearTimeout(this._call));
            }),
            (e.prototype.destroy = function () {
                var a, b;
                this.stop();
                for (a in this._handlers)
                    this._core.$element.off(a, this._handlers[a]);
                for (b in Object.getOwnPropertyNames(this))
                    "function" != typeof this[b] && (this[b] = null);
            }),
            (a.fn.owlCarousel.Constructor.Plugins.autoplay = e);
    })(window.Zepto || window.jQuery, window, document),
    (function (a, b, c, d) {
        "use strict";
        var e = function (b) {
            (this._core = b),
                (this._initialized = !1),
                (this._pages = []),
                (this._controls = {}),
                (this._templates = []),
                (this.$element = this._core.$element),
                (this._overrides = {
                    next: this._core.next,
                    prev: this._core.prev,
                    to: this._core.to,
                }),
                (this._handlers = {
                    "prepared.owl.carousel": a.proxy(function (b) {
                        b.namespace &&
                            this._core.settings.dotsData &&
                            this._templates.push(
                                '<div class="' +
                                    this._core.settings.dotClass +
                                    '">' +
                                    a(b.content)
                                        .find("[data-dot]")
                                        .addBack("[data-dot]")
                                        .attr("data-dot") +
                                    "</div>"
                            );
                    }, this),
                    "added.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            this._core.settings.dotsData &&
                            this._templates.splice(
                                a.position,
                                0,
                                this._templates.pop()
                            );
                    }, this),
                    "remove.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            this._core.settings.dotsData &&
                            this._templates.splice(a.position, 1);
                    }, this),
                    "changed.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            "position" == a.property.name &&
                            this.draw();
                    }, this),
                    "initialized.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            !this._initialized &&
                            (this._core.trigger(
                                "initialize",
                                null,
                                "navigation"
                            ),
                            this.initialize(),
                            this.update(),
                            this.draw(),
                            (this._initialized = !0),
                            this._core.trigger(
                                "initialized",
                                null,
                                "navigation"
                            ));
                    }, this),
                    "refreshed.owl.carousel": a.proxy(function (a) {
                        a.namespace &&
                            this._initialized &&
                            (this._core.trigger("refresh", null, "navigation"),
                            this.update(),
                            this.draw(),
                            this._core.trigger(
                                "refreshed",
                                null,
                                "navigation"
                            ));
                    }, this),
                }),
                (this._core.options = a.extend(
                    {},
                    e.Defaults,
                    this._core.options
                )),
                this.$element.on(this._handlers);
        };
        (e.Defaults = {
            nav: !1,
            navText: [
                '<span aria-label="Previous">&#x2039;</span>',
                '<span aria-label="Next">&#x203a;</span>',
            ],
            navSpeed: !1,
            navElement: 'button type="button" role="presentation"',
            navContainer: !1,
            navContainerClass: "owl-nav",
            navClass: ["owl-prev", "owl-next"],
            slideBy: 1,
            dotClass: "owl-dot",
            dotsClass: "owl-dots",
            dots: !0,
            dotsEach: !1,
            dotsData: !1,
            dotsSpeed: !1,
            dotsContainer: !1,
        }),
            (e.prototype.initialize = function () {
                var b,
                    c = this._core.settings;
                (this._controls.$relative = (
                    c.navContainer
                        ? a(c.navContainer)
                        : a("<div>")
                              .addClass(c.navContainerClass)
                              .appendTo(this.$element)
                ).addClass("disabled")),
                    (this._controls.$previous = a("<" + c.navElement + ">")
                        .addClass(c.navClass[0])
                        .html(c.navText[0])
                        .prependTo(this._controls.$relative)
                        .on(
                            "click",
                            a.proxy(function (a) {
                                this.prev(c.navSpeed);
                            }, this)
                        )),
                    (this._controls.$next = a("<" + c.navElement + ">")
                        .addClass(c.navClass[1])
                        .html(c.navText[1])
                        .appendTo(this._controls.$relative)
                        .on(
                            "click",
                            a.proxy(function (a) {
                                this.next(c.navSpeed);
                            }, this)
                        )),
                    c.dotsData ||
                        (this._templates = [
                            a('<button role="button">')
                                .addClass(c.dotClass)
                                .append(a("<span>"))
                                .prop("outerHTML"),
                        ]),
                    (this._controls.$absolute = (
                        c.dotsContainer
                            ? a(c.dotsContainer)
                            : a("<div>")
                                  .addClass(c.dotsClass)
                                  .appendTo(this.$element)
                    ).addClass("disabled")),
                    this._controls.$absolute.on(
                        "click",
                        "button",
                        a.proxy(function (b) {
                            var d = a(b.target)
                                .parent()
                                .is(this._controls.$absolute)
                                ? a(b.target).index()
                                : a(b.target).parent().index();
                            b.preventDefault(), this.to(d, c.dotsSpeed);
                        }, this)
                    );
                for (b in this._overrides)
                    this._core[b] = a.proxy(this[b], this);
            }),
            (e.prototype.destroy = function () {
                var a, b, c, d, e;
                e = this._core.settings;
                for (a in this._handlers)
                    this.$element.off(a, this._handlers[a]);
                for (b in this._controls)
                    "$relative" === b && e.navContainer
                        ? this._controls[b].html("")
                        : this._controls[b].remove();
                for (d in this.overides) this._core[d] = this._overrides[d];
                for (c in Object.getOwnPropertyNames(this))
                    "function" != typeof this[c] && (this[c] = null);
            }),
            (e.prototype.update = function () {
                var a,
                    b,
                    c,
                    d = this._core.clones().length / 2,
                    e = d + this._core.items().length,
                    f = this._core.maximum(!0),
                    g = this._core.settings,
                    h =
                        g.center || g.autoWidth || g.dotsData
                            ? 1
                            : g.dotsEach || g.items;
                if (
                    ("page" !== g.slideBy &&
                        (g.slideBy = Math.min(g.slideBy, g.items)),
                    g.dots || "page" == g.slideBy)
                )
                    for (this._pages = [], a = d, b = 0, c = 0; a < e; a++) {
                        if (b >= h || 0 === b) {
                            if (
                                (this._pages.push({
                                    start: Math.min(f, a - d),
                                    end: a - d + h - 1,
                                }),
                                Math.min(f, a - d) === f)
                            )
                                break;
                            (b = 0), ++c;
                        }
                        b += this._core.mergers(this._core.relative(a));
                    }
            }),
            (e.prototype.draw = function () {
                var b,
                    c = this._core.settings,
                    d = this._core.items().length <= c.items,
                    e = this._core.relative(this._core.current()),
                    f = c.loop || c.rewind;
                this._controls.$relative.toggleClass("disabled", !c.nav || d),
                    c.nav &&
                        (this._controls.$previous.toggleClass(
                            "disabled",
                            !f && e <= this._core.minimum(!0)
                        ),
                        this._controls.$next.toggleClass(
                            "disabled",
                            !f && e >= this._core.maximum(!0)
                        )),
                    this._controls.$absolute.toggleClass(
                        "disabled",
                        !c.dots || d
                    ),
                    c.dots &&
                        ((b =
                            this._pages.length -
                            this._controls.$absolute.children().length),
                        c.dotsData && 0 !== b
                            ? this._controls.$absolute.html(
                                  this._templates.join("")
                              )
                            : b > 0
                            ? this._controls.$absolute.append(
                                  new Array(b + 1).join(this._templates[0])
                              )
                            : b < 0 &&
                              this._controls.$absolute
                                  .children()
                                  .slice(b)
                                  .remove(),
                        this._controls.$absolute
                            .find(".active")
                            .removeClass("active"),
                        this._controls.$absolute
                            .children()
                            .eq(a.inArray(this.current(), this._pages))
                            .addClass("active"));
            }),
            (e.prototype.onTrigger = function (b) {
                var c = this._core.settings;
                b.page = {
                    index: a.inArray(this.current(), this._pages),
                    count: this._pages.length,
                    size:
                        c &&
                        (c.center || c.autoWidth || c.dotsData
                            ? 1
                            : c.dotsEach || c.items),
                };
            }),
            (e.prototype.current = function () {
                var b = this._core.relative(this._core.current());
                return a
                    .grep(
                        this._pages,
                        a.proxy(function (a, c) {
                            return a.start <= b && a.end >= b;
                        }, this)
                    )
                    .pop();
            }),
            (e.prototype.getPosition = function (b) {
                var c,
                    d,
                    e = this._core.settings;
                return (
                    "page" == e.slideBy
                        ? ((c = a.inArray(this.current(), this._pages)),
                          (d = this._pages.length),
                          b ? ++c : --c,
                          (c = this._pages[((c % d) + d) % d].start))
                        : ((c = this._core.relative(this._core.current())),
                          (d = this._core.items().length),
                          b ? (c += e.slideBy) : (c -= e.slideBy)),
                    c
                );
            }),
            (e.prototype.next = function (b) {
                a.proxy(this._overrides.to, this._core)(
                    this.getPosition(!0),
                    b
                );
            }),
            (e.prototype.prev = function (b) {
                a.proxy(this._overrides.to, this._core)(
                    this.getPosition(!1),
                    b
                );
            }),
            (e.prototype.to = function (b, c, d) {
                var e;
                !d && this._pages.length
                    ? ((e = this._pages.length),
                      a.proxy(this._overrides.to, this._core)(
                          this._pages[((b % e) + e) % e].start,
                          c
                      ))
                    : a.proxy(this._overrides.to, this._core)(b, c);
            }),
            (a.fn.owlCarousel.Constructor.Plugins.Navigation = e);
    })(window.Zepto || window.jQuery, window, document),
    (function (a, b, c, d) {
        "use strict";
        var e = function (c) {
            (this._core = c),
                (this._hashes = {}),
                (this.$element = this._core.$element),
                (this._handlers = {
                    "initialized.owl.carousel": a.proxy(function (c) {
                        c.namespace &&
                            "URLHash" === this._core.settings.startPosition &&
                            a(b).trigger("hashchange.owl.navigation");
                    }, this),
                    "prepared.owl.carousel": a.proxy(function (b) {
                        if (b.namespace) {
                            var c = a(b.content)
                                .find("[data-hash]")
                                .addBack("[data-hash]")
                                .attr("data-hash");
                            if (!c) return;
                            this._hashes[c] = b.content;
                        }
                    }, this),
                    "changed.owl.carousel": a.proxy(function (c) {
                        if (c.namespace && "position" === c.property.name) {
                            var d = this._core.items(
                                    this._core.relative(this._core.current())
                                ),
                                e = a
                                    .map(this._hashes, function (a, b) {
                                        return a === d ? b : null;
                                    })
                                    .join();
                            if (!e || b.location.hash.slice(1) === e) return;
                            b.location.hash = e;
                        }
                    }, this),
                }),
                (this._core.options = a.extend(
                    {},
                    e.Defaults,
                    this._core.options
                )),
                this.$element.on(this._handlers),
                a(b).on(
                    "hashchange.owl.navigation",
                    a.proxy(function (a) {
                        var c = b.location.hash.substring(1),
                            e = this._core.$stage.children(),
                            f = this._hashes[c] && e.index(this._hashes[c]);
                        f !== d &&
                            f !== this._core.current() &&
                            this._core.to(this._core.relative(f), !1, !0);
                    }, this)
                );
        };
        (e.Defaults = { URLhashListener: !1 }),
            (e.prototype.destroy = function () {
                var c, d;
                a(b).off("hashchange.owl.navigation");
                for (c in this._handlers)
                    this._core.$element.off(c, this._handlers[c]);
                for (d in Object.getOwnPropertyNames(this))
                    "function" != typeof this[d] && (this[d] = null);
            }),
            (a.fn.owlCarousel.Constructor.Plugins.Hash = e);
    })(window.Zepto || window.jQuery, window, document),
    (function (a, b, c, d) {
        function e(b, c) {
            var e = !1,
                f = b.charAt(0).toUpperCase() + b.slice(1);
            return (
                a.each(
                    (b + " " + h.join(f + " ") + f).split(" "),
                    function (a, b) {
                        if (g[b] !== d) return (e = !c || b), !1;
                    }
                ),
                e
            );
        }
        function f(a) {
            return e(a, !0);
        }
        var g = a("<support>").get(0).style,
            h = "Webkit Moz O ms".split(" "),
            i = {
                transition: {
                    end: {
                        WebkitTransition: "webkitTransitionEnd",
                        MozTransition: "transitionend",
                        OTransition: "oTransitionEnd",
                        transition: "transitionend",
                    },
                },
                animation: {
                    end: {
                        WebkitAnimation: "webkitAnimationEnd",
                        MozAnimation: "animationend",
                        OAnimation: "oAnimationEnd",
                        animation: "animationend",
                    },
                },
            },
            j = {
                csstransforms: function () {
                    return !!e("transform");
                },
                csstransforms3d: function () {
                    return !!e("perspective");
                },
                csstransitions: function () {
                    return !!e("transition");
                },
                cssanimations: function () {
                    return !!e("animation");
                },
            };
        j.csstransitions() &&
            ((a.support.transition = new String(f("transition"))),
            (a.support.transition.end =
                i.transition.end[a.support.transition])),
            j.cssanimations() &&
                ((a.support.animation = new String(f("animation"))),
                (a.support.animation.end =
                    i.animation.end[a.support.animation])),
            j.csstransforms() &&
                ((a.support.transform = new String(f("transform"))),
                (a.support.transform3d = j.csstransforms3d()));
    })(window.Zepto || window.jQuery, window, document);

// inview js
!(function (t) {
    function e() {
        var e,
            i,
            n = { height: a.innerHeight, width: a.innerWidth };
        return (
            n.height ||
                ((e = r.compatMode),
                (e || !t.support.boxModel) &&
                    ((i = "CSS1Compat" === e ? f : r.body),
                    (n = { height: i.clientHeight, width: i.clientWidth }))),
            n
        );
    }
    function i() {
        return {
            top: a.pageYOffset || f.scrollTop || r.body.scrollTop,
            left: a.pageXOffset || f.scrollLeft || r.body.scrollLeft,
        };
    }
    function n() {
        var n,
            l = t(),
            r = 0;
        if (
            (t.each(d, function (t, e) {
                var i = e.data.selector,
                    n = e.$element;
                l = l.add(i ? n.find(i) : n);
            }),
            (n = l.length))
        )
            for (o = o || e(), h = h || i(); n > r; r++)
                if (t.contains(f, l[r])) {
                    var a,
                        c,
                        p,
                        s = t(l[r]),
                        u = { height: s.height(), width: s.width() },
                        g = s.offset(),
                        v = s.data("inview");
                    if (!h || !o) return;
                    g.top + u.height > h.top &&
                    g.top < h.top + o.height &&
                    g.left + u.width > h.left &&
                    g.left < h.left + o.width
                        ? ((a =
                              h.left > g.left
                                  ? "right"
                                  : h.left + o.width < g.left + u.width
                                  ? "left"
                                  : "both"),
                          (c =
                              h.top > g.top
                                  ? "bottom"
                                  : h.top + o.height < g.top + u.height
                                  ? "top"
                                  : "both"),
                          (p = a + "-" + c),
                          (v && v === p) ||
                              s.data("inview", p).trigger("inview", [!0, a, c]))
                        : v && s.data("inview", !1).trigger("inview", [!1]);
                }
    }
    var o,
        h,
        l,
        d = {},
        r = document,
        a = window,
        f = r.documentElement,
        c = t.expando;
    (t.event.special.inview = {
        add: function (e) {
            (d[e.guid + "-" + this[c]] = { data: e, $element: t(this) }),
                l || t.isEmptyObject(d) || (l = setInterval(n, 250));
        },
        remove: function (e) {
            try {
                delete d[e.guid + "-" + this[c]];
            } catch (i) {}
            t.isEmptyObject(d) && (clearInterval(l), (l = null));
        },
    }),
        t(a).bind("scroll resize scrollstop", function () {
            o = h = null;
        }),
        !f.addEventListener &&
            f.attachEvent &&
            f.attachEvent("onfocusin", function () {
                h = null;
            });
})(jQuery);

/*! Magnific Popup - v1.1.0 - 2016-02-20
 * http://dimsemenov.com/plugins/magnific-popup/
 * Copyright (c) 2016 Dmitry Semenov; */
!(function (a) {
    "function" == typeof define && define.amd
        ? define(["jquery"], a)
        : a(
              "object" == typeof exports
                  ? require("jquery")
                  : window.jQuery || window.Zepto
          );
})(function (a) {
    var b,
        c,
        d,
        e,
        f,
        g,
        h = "Close",
        i = "BeforeClose",
        j = "AfterClose",
        k = "BeforeAppend",
        l = "MarkupParse",
        m = "Open",
        n = "Change",
        o = "mfp",
        p = "." + o,
        q = "mfp-ready",
        r = "mfp-removing",
        s = "mfp-prevent-close",
        t = function () {},
        u = !!window.jQuery,
        v = a(window),
        w = function (a, c) {
            b.ev.on(o + a + p, c);
        },
        x = function (b, c, d, e) {
            var f = document.createElement("div");
            return (
                (f.className = "mfp-" + b),
                d && (f.innerHTML = d),
                e ? c && c.appendChild(f) : ((f = a(f)), c && f.appendTo(c)),
                f
            );
        },
        y = function (c, d) {
            b.ev.triggerHandler(o + c, d),
                b.st.callbacks &&
                    ((c = c.charAt(0).toLowerCase() + c.slice(1)),
                    b.st.callbacks[c] &&
                        b.st.callbacks[c].apply(b, a.isArray(d) ? d : [d]));
        },
        z = function (c) {
            return (
                (c === g && b.currTemplate.closeBtn) ||
                    ((b.currTemplate.closeBtn = a(
                        b.st.closeMarkup.replace("%title%", b.st.tClose)
                    )),
                    (g = c)),
                b.currTemplate.closeBtn
            );
        },
        A = function () {
            a.magnificPopup.instance ||
                ((b = new t()), b.init(), (a.magnificPopup.instance = b));
        },
        B = function () {
            var a = document.createElement("p").style,
                b = ["ms", "O", "Moz", "Webkit"];
            if (void 0 !== a.transition) return !0;
            for (; b.length; ) if (b.pop() + "Transition" in a) return !0;
            return !1;
        };
    (t.prototype = {
        constructor: t,
        init: function () {
            var c = navigator.appVersion;
            (b.isLowIE = b.isIE8 = document.all && !document.addEventListener),
                (b.isAndroid = /android/gi.test(c)),
                (b.isIOS = /iphone|ipad|ipod/gi.test(c)),
                (b.supportsTransition = B()),
                (b.probablyMobile =
                    b.isAndroid ||
                    b.isIOS ||
                    /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(
                        navigator.userAgent
                    )),
                (d = a(document)),
                (b.popupsCache = {});
        },
        open: function (c) {
            var e;
            if (c.isObj === !1) {
                (b.items = c.items.toArray()), (b.index = 0);
                var g,
                    h = c.items;
                for (e = 0; e < h.length; e++)
                    if (
                        ((g = h[e]), g.parsed && (g = g.el[0]), g === c.el[0])
                    ) {
                        b.index = e;
                        break;
                    }
            } else
                (b.items = a.isArray(c.items) ? c.items : [c.items]),
                    (b.index = c.index || 0);
            if (b.isOpen) return void b.updateItemHTML();
            (b.types = []),
                (f = ""),
                c.mainEl && c.mainEl.length
                    ? (b.ev = c.mainEl.eq(0))
                    : (b.ev = d),
                c.key
                    ? (b.popupsCache[c.key] || (b.popupsCache[c.key] = {}),
                      (b.currTemplate = b.popupsCache[c.key]))
                    : (b.currTemplate = {}),
                (b.st = a.extend(!0, {}, a.magnificPopup.defaults, c)),
                (b.fixedContentPos =
                    "auto" === b.st.fixedContentPos
                        ? !b.probablyMobile
                        : b.st.fixedContentPos),
                b.st.modal &&
                    ((b.st.closeOnContentClick = !1),
                    (b.st.closeOnBgClick = !1),
                    (b.st.showCloseBtn = !1),
                    (b.st.enableEscapeKey = !1)),
                b.bgOverlay ||
                    ((b.bgOverlay = x("bg").on("click" + p, function () {
                        b.close();
                    })),
                    (b.wrap = x("wrap")
                        .attr("tabindex", -1)
                        .on("click" + p, function (a) {
                            b._checkIfClose(a.target) && b.close();
                        })),
                    (b.container = x("container", b.wrap))),
                (b.contentContainer = x("content")),
                b.st.preloader &&
                    (b.preloader = x("preloader", b.container, b.st.tLoading));
            var i = a.magnificPopup.modules;
            for (e = 0; e < i.length; e++) {
                var j = i[e];
                (j = j.charAt(0).toUpperCase() + j.slice(1)),
                    b["init" + j].call(b);
            }
            y("BeforeOpen"),
                b.st.showCloseBtn &&
                    (b.st.closeBtnInside
                        ? (w(l, function (a, b, c, d) {
                              c.close_replaceWith = z(d.type);
                          }),
                          (f += " mfp-close-btn-in"))
                        : b.wrap.append(z())),
                b.st.alignTop && (f += " mfp-align-top"),
                b.fixedContentPos
                    ? b.wrap.css({
                          overflow: b.st.overflowY,
                          overflowX: "hidden",
                          overflowY: b.st.overflowY,
                      })
                    : b.wrap.css({ top: v.scrollTop(), position: "absolute" }),
                (b.st.fixedBgPos === !1 ||
                    ("auto" === b.st.fixedBgPos && !b.fixedContentPos)) &&
                    b.bgOverlay.css({
                        height: d.height(),
                        position: "absolute",
                    }),
                b.st.enableEscapeKey &&
                    d.on("keyup" + p, function (a) {
                        27 === a.keyCode && b.close();
                    }),
                v.on("resize" + p, function () {
                    b.updateSize();
                }),
                b.st.closeOnContentClick || (f += " mfp-auto-cursor"),
                f && b.wrap.addClass(f);
            var k = (b.wH = v.height()),
                n = {};
            if (b.fixedContentPos && b._hasScrollBar(k)) {
                var o = b._getScrollbarSize();
                o && (n.marginRight = o);
            }
            b.fixedContentPos &&
                (b.isIE7
                    ? a("body, html").css("overflow", "hidden")
                    : (n.overflow = "hidden"));
            var r = b.st.mainClass;
            return (
                b.isIE7 && (r += " mfp-ie7"),
                r && b._addClassToMFP(r),
                b.updateItemHTML(),
                y("BuildControls"),
                a("html").css(n),
                b.bgOverlay
                    .add(b.wrap)
                    .prependTo(b.st.prependTo || a(document.body)),
                (b._lastFocusedEl = document.activeElement),
                setTimeout(function () {
                    b.content
                        ? (b._addClassToMFP(q), b._setFocus())
                        : b.bgOverlay.addClass(q),
                        d.on("focusin" + p, b._onFocusIn);
                }, 16),
                (b.isOpen = !0),
                b.updateSize(k),
                y(m),
                c
            );
        },
        close: function () {
            b.isOpen &&
                (y(i),
                (b.isOpen = !1),
                b.st.removalDelay && !b.isLowIE && b.supportsTransition
                    ? (b._addClassToMFP(r),
                      setTimeout(function () {
                          b._close();
                      }, b.st.removalDelay))
                    : b._close());
        },
        _close: function () {
            y(h);
            var c = r + " " + q + " ";
            if (
                (b.bgOverlay.detach(),
                b.wrap.detach(),
                b.container.empty(),
                b.st.mainClass && (c += b.st.mainClass + " "),
                b._removeClassFromMFP(c),
                b.fixedContentPos)
            ) {
                var e = { marginRight: "" };
                b.isIE7
                    ? a("body, html").css("overflow", "")
                    : (e.overflow = ""),
                    a("html").css(e);
            }
            d.off("keyup" + p + " focusin" + p),
                b.ev.off(p),
                b.wrap.attr("class", "mfp-wrap").removeAttr("style"),
                b.bgOverlay.attr("class", "mfp-bg"),
                b.container.attr("class", "mfp-container"),
                !b.st.showCloseBtn ||
                    (b.st.closeBtnInside &&
                        b.currTemplate[b.currItem.type] !== !0) ||
                    (b.currTemplate.closeBtn &&
                        b.currTemplate.closeBtn.detach()),
                b.st.autoFocusLast &&
                    b._lastFocusedEl &&
                    a(b._lastFocusedEl).focus(),
                (b.currItem = null),
                (b.content = null),
                (b.currTemplate = null),
                (b.prevHeight = 0),
                y(j);
        },
        updateSize: function (a) {
            if (b.isIOS) {
                var c =
                        document.documentElement.clientWidth /
                        window.innerWidth,
                    d = window.innerHeight * c;
                b.wrap.css("height", d), (b.wH = d);
            } else b.wH = a || v.height();
            b.fixedContentPos || b.wrap.css("height", b.wH), y("Resize");
        },
        updateItemHTML: function () {
            var c = b.items[b.index];
            b.contentContainer.detach(),
                b.content && b.content.detach(),
                c.parsed || (c = b.parseEl(b.index));
            var d = c.type;
            if (
                (y("BeforeChange", [b.currItem ? b.currItem.type : "", d]),
                (b.currItem = c),
                !b.currTemplate[d])
            ) {
                var f = b.st[d] ? b.st[d].markup : !1;
                y("FirstMarkupParse", f),
                    f ? (b.currTemplate[d] = a(f)) : (b.currTemplate[d] = !0);
            }
            e &&
                e !== c.type &&
                b.container.removeClass("mfp-" + e + "-holder");
            var g = b["get" + d.charAt(0).toUpperCase() + d.slice(1)](
                c,
                b.currTemplate[d]
            );
            b.appendContent(g, d),
                (c.preloaded = !0),
                y(n, c),
                (e = c.type),
                b.container.prepend(b.contentContainer),
                y("AfterChange");
        },
        appendContent: function (a, c) {
            (b.content = a),
                a
                    ? b.st.showCloseBtn &&
                      b.st.closeBtnInside &&
                      b.currTemplate[c] === !0
                        ? b.content.find(".mfp-close").length ||
                          b.content.append(z())
                        : (b.content = a)
                    : (b.content = ""),
                y(k),
                b.container.addClass("mfp-" + c + "-holder"),
                b.contentContainer.append(b.content);
        },
        parseEl: function (c) {
            var d,
                e = b.items[c];
            if (
                (e.tagName
                    ? (e = { el: a(e) })
                    : ((d = e.type), (e = { data: e, src: e.src })),
                e.el)
            ) {
                for (var f = b.types, g = 0; g < f.length; g++)
                    if (e.el.hasClass("mfp-" + f[g])) {
                        d = f[g];
                        break;
                    }
                (e.src = e.el.attr("data-mfp-src")),
                    e.src || (e.src = e.el.attr("href"));
            }
            return (
                (e.type = d || b.st.type || "inline"),
                (e.index = c),
                (e.parsed = !0),
                (b.items[c] = e),
                y("ElementParse", e),
                b.items[c]
            );
        },
        addGroup: function (a, c) {
            var d = function (d) {
                (d.mfpEl = this), b._openClick(d, a, c);
            };
            c || (c = {});
            var e = "click.magnificPopup";
            (c.mainEl = a),
                c.items
                    ? ((c.isObj = !0), a.off(e).on(e, d))
                    : ((c.isObj = !1),
                      c.delegate
                          ? a.off(e).on(e, c.delegate, d)
                          : ((c.items = a), a.off(e).on(e, d)));
        },
        _openClick: function (c, d, e) {
            var f =
                void 0 !== e.midClick
                    ? e.midClick
                    : a.magnificPopup.defaults.midClick;
            if (
                f ||
                !(
                    2 === c.which ||
                    c.ctrlKey ||
                    c.metaKey ||
                    c.altKey ||
                    c.shiftKey
                )
            ) {
                var g =
                    void 0 !== e.disableOn
                        ? e.disableOn
                        : a.magnificPopup.defaults.disableOn;
                if (g)
                    if (a.isFunction(g)) {
                        if (!g.call(b)) return !0;
                    } else if (v.width() < g) return !0;
                c.type && (c.preventDefault(), b.isOpen && c.stopPropagation()),
                    (e.el = a(c.mfpEl)),
                    e.delegate && (e.items = d.find(e.delegate)),
                    b.open(e);
            }
        },
        updateStatus: function (a, d) {
            if (b.preloader) {
                c !== a && b.container.removeClass("mfp-s-" + c),
                    d || "loading" !== a || (d = b.st.tLoading);
                var e = { status: a, text: d };
                y("UpdateStatus", e),
                    (a = e.status),
                    (d = e.text),
                    b.preloader.html(d),
                    b.preloader.find("a").on("click", function (a) {
                        a.stopImmediatePropagation();
                    }),
                    b.container.addClass("mfp-s-" + a),
                    (c = a);
            }
        },
        _checkIfClose: function (c) {
            if (!a(c).hasClass(s)) {
                var d = b.st.closeOnContentClick,
                    e = b.st.closeOnBgClick;
                if (d && e) return !0;
                if (
                    !b.content ||
                    a(c).hasClass("mfp-close") ||
                    (b.preloader && c === b.preloader[0])
                )
                    return !0;
                if (c === b.content[0] || a.contains(b.content[0], c)) {
                    if (d) return !0;
                } else if (e && a.contains(document, c)) return !0;
                return !1;
            }
        },
        _addClassToMFP: function (a) {
            b.bgOverlay.addClass(a), b.wrap.addClass(a);
        },
        _removeClassFromMFP: function (a) {
            this.bgOverlay.removeClass(a), b.wrap.removeClass(a);
        },
        _hasScrollBar: function (a) {
            return (
                (b.isIE7 ? d.height() : document.body.scrollHeight) >
                (a || v.height())
            );
        },
        _setFocus: function () {
            (b.st.focus ? b.content.find(b.st.focus).eq(0) : b.wrap).focus();
        },
        _onFocusIn: function (c) {
            return c.target === b.wrap[0] || a.contains(b.wrap[0], c.target)
                ? void 0
                : (b._setFocus(), !1);
        },
        _parseMarkup: function (b, c, d) {
            var e;
            d.data && (c = a.extend(d.data, c)),
                y(l, [b, c, d]),
                a.each(c, function (c, d) {
                    if (void 0 === d || d === !1) return !0;
                    if (((e = c.split("_")), e.length > 1)) {
                        var f = b.find(p + "-" + e[0]);
                        if (f.length > 0) {
                            var g = e[1];
                            "replaceWith" === g
                                ? f[0] !== d[0] && f.replaceWith(d)
                                : "img" === g
                                ? f.is("img")
                                    ? f.attr("src", d)
                                    : f.replaceWith(
                                          a("<img>")
                                              .attr("src", d)
                                              .attr("class", f.attr("class"))
                                      )
                                : f.attr(e[1], d);
                        }
                    } else b.find(p + "-" + c).html(d);
                });
        },
        _getScrollbarSize: function () {
            if (void 0 === b.scrollbarSize) {
                var a = document.createElement("div");
                (a.style.cssText =
                    "width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;"),
                    document.body.appendChild(a),
                    (b.scrollbarSize = a.offsetWidth - a.clientWidth),
                    document.body.removeChild(a);
            }
            return b.scrollbarSize;
        },
    }),
        (a.magnificPopup = {
            instance: null,
            proto: t.prototype,
            modules: [],
            open: function (b, c) {
                return (
                    A(),
                    (b = b ? a.extend(!0, {}, b) : {}),
                    (b.isObj = !0),
                    (b.index = c || 0),
                    this.instance.open(b)
                );
            },
            close: function () {
                return (
                    a.magnificPopup.instance && a.magnificPopup.instance.close()
                );
            },
            registerModule: function (b, c) {
                c.options && (a.magnificPopup.defaults[b] = c.options),
                    a.extend(this.proto, c.proto),
                    this.modules.push(b);
            },
            defaults: {
                disableOn: 0,
                key: null,
                midClick: !1,
                mainClass: "",
                preloader: !0,
                focus: "",
                closeOnContentClick: !1,
                closeOnBgClick: !0,
                closeBtnInside: !0,
                showCloseBtn: !0,
                enableEscapeKey: !0,
                modal: !1,
                alignTop: !1,
                removalDelay: 0,
                prependTo: null,
                fixedContentPos: "auto",
                fixedBgPos: "auto",
                overflowY: "auto",
                closeMarkup:
                    '<button title="%title%" type="button" class="mfp-close">&#215;</button>',
                tClose: "Close (Esc)",
                tLoading: "Loading...",
                autoFocusLast: !0,
            },
        }),
        (a.fn.magnificPopup = function (c) {
            A();
            var d = a(this);
            if ("string" == typeof c)
                if ("open" === c) {
                    var e,
                        f = u ? d.data("magnificPopup") : d[0].magnificPopup,
                        g = parseInt(arguments[1], 10) || 0;
                    f.items
                        ? (e = f.items[g])
                        : ((e = d),
                          f.delegate && (e = e.find(f.delegate)),
                          (e = e.eq(g))),
                        b._openClick({ mfpEl: e }, d, f);
                } else
                    b.isOpen &&
                        b[c].apply(b, Array.prototype.slice.call(arguments, 1));
            else
                (c = a.extend(!0, {}, c)),
                    u ? d.data("magnificPopup", c) : (d[0].magnificPopup = c),
                    b.addGroup(d, c);
            return d;
        });
    var C,
        D,
        E,
        F = "inline",
        G = function () {
            E && (D.after(E.addClass(C)).detach(), (E = null));
        };
    a.magnificPopup.registerModule(F, {
        options: {
            hiddenClass: "hide",
            markup: "",
            tNotFound: "Content not found",
        },
        proto: {
            initInline: function () {
                b.types.push(F),
                    w(h + "." + F, function () {
                        G();
                    });
            },
            getInline: function (c, d) {
                if ((G(), c.src)) {
                    var e = b.st.inline,
                        f = a(c.src);
                    if (f.length) {
                        var g = f[0].parentNode;
                        g &&
                            g.tagName &&
                            (D ||
                                ((C = e.hiddenClass),
                                (D = x(C)),
                                (C = "mfp-" + C)),
                            (E = f.after(D).detach().removeClass(C))),
                            b.updateStatus("ready");
                    } else
                        b.updateStatus("error", e.tNotFound), (f = a("<div>"));
                    return (c.inlineElement = f), f;
                }
                return b.updateStatus("ready"), b._parseMarkup(d, {}, c), d;
            },
        },
    });
    var H,
        I = "ajax",
        J = function () {
            H && a(document.body).removeClass(H);
        },
        K = function () {
            J(), b.req && b.req.abort();
        };
    a.magnificPopup.registerModule(I, {
        options: {
            settings: null,
            cursor: "mfp-ajax-cur",
            tError: '<a href="%url%">The content</a> could not be loaded.',
        },
        proto: {
            initAjax: function () {
                b.types.push(I),
                    (H = b.st.ajax.cursor),
                    w(h + "." + I, K),
                    w("BeforeChange." + I, K);
            },
            getAjax: function (c) {
                H && a(document.body).addClass(H), b.updateStatus("loading");
                var d = a.extend(
                    {
                        url: c.src,
                        success: function (d, e, f) {
                            var g = { data: d, xhr: f };
                            y("ParseAjax", g),
                                b.appendContent(a(g.data), I),
                                (c.finished = !0),
                                J(),
                                b._setFocus(),
                                setTimeout(function () {
                                    b.wrap.addClass(q);
                                }, 16),
                                b.updateStatus("ready"),
                                y("AjaxContentAdded");
                        },
                        error: function () {
                            J(),
                                (c.finished = c.loadError = !0),
                                b.updateStatus(
                                    "error",
                                    b.st.ajax.tError.replace("%url%", c.src)
                                );
                        },
                    },
                    b.st.ajax.settings
                );
                return (b.req = a.ajax(d)), "";
            },
        },
    });
    var L,
        M = function (c) {
            if (c.data && void 0 !== c.data.title) return c.data.title;
            var d = b.st.image.titleSrc;
            if (d) {
                if (a.isFunction(d)) return d.call(b, c);
                if (c.el) return c.el.attr(d) || "";
            }
            return "";
        };
    a.magnificPopup.registerModule("image", {
        options: {
            markup: '<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',
            cursor: "mfp-zoom-out-cur",
            titleSrc: "title",
            verticalFit: !0,
            tError: '<a href="%url%">The image</a> could not be loaded.',
        },
        proto: {
            initImage: function () {
                var c = b.st.image,
                    d = ".image";
                b.types.push("image"),
                    w(m + d, function () {
                        "image" === b.currItem.type &&
                            c.cursor &&
                            a(document.body).addClass(c.cursor);
                    }),
                    w(h + d, function () {
                        c.cursor && a(document.body).removeClass(c.cursor),
                            v.off("resize" + p);
                    }),
                    w("Resize" + d, b.resizeImage),
                    b.isLowIE && w("AfterChange", b.resizeImage);
            },
            resizeImage: function () {
                var a = b.currItem;
                if (a && a.img && b.st.image.verticalFit) {
                    var c = 0;
                    b.isLowIE &&
                        (c =
                            parseInt(a.img.css("padding-top"), 10) +
                            parseInt(a.img.css("padding-bottom"), 10)),
                        a.img.css("max-height", b.wH - c);
                }
            },
            _onImageHasSize: function (a) {
                a.img &&
                    ((a.hasSize = !0),
                    L && clearInterval(L),
                    (a.isCheckingImgSize = !1),
                    y("ImageHasSize", a),
                    a.imgHidden &&
                        (b.content && b.content.removeClass("mfp-loading"),
                        (a.imgHidden = !1)));
            },
            findImageSize: function (a) {
                var c = 0,
                    d = a.img[0],
                    e = function (f) {
                        L && clearInterval(L),
                            (L = setInterval(function () {
                                return d.naturalWidth > 0
                                    ? void b._onImageHasSize(a)
                                    : (c > 200 && clearInterval(L),
                                      c++,
                                      void (3 === c
                                          ? e(10)
                                          : 40 === c
                                          ? e(50)
                                          : 100 === c && e(500)));
                            }, f));
                    };
                e(1);
            },
            getImage: function (c, d) {
                var e = 0,
                    f = function () {
                        c &&
                            (c.img[0].complete
                                ? (c.img.off(".mfploader"),
                                  c === b.currItem &&
                                      (b._onImageHasSize(c),
                                      b.updateStatus("ready")),
                                  (c.hasSize = !0),
                                  (c.loaded = !0),
                                  y("ImageLoadComplete"))
                                : (e++, 200 > e ? setTimeout(f, 100) : g()));
                    },
                    g = function () {
                        c &&
                            (c.img.off(".mfploader"),
                            c === b.currItem &&
                                (b._onImageHasSize(c),
                                b.updateStatus(
                                    "error",
                                    h.tError.replace("%url%", c.src)
                                )),
                            (c.hasSize = !0),
                            (c.loaded = !0),
                            (c.loadError = !0));
                    },
                    h = b.st.image,
                    i = d.find(".mfp-img");
                if (i.length) {
                    var j = document.createElement("img");
                    (j.className = "mfp-img"),
                        c.el &&
                            c.el.find("img").length &&
                            (j.alt = c.el.find("img").attr("alt")),
                        (c.img = a(j)
                            .on("load.mfploader", f)
                            .on("error.mfploader", g)),
                        (j.src = c.src),
                        i.is("img") && (c.img = c.img.clone()),
                        (j = c.img[0]),
                        j.naturalWidth > 0
                            ? (c.hasSize = !0)
                            : j.width || (c.hasSize = !1);
                }
                return (
                    b._parseMarkup(
                        d,
                        { title: M(c), img_replaceWith: c.img },
                        c
                    ),
                    b.resizeImage(),
                    c.hasSize
                        ? (L && clearInterval(L),
                          c.loadError
                              ? (d.addClass("mfp-loading"),
                                b.updateStatus(
                                    "error",
                                    h.tError.replace("%url%", c.src)
                                ))
                              : (d.removeClass("mfp-loading"),
                                b.updateStatus("ready")),
                          d)
                        : (b.updateStatus("loading"),
                          (c.loading = !0),
                          c.hasSize ||
                              ((c.imgHidden = !0),
                              d.addClass("mfp-loading"),
                              b.findImageSize(c)),
                          d)
                );
            },
        },
    });
    var N,
        O = function () {
            return (
                void 0 === N &&
                    (N =
                        void 0 !==
                        document.createElement("p").style.MozTransform),
                N
            );
        };
    a.magnificPopup.registerModule("zoom", {
        options: {
            enabled: !1,
            easing: "ease-in-out",
            duration: 300,
            opener: function (a) {
                return a.is("img") ? a : a.find("img");
            },
        },
        proto: {
            initZoom: function () {
                var a,
                    c = b.st.zoom,
                    d = ".zoom";
                if (c.enabled && b.supportsTransition) {
                    var e,
                        f,
                        g = c.duration,
                        j = function (a) {
                            var b = a
                                    .clone()
                                    .removeAttr("style")
                                    .removeAttr("class")
                                    .addClass("mfp-animated-image"),
                                d = "all " + c.duration / 1e3 + "s " + c.easing,
                                e = {
                                    position: "fixed",
                                    zIndex: 9999,
                                    left: 0,
                                    top: 0,
                                    "-webkit-backface-visibility": "hidden",
                                },
                                f = "transition";
                            return (
                                (e["-webkit-" + f] =
                                    e["-moz-" + f] =
                                    e["-o-" + f] =
                                    e[f] =
                                        d),
                                b.css(e),
                                b
                            );
                        },
                        k = function () {
                            b.content.css("visibility", "visible");
                        };
                    w("BuildControls" + d, function () {
                        if (b._allowZoom()) {
                            if (
                                (clearTimeout(e),
                                b.content.css("visibility", "hidden"),
                                (a = b._getItemToZoom()),
                                !a)
                            )
                                return void k();
                            (f = j(a)),
                                f.css(b._getOffset()),
                                b.wrap.append(f),
                                (e = setTimeout(function () {
                                    f.css(b._getOffset(!0)),
                                        (e = setTimeout(function () {
                                            k(),
                                                setTimeout(function () {
                                                    f.remove(),
                                                        (a = f = null),
                                                        y("ZoomAnimationEnded");
                                                }, 16);
                                        }, g));
                                }, 16));
                        }
                    }),
                        w(i + d, function () {
                            if (b._allowZoom()) {
                                if (
                                    (clearTimeout(e),
                                    (b.st.removalDelay = g),
                                    !a)
                                ) {
                                    if (((a = b._getItemToZoom()), !a)) return;
                                    f = j(a);
                                }
                                f.css(b._getOffset(!0)),
                                    b.wrap.append(f),
                                    b.content.css("visibility", "hidden"),
                                    setTimeout(function () {
                                        f.css(b._getOffset());
                                    }, 16);
                            }
                        }),
                        w(h + d, function () {
                            b._allowZoom() &&
                                (k(), f && f.remove(), (a = null));
                        });
                }
            },
            _allowZoom: function () {
                return "image" === b.currItem.type;
            },
            _getItemToZoom: function () {
                return b.currItem.hasSize ? b.currItem.img : !1;
            },
            _getOffset: function (c) {
                var d;
                d = c
                    ? b.currItem.img
                    : b.st.zoom.opener(b.currItem.el || b.currItem);
                var e = d.offset(),
                    f = parseInt(d.css("padding-top"), 10),
                    g = parseInt(d.css("padding-bottom"), 10);
                e.top -= a(window).scrollTop() - f;
                var h = {
                    width: d.width(),
                    height: (u ? d.innerHeight() : d[0].offsetHeight) - g - f,
                };
                return (
                    O()
                        ? (h["-moz-transform"] = h.transform =
                              "translate(" + e.left + "px," + e.top + "px)")
                        : ((h.left = e.left), (h.top = e.top)),
                    h
                );
            },
        },
    });
    var P = "iframe",
        Q = "//about:blank",
        R = function (a) {
            if (b.currTemplate[P]) {
                var c = b.currTemplate[P].find("iframe");
                c.length &&
                    (a || (c[0].src = Q),
                    b.isIE8 && c.css("display", a ? "block" : "none"));
            }
        };
    a.magnificPopup.registerModule(P, {
        options: {
            markup: '<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',
            srcAction: "iframe_src",
            patterns: {
                youtube: {
                    index: "youtube.com",
                    id: "v=",
                    src: "//www.youtube.com/embed/%id%?autoplay=1",
                },
                vimeo: {
                    index: "vimeo.com/",
                    id: "/",
                    src: "//player.vimeo.com/video/%id%?autoplay=1",
                },
                gmaps: { index: "//maps.google.", src: "%id%&output=embed" },
            },
        },
        proto: {
            initIframe: function () {
                b.types.push(P),
                    w("BeforeChange", function (a, b, c) {
                        b !== c && (b === P ? R() : c === P && R(!0));
                    }),
                    w(h + "." + P, function () {
                        R();
                    });
            },
            getIframe: function (c, d) {
                var e = c.src,
                    f = b.st.iframe;
                a.each(f.patterns, function () {
                    return e.indexOf(this.index) > -1
                        ? (this.id &&
                              (e =
                                  "string" == typeof this.id
                                      ? e.substr(
                                            e.lastIndexOf(this.id) +
                                                this.id.length,
                                            e.length
                                        )
                                      : this.id.call(this, e)),
                          (e = this.src.replace("%id%", e)),
                          !1)
                        : void 0;
                });
                var g = {};
                return (
                    f.srcAction && (g[f.srcAction] = e),
                    b._parseMarkup(d, g, c),
                    b.updateStatus("ready"),
                    d
                );
            },
        },
    });
    var S = function (a) {
            var c = b.items.length;
            return a > c - 1 ? a - c : 0 > a ? c + a : a;
        },
        T = function (a, b, c) {
            return a.replace(/%curr%/gi, b + 1).replace(/%total%/gi, c);
        };
    a.magnificPopup.registerModule("gallery", {
        options: {
            enabled: !1,
            arrowMarkup:
                '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
            preload: [0, 2],
            navigateByImgClick: !0,
            arrows: !0,
            tPrev: "Previous (Left arrow key)",
            tNext: "Next (Right arrow key)",
            tCounter: "%curr% of %total%",
        },
        proto: {
            initGallery: function () {
                var c = b.st.gallery,
                    e = ".mfp-gallery";
                return (
                    (b.direction = !0),
                    c && c.enabled
                        ? ((f += " mfp-gallery"),
                          w(m + e, function () {
                              c.navigateByImgClick &&
                                  b.wrap.on(
                                      "click" + e,
                                      ".mfp-img",
                                      function () {
                                          return b.items.length > 1
                                              ? (b.next(), !1)
                                              : void 0;
                                      }
                                  ),
                                  d.on("keydown" + e, function (a) {
                                      37 === a.keyCode
                                          ? b.prev()
                                          : 39 === a.keyCode && b.next();
                                  });
                          }),
                          w("UpdateStatus" + e, function (a, c) {
                              c.text &&
                                  (c.text = T(
                                      c.text,
                                      b.currItem.index,
                                      b.items.length
                                  ));
                          }),
                          w(l + e, function (a, d, e, f) {
                              var g = b.items.length;
                              e.counter =
                                  g > 1 ? T(c.tCounter, f.index, g) : "";
                          }),
                          w("BuildControls" + e, function () {
                              if (
                                  b.items.length > 1 &&
                                  c.arrows &&
                                  !b.arrowLeft
                              ) {
                                  var d = c.arrowMarkup,
                                      e = (b.arrowLeft = a(
                                          d
                                              .replace(/%title%/gi, c.tPrev)
                                              .replace(/%dir%/gi, "left")
                                      ).addClass(s)),
                                      f = (b.arrowRight = a(
                                          d
                                              .replace(/%title%/gi, c.tNext)
                                              .replace(/%dir%/gi, "right")
                                      ).addClass(s));
                                  e.click(function () {
                                      b.prev();
                                  }),
                                      f.click(function () {
                                          b.next();
                                      }),
                                      b.container.append(e.add(f));
                              }
                          }),
                          w(n + e, function () {
                              b._preloadTimeout &&
                                  clearTimeout(b._preloadTimeout),
                                  (b._preloadTimeout = setTimeout(function () {
                                      b.preloadNearbyImages(),
                                          (b._preloadTimeout = null);
                                  }, 16));
                          }),
                          void w(h + e, function () {
                              d.off(e),
                                  b.wrap.off("click" + e),
                                  (b.arrowRight = b.arrowLeft = null);
                          }))
                        : !1
                );
            },
            next: function () {
                (b.direction = !0),
                    (b.index = S(b.index + 1)),
                    b.updateItemHTML();
            },
            prev: function () {
                (b.direction = !1),
                    (b.index = S(b.index - 1)),
                    b.updateItemHTML();
            },
            goTo: function (a) {
                (b.direction = a >= b.index), (b.index = a), b.updateItemHTML();
            },
            preloadNearbyImages: function () {
                var a,
                    c = b.st.gallery.preload,
                    d = Math.min(c[0], b.items.length),
                    e = Math.min(c[1], b.items.length);
                for (a = 1; a <= (b.direction ? e : d); a++)
                    b._preloadItem(b.index + a);
                for (a = 1; a <= (b.direction ? d : e); a++)
                    b._preloadItem(b.index - a);
            },
            _preloadItem: function (c) {
                if (((c = S(c)), !b.items[c].preloaded)) {
                    var d = b.items[c];
                    d.parsed || (d = b.parseEl(c)),
                        y("LazyLoad", d),
                        "image" === d.type &&
                            (d.img = a('<img class="mfp-img" />')
                                .on("load.mfploader", function () {
                                    d.hasSize = !0;
                                })
                                .on("error.mfploader", function () {
                                    (d.hasSize = !0),
                                        (d.loadError = !0),
                                        y("LazyLoadError", d);
                                })
                                .attr("src", d.src)),
                        (d.preloaded = !0);
                }
            },
        },
    });
    var U = "retina";
    a.magnificPopup.registerModule(U, {
        options: {
            replaceSrc: function (a) {
                return a.src.replace(/\.\w+$/, function (a) {
                    return "@2x" + a;
                });
            },
            ratio: 1,
        },
        proto: {
            initRetina: function () {
                if (window.devicePixelRatio > 1) {
                    var a = b.st.retina,
                        c = a.ratio;
                    (c = isNaN(c) ? c() : c),
                        c > 1 &&
                            (w("ImageHasSize." + U, function (a, b) {
                                b.img.css({
                                    "max-width": b.img[0].naturalWidth / c,
                                    width: "100%",
                                });
                            }),
                            w("ElementParse." + U, function (b, d) {
                                d.src = a.replaceSrc(d, c);
                            }));
                }
            },
        },
    }),
        A();
});

/*  jQuery Nice Select - v1.0
    https://github.com/hernansartorio/jquery-nice-select
    Made by Hernán Sartorio  */
!(function (e) {
    e.fn.niceSelect = function (t) {
        function s(t) {
            t.after(
                e("<div></div>")
                    .addClass("nice-select")
                    .addClass(t.attr("class") || "")
                    .addClass(t.attr("disabled") ? "disabled" : "")
                    .attr("tabindex", t.attr("disabled") ? null : "0")
                    .html('<span class="current"></span><ul class="list"></ul>')
            );
            var s = t.next(),
                n = t.find("option"),
                i = t.find("option:selected");
            s.find(".current").html(i.data("display") || i.text()),
                n.each(function (t) {
                    var n = e(this),
                        i = n.data("display");
                    s.find("ul").append(
                        e("<li></li>")
                            .attr("data-value", n.val())
                            .attr("data-display", i || null)
                            .addClass(
                                "option" +
                                    (n.is(":selected") ? " selected" : "") +
                                    (n.is(":disabled") ? " disabled" : "")
                            )
                            .html(n.text())
                    );
                });
        }
        if ("string" == typeof t)
            return (
                "update" == t
                    ? this.each(function () {
                          var t = e(this),
                              n = e(this).next(".nice-select"),
                              i = n.hasClass("open");
                          n.length &&
                              (n.remove(),
                              s(t),
                              i && t.next().trigger("click"));
                      })
                    : "destroy" == t
                    ? (this.each(function () {
                          var t = e(this),
                              s = e(this).next(".nice-select");
                          s.length && (s.remove(), t.css("display", ""));
                      }),
                      0 == e(".nice-select").length &&
                          e(document).off(".nice_select"))
                    : console.log('Method "' + t + '" does not exist.'),
                this
            );
        this.hide(),
            this.each(function () {
                var t = e(this);
                t.next().hasClass("nice-select") || s(t);
            }),
            e(document).off(".nice_select"),
            e(document).on("click.nice_select", ".nice-select", function (t) {
                var s = e(this);
                e(".nice-select").not(s).removeClass("open"),
                    s.toggleClass("open"),
                    s.hasClass("open")
                        ? (s.find(".option"),
                          s.find(".focus").removeClass("focus"),
                          s.find(".selected").addClass("focus"))
                        : s.focus();
            }),
            e(document).on("click.nice_select", function (t) {
                0 === e(t.target).closest(".nice-select").length &&
                    e(".nice-select").removeClass("open").find(".option");
            }),
            e(document).on(
                "click.nice_select",
                ".nice-select .option:not(.disabled)",
                function (t) {
                    var s = e(this),
                        n = s.closest(".nice-select");
                    n.find(".selected").removeClass("selected"),
                        s.addClass("selected");
                    var i = s.data("display") || s.text();
                    n.find(".current").text(i),
                        n.prev("select").val(s.data("value")).trigger("change");
                }
            ),
            e(document).on("keydown.nice_select", ".nice-select", function (t) {
                var s = e(this),
                    n = e(s.find(".focus") || s.find(".list .option.selected"));
                if (32 == t.keyCode || 13 == t.keyCode)
                    return (
                        s.hasClass("open")
                            ? n.trigger("click")
                            : s.trigger("click"),
                        !1
                    );
                if (40 == t.keyCode) {
                    if (s.hasClass("open")) {
                        var i = n.nextAll(".option:not(.disabled)").first();
                        i.length > 0 &&
                            (s.find(".focus").removeClass("focus"),
                            i.addClass("focus"));
                    } else s.trigger("click");
                    return !1;
                }
                if (38 == t.keyCode) {
                    if (s.hasClass("open")) {
                        var l = n.prevAll(".option:not(.disabled)").first();
                        l.length > 0 &&
                            (s.find(".focus").removeClass("focus"),
                            l.addClass("focus"));
                    } else s.trigger("click");
                    return !1;
                }
                if (27 == t.keyCode) s.hasClass("open") && s.trigger("click");
                else if (9 == t.keyCode && s.hasClass("open")) return !1;
            });
        var n = document.createElement("a").style;
        return (
            (n.cssText = "pointer-events:auto"),
            "auto" !== n.pointerEvents &&
                e("html").addClass("no-csspointerevents"),
            this
        );
    };
})(jQuery);

/* flatpickr v4.6.13,, @license MIT */
!(function (e, n) {
    "object" == typeof exports && "undefined" != typeof module
        ? (module.exports = n())
        : "function" == typeof define && define.amd
        ? define(n)
        : ((e =
              "undefined" != typeof globalThis
                  ? globalThis
                  : e || self).flatpickr = n());
})(this, function () {
    "use strict";
    var e = function () {
        return (e =
            Object.assign ||
            function (e) {
                for (var n, t = 1, a = arguments.length; t < a; t++)
                    for (var i in (n = arguments[t]))
                        Object.prototype.hasOwnProperty.call(n, i) &&
                            (e[i] = n[i]);
                return e;
            }).apply(this, arguments);
    };
    function n() {
        for (var e = 0, n = 0, t = arguments.length; n < t; n++)
            e += arguments[n].length;
        var a = Array(e),
            i = 0;
        for (n = 0; n < t; n++)
            for (var o = arguments[n], r = 0, l = o.length; r < l; r++, i++)
                a[i] = o[r];
        return a;
    }
    var t = [
            "onChange",
            "onClose",
            "onDayCreate",
            "onDestroy",
            "onKeyDown",
            "onMonthChange",
            "onOpen",
            "onParseConfig",
            "onReady",
            "onValueUpdate",
            "onYearChange",
            "onPreCalendarPosition",
        ],
        a = {
            _disable: [],
            allowInput: !1,
            allowInvalidPreload: !1,
            altFormat: "F j, Y",
            altInput: !1,
            altInputClass: "form-control input",
            animate:
                "object" == typeof window &&
                -1 === window.navigator.userAgent.indexOf("MSIE"),
            ariaDateFormat: "F j, Y",
            autoFillDefaultTime: !0,
            clickOpens: !0,
            closeOnSelect: !0,
            conjunction: ", ",
            dateFormat: "Y-m-d",
            defaultHour: 12,
            defaultMinute: 0,
            defaultSeconds: 0,
            disable: [],
            disableMobile: !1,
            enableSeconds: !1,
            enableTime: !1,
            errorHandler: function (e) {
                return "undefined" != typeof console && console.warn(e);
            },
            getWeek: function (e) {
                var n = new Date(e.getTime());
                n.setHours(0, 0, 0, 0),
                    n.setDate(n.getDate() + 3 - ((n.getDay() + 6) % 7));
                var t = new Date(n.getFullYear(), 0, 4);
                return (
                    1 +
                    Math.round(
                        ((n.getTime() - t.getTime()) / 864e5 -
                            3 +
                            ((t.getDay() + 6) % 7)) /
                            7
                    )
                );
            },
            hourIncrement: 1,
            ignoredFocusElements: [],
            inline: !1,
            locale: "default",
            minuteIncrement: 5,
            mode: "single",
            monthSelectorType: "dropdown",
            nextArrow:
                "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 17 17'><g></g><path d='M13.207 8.472l-7.854 7.854-0.707-0.707 7.146-7.146-7.146-7.148 0.707-0.707 7.854 7.854z' /></svg>",
            noCalendar: !1,
            now: new Date(),
            onChange: [],
            onClose: [],
            onDayCreate: [],
            onDestroy: [],
            onKeyDown: [],
            onMonthChange: [],
            onOpen: [],
            onParseConfig: [],
            onReady: [],
            onValueUpdate: [],
            onYearChange: [],
            onPreCalendarPosition: [],
            plugins: [],
            position: "auto",
            positionElement: void 0,
            prevArrow:
                "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 17 17'><g></g><path d='M5.207 8.471l7.146 7.147-0.707 0.707-7.853-7.854 7.854-7.853 0.707 0.707-7.147 7.146z' /></svg>",
            shorthandCurrentMonth: !1,
            showMonths: 1,
            static: !1,
            time_24hr: !1,
            weekNumbers: !1,
            wrap: !1,
        },
        i = {
            weekdays: {
                shorthand: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                longhand: [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                ],
            },
            months: {
                shorthand: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                longhand: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                ],
            },
            daysInMonth: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
            firstDayOfWeek: 0,
            ordinal: function (e) {
                var n = e % 100;
                if (n > 3 && n < 21) return "th";
                switch (n % 10) {
                    case 1:
                        return "st";
                    case 2:
                        return "nd";
                    case 3:
                        return "rd";
                    default:
                        return "th";
                }
            },
            rangeSeparator: " to ",
            weekAbbreviation: "Wk",
            scrollTitle: "Scroll to increment",
            toggleTitle: "Click to toggle",
            amPM: ["AM", "PM"],
            yearAriaLabel: "Year",
            monthAriaLabel: "Month",
            hourAriaLabel: "Hour",
            minuteAriaLabel: "Minute",
            time_24hr: !1,
        },
        o = function (e, n) {
            return void 0 === n && (n = 2), ("000" + e).slice(-1 * n);
        },
        r = function (e) {
            return !0 === e ? 1 : 0;
        };
    function l(e, n) {
        var t;
        return function () {
            var a = this,
                i = arguments;
            clearTimeout(t),
                (t = setTimeout(function () {
                    return e.apply(a, i);
                }, n));
        };
    }
    var c = function (e) {
        return e instanceof Array ? e : [e];
    };
    function s(e, n, t) {
        if (!0 === t) return e.classList.add(n);
        e.classList.remove(n);
    }
    function d(e, n, t) {
        var a = window.document.createElement(e);
        return (
            (n = n || ""),
            (t = t || ""),
            (a.className = n),
            void 0 !== t && (a.textContent = t),
            a
        );
    }
    function u(e) {
        for (; e.firstChild; ) e.removeChild(e.firstChild);
    }
    function f(e, n) {
        return n(e) ? e : e.parentNode ? f(e.parentNode, n) : void 0;
    }
    function m(e, n) {
        var t = d("div", "numInputWrapper"),
            a = d("input", "numInput " + e),
            i = d("span", "arrowUp"),
            o = d("span", "arrowDown");
        if (
            (-1 === navigator.userAgent.indexOf("MSIE 9.0")
                ? (a.type = "number")
                : ((a.type = "text"), (a.pattern = "\\d*")),
            void 0 !== n)
        )
            for (var r in n) a.setAttribute(r, n[r]);
        return t.appendChild(a), t.appendChild(i), t.appendChild(o), t;
    }
    function g(e) {
        try {
            return "function" == typeof e.composedPath
                ? e.composedPath()[0]
                : e.target;
        } catch (n) {
            return e.target;
        }
    }
    var p = function () {},
        h = function (e, n, t) {
            return t.months[n ? "shorthand" : "longhand"][e];
        },
        v = {
            D: p,
            F: function (e, n, t) {
                e.setMonth(t.months.longhand.indexOf(n));
            },
            G: function (e, n) {
                e.setHours((e.getHours() >= 12 ? 12 : 0) + parseFloat(n));
            },
            H: function (e, n) {
                e.setHours(parseFloat(n));
            },
            J: function (e, n) {
                e.setDate(parseFloat(n));
            },
            K: function (e, n, t) {
                e.setHours(
                    (e.getHours() % 12) +
                        12 * r(new RegExp(t.amPM[1], "i").test(n))
                );
            },
            M: function (e, n, t) {
                e.setMonth(t.months.shorthand.indexOf(n));
            },
            S: function (e, n) {
                e.setSeconds(parseFloat(n));
            },
            U: function (e, n) {
                return new Date(1e3 * parseFloat(n));
            },
            W: function (e, n, t) {
                var a = parseInt(n),
                    i = new Date(
                        e.getFullYear(),
                        0,
                        2 + 7 * (a - 1),
                        0,
                        0,
                        0,
                        0
                    );
                return (
                    i.setDate(i.getDate() - i.getDay() + t.firstDayOfWeek), i
                );
            },
            Y: function (e, n) {
                e.setFullYear(parseFloat(n));
            },
            Z: function (e, n) {
                return new Date(n);
            },
            d: function (e, n) {
                e.setDate(parseFloat(n));
            },
            h: function (e, n) {
                e.setHours((e.getHours() >= 12 ? 12 : 0) + parseFloat(n));
            },
            i: function (e, n) {
                e.setMinutes(parseFloat(n));
            },
            j: function (e, n) {
                e.setDate(parseFloat(n));
            },
            l: p,
            m: function (e, n) {
                e.setMonth(parseFloat(n) - 1);
            },
            n: function (e, n) {
                e.setMonth(parseFloat(n) - 1);
            },
            s: function (e, n) {
                e.setSeconds(parseFloat(n));
            },
            u: function (e, n) {
                return new Date(parseFloat(n));
            },
            w: p,
            y: function (e, n) {
                e.setFullYear(2e3 + parseFloat(n));
            },
        },
        D = {
            D: "",
            F: "",
            G: "(\\d\\d|\\d)",
            H: "(\\d\\d|\\d)",
            J: "(\\d\\d|\\d)\\w+",
            K: "",
            M: "",
            S: "(\\d\\d|\\d)",
            U: "(.+)",
            W: "(\\d\\d|\\d)",
            Y: "(\\d{4})",
            Z: "(.+)",
            d: "(\\d\\d|\\d)",
            h: "(\\d\\d|\\d)",
            i: "(\\d\\d|\\d)",
            j: "(\\d\\d|\\d)",
            l: "",
            m: "(\\d\\d|\\d)",
            n: "(\\d\\d|\\d)",
            s: "(\\d\\d|\\d)",
            u: "(.+)",
            w: "(\\d\\d|\\d)",
            y: "(\\d{2})",
        },
        w = {
            Z: function (e) {
                return e.toISOString();
            },
            D: function (e, n, t) {
                return n.weekdays.shorthand[w.w(e, n, t)];
            },
            F: function (e, n, t) {
                return h(w.n(e, n, t) - 1, !1, n);
            },
            G: function (e, n, t) {
                return o(w.h(e, n, t));
            },
            H: function (e) {
                return o(e.getHours());
            },
            J: function (e, n) {
                return void 0 !== n.ordinal
                    ? e.getDate() + n.ordinal(e.getDate())
                    : e.getDate();
            },
            K: function (e, n) {
                return n.amPM[r(e.getHours() > 11)];
            },
            M: function (e, n) {
                return h(e.getMonth(), !0, n);
            },
            S: function (e) {
                return o(e.getSeconds());
            },
            U: function (e) {
                return e.getTime() / 1e3;
            },
            W: function (e, n, t) {
                return t.getWeek(e);
            },
            Y: function (e) {
                return o(e.getFullYear(), 4);
            },
            d: function (e) {
                return o(e.getDate());
            },
            h: function (e) {
                return e.getHours() % 12 ? e.getHours() % 12 : 12;
            },
            i: function (e) {
                return o(e.getMinutes());
            },
            j: function (e) {
                return e.getDate();
            },
            l: function (e, n) {
                return n.weekdays.longhand[e.getDay()];
            },
            m: function (e) {
                return o(e.getMonth() + 1);
            },
            n: function (e) {
                return e.getMonth() + 1;
            },
            s: function (e) {
                return e.getSeconds();
            },
            u: function (e) {
                return e.getTime();
            },
            w: function (e) {
                return e.getDay();
            },
            y: function (e) {
                return String(e.getFullYear()).substring(2);
            },
        },
        b = function (e) {
            var n = e.config,
                t = void 0 === n ? a : n,
                o = e.l10n,
                r = void 0 === o ? i : o,
                l = e.isMobile,
                c = void 0 !== l && l;
            return function (e, n, a) {
                var i = a || r;
                return void 0 === t.formatDate || c
                    ? n
                          .split("")
                          .map(function (n, a, o) {
                              return w[n] && "\\" !== o[a - 1]
                                  ? w[n](e, i, t)
                                  : "\\" !== n
                                  ? n
                                  : "";
                          })
                          .join("")
                    : t.formatDate(e, n, i);
            };
        },
        C = function (e) {
            var n = e.config,
                t = void 0 === n ? a : n,
                o = e.l10n,
                r = void 0 === o ? i : o;
            return function (e, n, i, o) {
                if (0 === e || e) {
                    var l,
                        c = o || r,
                        s = e;
                    if (e instanceof Date) l = new Date(e.getTime());
                    else if ("string" != typeof e && void 0 !== e.toFixed)
                        l = new Date(e);
                    else if ("string" == typeof e) {
                        var d = n || (t || a).dateFormat,
                            u = String(e).trim();
                        if ("today" === u) (l = new Date()), (i = !0);
                        else if (t && t.parseDate) l = t.parseDate(e, d);
                        else if (/Z$/.test(u) || /GMT$/.test(u))
                            l = new Date(e);
                        else {
                            for (
                                var f = void 0, m = [], g = 0, p = 0, h = "";
                                g < d.length;
                                g++
                            ) {
                                var w = d[g],
                                    b = "\\" === w,
                                    C = "\\" === d[g - 1] || b;
                                if (D[w] && !C) {
                                    h += D[w];
                                    var M = new RegExp(h).exec(e);
                                    M &&
                                        (f = !0) &&
                                        m["Y" !== w ? "push" : "unshift"]({
                                            fn: v[w],
                                            val: M[++p],
                                        });
                                } else b || (h += ".");
                            }
                            (l =
                                t && t.noCalendar
                                    ? new Date(new Date().setHours(0, 0, 0, 0))
                                    : new Date(
                                          new Date().getFullYear(),
                                          0,
                                          1,
                                          0,
                                          0,
                                          0,
                                          0
                                      )),
                                m.forEach(function (e) {
                                    var n = e.fn,
                                        t = e.val;
                                    return (l = n(l, t, c) || l);
                                }),
                                (l = f ? l : void 0);
                        }
                    }
                    if (l instanceof Date && !isNaN(l.getTime()))
                        return !0 === i && l.setHours(0, 0, 0, 0), l;
                    t.errorHandler(new Error("Invalid date provided: " + s));
                }
            };
        };
    function M(e, n, t) {
        return (
            void 0 === t && (t = !0),
            !1 !== t
                ? new Date(e.getTime()).setHours(0, 0, 0, 0) -
                  new Date(n.getTime()).setHours(0, 0, 0, 0)
                : e.getTime() - n.getTime()
        );
    }
    var y = function (e, n, t) {
            return 3600 * e + 60 * n + t;
        },
        x = 864e5;
    function E(e) {
        var n = e.defaultHour,
            t = e.defaultMinute,
            a = e.defaultSeconds;
        if (void 0 !== e.minDate) {
            var i = e.minDate.getHours(),
                o = e.minDate.getMinutes(),
                r = e.minDate.getSeconds();
            n < i && (n = i),
                n === i && t < o && (t = o),
                n === i && t === o && a < r && (a = e.minDate.getSeconds());
        }
        if (void 0 !== e.maxDate) {
            var l = e.maxDate.getHours(),
                c = e.maxDate.getMinutes();
            (n = Math.min(n, l)) === l && (t = Math.min(c, t)),
                n === l && t === c && (a = e.maxDate.getSeconds());
        }
        return { hours: n, minutes: t, seconds: a };
    }
    "function" != typeof Object.assign &&
        (Object.assign = function (e) {
            for (var n = [], t = 1; t < arguments.length; t++)
                n[t - 1] = arguments[t];
            if (!e)
                throw TypeError("Cannot convert undefined or null to object");
            for (
                var a = function (n) {
                        n &&
                            Object.keys(n).forEach(function (t) {
                                return (e[t] = n[t]);
                            });
                    },
                    i = 0,
                    o = n;
                i < o.length;
                i++
            ) {
                var r = o[i];
                a(r);
            }
            return e;
        });
    function k(p, v) {
        var w = { config: e(e({}, a), I.defaultConfig), l10n: i };
        function k() {
            var e;
            return (
                (null === (e = w.calendarContainer) || void 0 === e
                    ? void 0
                    : e.getRootNode()
                ).activeElement || document.activeElement
            );
        }
        function T(e) {
            return e.bind(w);
        }
        function S() {
            var e = w.config;
            (!1 === e.weekNumbers && 1 === e.showMonths) ||
                (!0 !== e.noCalendar &&
                    window.requestAnimationFrame(function () {
                        if (
                            (void 0 !== w.calendarContainer &&
                                ((w.calendarContainer.style.visibility =
                                    "hidden"),
                                (w.calendarContainer.style.display = "block")),
                            void 0 !== w.daysContainer)
                        ) {
                            var n = (w.days.offsetWidth + 1) * e.showMonths;
                            (w.daysContainer.style.width = n + "px"),
                                (w.calendarContainer.style.width =
                                    n +
                                    (void 0 !== w.weekWrapper
                                        ? w.weekWrapper.offsetWidth
                                        : 0) +
                                    "px"),
                                w.calendarContainer.style.removeProperty(
                                    "visibility"
                                ),
                                w.calendarContainer.style.removeProperty(
                                    "display"
                                );
                        }
                    }));
        }
        function _(e) {
            if (0 === w.selectedDates.length) {
                var n =
                        void 0 === w.config.minDate ||
                        M(new Date(), w.config.minDate) >= 0
                            ? new Date()
                            : new Date(w.config.minDate.getTime()),
                    t = E(w.config);
                n.setHours(t.hours, t.minutes, t.seconds, n.getMilliseconds()),
                    (w.selectedDates = [n]),
                    (w.latestSelectedDateObj = n);
            }
            void 0 !== e &&
                "blur" !== e.type &&
                (function (e) {
                    e.preventDefault();
                    var n = "keydown" === e.type,
                        t = g(e),
                        a = t;
                    void 0 !== w.amPM &&
                        t === w.amPM &&
                        (w.amPM.textContent =
                            w.l10n.amPM[
                                r(w.amPM.textContent === w.l10n.amPM[0])
                            ]);
                    var i = parseFloat(a.getAttribute("min")),
                        l = parseFloat(a.getAttribute("max")),
                        c = parseFloat(a.getAttribute("step")),
                        s = parseInt(a.value, 10),
                        d = e.delta || (n ? (38 === e.which ? 1 : -1) : 0),
                        u = s + c * d;
                    if (void 0 !== a.value && 2 === a.value.length) {
                        var f = a === w.hourElement,
                            m = a === w.minuteElement;
                        u < i
                            ? ((u = l + u + r(!f) + (r(f) && r(!w.amPM))),
                              m && L(void 0, -1, w.hourElement))
                            : u > l &&
                              ((u =
                                  a === w.hourElement ? u - l - r(!w.amPM) : i),
                              m && L(void 0, 1, w.hourElement)),
                            w.amPM &&
                                f &&
                                (1 === c
                                    ? u + s === 23
                                    : Math.abs(u - s) > c) &&
                                (w.amPM.textContent =
                                    w.l10n.amPM[
                                        r(w.amPM.textContent === w.l10n.amPM[0])
                                    ]),
                            (a.value = o(u));
                    }
                })(e);
            var a = w._input.value;
            O(), ye(), w._input.value !== a && w._debouncedChange();
        }
        function O() {
            if (void 0 !== w.hourElement && void 0 !== w.minuteElement) {
                var e,
                    n,
                    t = (parseInt(w.hourElement.value.slice(-2), 10) || 0) % 24,
                    a = (parseInt(w.minuteElement.value, 10) || 0) % 60,
                    i =
                        void 0 !== w.secondElement
                            ? (parseInt(w.secondElement.value, 10) || 0) % 60
                            : 0;
                void 0 !== w.amPM &&
                    ((e = t),
                    (n = w.amPM.textContent),
                    (t = (e % 12) + 12 * r(n === w.l10n.amPM[1])));
                var o =
                        void 0 !== w.config.minTime ||
                        (w.config.minDate &&
                            w.minDateHasTime &&
                            w.latestSelectedDateObj &&
                            0 ===
                                M(
                                    w.latestSelectedDateObj,
                                    w.config.minDate,
                                    !0
                                )),
                    l =
                        void 0 !== w.config.maxTime ||
                        (w.config.maxDate &&
                            w.maxDateHasTime &&
                            w.latestSelectedDateObj &&
                            0 ===
                                M(
                                    w.latestSelectedDateObj,
                                    w.config.maxDate,
                                    !0
                                ));
                if (
                    void 0 !== w.config.maxTime &&
                    void 0 !== w.config.minTime &&
                    w.config.minTime > w.config.maxTime
                ) {
                    var c = y(
                            w.config.minTime.getHours(),
                            w.config.minTime.getMinutes(),
                            w.config.minTime.getSeconds()
                        ),
                        s = y(
                            w.config.maxTime.getHours(),
                            w.config.maxTime.getMinutes(),
                            w.config.maxTime.getSeconds()
                        ),
                        d = y(t, a, i);
                    if (d > s && d < c) {
                        var u = (function (e) {
                            var n = Math.floor(e / 3600),
                                t = (e - 3600 * n) / 60;
                            return [n, t, e - 3600 * n - 60 * t];
                        })(c);
                        (t = u[0]), (a = u[1]), (i = u[2]);
                    }
                } else {
                    if (l) {
                        var f =
                            void 0 !== w.config.maxTime
                                ? w.config.maxTime
                                : w.config.maxDate;
                        (t = Math.min(t, f.getHours())) === f.getHours() &&
                            (a = Math.min(a, f.getMinutes())),
                            a === f.getMinutes() &&
                                (i = Math.min(i, f.getSeconds()));
                    }
                    if (o) {
                        var m =
                            void 0 !== w.config.minTime
                                ? w.config.minTime
                                : w.config.minDate;
                        (t = Math.max(t, m.getHours())) === m.getHours() &&
                            a < m.getMinutes() &&
                            (a = m.getMinutes()),
                            a === m.getMinutes() &&
                                (i = Math.max(i, m.getSeconds()));
                    }
                }
                A(t, a, i);
            }
        }
        function F(e) {
            var n = e || w.latestSelectedDateObj;
            n &&
                n instanceof Date &&
                A(n.getHours(), n.getMinutes(), n.getSeconds());
        }
        function A(e, n, t) {
            void 0 !== w.latestSelectedDateObj &&
                w.latestSelectedDateObj.setHours(e % 24, n, t || 0, 0),
                w.hourElement &&
                    w.minuteElement &&
                    !w.isMobile &&
                    ((w.hourElement.value = o(
                        w.config.time_24hr
                            ? e
                            : ((12 + e) % 12) + 12 * r(e % 12 == 0)
                    )),
                    (w.minuteElement.value = o(n)),
                    void 0 !== w.amPM &&
                        (w.amPM.textContent = w.l10n.amPM[r(e >= 12)]),
                    void 0 !== w.secondElement &&
                        (w.secondElement.value = o(t)));
        }
        function N(e) {
            var n = g(e),
                t = parseInt(n.value) + (e.delta || 0);
            (t / 1e3 > 1 ||
                ("Enter" === e.key && !/[^\d]/.test(t.toString()))) &&
                ee(t);
        }
        function P(e, n, t, a) {
            return n instanceof Array
                ? n.forEach(function (n) {
                      return P(e, n, t, a);
                  })
                : e instanceof Array
                ? e.forEach(function (e) {
                      return P(e, n, t, a);
                  })
                : (e.addEventListener(n, t, a),
                  void w._handlers.push({
                      remove: function () {
                          return e.removeEventListener(n, t, a);
                      },
                  }));
        }
        function Y() {
            De("onChange");
        }
        function j(e, n) {
            var t =
                    void 0 !== e
                        ? w.parseDate(e)
                        : w.latestSelectedDateObj ||
                          (w.config.minDate && w.config.minDate > w.now
                              ? w.config.minDate
                              : w.config.maxDate && w.config.maxDate < w.now
                              ? w.config.maxDate
                              : w.now),
                a = w.currentYear,
                i = w.currentMonth;
            try {
                void 0 !== t &&
                    ((w.currentYear = t.getFullYear()),
                    (w.currentMonth = t.getMonth()));
            } catch (e) {
                (e.message = "Invalid date supplied: " + t),
                    w.config.errorHandler(e);
            }
            n && w.currentYear !== a && (De("onYearChange"), q()),
                !n ||
                    (w.currentYear === a && w.currentMonth === i) ||
                    De("onMonthChange"),
                w.redraw();
        }
        function H(e) {
            var n = g(e);
            ~n.className.indexOf("arrow") &&
                L(e, n.classList.contains("arrowUp") ? 1 : -1);
        }
        function L(e, n, t) {
            var a = e && g(e),
                i = t || (a && a.parentNode && a.parentNode.firstChild),
                o = we("increment");
            (o.delta = n), i && i.dispatchEvent(o);
        }
        function R(e, n, t, a) {
            var i = ne(n, !0),
                o = d("span", e, n.getDate().toString());
            return (
                (o.dateObj = n),
                (o.$i = a),
                o.setAttribute(
                    "aria-label",
                    w.formatDate(n, w.config.ariaDateFormat)
                ),
                -1 === e.indexOf("hidden") &&
                    0 === M(n, w.now) &&
                    ((w.todayDateElem = o),
                    o.classList.add("today"),
                    o.setAttribute("aria-current", "date")),
                i
                    ? ((o.tabIndex = -1),
                      be(n) &&
                          (o.classList.add("selected"),
                          (w.selectedDateElem = o),
                          "range" === w.config.mode &&
                              (s(
                                  o,
                                  "startRange",
                                  w.selectedDates[0] &&
                                      0 === M(n, w.selectedDates[0], !0)
                              ),
                              s(
                                  o,
                                  "endRange",
                                  w.selectedDates[1] &&
                                      0 === M(n, w.selectedDates[1], !0)
                              ),
                              "nextMonthDay" === e &&
                                  o.classList.add("inRange"))))
                    : o.classList.add("flatpickr-disabled"),
                "range" === w.config.mode &&
                    (function (e) {
                        return (
                            !(
                                "range" !== w.config.mode ||
                                w.selectedDates.length < 2
                            ) &&
                            M(e, w.selectedDates[0]) >= 0 &&
                            M(e, w.selectedDates[1]) <= 0
                        );
                    })(n) &&
                    !be(n) &&
                    o.classList.add("inRange"),
                w.weekNumbers &&
                    1 === w.config.showMonths &&
                    "prevMonthDay" !== e &&
                    a % 7 == 6 &&
                    w.weekNumbers.insertAdjacentHTML(
                        "beforeend",
                        "<span class='flatpickr-day'>" +
                            w.config.getWeek(n) +
                            "</span>"
                    ),
                De("onDayCreate", o),
                o
            );
        }
        function W(e) {
            e.focus(), "range" === w.config.mode && oe(e);
        }
        function B(e) {
            for (
                var n = e > 0 ? 0 : w.config.showMonths - 1,
                    t = e > 0 ? w.config.showMonths : -1,
                    a = n;
                a != t;
                a += e
            )
                for (
                    var i = w.daysContainer.children[a],
                        o = e > 0 ? 0 : i.children.length - 1,
                        r = e > 0 ? i.children.length : -1,
                        l = o;
                    l != r;
                    l += e
                ) {
                    var c = i.children[l];
                    if (-1 === c.className.indexOf("hidden") && ne(c.dateObj))
                        return c;
                }
        }
        function J(e, n) {
            var t = k(),
                a = te(t || document.body),
                i =
                    void 0 !== e
                        ? e
                        : a
                        ? t
                        : void 0 !== w.selectedDateElem &&
                          te(w.selectedDateElem)
                        ? w.selectedDateElem
                        : void 0 !== w.todayDateElem && te(w.todayDateElem)
                        ? w.todayDateElem
                        : B(n > 0 ? 1 : -1);
            void 0 === i
                ? w._input.focus()
                : a
                ? (function (e, n) {
                      for (
                          var t =
                                  -1 === e.className.indexOf("Month")
                                      ? e.dateObj.getMonth()
                                      : w.currentMonth,
                              a = n > 0 ? w.config.showMonths : -1,
                              i = n > 0 ? 1 : -1,
                              o = t - w.currentMonth;
                          o != a;
                          o += i
                      )
                          for (
                              var r = w.daysContainer.children[o],
                                  l =
                                      t - w.currentMonth === o
                                          ? e.$i + n
                                          : n < 0
                                          ? r.children.length - 1
                                          : 0,
                                  c = r.children.length,
                                  s = l;
                              s >= 0 && s < c && s != (n > 0 ? c : -1);
                              s += i
                          ) {
                              var d = r.children[s];
                              if (
                                  -1 === d.className.indexOf("hidden") &&
                                  ne(d.dateObj) &&
                                  Math.abs(e.$i - s) >= Math.abs(n)
                              )
                                  return W(d);
                          }
                      w.changeMonth(i), J(B(i), 0);
                  })(i, n)
                : W(i);
        }
        function K(e, n) {
            for (
                var t =
                        (new Date(e, n, 1).getDay() -
                            w.l10n.firstDayOfWeek +
                            7) %
                        7,
                    a = w.utils.getDaysInMonth((n - 1 + 12) % 12, e),
                    i = w.utils.getDaysInMonth(n, e),
                    o = window.document.createDocumentFragment(),
                    r = w.config.showMonths > 1,
                    l = r ? "prevMonthDay hidden" : "prevMonthDay",
                    c = r ? "nextMonthDay hidden" : "nextMonthDay",
                    s = a + 1 - t,
                    u = 0;
                s <= a;
                s++, u++
            )
                o.appendChild(
                    R("flatpickr-day " + l, new Date(e, n - 1, s), 0, u)
                );
            for (s = 1; s <= i; s++, u++)
                o.appendChild(R("flatpickr-day", new Date(e, n, s), 0, u));
            for (
                var f = i + 1;
                f <= 42 - t && (1 === w.config.showMonths || u % 7 != 0);
                f++, u++
            )
                o.appendChild(
                    R("flatpickr-day " + c, new Date(e, n + 1, f % i), 0, u)
                );
            var m = d("div", "dayContainer");
            return m.appendChild(o), m;
        }
        function U() {
            if (void 0 !== w.daysContainer) {
                u(w.daysContainer), w.weekNumbers && u(w.weekNumbers);
                for (
                    var e = document.createDocumentFragment(), n = 0;
                    n < w.config.showMonths;
                    n++
                ) {
                    var t = new Date(w.currentYear, w.currentMonth, 1);
                    t.setMonth(w.currentMonth + n),
                        e.appendChild(K(t.getFullYear(), t.getMonth()));
                }
                w.daysContainer.appendChild(e),
                    (w.days = w.daysContainer.firstChild),
                    "range" === w.config.mode &&
                        1 === w.selectedDates.length &&
                        oe();
            }
        }
        function q() {
            if (
                !(
                    w.config.showMonths > 1 ||
                    "dropdown" !== w.config.monthSelectorType
                )
            ) {
                var e = function (e) {
                    return (
                        !(
                            void 0 !== w.config.minDate &&
                            w.currentYear === w.config.minDate.getFullYear() &&
                            e < w.config.minDate.getMonth()
                        ) &&
                        !(
                            void 0 !== w.config.maxDate &&
                            w.currentYear === w.config.maxDate.getFullYear() &&
                            e > w.config.maxDate.getMonth()
                        )
                    );
                };
                (w.monthsDropdownContainer.tabIndex = -1),
                    (w.monthsDropdownContainer.innerHTML = "");
                for (var n = 0; n < 12; n++)
                    if (e(n)) {
                        var t = d("option", "flatpickr-monthDropdown-month");
                        (t.value = new Date(w.currentYear, n)
                            .getMonth()
                            .toString()),
                            (t.textContent = h(
                                n,
                                w.config.shorthandCurrentMonth,
                                w.l10n
                            )),
                            (t.tabIndex = -1),
                            w.currentMonth === n && (t.selected = !0),
                            w.monthsDropdownContainer.appendChild(t);
                    }
            }
        }
        function $() {
            var e,
                n = d("div", "flatpickr-month"),
                t = window.document.createDocumentFragment();
            w.config.showMonths > 1 || "static" === w.config.monthSelectorType
                ? (e = d("span", "cur-month"))
                : ((w.monthsDropdownContainer = d(
                      "select",
                      "flatpickr-monthDropdown-months"
                  )),
                  w.monthsDropdownContainer.setAttribute(
                      "aria-label",
                      w.l10n.monthAriaLabel
                  ),
                  P(w.monthsDropdownContainer, "change", function (e) {
                      var n = g(e),
                          t = parseInt(n.value, 10);
                      w.changeMonth(t - w.currentMonth), De("onMonthChange");
                  }),
                  q(),
                  (e = w.monthsDropdownContainer));
            var a = m("cur-year", { tabindex: "-1" }),
                i = a.getElementsByTagName("input")[0];
            i.setAttribute("aria-label", w.l10n.yearAriaLabel),
                w.config.minDate &&
                    i.setAttribute(
                        "min",
                        w.config.minDate.getFullYear().toString()
                    ),
                w.config.maxDate &&
                    (i.setAttribute(
                        "max",
                        w.config.maxDate.getFullYear().toString()
                    ),
                    (i.disabled =
                        !!w.config.minDate &&
                        w.config.minDate.getFullYear() ===
                            w.config.maxDate.getFullYear()));
            var o = d("div", "flatpickr-current-month");
            return (
                o.appendChild(e),
                o.appendChild(a),
                t.appendChild(o),
                n.appendChild(t),
                { container: n, yearElement: i, monthElement: e }
            );
        }
        function V() {
            u(w.monthNav),
                w.monthNav.appendChild(w.prevMonthNav),
                w.config.showMonths &&
                    ((w.yearElements = []), (w.monthElements = []));
            for (var e = w.config.showMonths; e--; ) {
                var n = $();
                w.yearElements.push(n.yearElement),
                    w.monthElements.push(n.monthElement),
                    w.monthNav.appendChild(n.container);
            }
            w.monthNav.appendChild(w.nextMonthNav);
        }
        function z() {
            w.weekdayContainer
                ? u(w.weekdayContainer)
                : (w.weekdayContainer = d("div", "flatpickr-weekdays"));
            for (var e = w.config.showMonths; e--; ) {
                var n = d("div", "flatpickr-weekdaycontainer");
                w.weekdayContainer.appendChild(n);
            }
            return G(), w.weekdayContainer;
        }
        function G() {
            if (w.weekdayContainer) {
                var e = w.l10n.firstDayOfWeek,
                    t = n(w.l10n.weekdays.shorthand);
                e > 0 &&
                    e < t.length &&
                    (t = n(t.splice(e, t.length), t.splice(0, e)));
                for (var a = w.config.showMonths; a--; )
                    w.weekdayContainer.children[a].innerHTML =
                        "\n      <span class='flatpickr-weekday'>\n        " +
                        t.join("</span><span class='flatpickr-weekday'>") +
                        "\n      </span>\n      ";
            }
        }
        function Z(e, n) {
            void 0 === n && (n = !0);
            var t = n ? e : e - w.currentMonth;
            (t < 0 && !0 === w._hidePrevMonthArrow) ||
                (t > 0 && !0 === w._hideNextMonthArrow) ||
                ((w.currentMonth += t),
                (w.currentMonth < 0 || w.currentMonth > 11) &&
                    ((w.currentYear += w.currentMonth > 11 ? 1 : -1),
                    (w.currentMonth = (w.currentMonth + 12) % 12),
                    De("onYearChange"),
                    q()),
                U(),
                De("onMonthChange"),
                Ce());
        }
        function Q(e) {
            return w.calendarContainer.contains(e);
        }
        function X(e) {
            if (w.isOpen && !w.config.inline) {
                var n = g(e),
                    t = Q(n),
                    a =
                        !(
                            n === w.input ||
                            n === w.altInput ||
                            w.element.contains(n) ||
                            (e.path &&
                                e.path.indexOf &&
                                (~e.path.indexOf(w.input) ||
                                    ~e.path.indexOf(w.altInput)))
                        ) &&
                        !t &&
                        !Q(e.relatedTarget),
                    i = !w.config.ignoredFocusElements.some(function (e) {
                        return e.contains(n);
                    });
                a &&
                    i &&
                    (w.config.allowInput &&
                        w.setDate(
                            w._input.value,
                            !1,
                            w.config.altInput
                                ? w.config.altFormat
                                : w.config.dateFormat
                        ),
                    void 0 !== w.timeContainer &&
                        void 0 !== w.minuteElement &&
                        void 0 !== w.hourElement &&
                        "" !== w.input.value &&
                        void 0 !== w.input.value &&
                        _(),
                    w.close(),
                    w.config &&
                        "range" === w.config.mode &&
                        1 === w.selectedDates.length &&
                        w.clear(!1));
            }
        }
        function ee(e) {
            if (
                !(
                    !e ||
                    (w.config.minDate && e < w.config.minDate.getFullYear()) ||
                    (w.config.maxDate && e > w.config.maxDate.getFullYear())
                )
            ) {
                var n = e,
                    t = w.currentYear !== n;
                (w.currentYear = n || w.currentYear),
                    w.config.maxDate &&
                    w.currentYear === w.config.maxDate.getFullYear()
                        ? (w.currentMonth = Math.min(
                              w.config.maxDate.getMonth(),
                              w.currentMonth
                          ))
                        : w.config.minDate &&
                          w.currentYear === w.config.minDate.getFullYear() &&
                          (w.currentMonth = Math.max(
                              w.config.minDate.getMonth(),
                              w.currentMonth
                          )),
                    t && (w.redraw(), De("onYearChange"), q());
            }
        }
        function ne(e, n) {
            var t;
            void 0 === n && (n = !0);
            var a = w.parseDate(e, void 0, n);
            if (
                (w.config.minDate &&
                    a &&
                    M(
                        a,
                        w.config.minDate,
                        void 0 !== n ? n : !w.minDateHasTime
                    ) < 0) ||
                (w.config.maxDate &&
                    a &&
                    M(
                        a,
                        w.config.maxDate,
                        void 0 !== n ? n : !w.maxDateHasTime
                    ) > 0)
            )
                return !1;
            if (!w.config.enable && 0 === w.config.disable.length) return !0;
            if (void 0 === a) return !1;
            for (
                var i = !!w.config.enable,
                    o =
                        null !== (t = w.config.enable) && void 0 !== t
                            ? t
                            : w.config.disable,
                    r = 0,
                    l = void 0;
                r < o.length;
                r++
            ) {
                if ("function" == typeof (l = o[r]) && l(a)) return i;
                if (
                    l instanceof Date &&
                    void 0 !== a &&
                    l.getTime() === a.getTime()
                )
                    return i;
                if ("string" == typeof l) {
                    var c = w.parseDate(l, void 0, !0);
                    return c && c.getTime() === a.getTime() ? i : !i;
                }
                if (
                    "object" == typeof l &&
                    void 0 !== a &&
                    l.from &&
                    l.to &&
                    a.getTime() >= l.from.getTime() &&
                    a.getTime() <= l.to.getTime()
                )
                    return i;
            }
            return !i;
        }
        function te(e) {
            return (
                void 0 !== w.daysContainer &&
                -1 === e.className.indexOf("hidden") &&
                -1 === e.className.indexOf("flatpickr-disabled") &&
                w.daysContainer.contains(e)
            );
        }
        function ae(e) {
            var n = e.target === w._input,
                t = w._input.value.trimEnd() !== Me();
            !n ||
                !t ||
                (e.relatedTarget && Q(e.relatedTarget)) ||
                w.setDate(
                    w._input.value,
                    !0,
                    e.target === w.altInput
                        ? w.config.altFormat
                        : w.config.dateFormat
                );
        }
        function ie(e) {
            var n = g(e),
                t = w.config.wrap ? p.contains(n) : n === w._input,
                a = w.config.allowInput,
                i = w.isOpen && (!a || !t),
                o = w.config.inline && t && !a;
            if (13 === e.keyCode && t) {
                if (a)
                    return (
                        w.setDate(
                            w._input.value,
                            !0,
                            n === w.altInput
                                ? w.config.altFormat
                                : w.config.dateFormat
                        ),
                        w.close(),
                        n.blur()
                    );
                w.open();
            } else if (Q(n) || i || o) {
                var r = !!w.timeContainer && w.timeContainer.contains(n);
                switch (e.keyCode) {
                    case 13:
                        r ? (e.preventDefault(), _(), fe()) : me(e);
                        break;
                    case 27:
                        e.preventDefault(), fe();
                        break;
                    case 8:
                    case 46:
                        t &&
                            !w.config.allowInput &&
                            (e.preventDefault(), w.clear());
                        break;
                    case 37:
                    case 39:
                        if (r || t) w.hourElement && w.hourElement.focus();
                        else {
                            e.preventDefault();
                            var l = k();
                            if (
                                void 0 !== w.daysContainer &&
                                (!1 === a || (l && te(l)))
                            ) {
                                var c = 39 === e.keyCode ? 1 : -1;
                                e.ctrlKey
                                    ? (e.stopPropagation(), Z(c), J(B(1), 0))
                                    : J(void 0, c);
                            }
                        }
                        break;
                    case 38:
                    case 40:
                        e.preventDefault();
                        var s = 40 === e.keyCode ? 1 : -1;
                        (w.daysContainer && void 0 !== n.$i) ||
                        n === w.input ||
                        n === w.altInput
                            ? e.ctrlKey
                                ? (e.stopPropagation(),
                                  ee(w.currentYear - s),
                                  J(B(1), 0))
                                : r || J(void 0, 7 * s)
                            : n === w.currentYearElement
                            ? ee(w.currentYear - s)
                            : w.config.enableTime &&
                              (!r && w.hourElement && w.hourElement.focus(),
                              _(e),
                              w._debouncedChange());
                        break;
                    case 9:
                        if (r) {
                            var d = [
                                    w.hourElement,
                                    w.minuteElement,
                                    w.secondElement,
                                    w.amPM,
                                ]
                                    .concat(w.pluginElements)
                                    .filter(function (e) {
                                        return e;
                                    }),
                                u = d.indexOf(n);
                            if (-1 !== u) {
                                var f = d[u + (e.shiftKey ? -1 : 1)];
                                e.preventDefault(), (f || w._input).focus();
                            }
                        } else
                            !w.config.noCalendar &&
                                w.daysContainer &&
                                w.daysContainer.contains(n) &&
                                e.shiftKey &&
                                (e.preventDefault(), w._input.focus());
                }
            }
            if (void 0 !== w.amPM && n === w.amPM)
                switch (e.key) {
                    case w.l10n.amPM[0].charAt(0):
                    case w.l10n.amPM[0].charAt(0).toLowerCase():
                        (w.amPM.textContent = w.l10n.amPM[0]), O(), ye();
                        break;
                    case w.l10n.amPM[1].charAt(0):
                    case w.l10n.amPM[1].charAt(0).toLowerCase():
                        (w.amPM.textContent = w.l10n.amPM[1]), O(), ye();
                }
            (t || Q(n)) && De("onKeyDown", e);
        }
        function oe(e, n) {
            if (
                (void 0 === n && (n = "flatpickr-day"),
                1 === w.selectedDates.length &&
                    (!e ||
                        (e.classList.contains(n) &&
                            !e.classList.contains("flatpickr-disabled"))))
            ) {
                for (
                    var t = e
                            ? e.dateObj.getTime()
                            : w.days.firstElementChild.dateObj.getTime(),
                        a = w
                            .parseDate(w.selectedDates[0], void 0, !0)
                            .getTime(),
                        i = Math.min(t, w.selectedDates[0].getTime()),
                        o = Math.max(t, w.selectedDates[0].getTime()),
                        r = !1,
                        l = 0,
                        c = 0,
                        s = i;
                    s < o;
                    s += x
                )
                    ne(new Date(s), !0) ||
                        ((r = r || (s > i && s < o)),
                        s < a && (!l || s > l)
                            ? (l = s)
                            : s > a && (!c || s < c) && (c = s));
                Array.from(
                    w.rContainer.querySelectorAll(
                        "*:nth-child(-n+" + w.config.showMonths + ") > ." + n
                    )
                ).forEach(function (n) {
                    var i,
                        o,
                        s,
                        d = n.dateObj.getTime(),
                        u = (l > 0 && d < l) || (c > 0 && d > c);
                    if (u)
                        return (
                            n.classList.add("notAllowed"),
                            void ["inRange", "startRange", "endRange"].forEach(
                                function (e) {
                                    n.classList.remove(e);
                                }
                            )
                        );
                    (r && !u) ||
                        ([
                            "startRange",
                            "inRange",
                            "endRange",
                            "notAllowed",
                        ].forEach(function (e) {
                            n.classList.remove(e);
                        }),
                        void 0 !== e &&
                            (e.classList.add(
                                t <= w.selectedDates[0].getTime()
                                    ? "startRange"
                                    : "endRange"
                            ),
                            a < t && d === a
                                ? n.classList.add("startRange")
                                : a > t &&
                                  d === a &&
                                  n.classList.add("endRange"),
                            d >= l &&
                                (0 === c || d <= c) &&
                                ((o = a),
                                (s = t),
                                (i = d) > Math.min(o, s) &&
                                    i < Math.max(o, s)) &&
                                n.classList.add("inRange")));
                });
            }
        }
        function re() {
            !w.isOpen || w.config.static || w.config.inline || de();
        }
        function le(e) {
            return function (n) {
                var t = (w.config["_" + e + "Date"] = w.parseDate(
                        n,
                        w.config.dateFormat
                    )),
                    a = w.config["_" + ("min" === e ? "max" : "min") + "Date"];
                void 0 !== t &&
                    (w["min" === e ? "minDateHasTime" : "maxDateHasTime"] =
                        t.getHours() > 0 ||
                        t.getMinutes() > 0 ||
                        t.getSeconds() > 0),
                    w.selectedDates &&
                        ((w.selectedDates = w.selectedDates.filter(function (
                            e
                        ) {
                            return ne(e);
                        })),
                        w.selectedDates.length || "min" !== e || F(t),
                        ye()),
                    w.daysContainer &&
                        (ue(),
                        void 0 !== t
                            ? (w.currentYearElement[e] = t
                                  .getFullYear()
                                  .toString())
                            : w.currentYearElement.removeAttribute(e),
                        (w.currentYearElement.disabled =
                            !!a &&
                            void 0 !== t &&
                            a.getFullYear() === t.getFullYear()));
            };
        }
        function ce() {
            return w.config.wrap ? p.querySelector("[data-input]") : p;
        }
        function se() {
            "object" != typeof w.config.locale &&
                void 0 === I.l10ns[w.config.locale] &&
                w.config.errorHandler(
                    new Error("flatpickr: invalid locale " + w.config.locale)
                ),
                (w.l10n = e(
                    e({}, I.l10ns.default),
                    "object" == typeof w.config.locale
                        ? w.config.locale
                        : "default" !== w.config.locale
                        ? I.l10ns[w.config.locale]
                        : void 0
                )),
                (D.D = "(" + w.l10n.weekdays.shorthand.join("|") + ")"),
                (D.l = "(" + w.l10n.weekdays.longhand.join("|") + ")"),
                (D.M = "(" + w.l10n.months.shorthand.join("|") + ")"),
                (D.F = "(" + w.l10n.months.longhand.join("|") + ")"),
                (D.K =
                    "(" +
                    w.l10n.amPM[0] +
                    "|" +
                    w.l10n.amPM[1] +
                    "|" +
                    w.l10n.amPM[0].toLowerCase() +
                    "|" +
                    w.l10n.amPM[1].toLowerCase() +
                    ")"),
                void 0 ===
                    e(e({}, v), JSON.parse(JSON.stringify(p.dataset || {})))
                        .time_24hr &&
                    void 0 === I.defaultConfig.time_24hr &&
                    (w.config.time_24hr = w.l10n.time_24hr),
                (w.formatDate = b(w)),
                (w.parseDate = C({ config: w.config, l10n: w.l10n }));
        }
        function de(e) {
            if ("function" != typeof w.config.position) {
                if (void 0 !== w.calendarContainer) {
                    De("onPreCalendarPosition");
                    var n = e || w._positionElement,
                        t = Array.prototype.reduce.call(
                            w.calendarContainer.children,
                            function (e, n) {
                                return e + n.offsetHeight;
                            },
                            0
                        ),
                        a = w.calendarContainer.offsetWidth,
                        i = w.config.position.split(" "),
                        o = i[0],
                        r = i.length > 1 ? i[1] : null,
                        l = n.getBoundingClientRect(),
                        c = window.innerHeight - l.bottom,
                        d =
                            "above" === o ||
                            ("below" !== o && c < t && l.top > t),
                        u =
                            window.pageYOffset +
                            l.top +
                            (d ? -t - 2 : n.offsetHeight + 2);
                    if (
                        (s(w.calendarContainer, "arrowTop", !d),
                        s(w.calendarContainer, "arrowBottom", d),
                        !w.config.inline)
                    ) {
                        var f = window.pageXOffset + l.left,
                            m = !1,
                            g = !1;
                        "center" === r
                            ? ((f -= (a - l.width) / 2), (m = !0))
                            : "right" === r && ((f -= a - l.width), (g = !0)),
                            s(w.calendarContainer, "arrowLeft", !m && !g),
                            s(w.calendarContainer, "arrowCenter", m),
                            s(w.calendarContainer, "arrowRight", g);
                        var p =
                                window.document.body.offsetWidth -
                                (window.pageXOffset + l.right),
                            h = f + a > window.document.body.offsetWidth,
                            v = p + a > window.document.body.offsetWidth;
                        if (
                            (s(w.calendarContainer, "rightMost", h),
                            !w.config.static)
                        )
                            if (((w.calendarContainer.style.top = u + "px"), h))
                                if (v) {
                                    var D = (function () {
                                        for (
                                            var e = null, n = 0;
                                            n < document.styleSheets.length;
                                            n++
                                        ) {
                                            var t = document.styleSheets[n];
                                            if (t.cssRules) {
                                                try {
                                                    t.cssRules;
                                                } catch (e) {
                                                    continue;
                                                }
                                                e = t;
                                                break;
                                            }
                                        }
                                        return null != e
                                            ? e
                                            : ((a =
                                                  document.createElement(
                                                      "style"
                                                  )),
                                              document.head.appendChild(a),
                                              a.sheet);
                                        var a;
                                    })();
                                    if (void 0 === D) return;
                                    var b = window.document.body.offsetWidth,
                                        C = Math.max(0, b / 2 - a / 2),
                                        M = D.cssRules.length,
                                        y =
                                            "{left:" +
                                            l.left +
                                            "px;right:auto;}";
                                    s(w.calendarContainer, "rightMost", !1),
                                        s(
                                            w.calendarContainer,
                                            "centerMost",
                                            !0
                                        ),
                                        D.insertRule(
                                            ".flatpickr-calendar.centerMost:before,.flatpickr-calendar.centerMost:after" +
                                                y,
                                            M
                                        ),
                                        (w.calendarContainer.style.left =
                                            C + "px"),
                                        (w.calendarContainer.style.right =
                                            "auto");
                                } else
                                    (w.calendarContainer.style.left = "auto"),
                                        (w.calendarContainer.style.right =
                                            p + "px");
                            else
                                (w.calendarContainer.style.left = f + "px"),
                                    (w.calendarContainer.style.right = "auto");
                    }
                }
            } else w.config.position(w, e);
        }
        function ue() {
            w.config.noCalendar || w.isMobile || (q(), Ce(), U());
        }
        function fe() {
            w._input.focus(),
                -1 !== window.navigator.userAgent.indexOf("MSIE") ||
                void 0 !== navigator.msMaxTouchPoints
                    ? setTimeout(w.close, 0)
                    : w.close();
        }
        function me(e) {
            e.preventDefault(), e.stopPropagation();
            var n = f(g(e), function (e) {
                return (
                    e.classList &&
                    e.classList.contains("flatpickr-day") &&
                    !e.classList.contains("flatpickr-disabled") &&
                    !e.classList.contains("notAllowed")
                );
            });
            if (void 0 !== n) {
                var t = n,
                    a = (w.latestSelectedDateObj = new Date(
                        t.dateObj.getTime()
                    )),
                    i =
                        (a.getMonth() < w.currentMonth ||
                            a.getMonth() >
                                w.currentMonth + w.config.showMonths - 1) &&
                        "range" !== w.config.mode;
                if (((w.selectedDateElem = t), "single" === w.config.mode))
                    w.selectedDates = [a];
                else if ("multiple" === w.config.mode) {
                    var o = be(a);
                    o
                        ? w.selectedDates.splice(parseInt(o), 1)
                        : w.selectedDates.push(a);
                } else
                    "range" === w.config.mode &&
                        (2 === w.selectedDates.length && w.clear(!1, !1),
                        (w.latestSelectedDateObj = a),
                        w.selectedDates.push(a),
                        0 !== M(a, w.selectedDates[0], !0) &&
                            w.selectedDates.sort(function (e, n) {
                                return e.getTime() - n.getTime();
                            }));
                if ((O(), i)) {
                    var r = w.currentYear !== a.getFullYear();
                    (w.currentYear = a.getFullYear()),
                        (w.currentMonth = a.getMonth()),
                        r && (De("onYearChange"), q()),
                        De("onMonthChange");
                }
                if (
                    (Ce(),
                    U(),
                    ye(),
                    i || "range" === w.config.mode || 1 !== w.config.showMonths
                        ? void 0 !== w.selectedDateElem &&
                          void 0 === w.hourElement &&
                          w.selectedDateElem &&
                          w.selectedDateElem.focus()
                        : W(t),
                    void 0 !== w.hourElement &&
                        void 0 !== w.hourElement &&
                        w.hourElement.focus(),
                    w.config.closeOnSelect)
                ) {
                    var l = "single" === w.config.mode && !w.config.enableTime,
                        c =
                            "range" === w.config.mode &&
                            2 === w.selectedDates.length &&
                            !w.config.enableTime;
                    (l || c) && fe();
                }
                Y();
            }
        }
        (w.parseDate = C({ config: w.config, l10n: w.l10n })),
            (w._handlers = []),
            (w.pluginElements = []),
            (w.loadedPlugins = []),
            (w._bind = P),
            (w._setHoursFromDate = F),
            (w._positionCalendar = de),
            (w.changeMonth = Z),
            (w.changeYear = ee),
            (w.clear = function (e, n) {
                void 0 === e && (e = !0);
                void 0 === n && (n = !0);
                (w.input.value = ""),
                    void 0 !== w.altInput && (w.altInput.value = "");
                void 0 !== w.mobileInput && (w.mobileInput.value = "");
                (w.selectedDates = []),
                    (w.latestSelectedDateObj = void 0),
                    !0 === n &&
                        ((w.currentYear = w._initialDate.getFullYear()),
                        (w.currentMonth = w._initialDate.getMonth()));
                if (!0 === w.config.enableTime) {
                    var t = E(w.config),
                        a = t.hours,
                        i = t.minutes,
                        o = t.seconds;
                    A(a, i, o);
                }
                w.redraw(), e && De("onChange");
            }),
            (w.close = function () {
                (w.isOpen = !1),
                    w.isMobile ||
                        (void 0 !== w.calendarContainer &&
                            w.calendarContainer.classList.remove("open"),
                        void 0 !== w._input &&
                            w._input.classList.remove("active"));
                De("onClose");
            }),
            (w.onMouseOver = oe),
            (w._createElement = d),
            (w.createDay = R),
            (w.destroy = function () {
                void 0 !== w.config && De("onDestroy");
                for (var e = w._handlers.length; e--; ) w._handlers[e].remove();
                if (((w._handlers = []), w.mobileInput))
                    w.mobileInput.parentNode &&
                        w.mobileInput.parentNode.removeChild(w.mobileInput),
                        (w.mobileInput = void 0);
                else if (w.calendarContainer && w.calendarContainer.parentNode)
                    if (w.config.static && w.calendarContainer.parentNode) {
                        var n = w.calendarContainer.parentNode;
                        if (
                            (n.lastChild && n.removeChild(n.lastChild),
                            n.parentNode)
                        ) {
                            for (; n.firstChild; )
                                n.parentNode.insertBefore(n.firstChild, n);
                            n.parentNode.removeChild(n);
                        }
                    } else
                        w.calendarContainer.parentNode.removeChild(
                            w.calendarContainer
                        );
                w.altInput &&
                    ((w.input.type = "text"),
                    w.altInput.parentNode &&
                        w.altInput.parentNode.removeChild(w.altInput),
                    delete w.altInput);
                w.input &&
                    ((w.input.type = w.input._type),
                    w.input.classList.remove("flatpickr-input"),
                    w.input.removeAttribute("readonly"));
                [
                    "_showTimeInput",
                    "latestSelectedDateObj",
                    "_hideNextMonthArrow",
                    "_hidePrevMonthArrow",
                    "__hideNextMonthArrow",
                    "__hidePrevMonthArrow",
                    "isMobile",
                    "isOpen",
                    "selectedDateElem",
                    "minDateHasTime",
                    "maxDateHasTime",
                    "days",
                    "daysContainer",
                    "_input",
                    "_positionElement",
                    "innerContainer",
                    "rContainer",
                    "monthNav",
                    "todayDateElem",
                    "calendarContainer",
                    "weekdayContainer",
                    "prevMonthNav",
                    "nextMonthNav",
                    "monthsDropdownContainer",
                    "currentMonthElement",
                    "currentYearElement",
                    "navigationCurrentMonth",
                    "selectedDateElem",
                    "config",
                ].forEach(function (e) {
                    try {
                        delete w[e];
                    } catch (e) {}
                });
            }),
            (w.isEnabled = ne),
            (w.jumpToDate = j),
            (w.updateValue = ye),
            (w.open = function (e, n) {
                void 0 === n && (n = w._positionElement);
                if (!0 === w.isMobile) {
                    if (e) {
                        e.preventDefault();
                        var t = g(e);
                        t && t.blur();
                    }
                    return (
                        void 0 !== w.mobileInput &&
                            (w.mobileInput.focus(), w.mobileInput.click()),
                        void De("onOpen")
                    );
                }
                if (w._input.disabled || w.config.inline) return;
                var a = w.isOpen;
                (w.isOpen = !0),
                    a ||
                        (w.calendarContainer.classList.add("open"),
                        w._input.classList.add("active"),
                        De("onOpen"),
                        de(n));
                !0 === w.config.enableTime &&
                    !0 === w.config.noCalendar &&
                    (!1 !== w.config.allowInput ||
                        (void 0 !== e &&
                            w.timeContainer.contains(e.relatedTarget)) ||
                        setTimeout(function () {
                            return w.hourElement.select();
                        }, 50));
            }),
            (w.redraw = ue),
            (w.set = function (e, n) {
                if (null !== e && "object" == typeof e)
                    for (var a in (Object.assign(w.config, e), e))
                        void 0 !== ge[a] &&
                            ge[a].forEach(function (e) {
                                return e();
                            });
                else
                    (w.config[e] = n),
                        void 0 !== ge[e]
                            ? ge[e].forEach(function (e) {
                                  return e();
                              })
                            : t.indexOf(e) > -1 && (w.config[e] = c(n));
                w.redraw(), ye(!0);
            }),
            (w.setDate = function (e, n, t) {
                void 0 === n && (n = !1);
                void 0 === t && (t = w.config.dateFormat);
                if ((0 !== e && !e) || (e instanceof Array && 0 === e.length))
                    return w.clear(n);
                pe(e, t),
                    (w.latestSelectedDateObj =
                        w.selectedDates[w.selectedDates.length - 1]),
                    w.redraw(),
                    j(void 0, n),
                    F(),
                    0 === w.selectedDates.length && w.clear(!1);
                ye(n), n && De("onChange");
            }),
            (w.toggle = function (e) {
                if (!0 === w.isOpen) return w.close();
                w.open(e);
            });
        var ge = {
            locale: [se, G],
            showMonths: [V, S, z],
            minDate: [j],
            maxDate: [j],
            positionElement: [ve],
            clickOpens: [
                function () {
                    !0 === w.config.clickOpens
                        ? (P(w._input, "focus", w.open),
                          P(w._input, "click", w.open))
                        : (w._input.removeEventListener("focus", w.open),
                          w._input.removeEventListener("click", w.open));
                },
            ],
        };
        function pe(e, n) {
            var t = [];
            if (e instanceof Array)
                t = e.map(function (e) {
                    return w.parseDate(e, n);
                });
            else if (e instanceof Date || "number" == typeof e)
                t = [w.parseDate(e, n)];
            else if ("string" == typeof e)
                switch (w.config.mode) {
                    case "single":
                    case "time":
                        t = [w.parseDate(e, n)];
                        break;
                    case "multiple":
                        t = e.split(w.config.conjunction).map(function (e) {
                            return w.parseDate(e, n);
                        });
                        break;
                    case "range":
                        t = e.split(w.l10n.rangeSeparator).map(function (e) {
                            return w.parseDate(e, n);
                        });
                }
            else
                w.config.errorHandler(
                    new Error("Invalid date supplied: " + JSON.stringify(e))
                );
            (w.selectedDates = w.config.allowInvalidPreload
                ? t
                : t.filter(function (e) {
                      return e instanceof Date && ne(e, !1);
                  })),
                "range" === w.config.mode &&
                    w.selectedDates.sort(function (e, n) {
                        return e.getTime() - n.getTime();
                    });
        }
        function he(e) {
            return e
                .slice()
                .map(function (e) {
                    return "string" == typeof e ||
                        "number" == typeof e ||
                        e instanceof Date
                        ? w.parseDate(e, void 0, !0)
                        : e && "object" == typeof e && e.from && e.to
                        ? {
                              from: w.parseDate(e.from, void 0),
                              to: w.parseDate(e.to, void 0),
                          }
                        : e;
                })
                .filter(function (e) {
                    return e;
                });
        }
        function ve() {
            w._positionElement = w.config.positionElement || w._input;
        }
        function De(e, n) {
            if (void 0 !== w.config) {
                var t = w.config[e];
                if (void 0 !== t && t.length > 0)
                    for (var a = 0; t[a] && a < t.length; a++)
                        t[a](w.selectedDates, w.input.value, w, n);
                "onChange" === e &&
                    (w.input.dispatchEvent(we("change")),
                    w.input.dispatchEvent(we("input")));
            }
        }
        function we(e) {
            var n = document.createEvent("Event");
            return n.initEvent(e, !0, !0), n;
        }
        function be(e) {
            for (var n = 0; n < w.selectedDates.length; n++) {
                var t = w.selectedDates[n];
                if (t instanceof Date && 0 === M(t, e)) return "" + n;
            }
            return !1;
        }
        function Ce() {
            w.config.noCalendar ||
                w.isMobile ||
                !w.monthNav ||
                (w.yearElements.forEach(function (e, n) {
                    var t = new Date(w.currentYear, w.currentMonth, 1);
                    t.setMonth(w.currentMonth + n),
                        w.config.showMonths > 1 ||
                        "static" === w.config.monthSelectorType
                            ? (w.monthElements[n].textContent =
                                  h(
                                      t.getMonth(),
                                      w.config.shorthandCurrentMonth,
                                      w.l10n
                                  ) + " ")
                            : (w.monthsDropdownContainer.value = t
                                  .getMonth()
                                  .toString()),
                        (e.value = t.getFullYear().toString());
                }),
                (w._hidePrevMonthArrow =
                    void 0 !== w.config.minDate &&
                    (w.currentYear === w.config.minDate.getFullYear()
                        ? w.currentMonth <= w.config.minDate.getMonth()
                        : w.currentYear < w.config.minDate.getFullYear())),
                (w._hideNextMonthArrow =
                    void 0 !== w.config.maxDate &&
                    (w.currentYear === w.config.maxDate.getFullYear()
                        ? w.currentMonth + 1 > w.config.maxDate.getMonth()
                        : w.currentYear > w.config.maxDate.getFullYear())));
        }
        function Me(e) {
            var n =
                e ||
                (w.config.altInput ? w.config.altFormat : w.config.dateFormat);
            return w.selectedDates
                .map(function (e) {
                    return w.formatDate(e, n);
                })
                .filter(function (e, n, t) {
                    return (
                        "range" !== w.config.mode ||
                        w.config.enableTime ||
                        t.indexOf(e) === n
                    );
                })
                .join(
                    "range" !== w.config.mode
                        ? w.config.conjunction
                        : w.l10n.rangeSeparator
                );
        }
        function ye(e) {
            void 0 === e && (e = !0),
                void 0 !== w.mobileInput &&
                    w.mobileFormatStr &&
                    (w.mobileInput.value =
                        void 0 !== w.latestSelectedDateObj
                            ? w.formatDate(
                                  w.latestSelectedDateObj,
                                  w.mobileFormatStr
                              )
                            : ""),
                (w.input.value = Me(w.config.dateFormat)),
                void 0 !== w.altInput &&
                    (w.altInput.value = Me(w.config.altFormat)),
                !1 !== e && De("onValueUpdate");
        }
        function xe(e) {
            var n = g(e),
                t = w.prevMonthNav.contains(n),
                a = w.nextMonthNav.contains(n);
            t || a
                ? Z(t ? -1 : 1)
                : w.yearElements.indexOf(n) >= 0
                ? n.select()
                : n.classList.contains("arrowUp")
                ? w.changeYear(w.currentYear + 1)
                : n.classList.contains("arrowDown") &&
                  w.changeYear(w.currentYear - 1);
        }
        return (
            (function () {
                (w.element = w.input = p),
                    (w.isOpen = !1),
                    (function () {
                        var n = [
                                "wrap",
                                "weekNumbers",
                                "allowInput",
                                "allowInvalidPreload",
                                "clickOpens",
                                "time_24hr",
                                "enableTime",
                                "noCalendar",
                                "altInput",
                                "shorthandCurrentMonth",
                                "inline",
                                "static",
                                "enableSeconds",
                                "disableMobile",
                            ],
                            i = e(
                                e(
                                    {},
                                    JSON.parse(JSON.stringify(p.dataset || {}))
                                ),
                                v
                            ),
                            o = {};
                        (w.config.parseDate = i.parseDate),
                            (w.config.formatDate = i.formatDate),
                            Object.defineProperty(w.config, "enable", {
                                get: function () {
                                    return w.config._enable;
                                },
                                set: function (e) {
                                    w.config._enable = he(e);
                                },
                            }),
                            Object.defineProperty(w.config, "disable", {
                                get: function () {
                                    return w.config._disable;
                                },
                                set: function (e) {
                                    w.config._disable = he(e);
                                },
                            });
                        var r = "time" === i.mode;
                        if (!i.dateFormat && (i.enableTime || r)) {
                            var l = I.defaultConfig.dateFormat || a.dateFormat;
                            o.dateFormat =
                                i.noCalendar || r
                                    ? "H:i" + (i.enableSeconds ? ":S" : "")
                                    : l +
                                      " H:i" +
                                      (i.enableSeconds ? ":S" : "");
                        }
                        if (i.altInput && (i.enableTime || r) && !i.altFormat) {
                            var s = I.defaultConfig.altFormat || a.altFormat;
                            o.altFormat =
                                i.noCalendar || r
                                    ? "h:i" + (i.enableSeconds ? ":S K" : " K")
                                    : s +
                                      " h:i" +
                                      (i.enableSeconds ? ":S" : "") +
                                      " K";
                        }
                        Object.defineProperty(w.config, "minDate", {
                            get: function () {
                                return w.config._minDate;
                            },
                            set: le("min"),
                        }),
                            Object.defineProperty(w.config, "maxDate", {
                                get: function () {
                                    return w.config._maxDate;
                                },
                                set: le("max"),
                            });
                        var d = function (e) {
                            return function (n) {
                                w.config[
                                    "min" === e ? "_minTime" : "_maxTime"
                                ] = w.parseDate(n, "H:i:S");
                            };
                        };
                        Object.defineProperty(w.config, "minTime", {
                            get: function () {
                                return w.config._minTime;
                            },
                            set: d("min"),
                        }),
                            Object.defineProperty(w.config, "maxTime", {
                                get: function () {
                                    return w.config._maxTime;
                                },
                                set: d("max"),
                            }),
                            "time" === i.mode &&
                                ((w.config.noCalendar = !0),
                                (w.config.enableTime = !0));
                        Object.assign(w.config, o, i);
                        for (var u = 0; u < n.length; u++)
                            w.config[n[u]] =
                                !0 === w.config[n[u]] ||
                                "true" === w.config[n[u]];
                        t
                            .filter(function (e) {
                                return void 0 !== w.config[e];
                            })
                            .forEach(function (e) {
                                w.config[e] = c(w.config[e] || []).map(T);
                            }),
                            (w.isMobile =
                                !w.config.disableMobile &&
                                !w.config.inline &&
                                "single" === w.config.mode &&
                                !w.config.disable.length &&
                                !w.config.enable &&
                                !w.config.weekNumbers &&
                                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                                    navigator.userAgent
                                ));
                        for (u = 0; u < w.config.plugins.length; u++) {
                            var f = w.config.plugins[u](w) || {};
                            for (var m in f)
                                t.indexOf(m) > -1
                                    ? (w.config[m] = c(f[m])
                                          .map(T)
                                          .concat(w.config[m]))
                                    : void 0 === i[m] && (w.config[m] = f[m]);
                        }
                        i.altInputClass ||
                            (w.config.altInputClass =
                                ce().className + " " + w.config.altInputClass);
                        De("onParseConfig");
                    })(),
                    se(),
                    (function () {
                        if (((w.input = ce()), !w.input))
                            return void w.config.errorHandler(
                                new Error("Invalid input element specified")
                            );
                        (w.input._type = w.input.type),
                            (w.input.type = "text"),
                            w.input.classList.add("flatpickr-input"),
                            (w._input = w.input),
                            w.config.altInput &&
                                ((w.altInput = d(
                                    w.input.nodeName,
                                    w.config.altInputClass
                                )),
                                (w._input = w.altInput),
                                (w.altInput.placeholder = w.input.placeholder),
                                (w.altInput.disabled = w.input.disabled),
                                (w.altInput.required = w.input.required),
                                (w.altInput.tabIndex = w.input.tabIndex),
                                (w.altInput.type = "text"),
                                w.input.setAttribute("type", "hidden"),
                                !w.config.static &&
                                    w.input.parentNode &&
                                    w.input.parentNode.insertBefore(
                                        w.altInput,
                                        w.input.nextSibling
                                    ));
                        w.config.allowInput ||
                            w._input.setAttribute("readonly", "readonly");
                        ve();
                    })(),
                    (function () {
                        (w.selectedDates = []),
                            (w.now = w.parseDate(w.config.now) || new Date());
                        var e =
                            w.config.defaultDate ||
                            (("INPUT" !== w.input.nodeName &&
                                "TEXTAREA" !== w.input.nodeName) ||
                            !w.input.placeholder ||
                            w.input.value !== w.input.placeholder
                                ? w.input.value
                                : null);
                        e && pe(e, w.config.dateFormat);
                        (w._initialDate =
                            w.selectedDates.length > 0
                                ? w.selectedDates[0]
                                : w.config.minDate &&
                                  w.config.minDate.getTime() > w.now.getTime()
                                ? w.config.minDate
                                : w.config.maxDate &&
                                  w.config.maxDate.getTime() < w.now.getTime()
                                ? w.config.maxDate
                                : w.now),
                            (w.currentYear = w._initialDate.getFullYear()),
                            (w.currentMonth = w._initialDate.getMonth()),
                            w.selectedDates.length > 0 &&
                                (w.latestSelectedDateObj = w.selectedDates[0]);
                        void 0 !== w.config.minTime &&
                            (w.config.minTime = w.parseDate(
                                w.config.minTime,
                                "H:i"
                            ));
                        void 0 !== w.config.maxTime &&
                            (w.config.maxTime = w.parseDate(
                                w.config.maxTime,
                                "H:i"
                            ));
                        (w.minDateHasTime =
                            !!w.config.minDate &&
                            (w.config.minDate.getHours() > 0 ||
                                w.config.minDate.getMinutes() > 0 ||
                                w.config.minDate.getSeconds() > 0)),
                            (w.maxDateHasTime =
                                !!w.config.maxDate &&
                                (w.config.maxDate.getHours() > 0 ||
                                    w.config.maxDate.getMinutes() > 0 ||
                                    w.config.maxDate.getSeconds() > 0));
                    })(),
                    (w.utils = {
                        getDaysInMonth: function (e, n) {
                            return (
                                void 0 === e && (e = w.currentMonth),
                                void 0 === n && (n = w.currentYear),
                                1 === e &&
                                ((n % 4 == 0 && n % 100 != 0) || n % 400 == 0)
                                    ? 29
                                    : w.l10n.daysInMonth[e]
                            );
                        },
                    }),
                    w.isMobile ||
                        (function () {
                            var e = window.document.createDocumentFragment();
                            if (
                                ((w.calendarContainer = d(
                                    "div",
                                    "flatpickr-calendar"
                                )),
                                (w.calendarContainer.tabIndex = -1),
                                !w.config.noCalendar)
                            ) {
                                if (
                                    (e.appendChild(
                                        ((w.monthNav = d(
                                            "div",
                                            "flatpickr-months"
                                        )),
                                        (w.yearElements = []),
                                        (w.monthElements = []),
                                        (w.prevMonthNav = d(
                                            "span",
                                            "flatpickr-prev-month"
                                        )),
                                        (w.prevMonthNav.innerHTML =
                                            w.config.prevArrow),
                                        (w.nextMonthNav = d(
                                            "span",
                                            "flatpickr-next-month"
                                        )),
                                        (w.nextMonthNav.innerHTML =
                                            w.config.nextArrow),
                                        V(),
                                        Object.defineProperty(
                                            w,
                                            "_hidePrevMonthArrow",
                                            {
                                                get: function () {
                                                    return w.__hidePrevMonthArrow;
                                                },
                                                set: function (e) {
                                                    w.__hidePrevMonthArrow !==
                                                        e &&
                                                        (s(
                                                            w.prevMonthNav,
                                                            "flatpickr-disabled",
                                                            e
                                                        ),
                                                        (w.__hidePrevMonthArrow =
                                                            e));
                                                },
                                            }
                                        ),
                                        Object.defineProperty(
                                            w,
                                            "_hideNextMonthArrow",
                                            {
                                                get: function () {
                                                    return w.__hideNextMonthArrow;
                                                },
                                                set: function (e) {
                                                    w.__hideNextMonthArrow !==
                                                        e &&
                                                        (s(
                                                            w.nextMonthNav,
                                                            "flatpickr-disabled",
                                                            e
                                                        ),
                                                        (w.__hideNextMonthArrow =
                                                            e));
                                                },
                                            }
                                        ),
                                        (w.currentYearElement =
                                            w.yearElements[0]),
                                        Ce(),
                                        w.monthNav)
                                    ),
                                    (w.innerContainer = d(
                                        "div",
                                        "flatpickr-innerContainer"
                                    )),
                                    w.config.weekNumbers)
                                ) {
                                    var n = (function () {
                                            w.calendarContainer.classList.add(
                                                "hasWeeks"
                                            );
                                            var e = d(
                                                "div",
                                                "flatpickr-weekwrapper"
                                            );
                                            e.appendChild(
                                                d(
                                                    "span",
                                                    "flatpickr-weekday",
                                                    w.l10n.weekAbbreviation
                                                )
                                            );
                                            var n = d("div", "flatpickr-weeks");
                                            return (
                                                e.appendChild(n),
                                                {
                                                    weekWrapper: e,
                                                    weekNumbers: n,
                                                }
                                            );
                                        })(),
                                        t = n.weekWrapper,
                                        a = n.weekNumbers;
                                    w.innerContainer.appendChild(t),
                                        (w.weekNumbers = a),
                                        (w.weekWrapper = t);
                                }
                                (w.rContainer = d(
                                    "div",
                                    "flatpickr-rContainer"
                                )),
                                    w.rContainer.appendChild(z()),
                                    w.daysContainer ||
                                        ((w.daysContainer = d(
                                            "div",
                                            "flatpickr-days"
                                        )),
                                        (w.daysContainer.tabIndex = -1)),
                                    U(),
                                    w.rContainer.appendChild(w.daysContainer),
                                    w.innerContainer.appendChild(w.rContainer),
                                    e.appendChild(w.innerContainer);
                            }
                            w.config.enableTime &&
                                e.appendChild(
                                    (function () {
                                        w.calendarContainer.classList.add(
                                            "hasTime"
                                        ),
                                            w.config.noCalendar &&
                                                w.calendarContainer.classList.add(
                                                    "noCalendar"
                                                );
                                        var e = E(w.config);
                                        (w.timeContainer = d(
                                            "div",
                                            "flatpickr-time"
                                        )),
                                            (w.timeContainer.tabIndex = -1);
                                        var n = d(
                                                "span",
                                                "flatpickr-time-separator",
                                                ":"
                                            ),
                                            t = m("flatpickr-hour", {
                                                "aria-label":
                                                    w.l10n.hourAriaLabel,
                                            });
                                        w.hourElement =
                                            t.getElementsByTagName("input")[0];
                                        var a = m("flatpickr-minute", {
                                            "aria-label":
                                                w.l10n.minuteAriaLabel,
                                        });
                                        (w.minuteElement =
                                            a.getElementsByTagName("input")[0]),
                                            (w.hourElement.tabIndex =
                                                w.minuteElement.tabIndex =
                                                    -1),
                                            (w.hourElement.value = o(
                                                w.latestSelectedDateObj
                                                    ? w.latestSelectedDateObj.getHours()
                                                    : w.config.time_24hr
                                                    ? e.hours
                                                    : (function (e) {
                                                          switch (e % 24) {
                                                              case 0:
                                                              case 12:
                                                                  return 12;
                                                              default:
                                                                  return e % 12;
                                                          }
                                                      })(e.hours)
                                            )),
                                            (w.minuteElement.value = o(
                                                w.latestSelectedDateObj
                                                    ? w.latestSelectedDateObj.getMinutes()
                                                    : e.minutes
                                            )),
                                            w.hourElement.setAttribute(
                                                "step",
                                                w.config.hourIncrement.toString()
                                            ),
                                            w.minuteElement.setAttribute(
                                                "step",
                                                w.config.minuteIncrement.toString()
                                            ),
                                            w.hourElement.setAttribute(
                                                "min",
                                                w.config.time_24hr ? "0" : "1"
                                            ),
                                            w.hourElement.setAttribute(
                                                "max",
                                                w.config.time_24hr ? "23" : "12"
                                            ),
                                            w.hourElement.setAttribute(
                                                "maxlength",
                                                "2"
                                            ),
                                            w.minuteElement.setAttribute(
                                                "min",
                                                "0"
                                            ),
                                            w.minuteElement.setAttribute(
                                                "max",
                                                "59"
                                            ),
                                            w.minuteElement.setAttribute(
                                                "maxlength",
                                                "2"
                                            ),
                                            w.timeContainer.appendChild(t),
                                            w.timeContainer.appendChild(n),
                                            w.timeContainer.appendChild(a),
                                            w.config.time_24hr &&
                                                w.timeContainer.classList.add(
                                                    "time24hr"
                                                );
                                        if (w.config.enableSeconds) {
                                            w.timeContainer.classList.add(
                                                "hasSeconds"
                                            );
                                            var i = m("flatpickr-second");
                                            (w.secondElement =
                                                i.getElementsByTagName(
                                                    "input"
                                                )[0]),
                                                (w.secondElement.value = o(
                                                    w.latestSelectedDateObj
                                                        ? w.latestSelectedDateObj.getSeconds()
                                                        : e.seconds
                                                )),
                                                w.secondElement.setAttribute(
                                                    "step",
                                                    w.minuteElement.getAttribute(
                                                        "step"
                                                    )
                                                ),
                                                w.secondElement.setAttribute(
                                                    "min",
                                                    "0"
                                                ),
                                                w.secondElement.setAttribute(
                                                    "max",
                                                    "59"
                                                ),
                                                w.secondElement.setAttribute(
                                                    "maxlength",
                                                    "2"
                                                ),
                                                w.timeContainer.appendChild(
                                                    d(
                                                        "span",
                                                        "flatpickr-time-separator",
                                                        ":"
                                                    )
                                                ),
                                                w.timeContainer.appendChild(i);
                                        }
                                        w.config.time_24hr ||
                                            ((w.amPM = d(
                                                "span",
                                                "flatpickr-am-pm",
                                                w.l10n.amPM[
                                                    r(
                                                        (w.latestSelectedDateObj
                                                            ? w.hourElement
                                                                  .value
                                                            : w.config
                                                                  .defaultHour) >
                                                            11
                                                    )
                                                ]
                                            )),
                                            (w.amPM.title = w.l10n.toggleTitle),
                                            (w.amPM.tabIndex = -1),
                                            w.timeContainer.appendChild(
                                                w.amPM
                                            ));
                                        return w.timeContainer;
                                    })()
                                );
                            s(
                                w.calendarContainer,
                                "rangeMode",
                                "range" === w.config.mode
                            ),
                                s(
                                    w.calendarContainer,
                                    "animate",
                                    !0 === w.config.animate
                                ),
                                s(
                                    w.calendarContainer,
                                    "multiMonth",
                                    w.config.showMonths > 1
                                ),
                                w.calendarContainer.appendChild(e);
                            var i =
                                void 0 !== w.config.appendTo &&
                                void 0 !== w.config.appendTo.nodeType;
                            if (
                                (w.config.inline || w.config.static) &&
                                (w.calendarContainer.classList.add(
                                    w.config.inline ? "inline" : "static"
                                ),
                                w.config.inline &&
                                    (!i && w.element.parentNode
                                        ? w.element.parentNode.insertBefore(
                                              w.calendarContainer,
                                              w._input.nextSibling
                                          )
                                        : void 0 !== w.config.appendTo &&
                                          w.config.appendTo.appendChild(
                                              w.calendarContainer
                                          )),
                                w.config.static)
                            ) {
                                var l = d("div", "flatpickr-wrapper");
                                w.element.parentNode &&
                                    w.element.parentNode.insertBefore(
                                        l,
                                        w.element
                                    ),
                                    l.appendChild(w.element),
                                    w.altInput && l.appendChild(w.altInput),
                                    l.appendChild(w.calendarContainer);
                            }
                            w.config.static ||
                                w.config.inline ||
                                (void 0 !== w.config.appendTo
                                    ? w.config.appendTo
                                    : window.document.body
                                ).appendChild(w.calendarContainer);
                        })(),
                    (function () {
                        w.config.wrap &&
                            ["open", "close", "toggle", "clear"].forEach(
                                function (e) {
                                    Array.prototype.forEach.call(
                                        w.element.querySelectorAll(
                                            "[data-" + e + "]"
                                        ),
                                        function (n) {
                                            return P(n, "click", w[e]);
                                        }
                                    );
                                }
                            );
                        if (w.isMobile)
                            return void (function () {
                                var e = w.config.enableTime
                                    ? w.config.noCalendar
                                        ? "time"
                                        : "datetime-local"
                                    : "date";
                                (w.mobileInput = d(
                                    "input",
                                    w.input.className + " flatpickr-mobile"
                                )),
                                    (w.mobileInput.tabIndex = 1),
                                    (w.mobileInput.type = e),
                                    (w.mobileInput.disabled = w.input.disabled),
                                    (w.mobileInput.required = w.input.required),
                                    (w.mobileInput.placeholder =
                                        w.input.placeholder),
                                    (w.mobileFormatStr =
                                        "datetime-local" === e
                                            ? "Y-m-d\\TH:i:S"
                                            : "date" === e
                                            ? "Y-m-d"
                                            : "H:i:S"),
                                    w.selectedDates.length > 0 &&
                                        (w.mobileInput.defaultValue =
                                            w.mobileInput.value =
                                                w.formatDate(
                                                    w.selectedDates[0],
                                                    w.mobileFormatStr
                                                ));
                                w.config.minDate &&
                                    (w.mobileInput.min = w.formatDate(
                                        w.config.minDate,
                                        "Y-m-d"
                                    ));
                                w.config.maxDate &&
                                    (w.mobileInput.max = w.formatDate(
                                        w.config.maxDate,
                                        "Y-m-d"
                                    ));
                                w.input.getAttribute("step") &&
                                    (w.mobileInput.step = String(
                                        w.input.getAttribute("step")
                                    ));
                                (w.input.type = "hidden"),
                                    void 0 !== w.altInput &&
                                        (w.altInput.type = "hidden");
                                try {
                                    w.input.parentNode &&
                                        w.input.parentNode.insertBefore(
                                            w.mobileInput,
                                            w.input.nextSibling
                                        );
                                } catch (e) {}
                                P(w.mobileInput, "change", function (e) {
                                    w.setDate(
                                        g(e).value,
                                        !1,
                                        w.mobileFormatStr
                                    ),
                                        De("onChange"),
                                        De("onClose");
                                });
                            })();
                        var e = l(re, 50);
                        (w._debouncedChange = l(Y, 300)),
                            w.daysContainer &&
                                !/iPhone|iPad|iPod/i.test(
                                    navigator.userAgent
                                ) &&
                                P(w.daysContainer, "mouseover", function (e) {
                                    "range" === w.config.mode && oe(g(e));
                                });
                        P(w._input, "keydown", ie),
                            void 0 !== w.calendarContainer &&
                                P(w.calendarContainer, "keydown", ie);
                        w.config.inline ||
                            w.config.static ||
                            P(window, "resize", e);
                        void 0 !== window.ontouchstart
                            ? P(window.document, "touchstart", X)
                            : P(window.document, "mousedown", X);
                        P(window.document, "focus", X, { capture: !0 }),
                            !0 === w.config.clickOpens &&
                                (P(w._input, "focus", w.open),
                                P(w._input, "click", w.open));
                        void 0 !== w.daysContainer &&
                            (P(w.monthNav, "click", xe),
                            P(w.monthNav, ["keyup", "increment"], N),
                            P(w.daysContainer, "click", me));
                        if (
                            void 0 !== w.timeContainer &&
                            void 0 !== w.minuteElement &&
                            void 0 !== w.hourElement
                        ) {
                            var n = function (e) {
                                return g(e).select();
                            };
                            P(w.timeContainer, ["increment"], _),
                                P(w.timeContainer, "blur", _, { capture: !0 }),
                                P(w.timeContainer, "click", H),
                                P(
                                    [w.hourElement, w.minuteElement],
                                    ["focus", "click"],
                                    n
                                ),
                                void 0 !== w.secondElement &&
                                    P(w.secondElement, "focus", function () {
                                        return (
                                            w.secondElement &&
                                            w.secondElement.select()
                                        );
                                    }),
                                void 0 !== w.amPM &&
                                    P(w.amPM, "click", function (e) {
                                        _(e);
                                    });
                        }
                        w.config.allowInput && P(w._input, "blur", ae);
                    })(),
                    (w.selectedDates.length || w.config.noCalendar) &&
                        (w.config.enableTime &&
                            F(
                                w.config.noCalendar
                                    ? w.latestSelectedDateObj
                                    : void 0
                            ),
                        ye(!1)),
                    S();
                var n = /^((?!chrome|android).)*safari/i.test(
                    navigator.userAgent
                );
                !w.isMobile && n && de(), De("onReady");
            })(),
            w
        );
    }
    function T(e, n) {
        for (
            var t = Array.prototype.slice.call(e).filter(function (e) {
                    return e instanceof HTMLElement;
                }),
                a = [],
                i = 0;
            i < t.length;
            i++
        ) {
            var o = t[i];
            try {
                if (null !== o.getAttribute("data-fp-omit")) continue;
                void 0 !== o._flatpickr &&
                    (o._flatpickr.destroy(), (o._flatpickr = void 0)),
                    (o._flatpickr = k(o, n || {})),
                    a.push(o._flatpickr);
            } catch (e) {
                console.error(e);
            }
        }
        return 1 === a.length ? a[0] : a;
    }
    "undefined" != typeof HTMLElement &&
        "undefined" != typeof HTMLCollection &&
        "undefined" != typeof NodeList &&
        ((HTMLCollection.prototype.flatpickr = NodeList.prototype.flatpickr =
            function (e) {
                return T(this, e);
            }),
        (HTMLElement.prototype.flatpickr = function (e) {
            return T([this], e);
        }));
    var I = function (e, n) {
        return "string" == typeof e
            ? T(window.document.querySelectorAll(e), n)
            : e instanceof Node
            ? T([e], n)
            : T(e, n);
    };
    return (
        (I.defaultConfig = {}),
        (I.l10ns = { en: e({}, i), default: e({}, i) }),
        (I.localize = function (n) {
            I.l10ns.default = e(e({}, I.l10ns.default), n);
        }),
        (I.setDefaults = function (n) {
            I.defaultConfig = e(e({}, I.defaultConfig), n);
        }),
        (I.parseDate = C({})),
        (I.formatDate = b({})),
        (I.compareDates = M),
        "undefined" != typeof jQuery &&
            void 0 !== jQuery.fn &&
            (jQuery.fn.flatpickr = function (e) {
                return T(this, e);
            }),
        (Date.prototype.fp_incr = function (e) {
            return new Date(
                this.getFullYear(),
                this.getMonth(),
                this.getDate() + ("string" == typeof e ? parseInt(e, 10) : e)
            );
        }),
        "undefined" != typeof window && (window.flatpickr = I),
        I
    );
});

/*


+--------------------------------------------------------------------+

    felixg.io - dateDropper Javascript

    Version: 1.1.0
    Realase: 2023-04-16
    Created by: Felice Gattuso
    Twitter: @felixggi 
    Instagram: @felixggi
    Docs: https://felixg.io/docs/guides/datedropper-javascript
    
+--------------------------------------------------------------------+

*/

var dateDropperSetup = {
    languages: {
        en: {
            m: {
                s: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "June",
                    "July",
                    "Aug",
                    "Sept",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                f: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                ],
            },
            w: {
                s: ["S", "M", "T", "W", "T", "F", "S"],
                f: [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                ],
            },
        },
    },
};
!(function () {
    this.dateDropper = function () {
        var e = dateDropper.prototype;
        e.fetch = function () {
            (d.els = document.querySelectorAll(d.options.selector)),
                d.els.length &&
                    d.els.forEach(function (e, t) {
                        d.prepare(e);
                    });
        };
        var d = {};
        function t(e, d) {
            return [
                31,
                e % 4 == 0 && (e % 100 != 0 || e % 400 == 0) ? 29 : 28,
                31,
                30,
                31,
                30,
                31,
                31,
                30,
                31,
                30,
                31,
            ][d - 1];
        }
        function n(e) {
            return e < 10 ? "0" + e : e;
        }
        function o(e) {
            var d = ["th", "st", "nd", "rd"],
                t = e % 100;
            return e + (d[(t - 20) % 10] || d[t] || d[0]);
        }
        function a(e) {
            return Date.parse(e) / 1e3;
        }
        function r(e) {
            if (!e) return !1;
            var d = [];
            return (
                ("string" == typeof e || e instanceof String) &&
                    (e = e.split(",")),
                !!Array.isArray(e) &&
                    (e.forEach(function (e) {
                        d.push(a(new Date(e)));
                    }),
                    d)
            );
        }
        function i(e, d) {
            return !(!e || !d) && e.y == d.y && e.m == d.m && e.d == d.d;
        }
        function l(e) {
            return !!e && e.y + "/" + n(e.m) + "/" + n(e.d);
        }
        function s(e) {
            return !!e && new Date(l(e));
        }
        function c(e) {
            return (
                !!e && {
                    d: e.getDate(),
                    m: e.getMonth() + 1,
                    y: e.getFullYear(),
                }
            );
        }
        function p(e) {
            return l(c(e));
        }
        function u(e) {
            return !!e && new Date(e);
        }
        function g(e) {
            return c(u(e));
        }
        function m(e) {
            return !!e.arr && e.arr.includes(a(e.date));
        }
        function f(e) {
            e &&
                (e.classList.remove("dd-shown"),
                setTimeout(function () {
                    e.remove();
                }, 600));
        }
        function b(e, d) {
            var t = e.querySelectorAll("." + d);
            t &&
                t.forEach(function (e) {
                    e.classList.remove(d);
                });
        }
        function v(e, d) {
            e.setAttribute("data-dd-opt-default-date", l(d));
        }
        function h(e, d) {
            e && e instanceof HTMLInputElement && (e.value = d);
        }
        function y(e, d) {
            return Math.round((d - e) / 864e5);
        }
        function w(e, d) {
            var t = document.createElement(e);
            return (
                d &&
                    (d.class && (t.className = d.class),
                    d.html && (t.innerHTML = d.html),
                    d.id && (t.id = d.id)),
                t
            );
        }
        function x(e) {
            e.classList.add("dd-rumble"),
                setTimeout(function () {
                    e.classList.remove("dd-rumble");
                }, 400);
        }
        function k(e, d) {
            for (var t in d)
                try {
                    d[t].constructor == Object
                        ? (e[t] = _.extend(e[t], d[t]))
                        : (e[t] = d[t]);
                } catch (n) {
                    e[t] = d[t];
                }
            return e;
        }
        function D(e) {
            return e
                .replace(/(?:^\w|[A-Z]|\b\w)/g, function (e, d) {
                    return 0 === d ? e.toLowerCase() : e.toUpperCase();
                })
                .replace(/\s+/g, "")
                .replace("-", "");
        }
        (d.options = {
            format: "y-mm-dd",
            lang: "en",
            blocks: ["m", "d", "y"],
            autoFill: !0,
            jump: 10,
            loopAll: !0,
            loopDays: !0,
            loopMonths: !0,
            loopYears: !0,
            highlightWeekend: !0,
            defaultBehavior: !0,
            showArrowsOnHover: !0,
        }),
            k(d.options, arguments[0]),
            (d.inline = d.options.inline),
            (d.prepare = function (e) {
                if (e.classList.contains("dd__trigger")) return !1;
                e.classList.add("dd__trigger"),
                    e instanceof HTMLInputElement &&
                        (e.setAttribute("readonly", !0),
                        e.setAttribute("type", "text"));
                var t = d.methods(e);
                d.inline
                    ? e.datedropper("show")
                    : ((t.triggerFunc = function () {
                          this.classList.contains("dd-focused") ||
                              this.datedropper("show");
                      }),
                      e.addEventListener("click", t.triggerFunc));
            }),
            (d.destroy = function (e) {
                d.exit(e),
                    e.trigger.removeEventListener("click", e.triggerFunc),
                    delete e.trigger.datedropper,
                    e.options.onDestroy && e.options.onDestroy(e.trigger);
            }),
            (d.methods = function (e) {
                var t = {};
                return (
                    (t.trigger = e),
                    Object.defineProperty(t.trigger, "datedropper", {
                        value: function (e, n) {
                            switch (e) {
                                case "show":
                                    d.open(t);
                                    break;
                                case "hide":
                                    d.exit(t);
                                    break;
                                case "destroy":
                                    d.destroy(t);
                                    break;
                                case "set":
                                    d.set(t, n);
                            }
                        },
                        configurable: !0,
                    }),
                    t
                );
            }),
            (d.set = function (e, t) {
                Object.keys(t).forEach(function (d) {
                    var n = d.replace(/[A-Z]/g, (e) => "-" + e.toLowerCase());
                    e.trigger.setAttribute("data-dd-opt-" + n, t[d]);
                }),
                    e.dropdown && d.open(e);
            }),
            (d.open = function (e) {
                e.dropdown && d.exit(e),
                    (e.options = d.getOptions(e)),
                    d.cleanOptions(e),
                    d.dropdown(e),
                    d.change(e, !0);
            }),
            (d.locked = function (e, d) {
                e.primaryButton &&
                    (d
                        ? (x(e.primaryButton),
                          e.primaryButton.setAttribute("disabled", ""))
                        : e.primaryButton.removeAttribute("disabled"));
            }),
            (d.dataOptions = function (e) {
                for (
                    var d = e.trigger.attributes, t = d.length, n = {};
                    t--;

                ) {
                    var o = d[t];
                    if (o.value && o.name.includes("data-dd-opt-")) {
                        var a = D(o.name.replace("data-dd-opt-", "")),
                            r = o.value;
                        switch (r) {
                            case "true":
                                r = !0;
                                break;
                            case "false":
                                r = !1;
                        }
                        n[a] = r;
                    }
                }
                return n;
            }),
            (d.getOptions = function (e) {
                var t = k({}, d.options);
                switch (
                    ((t = k(t, d.dataOptions(e))),
                    ["maxYear", "minYear"].forEach(function (e) {
                        t[e] =
                            t[e] ||
                            new Date().getFullYear() +
                                ("maxYear" == e ? 50 : -50);
                    }),
                    ["maxDate", "minDate"].forEach(function (e) {
                        t[e] = "today" == t[e] ? p(new Date()) : t[e];
                    }),
                    (t.defaultDate = u(t.defaultDate) || new Date()),
                    (t.range = t.range || Boolean(t.rangeStart || t.rangeEnd)),
                    (t.expandedOnly = t.expandedOnly || t.range),
                    (t.expandedDefault = t.expandedDefault || t.expandedOnly),
                    (t.expandable =
                        t.expandable || t.expandedDefault || t.doubleView),
                    ["onlyMonth", "onlyYear"].includes(t.preset) &&
                        ((t.range = !1),
                        (t.defaultBehavior = !1),
                        (t.expandable = !1),
                        (t.customClass =
                            (t.customClass || "") + " dd-preset-" + t.preset)),
                    t.preset)
                ) {
                    case "onlyMonth":
                        (t.blocks = ["m"]),
                            (t.format = ["m", "mm", "M", "MM"].includes(
                                t.format
                            )
                                ? t.format
                                : "m");
                        break;
                    case "onlyYear":
                        (t.blocks = ["y"]), (t.format = "y");
                }
                return t;
            }),
            (d.fixDate = function (e, d) {
                var t = e.options.maxYear,
                    n = e.options.minYear,
                    o = d.input.getFullYear();
                return (
                    t && o > t && (o = d.fill ? t : n),
                    n && o < n && (o = d.fill ? n : t),
                    d.input.setFullYear(o),
                    d.input
                );
            }),
            (d.cleanOptions = function (e) {
                (e.date = d.fixDate(e, {
                    input: e.options.defaultDate,
                    fill: !0,
                })),
                    e.options.rangeStart &&
                        e.options.rangeEnd &&
                        d.valid(e, u(e.options.rangeStart)) &&
                        d.valid(e, u(e.options.rangeEnd)) &&
                        u(e.options.rangeEnd) >= u(e.options.rangeStart) &&
                        ((e.options.range = !0),
                        (e.range = {
                            a: g(e.options.rangeStart),
                            b: g(e.options.rangeEnd),
                        }),
                        (e.date = s(e.range.a)),
                        (e.selected = new Date(p(e.date)))),
                    e.options.range || (e.selected = new Date(p(e.date)));
            }),
            (d.lang = function (e) {
                var d = dateDropperSetup.languages;
                return d[e.options.lang] || d.en;
            }),
            (d.output = function (e, t) {
                var r = (t = t || {}).input || e.selected || e.date,
                    i = r.getFullYear(),
                    l = r.getMonth() + 1,
                    s = r.getDate(),
                    c = r.getDay(),
                    p = d.lang(e),
                    u = {
                        d: s,
                        dd: n(s),
                        m: l,
                        mm: n(l),
                        M: p.m.s[l - 1],
                        MM: p.m.f[l - 1],
                        y: i,
                        w: c,
                        W: p.w.f[c].substr(0, 3),
                        WW: p.w.f[c],
                        S: o(s),
                        U: a(r),
                    };
                return (
                    (u.string = (t.format || e.options.format)
                        .replace(/\b(d)\b/g, u.d)
                        .replace(/\b(dd)\b/g, u.dd)
                        .replace(/\b(m)\b/g, u.m)
                        .replace(/\b(mm)\b/g, u.mm)
                        .replace(/\b(M)\b/g, u.M)
                        .replace(/\b(MM)\b/g, u.MM)
                        .replace(/\b(y)\b/g, u.y)
                        .replace(/\b(w)\b/g, u.w)
                        .replace(/\b(W)\b/g, u.W)
                        .replace(/\b(WW)\b/g, u.WW)
                        .replace(/\b(S)\b/g, u.S)
                        .replace(/\b(U)\b/g, u.U)),
                    u
                );
            }),
            (d.offset = function (e) {
                var t,
                    n,
                    o = document.querySelectorAll(d.options.selector),
                    a = e.trigger.getBoundingClientRect(),
                    r = e.dropdown.getBoundingClientRect().width / 2,
                    i = document.documentElement.scrollTop;
                (t = a.top + i + a.height + 16),
                    (e.dropdown.style.top = t + "px");
                var l = document.documentElement.scrollLeft;
                if (e.options.range && 2 == o.length) {
                    var s = o[0].getBoundingClientRect(),
                        c = o[1].getBoundingClientRect(),
                        p = l + s.left;
                    n = p + (l + c.left + c.width - p) / 2;
                } else {
                    n = a.left + l + a.width / 2;
                }
                0 > n - r && (n = 16 + r),
                    n + r + 16 > window.innerWidth &&
                        (n = window.innerWidth - 16 - r),
                    (e.dropdown.style.left = n + "px");
            }),
            (d.block = function (e, t) {
                var n = w("div", {
                    class: "dd__block",
                    html:
                        '<div class="dd__nav dd-left dd-hidden">' +
                        d.svg("arrowLeft") +
                        '</div><div class="dd__nav dd-right dd-hidden">' +
                        d.svg("arrowRight") +
                        '</div><div class="dd__view"></div>',
                });
                n.setAttribute("data-key", t),
                    n
                        .querySelector(".dd-left")
                        .addEventListener("click", function () {
                            d.move(e, t, !1);
                        }),
                    n
                        .querySelector(".dd-right")
                        .addEventListener("click", function () {
                            d.move(e, t, !0);
                        }),
                    e.options.defaultBehavior &&
                        n
                            .querySelector(".dd__view")
                            .addEventListener("click", function () {
                                switch (t) {
                                    case "y":
                                        d.yearDialog(e);
                                        break;
                                    case "m":
                                        d.monthDialog(e);
                                        break;
                                    case "d":
                                        d.toggleView(e);
                                }
                            }),
                    e.dropdown.appendChild(n);
            }),
            (d.toggleView = function (e) {
                e.options.expandable && ((e.expanded = !e.expanded), d.open(e));
            }),
            (d.calendarHeader = function (e) {
                for (
                    var t = d.lang(e),
                        n = w("div", { class: "dd__header" }),
                        o = 0;
                    o <= 6;
                    o++
                ) {
                    var a = o,
                        r = w("div", { class: "dd__item" });
                    e.options.startFromMonday && (a = a + 1 == 7 ? 0 : a + 1),
                        (r.innerHTML = t.w.s[a]),
                        n.appendChild(r);
                }
                return n;
            }),
            (d.validRange = function (e, d, t) {
                var n = !0,
                    o = y(d, t);
                return (
                    n && e.options.minRange && (n = o >= e.options.minRange),
                    n && e.options.maxRange && (n = o <= e.options.maxRange),
                    n
                );
            }),
            (d.setRange = function (e, t) {
                var n = t.date,
                    o = t.item;
                if (e.selecting) {
                    var a = s(e.range.a),
                        r = s(n);
                    if (r >= a) {
                        if (!d.validRange(e, a, r)) return void x(o);
                        (e.range.b = n), (e.selecting = !1);
                    } else e.range.a = n;
                } else
                    (e.range = {}),
                        (e.range.a = n),
                        (e.selecting = !0),
                        d.setDate(e, { d: n.d, m: n.m, y: n.y });
                e.options.onRangeSet &&
                    e.options.onRangeSet(d.prepareOutput(e));
            }),
            (d.calendarDay = function (e, t) {
                var n = s(t.date),
                    o = w("div", {
                        html: '<div class="dd-value">' + t.date.d + "</div>",
                        class: "dd__item " + (t.class || ""),
                    });
                d.weekend(e, n.getDay()) && o.classList.add("dd-weekend");
                var r = i(c(new Date()), t.date),
                    l = i(c(e.selected), t.date);
                if (
                    (!l && r && o.classList.add("dd-today"),
                    e.options.range && e.range)
                ) {
                    if (
                        (["a", "b"].forEach(function (d) {
                            e.range[d] &&
                                i(t.date, e.range[d]) &&
                                (e.range.a &&
                                    e.range.b &&
                                    s(e.range.a) != s(e.range.b) &&
                                    o.classList.add("dd-" + d),
                                o.classList.add("dd-selected"));
                        }),
                        e.range.a && e.range.b)
                    ) {
                        var p = a(s(e.range.a)),
                            u = a(s(e.range.b)),
                            g = a(n);
                        g > p && g < u && o.classList.add("dd-point");
                    }
                } else l && o.classList.add("dd-selected");
                if (
                    (!(e.range && !e.range.b) ||
                        d.validRange(e, s(e.range.a), s(t.date))) &&
                    d.valid(e, n)
                ) {
                    var m = { item: o, date: t.date };
                    e.options.onRender && d.putOnSchema(e, m),
                        o.addEventListener("click", function () {
                            e.options.range
                                ? d.setRange(e, m)
                                : d.setDate(e, {
                                      d: t.date.d,
                                      m: t.date.m,
                                      y: t.date.y,
                                  }),
                                d.change(e, !0);
                        }),
                        e.options.range &&
                            (o.addEventListener("mouseenter", function () {
                                d.settingRange(e, m),
                                    e.dropdown.classList.add("dd-selecting"),
                                    o.classList.add("dd-selecting");
                            }),
                            o.addEventListener("mouseleave", function () {
                                b(e.dropdown, "dd-selecting"),
                                    b(e.dropdown, "dd-starting"),
                                    b(e.dropdown, "dd-perEnd"),
                                    b(e.dropdown, "dd-perStart");
                            }));
                } else o.classList.add("dd-disabled");
                return o;
            }),
            (d.putOnSchema = function (e, d) {
                var t = {
                    node: d.item,
                    customLabel: function (e) {
                        if (
                            (d.item.setAttribute("data-dd-tooltip", e.label),
                            e.color)
                        ) {
                            var t = w("div", { class: "dd-color" });
                            t.setAttribute(
                                "style",
                                "background-color:" + e.color
                            );
                        }
                        d.item.appendChild(t);
                    },
                };
                e.CSCHEMA[l(d.date)] = t;
            }),
            (d.settingRange = function (e, t) {
                if (
                    e.range &&
                    e.range.a &&
                    !e.range.b &&
                    s(e.range.a) < s(t.date)
                ) {
                    var n =
                        t.item.parentNode.querySelector(
                            ".dd__item.dd-selected"
                        ) ||
                        t.item.parentNode.querySelector(
                            ".dd__body .dd__item:first-of-type"
                        );
                    if (d.isDoubleView(e)) {
                        var o = t.item.parentNode.parentNode.previousSibling;
                        if (o)
                            if (o.querySelector(".dd__item.dd-selected"))
                                o.classList.add("dd-perEnd");
                            else
                                s(t.date).getMonth() !=
                                    s(e.range.a).getMonth() &&
                                    o.classList.add("dd-perStart");
                    }
                    n.classList.add("dd-starting");
                }
            }),
            (d.calendarBody = function (e, n) {
                var o = w("div", { class: "dd__body" }),
                    a = n.date || d.output(e),
                    r = t(a.y, a.m),
                    i = a.y + "/" + a.m + "/01",
                    l = new Date(i);
                l.setDate(l.getDate() - 1);
                var s = new Date(i);
                s.setMonth(s.getMonth() + 1);
                var c = 42,
                    p = l.getDay() + (e.options.startFromMonday ? -1 : 0);
                if (6 != p)
                    for (var u = p; u >= 0; u--)
                        o.appendChild(
                            d.calendarDay(e, {
                                class: "dd-placeholder dd-before",
                                date: {
                                    d: l.getDate() - u,
                                    m: l.getMonth() + 1,
                                    y: l.getFullYear(),
                                },
                            })
                        ),
                            c--;
                for (u = 1; u <= r; u++)
                    o.appendChild(
                        d.calendarDay(e, {
                            class: "dd-i",
                            date: { d: u, m: a.m, y: a.y },
                        })
                    ),
                        c--;
                for (u = 1; u <= c; u++)
                    o.appendChild(
                        d.calendarDay(e, {
                            class: "dd-placeholder",
                            date: {
                                d: u,
                                m: s.getMonth() + 1,
                                y: s.getFullYear(),
                            },
                        })
                    );
                return o;
            }),
            (d.createCalendar = function (e, t) {
                var n = w("div");
                return (
                    n.appendChild(d.calendarHeader(e)),
                    n.appendChild(d.calendarBody(e, t)),
                    n
                );
            }),
            (d.calendar = function (e) {
                var t = e.dropdown.querySelector(".dd__calendar");
                if (!t) return !1;
                (t.innerHTML = ""), (e.CSCHEMA = {});
                var n = c(e.date);
                if (
                    (t.appendChild(d.createCalendar(e, { date: n })),
                    d.isDoubleView(e))
                ) {
                    var o = s(n);
                    o.setMonth(o.getMonth() + 1),
                        (o = c(o)),
                        t.appendChild(d.createCalendar(e, { date: o }));
                }
            }),
            (d.prepareOutput = function (e) {
                return e.options.range
                    ? {
                          a: d.output(e, {
                              input: e.range ? s(e.range.a) : e.selected,
                          }),
                          b: d.output(e, {
                              input: e.range
                                  ? s(e.range.b || e.range.a)
                                  : e.selected,
                          }),
                      }
                    : d.output(e);
            }),
            (d.save = function (e, t) {
                e.options.range ? d.saveValues(e) : d.saveValue(e),
                    e.options.onChange &&
                        e.options.onChange({
                            trigger: e.trigger,
                            dropdown: e.dropdown,
                            output: d.prepareOutput(e),
                        }),
                    t &&
                        e.options.onSubmit &&
                        e.options.onSubmit({
                            trigger: e.trigger,
                            dropdown: e.dropdown,
                            output: d.prepareOutput(e),
                        });
            }),
            (d.checkoutDay = function (e, d) {
                return (
                    e.options.checkout &&
                        ((d = s(d)).setDate(d.getDate() + 1), (d = c(d))),
                    d
                );
            }),
            (d.saveValues = function (e) {
                e.range &&
                    ["a", "b"].forEach(function (t, n) {
                        var o = e.range[t] || d.checkoutDay(e, e.range.a);
                        if (
                            o &&
                            (d.els.forEach(function (e) {
                                var d =
                                    "data-dd-opt-range-" +
                                    ("a" == t ? "start" : "end");
                                e.setAttribute(d, l(o));
                            }),
                            2 == d.els.length && d.els[n])
                        ) {
                            var a = d.output(e, { input: s(o) });
                            v(d.els[n], a), h(d.els[n], a.string);
                        }
                    });
            }),
            (d.saveValue = function (e) {
                var t = d.output(e);
                v(e.trigger, t),
                    h(e.trigger, t.string),
                    e.options.changeValueTo &&
                        h(
                            document.querySelector(e.options.changeValueTo),
                            t.string
                        );
            }),
            (d.change = function (e, t) {
                e.dropdown &&
                    (d.fillBlocks(e, { input: e.date }),
                    e.options.expandable && e.expanded && d.calendar(e)),
                    d.valid(e)
                        ? (d.locked(e, !1), e.options.autoFill && d.save(e))
                        : d.locked(e, !0),
                    t &&
                        e.expanded &&
                        e.options.onRender &&
                        e.options.onRender(e.CSCHEMA);
            }),
            (d.valid = function (e, d) {
                if (!(d = d || e.selected)) return d;
                var t = !0,
                    n = e.options.enabledDays,
                    o = e.options.disabledDays;
                t && !n && o && (t = !m({ date: d, arr: r(o) })),
                    t && !o && n && (t = m({ date: d, arr: r(n) }));
                var i = e.options.maxDate,
                    l = e.options.minDate;
                t && l && (t = a(d) >= a(l)), t && i && (t = a(d) <= a(i));
                var s = e.options.disabledWeekDays;
                return t && s && (t = !s.includes(d.getDay())), t;
            }),
            (d.loopSet = function (e, d) {
                var t = !e.options.loopAll;
                switch (d) {
                    case "y":
                        t = t || !e.options.loopYears;
                        break;
                    case "m":
                        t = t || !e.options.loopMonths;
                        break;
                    case "d":
                        t = t || !e.options.loopDays;
                }
                return t;
            }),
            (d.lockedLoop = function (e, n, o) {
                var a = !0,
                    r = c(e.date);
                switch (n) {
                    case "y":
                        a =
                            d.loopSet(e, "y") &&
                            r.y == (o ? e.options.maxYear : e.options.minYear);
                        break;
                    case "m":
                        a = d.loopSet(e, "m") && r.m == (o ? 12 : 1);
                        break;
                    case "d":
                        a = d.loopSet(e, "d") && r.d == (o ? t(r.y, r.m) : 1);
                }
                return a;
            }),
            (d.move = function (e, t, n) {
                var o = e.date,
                    a = n ? 1 : -1;
                if (d.lockedLoop(e, t, n)) return !1;
                switch (t) {
                    case "y":
                        o.setFullYear(o.getFullYear() + a);
                        break;
                    case "m":
                        o.setMonth(o.getMonth() + a);
                        break;
                    case "d":
                        o.setDate(o.getDate() + a);
                }
                (o = d.fixDate(e, { input: o })),
                    e.expanded || (e.selected = new Date(p(e.date))),
                    d.change(e, !0);
            }),
            (d.isDoubleView = function (e) {
                return e.options.doubleView && window.innerWidth > 768
                    ? (e.dropdown.classList.add("dd-doubleView"), !0)
                    : (e.dropdown.classList.remove("dd-doubleView"), !1);
            }),
            (d.weekend = function (e, d) {
                return e.options.highlightWeekend && [0, 6].includes(d);
            }),
            (d.fillBlocks = function (e) {
                var t = d.output(e, { input: e.date }),
                    n = t.M;
                if (e.expanded && d.isDoubleView(e)) {
                    var o = new Date(p(e.date));
                    o.setMonth(o.getMonth() + 1),
                        (n = n + " - " + (o = d.output(e, { input: o })).M);
                }
                var a = {
                    y: "<div>" + t.y + "</div>",
                    m: "<div>" + n + "</div>",
                    d:
                        "<div>" +
                        t.dd +
                        "</div><div " +
                        (d.weekend(e, t.w) ? 'class="dd-w"' : "") +
                        '">' +
                        t.WW +
                        "</div>",
                };
                e.options.blocks.forEach(function (d) {
                    e.dropdown.querySelector(
                        '.dd__block[data-key="' + d + '"] .dd__view'
                    ).innerHTML = a[d];
                });
            }),
            (d.monthDialog = function (e) {
                d.dialog(e, {
                    onDom: function (t) {
                        for (var n = 0; n <= 11; n++)
                            t.appendChild(
                                d.monthDialogItem(e, {
                                    dialog: t,
                                    value: n,
                                    timeout: 50 * n,
                                })
                            );
                    },
                });
            }),
            (d.monthDialogItem = function (e, t) {
                var n = d.lang(e);
                return d.dialogItem(e, {
                    class: "dd__item dd-hidden",
                    html: n.m.s[t.value],
                    timeout: t.timeout,
                    onClick: function () {
                        d.setDate(e, { m: t.value + 1 }, !0),
                            d.change(e, !0),
                            d.exitDialog(e, t.dialog);
                    },
                });
            }),
            (d.yearDialogLoop = function (e, t) {
                var n = 0;
                if (!t.init) {
                    var o = d.dialogItem(e, {
                        html: "...",
                        class: "dd__item dd-hidden",
                        timeout: 0,
                        onClick: function () {
                            d.exitDialog(e, t.dialog), d.yearDialog(e);
                        },
                    });
                    t.dialog.appendChild(o);
                }
                for (var a = t.min; a <= t.max; a++)
                    if (!t.multiple || (t.multiple && a % t.multiple == 0)) {
                        var r = d.yearDialogItem(e, {
                            dialog: t.dialog,
                            value: a,
                            init: t.init,
                            timeout: 50 * n,
                        });
                        t.dialog.appendChild(r), n++;
                    }
            }),
            (d.yearDialog = function (e) {
                d.dialog(e, {
                    onDom: function (t) {
                        d.yearDialogLoop(e, {
                            min: e.options.minYear,
                            max: e.options.maxYear,
                            multiple: e.options.jump,
                            dialog: t,
                            init: !0,
                        });
                    },
                });
            }),
            (d.yearDialogItem = function (e, t) {
                return d.dialogItem(e, {
                    html: t.value,
                    class: "dd__item dd-hidden",
                    timeout: t.timeout,
                    onClick: function () {
                        t.init
                            ? ((t.dialog.innerHTML = ""),
                              (t.dialog.scrollTop = 0),
                              d.yearDialogLoop(e, {
                                  min: t.value,
                                  max: t.value + 10,
                                  dialog: t.dialog,
                              }))
                            : (d.setDate(e, { y: t.value }, !0),
                              d.change(e, !0),
                              d.exitDialog(e, t.dialog));
                    },
                });
            }),
            (d.setDate = function (e, d, t) {
                var n = c(e.selected || e.date);
                (e.selected = new Date(
                    (d.y || n.y) + "/" + (d.m || n.m) + "/" + (d.d || n.d)
                )),
                    (!t && e.expanded) || (e.date = new Date(p(e.selected)));
            }),
            (d.dialogItem = function (e, d) {
                var t = w("div", { class: d.class, html: d.html });
                return (
                    d.onClick && t.addEventListener("click", d.onClick),
                    setTimeout(function () {
                        t.classList.add("dd-shown");
                    }, d.timeout || 0),
                    t
                );
            }),
            (d.dialog = function (e, t) {
                var n = w("div", { class: "dd__dialog dd-hidden" });
                t.onDom && t.onDom(n);
                var o = w("div", { class: "dd__footer" });
                o.addEventListener("click", function () {
                    d.exitDialog(e, n);
                }),
                    n.appendChild(o),
                    e.dropdown.appendChild(n),
                    e.dropdown.classList.add("dd--dialog-shown"),
                    setTimeout(function () {
                        n.classList.add("dd-shown");
                    }, 50);
            }),
            (d.exitDialog = function (e, d) {
                e.dropdown.classList.remove("dd--dialog-shown"), f(d);
            }),
            (d.dropdown = function (e) {
                if (
                    ((e.dropdown = w("div", {
                        class:
                            "dd__dropdown dd-hidden " +
                            (e.options.customClass || "") +
                            (e.options.showArrowsOnHover
                                ? " dd-arw-hover"
                                : "") +
                            (d.inline ? " dd-inline" : ""),
                        id: "datedropper",
                    })),
                    e.options.overlay &&
                        ((e.overlay = w("div", {
                            class: "dd__overlay dd-hidden",
                        })),
                        document.body.appendChild(e.overlay)),
                    e.options.blocks.forEach(function (t) {
                        d.block(e, t);
                    }),
                    !d.inline)
                ) {
                    var t = w("div", { class: "dd__footer" });
                    e.dropdown.appendChild(t),
                        (e.primaryButton = w("div", {
                            class: "dd__primaryButton",
                            html: d.svg("checkmark"),
                        })),
                        e.primaryButton.addEventListener("click", function () {
                            d.save(e, !0), d.exit(e);
                        }),
                        t.appendChild(e.primaryButton);
                }
                if (e.options.expandable) {
                    if (!e.options.expandedOnly && !d.inline) {
                        var n = w("div", {
                            class: "dd__expandButton",
                            html: e.expanded
                                ? d.svg("reduce")
                                : d.svg("expand"),
                        });
                        n.addEventListener("click", function () {
                            d.toggleView(e);
                        }),
                            e.dropdown.appendChild(n);
                    }
                    if (
                        ((e.expanded =
                            !(
                                void 0 !== e.expanded ||
                                !e.options.expandedDefault
                            ) || e.expanded),
                        e.expanded)
                    ) {
                        e.dropdown.classList.add("dd-expanded"),
                            d.isDoubleView(e);
                        var o = e.dropdown.querySelector("[data-key=d]");
                        if (o) {
                            var a = w("div", { class: "dd__calendar" });
                            o.parentNode.insertBefore(a, o);
                        }
                    }
                }
                d.inline
                    ? ((e.trigger.innerHTML = ""),
                      e.trigger.appendChild(e.dropdown))
                    : (e.trigger.classList.add("dd-focused"),
                      document.body.appendChild(e.dropdown)),
                    (e.onResize = function (t) {
                        if (
                            (d.inline || d.offset(e),
                            e.expanded && e.options.doubleView)
                        ) {
                            var n =
                                e.dropdown.classList.contains("dd-doubleView");
                            ((window.innerWidth < 768 && n) ||
                                (window.innerWidth > 768 && !n)) &&
                                e.trigger.datedropper("show");
                        }
                    }),
                    window.addEventListener("resize", e.onResize),
                    d.inline
                        ? (e.onResize(), e.dropdown.classList.add("dd-shown"))
                        : ((e.onBlur = function (t) {
                              (t = t || window.event).target == e.trigger ||
                                  t.target == e.dropdown ||
                                  e.dropdown.contains(t.target) ||
                                  d.exit(e);
                          }),
                          document.addEventListener("mousedown", e.onBlur),
                          setTimeout(function () {
                              e.onResize(),
                                  e.dropdown.classList.add("dd-shown"),
                                  e.overlay &&
                                      e.overlay.classList.add("dd-shown"),
                                  e.options.onDropdownOpen &&
                                      e.options.onDropdownOpen({
                                          trigger: e.trigger,
                                          dropdown: e.dropdown,
                                          output: d.prepareOutput(e),
                                      });
                          }, 50));
            }),
            (d.svg = function (e) {
                return (
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">' +
                    {
                        arrowLeft: '<path d="M16 21l-9-9 9-9"/>',
                        arrowRight: '<path d="M7 21l9-9-9-9"/>',
                        checkmark:
                            '<path d="M2.998 11.049l6.965 6.942 11.035-11"/>',
                        close: '<path d="M5.5 5.5l13 13M18.5 5.5l-13 13"/>',
                        expand: '<g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-width="2"><path stroke-linecap="square" d="M19 5l-4.643 4.643"/><path d="M12 4h8v8"/><path stroke-linecap="square" d="M5 19l4.643-4.643"/><path d="M12 20H4v-8"/></g>',
                        reduce: '<g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-width="2"><path stroke-linecap="square" d="M4 21l6-6"/><path d="M3 14h8v8"/><path stroke-linecap="square" d="M21 3l-6 6"/><g><path d="M22 10h-8V2"/></g></g>',
                    }[e] +
                    "</svg>"
                );
            }),
            (d.exit = function (e) {
                d.inline ||
                    (f(e.dropdown),
                    f(e.overlay),
                    (e.dropdown = !1),
                    e.options.onDropdownExit &&
                        e.options.onDropdownExit({
                            trigger: e.trigger,
                            dropdown: e.dropdown,
                            output: d.prepareOutput(e),
                        }),
                    document.removeEventListener("mousedown", e.onBlur),
                    window.removeEventListener("resize", e.onResize),
                    e.trigger.classList.remove("dd-focused"));
            }),
            e.fetch();
    };
    var e = document.createElement("style"),
        d =
            ':root{--dd-overlay:rgba(0,0,0,.75);--dd-background:#FFFFFF;--dd-text1:#333333;--dd-text2:#FFFFFF;--dd-primary:#FD4741;--dd-gradient:linear-gradient(45deg,#e61e68 0%,#FD4741 100%);--dd-radius:.35em;--dd-shadow:0 0 2.5em rgba(0,0,0,0.1);--dd-range:rgba(0,0,0,0.05);--dd-monthBackground:var(--dd-gradient);--dd-monthText:var(--dd-text2);--dd-monthBorder:transparent;--dd-confirmButtonBackground:var(--dd-gradient);--dd-confirmButtonText:var(--dd-text2);--dd-selectedBackground:var(--dd-gradient);--dd-selectedText:var(--dd-text2);--dd-borderColor:rgba(0,0,0,0.1)}@keyframes dd-rumble{0%,to{transform:translate3d(0,0,0)}10%,30%,50%,70%,90%{transform:translate3d(-2px,0,0)}20%,40%,60%,80%{transform:translate3d(2px,0,0)}}.dd-theme-translucent{--dd-background:#ffffff03;--dd-text1:#ffffff;--dd-text2:var(--dd-background);--dd-primary:#7CD259;--dd-primaryBackground:var(--dd-primary);--dd-shadow:0 0 0 1px rgba(255,255,255,0.1),0 0 2.5em rgba(0,0,0,0.1);--dd-range:#7CD25920;--dd-monthBackground:var(--dd-background);--dd-monthText:var(--dd-text1 );--dd-monthBorder:rgba(0,0,0,0.1);--dd-confirmButtonBackground:var(--dd-primaryBackground);--dd-confirmButtonText:#222;--dd-selectedBackground:var(--dd-primaryBackground);--dd-selectedText:#222;-webkit-backdrop-filter:blur(0.5rem);backdrop-filter:blur(0.5rem)}.dd-theme-translucent .dd__dialog{background-color:rgba(255,255,255,0.025)}.dd-theme-translucent .dd__dialog .dd__item{background-color:rgba(0,0,0,0.1)}.dd-theme-translucent .dd__dialog .dd__item:hover{background-color:rgba(0,0,0,0.2)}.dd-theme-translucent .dd__block,.dd-theme-translucent .dd__calendar,.dd-theme-translucent .dd__footer{transition:filter 0.4s ease}.dd-theme-translucent.dd--dialog-shown .dd__block,.dd-theme-translucent.dd--dialog-shown .dd__calendar,.dd-theme-translucent.dd--dialog-shown .dd__footer{filter:blur(1rem)}.dd-theme-bootstrap{--dd-background:#f8f9fa;--dd-text1:#212529;--dd-text2:var(--dd-background);--dd-primary:#0d6efd;--dd-primaryBackground:var(--dd-primary);--dd-shadow:0 0 0 1px rgba(0,0,0,0.1),0 0 2.5em rgba(0,0,0,0.1);--dd-range:#0d6efd20;--dd-monthBackground:var(--dd-background);--dd-monthText:var(--dd-text1 );--dd-monthBorder:rgba(0,0,0,0.1);--dd-confirmButtonBackground:var(--dd-primaryBackground);--dd-confirmButtonText:var(--dd-text2);--dd-selectedBackground:var(--dd-primaryBackground);--dd-selectedText:var(--dd-text2)}.dd-theme-dark{--dd-background:#2f2f2f;--dd-text1:#ffffff;--dd-text2:#ffffff;--dd-primary:#505050;--dd-range:rgba(0,0,0,0.2)}.dd-rumble{animation:dd-rumble 0.4s ease}.dd-hidden{transition:opacity 0.6s cubic-bezier(0.165,0.84,0.44,1),pointer-events 0.6s cubic-bezier(0.165,0.84,0.44,1),visibility 0.6s cubic-bezier(0.165,0.84,0.44,1),transform 0.6s cubic-bezier(0.165,0.84,0.44,1),width 0.6s cubic-bezier(0.165,0.84,0.44,1),top 0.6s cubic-bezier(0.165,0.84,0.44,1),left 0.6s cubic-bezier(0.165,0.84,0.44,1);opacity:0;pointer-events:none;visibility:hidden;will-change:opacity,visibility,transform}.dd-shown{opacity:1;pointer-events:auto;visibility:visible}.dd-w{color:var(--dd-primary)}.dd__block{position:relative;font-weight:bold;z-index:1;display:flex;align-items:center;justify-content:center}.dd__block[data-key=m]{font-weight:normal;background:var(--dd-monthBackground);color:var(--dd-monthText);border-bottom:1px solid var(--dd-monthBorder);border-top-left-radius:var(--dd-radius);border-top-right-radius:var(--dd-radius)}.dd__block[data-key=m] .dd__view>div{font-size:2em}.dd__block[data-key=d]{border-bottom:1px solid var(--dd-borderColor)}.dd__block[data-key=d] .dd__view{padding:0.75rem 0.35em}.dd__block[data-key=d] .dd__view>div:first-of-type{font-size:5em;line-height:0.65;margin-bottom:0.125em}.dd__block[data-key=d] .dd__view>div:last-of-type{font-size:1.15em}.dd__block[data-key=y] .dd__view>div{font-size:1.5em}.dd__block:hover .dd__nav{opacity:0.5;visibility:visible;pointer-events:auto}.dd__block:hover .dd__nav:hover{opacity:1}.dd__block:hover .dd__view{background-color:rgba(0,0,0,0.05)}.dd__view{padding:0.35em;margin:0.25em;border-radius:0.35em;flex:1;cursor:pointer}.dd__nav{position:absolute;top:50%;transform:translateY(-50%);display:flex;padding:1em;cursor:pointer;width:35%;z-index:1}.dd__nav.dd-left{left:0}.dd__nav.dd-right{right:0;justify-content:flex-end}.dd__nav svg{width:1em;fill:none;fill-rule:evenodd;stroke:currentColor;stroke-width:3px;transition:stroke-width 0.6s cubic-bezier(0.165,0.84,0.44,1);will-change:stroke-width}.dd__nav:hover svg{stroke-width:5px}.dd__primaryButton{width:3.5em;height:3.5em;display:flex;align-items:center;justify-content:center;border-top-left-radius:2em;border-top-right-radius:2em;transition:transform 0.6s cubic-bezier(0.165,0.84,0.44,1);will-change:box-shadow,transform;position:relative;margin:0;outline:0;border-bottom:0;background:var(--dd-confirmButtonBackground);color:var(--dd-confirmButtonText);background-size:150% 150%;background-position:center;overflow:hidden}.dd__primaryButton svg{fill:none;fill-rule:evenodd;stroke:currentColor;stroke-width:3px;transition:stroke-width 0.6s cubic-bezier(0.165,0.84,0.44,1);will-change:stroke-width;color:currentColor;width:2em}.dd__primaryButton:before{content:"";pointer-events:none;position:absolute;top:0;left:0;background-color:black;width:100%;height:100%;transition:opacity 0.6s cubic-bezier(0.165,0.84,0.44,1);opacity:0;z-index:-1}.dd__primaryButton:not([disabled]){cursor:pointer}.dd__primaryButton[disabled]{background:rgba(0,0,0,0.075);color:var(--dd-text1);pointer-events:none}.dd__primaryButton:not([disabled]):hover{transform:translateY(0.35em)}.dd__primaryButton:not([disabled]):hover:before{opacity:0.25}.dd-selecting .dd__calendar div:not(.dd-perEnd) .dd-starting:not(.dd-selected),.dd-selecting .dd__calendar div:not(.dd-perEnd) .dd-starting~.dd__item:not(.dd-selecting~.dd__item):not(.dd-b~.dd__item),.dd-selecting .dd__calendar div:not(.dd-perStart) .dd-starting:not(.dd-selected),.dd-selecting .dd__calendar div:not(.dd-perStart) .dd-starting~.dd__item:not(.dd-selecting~.dd__item):not(.dd-b~.dd__item){background-color:var(--dd-range)}.dd-selecting .dd__calendar div.dd-perEnd .dd-selected~.dd__item,.dd-selecting .dd__calendar div.dd-perStart .dd__item:first-of-type~.dd__item{background-color:var(--dd-range)}.dd__calendar{display:flex;position:relative;border-bottom:1px solid var(--dd-borderColor)}.dd__calendar>div{display:flex;flex-direction:column;transform-origin:top center;padding:0.5rem}.dd__calendar .dd__item{flex:0 0 14.2857142857%;max-width:14.2857142857%;padding:0.5em 0.65em;position:relative}.dd__calendar .dd__item,.dd__calendar .dd__item .dd-value{display:flex;align-items:center;justify-content:center;position:relative}.dd__calendar .dd__item .dd-value{font-size:0.9em}.dd__calendar .dd__item .dd-color{position:absolute;height:0.5rem;width:2rem;opacity:0.25;border-radius:0.35rem;z-index:-1}.dd__calendar .dd__item[data-dd-tooltip]:after{content:attr(data-dd-tooltip);pointer-events:none;position:absolute;box-shadow:0 0 0.5rem rgba(0,0,0,0.1);border-radius:0.35rem;background-color:var(--dd-text1);color:var(--dd-background);padding:0.5rem 1rem;top:100%;left:50%;transform:translateX(-50%) translateY(-0.5rem);z-index:2;opacity:0;visibility:hidden;transition:opacity 0.6s cubic-bezier(0.165,0.84,0.44,1),pointer-events 0.6s cubic-bezier(0.165,0.84,0.44,1),visibility 0.6s cubic-bezier(0.165,0.84,0.44,1),transform 0.6s cubic-bezier(0.165,0.84,0.44,1)}.dd__calendar .dd__item[data-dd-tooltip]:hover:after{transform:translateX(-50%) translateY(0);opacity:1;visibility:visible}.dd__calendar .dd__body,.dd__calendar .dd__header{display:flex;align-items:center;flex-wrap:wrap}.dd__calendar .dd__header{flex-shrink:0;margin-bottom:0.5rem;border-bottom:1px solid var(--dd-borderColor)}.dd__calendar .dd__header>div{opacity:0.5}.dd__calendar .dd__body{flex:1 1 auto}.dd__calendar .dd__body .dd__item{padding:0.85em 0.5em;margin-bottom:0.25rem}.dd__calendar .dd__body .dd__item:before{width:3.25em;height:3.25em;content:"";border-radius:3.25em;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);border:1px solid transparent}.dd__calendar .dd__body .dd__item.dd-selected{color:var(--dd-selectedText);position:relative;z-index:1}.dd__calendar .dd__body .dd__item.dd-selected:before{background:var(--dd-selectedBackground);background-size:150% 150%;background-position:center}.dd__calendar .dd__body .dd__item.dd-selected .dd-value{transform:scale(1.35);opacity:1;font-weight:bold}.dd__calendar .dd__body .dd__item.dd-selected.dd-a:not(.dd-b){background-color:var(--dd-range);border-top-left-radius:3.25em;border-bottom-left-radius:3.25em}.dd__calendar .dd__body .dd__item.dd-selected.dd-b:not(.dd-a){background-color:var(--dd-range);border-top-right-radius:3.25em;border-bottom-right-radius:3.25em}.dd__calendar .dd__body .dd__item:not(.dd-selected).dd-disabled .dd-value{text-decoration:line-through;opacity:0.5}.dd__calendar .dd__body .dd__item:not(.dd-selected):not(.dd-disabled){cursor:pointer}.dd__calendar .dd__body .dd__item:not(.dd-selected):not(.dd-disabled).dd-placeholder .dd-value{opacity:0.5}.dd__calendar .dd__body .dd__item:not(.dd-selected):not(.dd-disabled).dd-point{background-color:var(--dd-range)}.dd__calendar .dd__body .dd__item:not(.dd-selected):not(.dd-disabled):not(.dd-selected).dd-today{text-decoration:underline}.dd__calendar .dd__body .dd__item:not(.dd-selected):not(.dd-disabled):not(.dd-selected).dd-weekend{color:var(--dd-primary)}.dd__calendar .dd__body .dd__item:not(.dd-selected):not(.dd-disabled):not(.dd-selected):hover .dd-value{opacity:1;transform:scale(1.35)}.dd__calendar .dd__body .dd__item:not(.dd-selected):not(.dd-disabled):not(.dd-selected):hover:before{border-color:currentColor;border-style:dashed}.dd__dialog{position:absolute;top:0;left:0;width:100%;height:100%;overflow-y:auto;display:flex;flex-wrap:wrap;align-items:inherit;padding:0.25em;border-radius:var(--dd-radius);background-color:var(--dd-background);z-index:2;transform:translateY(1em)}.dd__dialog .dd__item{flex:0 0 46%;max-width:46%;margin:2%;border-radius:0.35em;padding:1em;font-size:1.25em;font-weight:bold;background-color:rgba(0,0,0,0.05);cursor:pointer;display:flex;align-items:center;justify-content:center;border:1px solid transparent;transform:translateY(1em)}.dd__dialog .dd__item.dd-shown{transform:translateY(0)}.dd__dialog .dd__item:hover{background-color:rgba(0,0,0,0.1)}.dd__dialog.dd-shown{transform:translateY(0)}.dd__expandButton{position:absolute;bottom:0.5em;right:0.5em;width:2.5em;height:2.5em;display:flex;align-items:center;justify-content:center;border-radius:0.35em;background-color:var(--dd-background);box-shadow:0 0 1em rgba(0,0,0,0.15);transition:box-shadow 0.6s cubic-bezier(0.165,0.84,0.44,1),transform 0.6s cubic-bezier(0.165,0.84,0.44,1);cursor:pointer}.dd__expandButton:hover{box-shadow:0 0 0.5em rgba(0,0,0,0.2);transform:scale(0.95)}.dd__expandButton:active{transform:scale(0.9)}.dd__overlay{position:fixed;top:0;left:0;z-index:1;width:100%;height:100%;z-index:2147483646;background-color:var(--dd-overlay)}.dd-preset-onlyMonth .dd__block[data-key=m],.dd-preset-onlyMonth .dd__header,.dd-preset-onlyYear .dd__block[data-key=m],.dd-preset-onlyYear .dd__header{background:var(--dd-background);color:var(--dd-text1)}.dd__dropdown{background-color:var(--dd-background);color:var(--dd-text1);border-radius:var(--dd-radius);box-shadow:var(--dd-shadow);margin:0;padding:0;list-style:none;font-size:16px}.dd__dropdown,.dd__dropdown *{box-sizing:border-box;-webkit-user-select:none;user-select:none;font-family:"Helvetica Neue",sans-serif;-webkit-tap-highlight-color:transparent;text-align:center;touch-action:manipulation;line-height:1.2}.dd__dropdown>.dd__footer{display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden}.dd__dropdown.dd-inline{min-width:16em}.dd__dropdown:not(.dd-inline){position:absolute;z-index:2147483647;width:11em;transform:translateY(-1em) translateX(-50%)}.dd__dropdown:not(.dd-inline).dd-shown{transform:translateY(0) translateX(-50%)}@media (max-height:480px),(max-width:480px){.dd__dropdown:not(.dd-inline){position:fixed!important;top:50%!important;left:50%!important;transform:translate(-50%,-50%)!important}}.dd__dropdown:not(.dd-inline).dd-expanded{width:20em}.dd__dropdown:not(.dd-inline).dd-expanded.dd-doubleView{width:40em}.dd__dropdown:not(.dd-inline).dd-expanded.dd-doubleView .dd__calendar>div{flex:0 0 50%}.dd__dropdown:not(.dd-arw-hover) .dd__nav{opacity:0.5;visibility:visible}.dd__dropdown.dd-expanded.dd-doubleView .dd-placeholder{opacity:0;visibility:hidden;pointer-events:none}.dd__dropdown.dd-expanded.dd-doubleView .dd__calendar>div:last-of-type{box-shadow:inset 1px 0 var(--dd-borderColor)}.dd__dropdown.dd-expanded [data-key=d]{display:none}';
    (e.type = "text/css"),
        e.styleSheet
            ? (e.styleSheet.cssText = d)
            : e.appendChild(document.createTextNode(d)),
        document.head.appendChild(e);
})();

!(function (e, t) {
    "object" == typeof exports && "undefined" != typeof module
        ? (module.exports = t())
        : "function" == typeof define && define.amd
        ? define(t)
        : (e.AOS = t());
})(this, function () {
    "use strict";
    var e =
            "undefined" != typeof window
                ? window
                : "undefined" != typeof global
                ? global
                : "undefined" != typeof self
                ? self
                : {},
        t = "Expected a function",
        n = NaN,
        o = "[object Symbol]",
        i = /^\s+|\s+$/g,
        a = /^[-+]0x[0-9a-f]+$/i,
        r = /^0b[01]+$/i,
        c = /^0o[0-7]+$/i,
        s = parseInt,
        u = "object" == typeof e && e && e.Object === Object && e,
        d = "object" == typeof self && self && self.Object === Object && self,
        l = u || d || Function("return this")(),
        f = Object.prototype.toString,
        m = Math.max,
        p = Math.min,
        b = function () {
            return l.Date.now();
        };
    function v(e, n, o) {
        var i,
            a,
            r,
            c,
            s,
            u,
            d = 0,
            l = !1,
            f = !1,
            v = !0;
        if ("function" != typeof e) throw new TypeError(t);
        function y(t) {
            var n = i,
                o = a;
            return (i = a = void 0), (d = t), (c = e.apply(o, n));
        }
        function h(e) {
            var t = e - u;
            return void 0 === u || t >= n || t < 0 || (f && e - d >= r);
        }
        function k() {
            var e = b();
            if (h(e)) return x(e);
            s = setTimeout(
                k,
                (function (e) {
                    var t = n - (e - u);
                    return f ? p(t, r - (e - d)) : t;
                })(e)
            );
        }
        function x(e) {
            return (s = void 0), v && i ? y(e) : ((i = a = void 0), c);
        }
        function O() {
            var e = b(),
                t = h(e);
            if (((i = arguments), (a = this), (u = e), t)) {
                if (void 0 === s)
                    return (function (e) {
                        return (d = e), (s = setTimeout(k, n)), l ? y(e) : c;
                    })(u);
                if (f) return (s = setTimeout(k, n)), y(u);
            }
            return void 0 === s && (s = setTimeout(k, n)), c;
        }
        return (
            (n = w(n) || 0),
            g(o) &&
                ((l = !!o.leading),
                (r = (f = "maxWait" in o) ? m(w(o.maxWait) || 0, n) : r),
                (v = "trailing" in o ? !!o.trailing : v)),
            (O.cancel = function () {
                void 0 !== s && clearTimeout(s),
                    (d = 0),
                    (i = u = a = s = void 0);
            }),
            (O.flush = function () {
                return void 0 === s ? c : x(b());
            }),
            O
        );
    }
    function g(e) {
        var t = typeof e;
        return !!e && ("object" == t || "function" == t);
    }
    function w(e) {
        if ("number" == typeof e) return e;
        if (
            (function (e) {
                return (
                    "symbol" == typeof e ||
                    ((function (e) {
                        return !!e && "object" == typeof e;
                    })(e) &&
                        f.call(e) == o)
                );
            })(e)
        )
            return n;
        if (g(e)) {
            var t = "function" == typeof e.valueOf ? e.valueOf() : e;
            e = g(t) ? t + "" : t;
        }
        if ("string" != typeof e) return 0 === e ? e : +e;
        e = e.replace(i, "");
        var u = r.test(e);
        return u || c.test(e) ? s(e.slice(2), u ? 2 : 8) : a.test(e) ? n : +e;
    }
    var y = function (e, n, o) {
            var i = !0,
                a = !0;
            if ("function" != typeof e) throw new TypeError(t);
            return (
                g(o) &&
                    ((i = "leading" in o ? !!o.leading : i),
                    (a = "trailing" in o ? !!o.trailing : a)),
                v(e, n, { leading: i, maxWait: n, trailing: a })
            );
        },
        h = "Expected a function",
        k = NaN,
        x = "[object Symbol]",
        O = /^\s+|\s+$/g,
        j = /^[-+]0x[0-9a-f]+$/i,
        E = /^0b[01]+$/i,
        N = /^0o[0-7]+$/i,
        z = parseInt,
        C = "object" == typeof e && e && e.Object === Object && e,
        A = "object" == typeof self && self && self.Object === Object && self,
        q = C || A || Function("return this")(),
        L = Object.prototype.toString,
        T = Math.max,
        M = Math.min,
        S = function () {
            return q.Date.now();
        };
    function D(e) {
        var t = typeof e;
        return !!e && ("object" == t || "function" == t);
    }
    function H(e) {
        if ("number" == typeof e) return e;
        if (
            (function (e) {
                return (
                    "symbol" == typeof e ||
                    ((function (e) {
                        return !!e && "object" == typeof e;
                    })(e) &&
                        L.call(e) == x)
                );
            })(e)
        )
            return k;
        if (D(e)) {
            var t = "function" == typeof e.valueOf ? e.valueOf() : e;
            e = D(t) ? t + "" : t;
        }
        if ("string" != typeof e) return 0 === e ? e : +e;
        e = e.replace(O, "");
        var n = E.test(e);
        return n || N.test(e) ? z(e.slice(2), n ? 2 : 8) : j.test(e) ? k : +e;
    }
    var $ = function (e, t, n) {
            var o,
                i,
                a,
                r,
                c,
                s,
                u = 0,
                d = !1,
                l = !1,
                f = !0;
            if ("function" != typeof e) throw new TypeError(h);
            function m(t) {
                var n = o,
                    a = i;
                return (o = i = void 0), (u = t), (r = e.apply(a, n));
            }
            function p(e) {
                var n = e - s;
                return void 0 === s || n >= t || n < 0 || (l && e - u >= a);
            }
            function b() {
                var e = S();
                if (p(e)) return v(e);
                c = setTimeout(
                    b,
                    (function (e) {
                        var n = t - (e - s);
                        return l ? M(n, a - (e - u)) : n;
                    })(e)
                );
            }
            function v(e) {
                return (c = void 0), f && o ? m(e) : ((o = i = void 0), r);
            }
            function g() {
                var e = S(),
                    n = p(e);
                if (((o = arguments), (i = this), (s = e), n)) {
                    if (void 0 === c)
                        return (function (e) {
                            return (
                                (u = e), (c = setTimeout(b, t)), d ? m(e) : r
                            );
                        })(s);
                    if (l) return (c = setTimeout(b, t)), m(s);
                }
                return void 0 === c && (c = setTimeout(b, t)), r;
            }
            return (
                (t = H(t) || 0),
                D(n) &&
                    ((d = !!n.leading),
                    (a = (l = "maxWait" in n) ? T(H(n.maxWait) || 0, t) : a),
                    (f = "trailing" in n ? !!n.trailing : f)),
                (g.cancel = function () {
                    void 0 !== c && clearTimeout(c),
                        (u = 0),
                        (o = s = i = c = void 0);
                }),
                (g.flush = function () {
                    return void 0 === c ? r : v(S());
                }),
                g
            );
        },
        W = function () {};
    function P(e) {
        e &&
            e.forEach(function (e) {
                var t = Array.prototype.slice.call(e.addedNodes),
                    n = Array.prototype.slice.call(e.removedNodes);
                if (
                    (function e(t) {
                        var n = void 0,
                            o = void 0;
                        for (n = 0; n < t.length; n += 1) {
                            if ((o = t[n]).dataset && o.dataset.aos) return !0;
                            if (o.children && e(o.children)) return !0;
                        }
                        return !1;
                    })(t.concat(n))
                )
                    return W();
            });
    }
    function Y() {
        return (
            window.MutationObserver ||
            window.WebKitMutationObserver ||
            window.MozMutationObserver
        );
    }
    var _ = {
            isSupported: function () {
                return !!Y();
            },
            ready: function (e, t) {
                var n = window.document,
                    o = new (Y())(P);
                (W = t),
                    o.observe(n.documentElement, {
                        childList: !0,
                        subtree: !0,
                        removedNodes: !0,
                    });
            },
        },
        B = function (e, t) {
            if (!(e instanceof t))
                throw new TypeError("Cannot call a class as a function");
        },
        F = (function () {
            function e(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var o = t[n];
                    (o.enumerable = o.enumerable || !1),
                        (o.configurable = !0),
                        "value" in o && (o.writable = !0),
                        Object.defineProperty(e, o.key, o);
                }
            }
            return function (t, n, o) {
                return n && e(t.prototype, n), o && e(t, o), t;
            };
        })(),
        I =
            Object.assign ||
            function (e) {
                for (var t = 1; t < arguments.length; t++) {
                    var n = arguments[t];
                    for (var o in n)
                        Object.prototype.hasOwnProperty.call(n, o) &&
                            (e[o] = n[o]);
                }
                return e;
            },
        K =
            /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i,
        G =
            /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i,
        J =
            /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i,
        Q =
            /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i;
    function R() {
        return navigator.userAgent || navigator.vendor || window.opera || "";
    }
    var U = new ((function () {
            function e() {
                B(this, e);
            }
            return (
                F(e, [
                    {
                        key: "phone",
                        value: function () {
                            var e = R();
                            return !(!K.test(e) && !G.test(e.substr(0, 4)));
                        },
                    },
                    {
                        key: "mobile",
                        value: function () {
                            var e = R();
                            return !(!J.test(e) && !Q.test(e.substr(0, 4)));
                        },
                    },
                    {
                        key: "tablet",
                        value: function () {
                            return this.mobile() && !this.phone();
                        },
                    },
                    {
                        key: "ie11",
                        value: function () {
                            return (
                                "-ms-scroll-limit" in
                                    document.documentElement.style &&
                                "-ms-ime-align" in
                                    document.documentElement.style
                            );
                        },
                    },
                ]),
                e
            );
        })())(),
        V = function (e, t) {
            var n = void 0;
            return (
                U.ie11()
                    ? (n = document.createEvent("CustomEvent")).initCustomEvent(
                          e,
                          !0,
                          !0,
                          { detail: t }
                      )
                    : (n = new CustomEvent(e, { detail: t })),
                document.dispatchEvent(n)
            );
        },
        X = function (e) {
            return e.forEach(function (e, t) {
                return (function (e, t) {
                    var n = e.options,
                        o = e.position,
                        i = e.node,
                        a =
                            (e.data,
                            function () {
                                e.animated &&
                                    ((function (e, t) {
                                        t &&
                                            t.forEach(function (t) {
                                                return e.classList.remove(t);
                                            });
                                    })(i, n.animatedClassNames),
                                    V("aos:out", i),
                                    e.options.id &&
                                        V("aos:in:" + e.options.id, i),
                                    (e.animated = !1));
                            });
                    n.mirror && t >= o.out && !n.once
                        ? a()
                        : t >= o.in
                        ? e.animated ||
                          ((function (e, t) {
                              t &&
                                  t.forEach(function (t) {
                                      return e.classList.add(t);
                                  });
                          })(i, n.animatedClassNames),
                          V("aos:in", i),
                          e.options.id && V("aos:in:" + e.options.id, i),
                          (e.animated = !0))
                        : e.animated && !n.once && a();
                })(e, window.pageYOffset);
            });
        },
        Z = function (e) {
            for (
                var t = 0, n = 0;
                e && !isNaN(e.offsetLeft) && !isNaN(e.offsetTop);

            )
                (t += e.offsetLeft - ("BODY" != e.tagName ? e.scrollLeft : 0)),
                    (n +=
                        e.offsetTop - ("BODY" != e.tagName ? e.scrollTop : 0)),
                    (e = e.offsetParent);
            return { top: n, left: t };
        },
        ee = function (e, t, n) {
            var o = e.getAttribute("data-aos-" + t);
            if (void 0 !== o) {
                if ("true" === o) return !0;
                if ("false" === o) return !1;
            }
            return o || n;
        },
        te = function (e, t) {
            return (
                e.forEach(function (e, n) {
                    var o = ee(e.node, "mirror", t.mirror),
                        i = ee(e.node, "once", t.once),
                        a = ee(e.node, "id"),
                        r = t.useClassNames && e.node.getAttribute("data-aos"),
                        c = [t.animatedClassName]
                            .concat(r ? r.split(" ") : [])
                            .filter(function (e) {
                                return "string" == typeof e;
                            });
                    t.initClassName && e.node.classList.add(t.initClassName),
                        (e.position = {
                            in: (function (e, t, n) {
                                var o = window.innerHeight,
                                    i = ee(e, "anchor"),
                                    a = ee(e, "anchor-placement"),
                                    r = Number(ee(e, "offset", a ? 0 : t)),
                                    c = a || n,
                                    s = e;
                                i &&
                                    document.querySelectorAll(i) &&
                                    (s = document.querySelectorAll(i)[0]);
                                var u = Z(s).top - o;
                                switch (c) {
                                    case "top-bottom":
                                        break;
                                    case "center-bottom":
                                        u += s.offsetHeight / 2;
                                        break;
                                    case "bottom-bottom":
                                        u += s.offsetHeight;
                                        break;
                                    case "top-center":
                                        u += o / 2;
                                        break;
                                    case "center-center":
                                        u += o / 2 + s.offsetHeight / 2;
                                        break;
                                    case "bottom-center":
                                        u += o / 2 + s.offsetHeight;
                                        break;
                                    case "top-top":
                                        u += o;
                                        break;
                                    case "bottom-top":
                                        u += o + s.offsetHeight;
                                        break;
                                    case "center-top":
                                        u += o + s.offsetHeight / 2;
                                }
                                return u + r;
                            })(e.node, t.offset, t.anchorPlacement),
                            out:
                                o &&
                                (function (e, t) {
                                    window.innerHeight;
                                    var n = ee(e, "anchor"),
                                        o = ee(e, "offset", t),
                                        i = e;
                                    return (
                                        n &&
                                            document.querySelectorAll(n) &&
                                            (i =
                                                document.querySelectorAll(
                                                    n
                                                )[0]),
                                        Z(i).top + i.offsetHeight - o
                                    );
                                })(e.node, t.offset),
                        }),
                        (e.options = {
                            once: i,
                            mirror: o,
                            animatedClassNames: c,
                            id: a,
                        });
                }),
                e
            );
        },
        ne = function () {
            var e = document.querySelectorAll("[data-aos]");
            return Array.prototype.map.call(e, function (e) {
                return { node: e };
            });
        },
        oe = [],
        ie = !1,
        ae = {
            offset: 120,
            delay: 0,
            easing: "ease",
            duration: 400,
            disable: !1,
            once: !1,
            mirror: !1,
            anchorPlacement: "top-bottom",
            startEvent: "DOMContentLoaded",
            animatedClassName: "aos-animate",
            initClassName: "aos-init",
            useClassNames: !1,
            disableMutationObserver: !1,
            throttleDelay: 99,
            debounceDelay: 50,
        },
        re = function () {
            return document.all && !window.atob;
        },
        ce = function () {
            arguments.length > 0 &&
                void 0 !== arguments[0] &&
                arguments[0] &&
                (ie = !0),
                ie &&
                    ((oe = te(oe, ae)),
                    X(oe),
                    window.addEventListener(
                        "scroll",
                        y(function () {
                            X(oe, ae.once);
                        }, ae.throttleDelay)
                    ));
        },
        se = function () {
            if (((oe = ne()), de(ae.disable) || re())) return ue();
            ce();
        },
        ue = function () {
            oe.forEach(function (e, t) {
                e.node.removeAttribute("data-aos"),
                    e.node.removeAttribute("data-aos-easing"),
                    e.node.removeAttribute("data-aos-duration"),
                    e.node.removeAttribute("data-aos-delay"),
                    ae.initClassName &&
                        e.node.classList.remove(ae.initClassName),
                    ae.animatedClassName &&
                        e.node.classList.remove(ae.animatedClassName);
            });
        },
        de = function (e) {
            return (
                !0 === e ||
                ("mobile" === e && U.mobile()) ||
                ("phone" === e && U.phone()) ||
                ("tablet" === e && U.tablet()) ||
                ("function" == typeof e && !0 === e())
            );
        };
    return {
        init: function (e) {
            return (
                (ae = I(ae, e)),
                (oe = ne()),
                ae.disableMutationObserver ||
                    _.isSupported() ||
                    (console.info(
                        '\n      aos: MutationObserver is not supported on this browser,\n      code mutations observing has been disabled.\n      You may have to call "refreshHard()" by yourself.\n    '
                    ),
                    (ae.disableMutationObserver = !0)),
                ae.disableMutationObserver || _.ready("[data-aos]", se),
                de(ae.disable) || re()
                    ? ue()
                    : (document
                          .querySelector("body")
                          .setAttribute("data-aos-easing", ae.easing),
                      document
                          .querySelector("body")
                          .setAttribute("data-aos-duration", ae.duration),
                      document
                          .querySelector("body")
                          .setAttribute("data-aos-delay", ae.delay),
                      -1 === ["DOMContentLoaded", "load"].indexOf(ae.startEvent)
                          ? document.addEventListener(
                                ae.startEvent,
                                function () {
                                    ce(!0);
                                }
                            )
                          : window.addEventListener("load", function () {
                                ce(!0);
                            }),
                      "DOMContentLoaded" === ae.startEvent &&
                          ["complete", "interactive"].indexOf(
                              document.readyState
                          ) > -1 &&
                          ce(!0),
                      window.addEventListener(
                          "resize",
                          $(ce, ae.debounceDelay, !0)
                      ),
                      window.addEventListener(
                          "orientationchange",
                          $(ce, ae.debounceDelay, !0)
                      ),
                      oe)
            );
        },
        refresh: ce,
        refreshHard: se,
    };
});
