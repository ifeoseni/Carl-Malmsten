(function () {
    var toggle = document.querySelector('.nav-toggle');
    var nav = document.getElementById('site-nav');
    if (!toggle || !nav) return;

    function set(open) {
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        nav.classList.toggle('open', open);
    }

    toggle.addEventListener('click', function () {
        set(toggle.getAttribute('aria-expanded') !== 'true');
    });
    nav.addEventListener('click', function (e) {
        if (e.target.closest('a')) set(false);
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') set(false);
    });
})();
