console.log('sure...');

/*<![CDATA[*/
/*@shinsenter/defer.js*/
! function(c, i, t) {
  var f, o = /^data-(.+)/,
    u = 'IntersectionObserver',
    r = /p/.test(i.readyState),
    s = [],
    a = s.slice,
    d = 'lazied',
    n = 'load',
    e = 'pageshow',
    l = 'forEach',
    m = 'hasAttribute',
    h = 'shift';

  function p(e) {
    i.head.appendChild(e)
  }

  function v(e, n) {
    a.call(e.attributes)[l](n)
  }

  function y(e, n, t, o) {
    return o = (o = n ? i.getElementById(n) : o) || i.createElement(e), n && (o.id = n), t && (o.onload = t), o
  }

  function b(e, n) {
    return a.call((n || i).querySelectorAll(e))
  }

  function g(t, e) {
    b('source', t)[l](g), v(t, function(e, n) {
      (n = o.exec(e.name)) && (t[n[1]] = e.value)
    }), e && (t.className += ' ' + e), n in t && t[n]()
  }

  function I(e) {
    f(function(o) {
      o = b(e || '[type=deferjs]'),
        function e(n, t) {
          (n = o[h]()) && (n.parentNode.removeChild(n), (t = y(n.nodeName)).text = n.text, v(n,
            function(e) {
              'type' != e.name && (t[e.name] = e.value)
            }), t.src && !t[m]('async') ? (t.onload = t.onerror = e, p(t)) : (p(t), e()))
        }()
    })
  }(f = function(e, n) {
    r ? t(e, n) : s.push(e, n)
  }).all = I, f.js = function(n, t, e, o) {
    f(function(e) {
      (e = y('SCRIPT', t, o)).src = n, p(e)
    }, e)
  }, f.css = function(n, t, e, o) {
    f(function(e) {
      (e = y('LINK', t, o)).rel = 'stylesheet', e.href = n, p(e)
    }, e)
  }, f.dom = function(e, n, t, o, i) {
    function r(e) {
      o && !1 === o(e) || g(e, t)
    }
    f(function(t) {
      t = u in c && new c[u](function(e) {
        e[l](function(e, n) {
          e.isIntersecting && (n = e.target) && (t.unobserve(n), r(n))
        })
      }, i), b(e || '[data-src]')[l](function(e) {
        e[m](d) || (e.setAttribute(d, ''), t ? t.observe(e) : r(e))
      })
    }, n)
  }, f.reveal = g, c.Defer = f, c.addEventListener('on' + e in c ? e : n, function() {
    for (I(); s[0]; t(s[h](), s[h]())) r = 1
  })
}(this, document, setTimeout),
function(e, n) {
  e.defer = n = e.Defer, e.deferscript = n.js, e.deferstyle = n.css, e.deferimg = e.deferiframe = n.dom
}(this);
'IntersectionObserver' in window || document.write(
  '<script src="https://polyfill.io/v3/polyfill.min.js?features=IntersectionObserver"><\/script>');

/* Javascript TimeAgo, source: coderwall.com/p/uub3pw/javascript-timeago-func-e-g-8-hours-ago */
    (function timeAgo(selector) {
        var templates = {
            prefix: "",
            suffix: " ago",
            seconds: "few seconds",
            minute: "a minute",
            minutes: "%d minutes",
            hour: "an hour",
            hours: "%d hours",
            day: "a day",
            days: "%d days",
            month: "a month",
            months: "%d months",
            year: "a year",
            years: "%d years"
        };
        var template = function(t, n) {
            return templates[t] && templates[t].replace(/%d/i, Math.abs(Math.round(n)));
        };
        var timer = function(time) {
            if (!time) return;
            time = time.replace(/\.\d+/, "");
            time = time.replace(/-/, "/").replace(/-/, "/");
            time = time.replace(/T/, " ").replace(/Z/, " UTC");
            time = time.replace(/([\+\-]\d\d)\:?(\d\d)/, " $1$2");
            time = new Date(time * 1000 || time);
            var now = new Date();
            var seconds = ((now.getTime() - time) * .001) >> 0;
            var minutes = seconds / 60;
            var hours = minutes / 60;
            var days = hours / 24;
            var years = days / 365;
            return templates.prefix + (seconds < 45 && template("seconds", seconds) || seconds < 90 && template("minute", 1) || minutes < 45 && template("minutes", minutes) || minutes < 90 && template("hour", 1) || hours < 24 && template("hours", hours) || hours < 42 && template("day", 1) || days < 30 && template("days", days) || days < 45 && template("month", 1) || days < 365 && template("months", days / 30) || years < 1.5 && template("year", 1) || template("years", years)) + templates.suffix;
        };
        var elements = document.getElementsByClassName("timeAgo");
        for (var i in elements) {
            var $this = elements[i];
            if (typeof $this === "object") {
                $this.innerHTML = timer($this.getAttribute("datetime") || $this.getAttribute("data-time"));
            };
        };
        setTimeout(timeAgo, 1000);
    })(); 

