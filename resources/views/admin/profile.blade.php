@extends('admin.layouts.admin')
@section('title', 'Profile')

@section('content')
    <h1 class="page">Profile & Password</h1>

    <form class="postbox" method="POST" action="{{ route('admin.profile.update') }}">
        @csrf @method('PUT')
        <h2>Your details</h2>
        <div class="inside">
            <table class="form-table">
                <tr><th><label for="name">Name</label></th><td><input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required></td></tr>
                <tr><th><label for="email">Email</label></th><td><input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required></td></tr>
            </table>
            <p><button class="button button-primary" type="submit">Update profile</button></p>
        </div>
    </form>

    <form class="postbox" method="POST" action="{{ route('admin.profile.password') }}">
        @csrf @method('PUT')
        <h2>Change password</h2>
        <div class="inside">
            <table class="form-table">
                <tr><th><label for="current_password">Current password</label></th><td><input type="password" id="current_password" name="current_password" required autocomplete="current-password"></td></tr>
                <tr><th><label for="password">New password</label></th><td><input type="password" id="password" name="password" required minlength="8" autocomplete="new-password"><p class="desc">At least 8 characters.</p></td></tr>
                <tr><th><label for="password_confirmation">Confirm new password</label></th><td><input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"></td></tr>
            </table>
            <p><button class="button button-primary" type="submit">Change password</button></p>
        </div>
    </form>
@endsection
