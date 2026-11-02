<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') ‹ Carl Malmsten — Admin</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <style>
        :root { --bar:#1d2327; --menu-hover:#2c3338; --bg:#f0f0f1; --text:#2c3338; --link:#2271b1; --link-hover:#135e96; --border:#c3c4c7; --bronze:#8a6d57; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--bg); color: var(--text); font: 13px/1.5 -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; }
        a { color: var(--link); }
        #bar { position: fixed; inset: 0 0 auto 0; height: 32px; background: var(--bar); color: #c3c4c7; display: flex; justify-content: space-between; align-items: center; z-index: 1000; padding-right: 12px; }
        #bar .group { display: flex; align-items: center; height: 100%; }
        #bar a, #bar button { color: #c3c4c7; text-decoration: none; padding: 0 10px; height: 32px; line-height: 32px; display: inline-flex; align-items: center; gap: 6px; background: none; border: 0; font: inherit; cursor: pointer; }
        #bar a:hover, #bar button:hover { background: var(--menu-hover); color: #72aee6; }
        #menu-toggle { display: none; }
        #side { position: fixed; top: 32px; left: 0; bottom: 0; width: 180px; background: var(--bar); overflow-y: auto; z-index: 900; padding-top: 8px; }
        #side a { display: flex; align-items: center; gap: 10px; padding: 9px 12px; color: #f0f0f1; text-decoration: none; font-size: 14px; }
        #side a:hover { background: var(--menu-hover); color: #72aee6; }
        #side a.active { background: var(--link); color: #fff; font-weight: 600; }
        #side svg { width: 18px; height: 18px; flex: none; opacity: .85; }
        #side .sep { height: 1px; background: #3c434a; margin: 8px 12px; }
        #content { margin-left: 180px; padding: 52px 20px 40px; min-height: 100vh; }
        .wrap { max-width: 1180px; }
        h1.page { font-size: 23px; font-weight: 400; margin: 6px 0 14px; }
        .notice { background: #fff; border-left: 4px solid #00a32a; box-shadow: 0 1px 1px rgba(0,0,0,.05); padding: 10px 14px; margin: 0 0 16px; font-weight: 600; }
        .notice.error { border-color: #d63638; }
        .postbox { background: #fff; border: 1px solid var(--border); box-shadow: 0 1px 1px rgba(0,0,0,.04); margin-bottom: 18px; }
        .postbox > h2 { font-size: 14px; padding: 10px 14px; border-bottom: 1px solid var(--border); background: #fafafa; }
        .inside { padding: 14px 18px; }
        .button { display: inline-flex; align-items: center; gap: 6px; font: inherit; min-height: 30px; padding: 0 12px; border: 1px solid #dcdcde; border-radius: 3px; background: #f6f7f7; color: var(--text); cursor: pointer; text-decoration: none; }
        .button:hover { border-color: #0a4b78; color: #0a4b78; background: #f0f0f1; }
        .button-primary { background: var(--link); border-color: var(--link); color: #fff; }
        .button-primary:hover { background: var(--link-hover); border-color: var(--link-hover); color: #fff; }
        .button-link-delete { color: #b32d2e; }
        input[type=text], input[type=url], input[type=email], input[type=password], input[type=number], textarea, select { width: 100%; padding: 7px 10px; border: 1px solid #8c8f94; border-radius: 4px; font: inherit; font-size: 14px; background: #fff; color: var(--text); }
        textarea { resize: vertical; min-height: 70px; line-height: 1.5; }
        input:focus, textarea:focus, select:focus { border-color: var(--link); box-shadow: 0 0 0 1px var(--link); outline: 0; }
        .form-table { width: 100%; border-collapse: collapse; }
        .form-table th { width: 200px; text-align: left; vertical-align: top; padding: 16px 12px 16px 0; font-size: 14px; }
        .form-table td { padding: 12px 0; vertical-align: top; }
        .form-table tr + tr { border-top: 1px solid #f0f0f1; }
        .desc { color: #646970; font-size: 12px; font-style: italic; margin-top: 5px; }
        .tabs { display: flex; flex-wrap: wrap; gap: 4px; border-bottom: 1px solid var(--border); margin-bottom: 16px; }
        .tabs a { padding: 8px 14px; background: #dcdcde; border: 1px solid var(--border); border-bottom: 0; color: #50575e; font-weight: 600; text-decoration: none; border-radius: 4px 4px 0 0; margin-bottom: -1px; }
        .tabs a:hover { background: #fff; color: var(--text); }
        .tabs a.on { background: #fff; color: var(--text); border-bottom: 1px solid #fff; }
        .list { width: 100%; border-collapse: collapse; }
        .list th, .list td { padding: 8px 10px; border-bottom: 1px solid #e0e0e0; text-align: left; vertical-align: top; }
        .list th { background: #fafafa; font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: .03em; color: #50575e; }
        .list .narrow { width: 70px; } .list .check { width: 70px; text-align: center; }
        .imgprev { display: block; max-width: 260px; max-height: 150px; border: 1px solid var(--border); background: #2b2d31; padding: 6px; margin-bottom: 8px; }
        .imgprev.icon { max-height: 56px; max-width: 120px; margin: 0 0 6px; }
        .split { display: flex; gap: 20px; align-items: flex-start; }
        .split .editor { flex: 1; min-width: 0; }
        .split.preview-on .editor { flex: 0 0 46%; max-width: 46%; }
        .preview { display: none; flex: 1; min-width: 0; position: sticky; top: 44px; height: calc(100vh - 60px); background: #1e1e1e; border-radius: 6px; flex-direction: column; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,.25); }
        .split.preview-on .preview { display: flex; }
        .preview .pbar { display: flex; justify-content: space-between; align-items: center; gap: 8px; background: #2c3338; padding: 8px 12px; color: #fff; font-size: 12px; flex-wrap: wrap; }
        .preview .pbar button { background: #1d2327; border: 0; color: #a7aaad; padding: 4px 10px; border-radius: 3px; cursor: pointer; font-size: 11px; }
        .preview .pbar button.on { background: var(--link); color: #fff; }
        .preview .pframe { flex: 1; display: flex; justify-content: center; background: #141618; padding: 8px 0; min-height: 0; }
        .preview iframe { width: 100%; height: 100%; border: 0; background: #fff; transition: width .25s; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 18px; }
        .stat { background: #fff; border: 1px solid var(--border); padding: 14px 18px; }
        .stat b { display: block; font-size: 26px; font-weight: 400; }
        .grid2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 10px; }
        .grid2 a { display: block; padding: 12px 14px; background: #f6f7f7; border: 1px solid var(--border); text-decoration: none; font-weight: 600; }
        .grid2 a:hover { background: #fff; border-color: var(--link); }
        .grid2 span { display: block; font-weight: 400; color: #646970; font-size: 12px; }
        @media (max-width: 960px) { .split.preview-on { flex-direction: column; } .split.preview-on .editor { flex: 1; max-width: none; width: 100%; } .preview { position: static; width: 100%; height: 520px; } }
        @media (max-width: 782px) {
            #menu-toggle { display: inline-flex; }
            #side { transform: translateX(-100%); transition: transform .2s; width: 220px; }
            body.menu-open #side { transform: none; }
            #content { margin-left: 0; padding: 52px 12px 30px; }
            .form-table, .form-table tbody, .form-table tr, .form-table th, .form-table td { display: block; width: 100%; }
            .form-table th { padding: 12px 0 2px; }
            .list { display: block; overflow-x: auto; white-space: nowrap; }
            #bar .hide-sm { display: none !important; }
        }
    </style>
    @yield('head')
</head>
<body>
    <div id="bar">
        <div class="group">
            <button id="menu-toggle" type="button" aria-label="Menu">☰</button>
            <a href="{{ route('admin.dashboard') }}"><strong>Carl Malmsten</strong></a>
            <a href="{{ route('home') }}" target="_blank" class="hide-sm">Visit site ↗</a>
            <a href="{{ route('admin.customize') }}" class="hide-sm">Customize</a>
        </div>
        <div class="group">
            <a href="{{ route('admin.profile') }}" class="hide-sm">Howdy, <strong>{{ Auth::user()->name }}</strong></a>
            <form action="{{ route('admin.logout') }}" method="POST">@csrf<button type="submit">Log out</button></form>
        </div>
    </div>

    <nav id="side" aria-label="Admin">
        @php
            $icons = [
                'dash' => '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>',
                'edit' => '<path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/>',
                'menu' => '<line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>',
                'card' => '<rect x="3" y="4" width="18" height="16" rx="2"/><line x1="3" y1="10" x2="21" y2="10"/>',
                'user' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
                'eye' => '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>',
            ];
            $nav = [
                ['admin.dashboard', 'Dashboard', 'dash', 'admin.dashboard'],
                ['admin.customize', 'Customize Page', 'edit', 'admin.customize*'],
                ['admin.services', 'Service Cards', 'card', 'admin.services*'],
                ['admin.menus', 'Menus', 'menu', 'admin.menus*'],
                ['admin.profile', 'Profile & Password', 'user', 'admin.profile*'],
            ];
        @endphp
        @foreach($nav as [$route, $label, $icon, $match])
            <a href="{{ route($route) }}" class="{{ request()->routeIs($match) ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icons[$icon] !!}</svg>{{ $label }}
            </a>
        @endforeach
        <div class="sep"></div>
        <a href="{{ route('home') }}" target="_blank"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">{!! $icons['eye'] !!}</svg>View website</a>
    </nav>

    <main id="content">
        <div class="wrap">
            @if(session('success'))<div class="notice">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="notice error">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>@endif
            @yield('content')
        </div>
    </main>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () { document.body.classList.toggle('menu-open'); });
        document.getElementById('content').addEventListener('click', function () { document.body.classList.remove('menu-open'); });
    </script>
    @yield('scripts')
</body>
</html>
