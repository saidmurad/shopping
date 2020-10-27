/* https://telegram.org/js/games.js */
(function () {
    function g(a) { try { return decodeURIComponent(a) } catch (b) { return a } } function n(a, b, c) { b || (b = function () { }); void 0 === c && (c = ""); if (void 0 !== window.TelegramWebviewProxy) TelegramWebviewProxy.postEvent(a, c), b(); else if (window.external && "notify" in window.external) window.external.notify(JSON.stringify({ eventType: a, eventData: c })), b(); else if (k) try { var d = "https://web.telegram.org", d = "*"; window.parent.postMessage(JSON.stringify({ eventType: a, eventData: c }), d) } catch (e) { b(e) } else b({ notAvailable: !0 }) }
    function l(a, b) { var c = f[a]; if (void 0 !== c && c.length) for (var d = 0; d < c.length; d++)try { c[d](a, b) } catch (e) { } } var f = {}, m = ""; try { m = location.hash.toString() } catch (a) { } var h = function (a) { a = a.replace(/^#/, ""); var b = {}; if (!a.length) return b; if (0 > a.indexOf("=") && 0 > a.indexOf("?")) return b._path = g(a), b; var c = a.indexOf("?"); if (0 <= c) { var d = a.substr(0, c); b._path = g(d); a = a.substr(c + 1) } a = a.split("&"); for (var e, c = 0; c < a.length; c++)e = a[c].split("="), d = g(e[0]), e = null == e[1] ? null : g(e[1]), b[d] = e; return b }(m), k = !1; try {
        k = null !=
            window.parent && window != window.parent
    } catch (a) { } window.TelegramGameProxy_receiveEvent = l; window.TelegramGameProxy = { initParams: h, receiveEvent: l, onEvent: function (a, b) { void 0 === f[a] && (f[a] = []); -1 === f[a].indexOf(b) && f[a].push(b) }, shareScore: function () { n("share_score", function (a) { if (a && (a = h.tgShareScoreUrl || h.shareScoreUrl)) { var b = !1; try { b = window.open(a, "_blank") } catch (c) { b = !1 } b || (location.href = a) } }) } }
})();


/* Math Battle */
(function (P, p) {
    function f(a) { return "string" == typeof a ? p.getElementById(a) : a } function Q(a) { return (a || "").replace(/^[\s\uFEFF]+|[\s\uFEFF]+$/g, "") } function w(a, b) { return (a = f(a)) && (new RegExp("(\\s|^)" + b + "(\\s|$)")).test(a.className) } function q(a, b) { (a = f(a)) && !w(a, b) && (a.className = Q(a.className + " " + b)) } function u(a, b) { (a = f(a)) && w(a, b) && (a.className = Q(a.className.replace(new RegExp("(\\s+|^)" + b + "(\\s+|$)"), " "))) } function x(a, b, d) { ("undefined" == typeof d ? w(a, b) : !d) ? u(a, b) : q(a, b) } function m(a, b, d) {
        if (a =
            f(a), d = d || rf, a && 3 != a.nodeType && 8 != a.nodeType) { a.setInterval && a != P && (a = P); b = b.split(" "); for (var c = 0, ea = b.length; ea > c; c++) { var e = b[c]; a.addEventListener ? a.addEventListener(e, d, !1) : a.attachEvent && a.attachEvent("on" + e, d) } }
    } function h(a, b) { return Math.floor(Math.random() * (b - a + 1) + a) } function R() {
        var a, b, d, c, e, f; d = h(1, 4E3) % 4; f = 500 >= h(1, 1E3); hard = 30 < r; d = ["+", "\u2013", "\u00d7", "/"][d]; switch (d) {
            case "+": case "\u2013": "+" == d ? (a = h(hard ? 10 : 0, hard ? 200 : 100), b = h(hard ? 10 : 0, hard ? 200 : 100), e = a + b) : (e = h(hard ? 10 : 0, hard ?
                200 : 100), b = h(hard ? 10 : 0, hard ? 200 : 100), a = e + b); f || (c = Math.min(a, b), c = Math.min(c, e), (c = h(-c, c)) || c++, e = c + 100); break; case "\u00d7": case "/": "\u00d7" == d ? (a = h(hard ? 3 : 1, hard ? 20 : 10), b = h(hard ? 3 : 1, hard ? 20 : 10), e = a * b) : (e = h(hard ? 3 : 1, hard ? 20 : 10), b = h(hard ? 3 : 1, hard ? 20 : 10), a = e * b), f || (c = Math.min(a, b), c = Math.min(c, e), (c = h(-c, c)) || c++, e += c)
        }return { x: a, op: d, y: b, res: e, correct: f }
    } function S() { clearTimeout(D); T(!0); v && (D = setTimeout(S, 30)) } function T(a, b) { if (0 < t - +new Date) return E(b); clearTimeout(D); v = !1; a ? U() : E(b, function () { U() }) }
    function F() { var a = +r || "0"; fa.innerHTML = a; ga.innerHTML = a } function G() { k && (ha.innerHTML = +k.x || "0", ia.innerHTML = k.op || "", ja.innerHTML = +k.y || "0", ka.innerHTML = +k.res || "0") } function la() { clearTimeout(V); q(W, "tossing"); V = setTimeout(function () { u(W, "tossing") }, 350) } function E(a, b) { var d = (t - +new Date) / 1E4; 0 > d && (d = 0); 1 < d && (d = 1); a && (clearTimeout(X), q(H, "animated"), X = setTimeout(function () { u(H, "animated") }, 150)); H.style.right = 100 - 100 * d + "%"; b && setTimeout(b, 300) } function Y() {
        if (e && e.length) for (var a = 0; a < e.length; a++) {
            var b =
                e[a]; if (b.current) { Z = b.score; break }
        }
    } function I() { if (!1 !== e && l) { for (var a = "", b = 0; b < e.length; b++)var d = e[b], a = a + ('<li class="row' + (d.current ? " you" : "") + '"><span class="place">' + d.pos + '.</span><span class="score">' + d.score + '</span><div class="name">' + d.name + "</div></li>"); ma.innerHTML = a; 0 < e.length ? q(aa, "opened") : u(aa, "opened") } } function J() { x(K, "in_greet", !y); x(K, "in_game", !l); x(K, "in_result", l) } function L() { v = y = !0; l = !1; k = R(); t = +new Date + 1E4; r = 100; z = !1; S(); F(); G(); E(); J(); x(M, "shown", z) } function ba(a,
        b, d) { var c = new XMLHttpRequest, e = [], f; for (f in b) e.push(encodeURIComponent(f) + "=" + encodeURIComponent(b[f])); c.onreadystatechange = function () { 4 == c.readyState && 200 == c.status && d(JSON.parse(c.responseText)) }; c.open("POST", a, !0); c.send(e.join("&")) } function na() { n && ba("/api/setScore", { data: n, score: r || 0 }, function (a) { e = a.scores; Y(); I(); a["new"] && l && (z = !0, x(M, "shown", z)) }) } function ca() { n && ba("/api/getHighScores", { data: n }, function (a) { e = a.scores; Y(); I() }) } function U() {
            if (!l) {
                l = !0; a: {
                    var a = r; if (A && a) {
                        e || (e = []);
                        for (var b = 0, d = 0; d < e.length; d++) { var c = e[d]; if (c.current) { if (c.score >= a) break a; b = c.pos; break } } b || (b = c ? c.pos + 1 : 1, e.push({ pos: b, score: 0, name: A, current: !0 })); for (var f = !1, d = 0; d < e.length; d++)if (c = e[d], f) if (c.pos <= b) f.pos++, e[d] = f, f = c; else break; else a > c.score && (e[d] = { pos: c.pos, score: a, name: A, current: !0 }, f = c)
                    }
                } I(); r > Z ? na() : ca(); J()
            }
        } function B(a) { v && (!a === !k.correct ? (t += 1500, 1E4 < t - +new Date && (t = +new Date + 1E4), r++, F()) : (t -= 4E3, la()), T(!1, !a !== !k.correct), k = R(), G()) } function N(a) {
            q(a, "hover"); setTimeout(function () {
                u(a,
                    "hover")
            }, 100)
        } var t, D, y = !1, v = !1, l = !0, k, e = !1, r = 0, z, n = (location.hash || "").substr(1), n = n.replace(/[\?&].*/g, ""), Z = 0, A = !1; if (n) try { var C = decodeURIComponent(escape(atob(n))), A = JSON.parse(C.substr(0, C.length - 32)).n } catch (a) { } var fa = f("score_value"), ga = f("result_score_value"), M = f("score_share"), W = f("task"), ha = f("task_x"), ia = f("task_op"), ja = f("task_y"), ka = f("task_res"), H = f("timeline_progress"), ma = f("table"), aa = f("table_wrap"), K = f("page_wrap"), C = f("game_title"), O = f("button_correct"), da = f("button_wrong"),
            V, X; m(C, "click", function () { y || L() }); m(O, "click", function () { !y || l ? L() : B(!0) }); m(da, "click", function () { v && B(!1) }); m(M, "click", function () { z && TelegramGameProxy && TelegramGameProxy.shareScore() }); m(p, "keydown", function (a) { a.preventDefault(); a = a.which || a.keyCode; v ? (37 == a && (N(O), B(!0)), 39 == a && (N(da), B(!1))) : y && !l || 32 != a || (N(O), L()) }); F(); G(); J(); ca(); var g = {
                obj: null, start: function (a) { a.touches && 1 == a.touches.length && (g.end(a), g.obj = this || null, g.obj && q(g.obj, "hover")) }, cancel: function (a) { g.obj && g.end(a) }, end: function () {
                    g.obj &&
                        (u(g.obj, "hover"), g.obj = null, g.highlight = !1)
                }, check: function (a) { if (!a) return !1; do if (w(a, "button") || w(a, "score_share")) return a; while (a = a.parentNode); return !1 }
            }; m(p, "touchmove touchcancel", g.cancel); m(p, "touchend", g.end); m(p, "touchstart", function (a) { var b = g.check(a.target); b && g.start.call(b, a) }); "ontouchstart" in p || q(p.body, "_hover")
})(window, document);
