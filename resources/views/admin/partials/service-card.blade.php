@php $p = "items[$key]"; @endphp
<div class="postbox">
    <h2>{{ $card?->title ?? 'New card' }}</h2>
    <div class="inside">
        <table class="form-table">
            <tr><th>Title</th><td><input type="text" name="{{ $p }}[title]" value="{{ $card?->title }}" placeholder="Individual Work"></td></tr>
            <tr><th>Description</th><td><textarea name="{{ $p }}[description]" rows="2">{{ $card?->description }}</textarea></td></tr>
            <tr><th>Link address</th><td><input type="text" name="{{ $p }}[url]" value="{{ $card?->url ?? '#' }}"></td></tr>
            <tr>
                <th>Icon</th>
                <td>
                    @if($card && $card->iconUrl())<img class="imgprev icon" src="{{ $card->iconUrl() }}" alt="">@endif
                    <input type="file" name="{{ $p }}[icon_file]" accept="image/*">
                    <p class="desc">Transparent PNG, about 120px tall.</p>
                </td>
            </tr>
            <tr>
                <th>Display</th>
                <td style="display:flex;gap:20px;flex-wrap:wrap;align-items:center">
                    <label><input type="checkbox" name="{{ $p }}[is_active]" value="1" @checked($card?->is_active ?? true)> Visible</label>
                    <label>Order <input type="number" name="{{ $p }}[order]" value="{{ $card?->order ?? 99 }}" style="width:80px"></label>
                    @if($card)<label class="button-link-delete"><input type="checkbox" name="{{ $p }}[delete]" value="1"> Delete this card</label>@endif
                </td>
            </tr>
        </table>
    </div>
</div>