// Select the element to be lazy loaded
    /*<![CDATA[*/ function darkMode() {
    localStorage.setItem("mode", "darkmode" === localStorage.getItem("mode") ? "light" : "darkmode"), "darkmode" === localStorage.getItem("mode") ? document.querySelector("#mainCont").classList.add("drK") : document.querySelector("#mainCont").classList.remove("drK")
};

function headScroll() {
    const distanceY = window.pageYOffset || document.documentElement.scrollTop,
        shrinkOn = 40,
        commentEl = document.getElementById('header');
    if (distanceY > shrinkOn) {
        commentEl.classList.add("stick");
    } else {
        commentEl.classList.remove("stick");
    }
}
window.addEventListener('scroll', headScroll);

/* lazy youtube */
(function() {
    var youtube = document.querySelectorAll(".lazyYt");
    for (var i = 0; i < youtube.length; i++) {
        var source = "https://img.youtube.com/vi/" + youtube[i].dataset.embed + "/sddefault.jpg";
        var image = new Image();
        image.setAttribute("class", "lazy");
        image.setAttribute("data-src", source);
        image.setAttribute("src", "data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=");
        image.setAttribute("alt", "Youtube video");
        image.addEventListener("load", function() {
            youtube[i].appendChild(image);
        }(i));
        youtube[i].addEventListener("click", function() {
            var iframe = document.createElement("iframe");
            iframe.setAttribute("frameborder", "0");
            iframe.setAttribute("allowfullscreen", "");
            iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");
            this.innerHTML = "";
            this.appendChild(iframe);
        });
    };
})();
/* Lightbox image script, source: kompiajaib.com/2021/09/update-image-lightbox-dengan-css-dan.html */
for (var imageslazy = document.querySelectorAll('.pS .separator img, .pS .tr-caption-container img, .pS .psImg >img, .pS .btImg >img'), i = 0; i < imageslazy.length; i++) imageslazy[i].setAttribute('onclick', 'return false');

function wrap(o, t, e) {
    for (var i = document.querySelectorAll(t), c = 0; c < i.length; c++) {
        var a = o + i[c].outerHTML + e;
        i[c].outerHTML = a
    }
}
wrap('<div class="zmImg">', '.pS .separator >a', '</div>');
wrap('<div class="zmImg">', '.pS .tr-caption-container td >a', '</div>');
wrap('<div class="zmImg">', '.pS .separator >img', '</div>');
wrap('<div class="zmImg">', '.pS .tr-caption-container td >img', '</div>');
wrap('<div class="zmImg">', '.pS .psImg >img', '</div>');
wrap('<div class="zmImg">', '.pS .btImg >img', '</div>');
for (var containerimg = document.getElementsByClassName('zmImg'), i = 0; i < containerimg.length; i++) containerimg[i].onclick = function() {
    this.classList.toggle('s');
};
Defer.dom('.lazy', 100, 'loaded', null, {
    rootMargin: '1px'
}), 'undefined' != typeof infinite_scroll && infinite_scroll.on('load', function() {
    Defer.dom('.lazy', 100, 'loaded', null, {
        rootMargin: '1px'
    })
}); 
/*]]>*/