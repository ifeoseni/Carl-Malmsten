@extends('admin.layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <h1 class="page">Dashboard</h1>

    <div class="stats">
        <div class="stat"><b>{{ count($tabs) }}</b>Editable sections</div>
        <div class="stat"><b>{{ $serviceCount }}</b>Service cards</div>
        <div class="stat"><b>{{ $menuCount }}</b>Menu links</div>
    </div>

    <div class="postbox">
        <h2>Edit your website</h2>
        <div class="inside">
            <div class="grid2">
                @foreach($tabs as $key => $tab)
                    <a href="{{ route('admin.customize', ['tab' => $key]) }}">{{ $tab['label'] }}<span>{{ count($tab['fields']) }} fields</span></a>
                @endforeach
                <a href="{{ route('admin.services') }}">Service Cards<span>Individual, Couples, Men's work — icons, text, links</span></a>
                <a href="{{ route('admin.menus') }}">Menus<span>Header navigation, Book a Session button, footer links</span></a>
            </div>
        </div>
    </div>

    <div class="postbox">
        <h2>Quick tips</h2>
        <div class="inside">
            <p>Open <strong>Customize Page</strong> and switch on <em>Live preview</em> to edit text and photos while watching the site update in desktop, tablet and phone sizes.</p>
            <p style="margin-top:8px">The <em>Services</em>, <em>Approach</em> and <em>Book a Session</em> links currently point to “#”. When those pages exist, set their addresses under <a href="{{ route('admin.menus') }}">Menus</a>.</p>
        </div>
    </div>
@endsection
