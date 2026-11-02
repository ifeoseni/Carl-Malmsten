<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in ‹ Carl Malmsten</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { min-height: 100vh; background: #2a2b2e; display: flex; align-items: center; justify-content: center; padding: 20px; font: 14px/1.5 -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; color: #2c3338; }
        .box { width: 100%; max-width: 360px; }
        .logo { text-align: center; margin-bottom: 20px; color: #e4d9ce; font-family: Georgia, serif; font-size: 24px; }
        .logo img { height: 70px; margin: 0 auto 10px; display: block; }
        form { background: #fff; padding: 26px; border-radius: 4px; box-shadow: 0 6px 24px rgba(0,0,0,.4); }
        label { display: block; font-weight: 600; margin: 0 0 4px; }
        input[type=email], input[type=password] { width: 100%; padding: 10px 12px; border: 1px solid #8c8f94; border-radius: 4px; font: inherit; margin-bottom: 16px; }
        input:focus { border-color: #2271b1; box-shadow: 0 0 0 1px #2271b1; outline: 0; }
        .row { display: flex; justify-content: space-between; align-items: center; }
        button { background: #2271b1; color: #fff; border: 0; padding: 9px 18px; border-radius: 3px; font: inherit; font-weight: 600; cursor: pointer; }
        button:hover { background: #135e96; }
        .err { background: #fcf0f1; border-left: 4px solid #d63638; padding: 8px 12px; margin-bottom: 16px; font-size: 13px; }
        .ok { background: #fff; border-left: 4px solid #00a32a; padding: 8px 12px; margin-bottom: 14px; font-size: 13px; }
        a.back { display: block; text-align: center; margin-top: 16px; color: #cbc2ba; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>
    <div class="box">
        <div class="logo"><img src="{{ asset(\App\Models\SiteSetting::get('logo')) }}" alt="">Carl Malmsten</div>
        @if(session('status'))<div class="ok">{{ session('status') }}</div>@endif
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            @if($errors->any())<div class="err">{{ $errors->first() }}</div>@endif
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
            <div class="row">
                <label style="font-weight:400;margin:0"><input type="checkbox" name="remember" value="1"> Remember me</label>
                <button type="submit">Log in</button>
            </div>
        </form>
        <a class="back" href="{{ route('home') }}">← Back to website</a>
    </div>
</body>
</html>
