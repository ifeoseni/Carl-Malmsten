@extends('layouts.site')

@php use App\Models\SiteSetting as S; @endphp

@section('content')
<main>
    <section class="hero">
        <div class="hero-photo" style="background-image:url('{{ S::image('hero_image') }}')" role="img" aria-label="{{ S::get('brand_name') }}"></div>
        <div class="hero-inner">
            <div class="hero-copy">
                <h1>{!! nl2br(e(S::get('hero_title'))) !!}</h1>
                <p class="hero-text">{!! nl2br(e(S::get('hero_text'))) !!}</p>
                <hr class="hero-rule">
                <p class="hero-quote">{!! nl2br(e(S::get('hero_quote'))) !!}</p>
                <a href="{{ S::get('hero_cta_url') }}" class="btn btn-hero">{{ S::get('hero_cta_label') }}</a>
            </div>
        </div>
    </section>

    <section class="services" aria-label="Services">
        <div class="services-inner">
            @foreach($services as $card)
                <a href="{{ $card->url }}" class="service">
                    @if($icon = $card->iconUrl())
                        <img class="service-icon" src="{{ $icon }}" alt="">
                    @endif
                    <h2 class="service-title">{{ $card->title }}</h2>
                    <p class="service-text">{!! nl2br(e($card->description)) !!}<span class="arrow" aria-hidden="true">→</span></p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="about">
        <div class="about-inner">
            <div class="about-copy">
                <h2 class="about-title">{{ S::get('about_title') }}</h2>
                <p class="about-subtitle">{!! nl2br(e(S::get('about_subtitle'))) !!}</p>
                <p>{{ S::get('about_p1') }}</p>
                <p>{{ S::get('about_p2') }}</p>
            </div>
            <figure class="about-photo">
                <img src="{{ S::image('about_image') }}" alt="{{ S::get('about_image_alt') }}">
            </figure>
        </div>
    </section>

    <section class="closing">
        <blockquote>{{ S::get('quote_text') }}</blockquote>
        <a href="{{ S::get('quote_cta_url') }}" class="btn btn-closing">{{ S::get('quote_cta_label') }}</a>
    </section>
</main>
@endsection
