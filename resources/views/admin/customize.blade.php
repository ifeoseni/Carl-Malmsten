@extends('admin.layouts.admin')
@section('title', 'Customize Page')

@section('content')
    @php $fields = $tabs[$active]['fields']; @endphp

    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px">
        <h1 class="page">Customize Page</h1>
        <div style="display:flex;gap:8px">
            <button type="button" class="button" id="previewBtn">👁 Live preview</button>
            <a class="button" href="{{ route('home') }}" target="_blank">Open site ↗</a>
        </div>
    </div>

    <nav class="tabs">
        @foreach($tabs as $key => $tab)
            <a href="{{ route('admin.customize', ['tab' => $key]) }}" class="{{ $key === $active ? 'on' : '' }}">{{ $tab['label'] }}</a>
        @endforeach
    </nav>

    <div class="split" id="split">
        <div class="editor">
            <form class="postbox" method="POST" action="{{ route('admin.customize.update', $active) }}" enctype="multipart/form-data">
                @csrf
                <h2>{{ $tabs[$active]['label'] }}</h2>
                <div class="inside">
                    <table class="form-table">
                        @foreach($fields as $key => $f)
                            @php $value = \App\Models\SiteSetting::get($key); @endphp
                            <tr>
                                <th><label for="f_{{ $key }}">{{ $f['label'] }}</label></th>
                                <td>
                                    @switch($f['type'])
                                        @case('textarea')
                                            <textarea id="f_{{ $key }}" name="{{ $key }}" rows="3">{{ old($key, $value) }}</textarea>
                                            @break
                                        @case('color')
                                            <div style="display:flex;gap:10px;align-items:center">
                                                <input type="color" id="f_{{ $key }}" name="{{ $key }}" value="{{ old($key, $value) }}" style="width:54px;height:36px;padding:2px;border:1px solid #8c8f94;border-radius:4px">
                                                <code>{{ $value }}</code>
                                            </div>
                                            @break
                                        @case('image')
                                            @if($value)<img class="imgprev" src="{{ preg_match('#^https?://#', $value) ? $value : asset($value) }}" alt="">@endif
                                            <input type="file" id="f_{{ $key }}" name="{{ $key }}" accept="image/*">
                                            <label style="display:block;margin-top:6px"><input type="checkbox" name="reset_{{ $key }}" value="1"> Reset to the original image</label>
                                            @break
                                        @default
                                            <input type="{{ $f['type'] === 'url' ? 'text' : 'text' }}" id="f_{{ $key }}" name="{{ $key }}" value="{{ old($key, $value) }}">
                                    @endswitch
                                    @isset($f['help'])<p class="desc">{{ $f['help'] }}</p>@endisset
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <p style="margin-top:14px;padding-top:14px;border-top:1px solid #f0f0f1"><button class="button button-primary" type="submit">Save changes</button></p>
                </div>
            </form>
        </div>

        <aside class="preview" id="preview">
            <div class="pbar">
                <strong>Live preview</strong>
                <span>
                    <button type="button" data-w="100%" class="on">Desktop</button>
                    <button type="button" data-w="768px">Tablet</button>
                    <button type="button" data-w="390px">Phone</button>
                </span>
                <button type="button" id="reloadBtn">↻ Refresh</button>
            </div>
            <div class="pframe"><iframe id="frame" title="Site preview" data-src="{{ route('home') }}"></iframe></div>
        </aside>
    </div>
@endsection

@section('scripts')
<script>
    (function () {
        var split = document.getElementById('split'), frame = document.getElementById('frame'), KEY = 'carl_preview_open';
        function set(on) {
            split.classList.toggle('preview-on', on);
            if (on && !frame.src) frame.src = frame.dataset.src;
            try { localStorage.setItem(KEY, on ? '1' : '0'); } catch (e) {}
        }
        document.getElementById('previewBtn').addEventListener('click', function () { set(!split.classList.contains('preview-on')); });
        document.getElementById('reloadBtn').addEventListener('click', function () { frame.src = frame.dataset.src; });
        document.querySelectorAll('.pbar [data-w]').forEach(function (b) {
            b.addEventListener('click', function () {
                frame.style.width = b.dataset.w;
                document.querySelectorAll('.pbar [data-w]').forEach(function (x) { x.classList.toggle('on', x === b); });
            });
        });
        try { if (localStorage.getItem(KEY) === '1') set(true); } catch (e) {}
    })();
</script>
@endsection
