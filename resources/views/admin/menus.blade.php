@extends('admin.layouts.admin')
@section('title', 'Menus')

@section('content')
    <h1 class="page">Menus</h1>

    <form method="POST" action="{{ route('admin.menus.save') }}">
        @csrf
        @foreach(['header' => ['Header navigation', $header], 'footer' => ['Footer links', $footer]] as $loc => [$title, $items])
            <div class="postbox">
                <h2>{{ $title }}</h2>
                <div class="inside">
                    <table class="list" data-loc="{{ $loc }}">
                        <thead>
                            <tr><th>Label</th><th>Link address</th>@if($loc === 'header')<th class="check">Button</th>@endif<th class="check">Visible</th><th class="narrow">Order</th><th class="check">Delete</th></tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td><input type="text" name="items[{{ $item->id }}][label]" value="{{ $item->label }}"><input type="hidden" name="items[{{ $item->id }}][location]" value="{{ $loc }}"></td>
                                    <td><input type="text" name="items[{{ $item->id }}][url]" value="{{ $item->url }}" placeholder="/services or https://…"></td>
                                    @if($loc === 'header')<td class="check"><input type="checkbox" name="items[{{ $item->id }}][is_button]" value="1" @checked($item->is_button)></td>@endif
                                    <td class="check"><input type="checkbox" name="items[{{ $item->id }}][is_active]" value="1" @checked($item->is_active)></td>
                                    <td><input type="number" name="items[{{ $item->id }}][order]" value="{{ $item->order }}"></td>
                                    <td class="check"><input type="checkbox" name="items[{{ $item->id }}][delete]" value="1"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p style="margin-top:12px"><button type="button" class="button" data-add="{{ $loc }}">+ Add link</button></p>
                </div>
            </div>
        @endforeach
        <p><button class="button button-primary" type="submit">Save menus</button></p>
    </form>
@endsection

@section('scripts')
<script>
    var n = 0;
    document.querySelectorAll('[data-add]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var loc = btn.dataset.add, tbody = document.querySelector('table[data-loc="' + loc + '"] tbody'), k = 'new_' + (++n), p = 'items[' + k + ']';
            var tr = document.createElement('tr');
            tr.innerHTML = '<td><input type="text" name="' + p + '[label]" placeholder="Label"><input type="hidden" name="' + p + '[location]" value="' + loc + '"></td>' +
                '<td><input type="text" name="' + p + '[url]" value="#"></td>' +
                (loc === 'header' ? '<td class="check"><input type="checkbox" name="' + p + '[is_button]" value="1"></td>' : '') +
                '<td class="check"><input type="checkbox" name="' + p + '[is_active]" value="1" checked></td>' +
                '<td><input type="number" name="' + p + '[order]" value="' + (tbody.children.length + 1) + '"></td><td></td>';
            tbody.appendChild(tr);
            tr.querySelector('input[type=text]').focus();
        });
    });
</script>
@endsection
