@extends('admin.layouts.admin')
@section('title', 'Service Cards')

@section('content')
    <h1 class="page">Service Cards</h1>
    <p class="desc" style="margin:-6px 0 14px;font-style:normal">The three columns under the hero (Individual, Couples, Men's work). Use a new line in the description to control where the text breaks.</p>

    <form method="POST" action="{{ route('admin.services.save') }}" enctype="multipart/form-data">
        @csrf
        <div id="cards">
            @foreach($cards as $card)
                @include('admin.partials.service-card', ['key' => $card->id, 'card' => $card])
            @endforeach
        </div>
        <p style="margin-bottom:16px"><button type="button" class="button" id="addCard">+ Add card</button></p>
        <p><button class="button button-primary" type="submit">Save service cards</button></p>
    </form>

    <template id="tpl">
        @include('admin.partials.service-card', ['key' => '__KEY__', 'card' => null])
    </template>
@endsection

@section('scripts')
<script>
    var n = 0, box = document.getElementById('cards');
    document.getElementById('addCard').addEventListener('click', function () {
        var html = document.getElementById('tpl').innerHTML.replace(/__KEY__/g, 'new_' + (++n));
        box.insertAdjacentHTML('beforeend', html);
        box.lastElementChild.querySelector('input[type=text]').focus();
    });
</script>
@endsection
