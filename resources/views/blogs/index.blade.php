@extends('layouts.main')

@section('seo_title', 'Блог — Intercar')
@section('seo_description', 'Статьи об автомобилях из Китая и Кореи, доставке и выборе машины.')
@section('seo_keywords', 'блог, автомобили из китая, автомобили из кореи')

@section('content')
    <div id="wrapper">
        <div id="page" class="clearfix">
            <div class="tf-page-title mt-10">
                <div class="themesflat-container full">
                    <div class="page-title t-al-center">
                        <span>Intercar</span>
                        <h1 class="main-title">Блог</h1>
                    </div>
                </div>
            </div>

            <div class="flat-blog-list main-content">
                <div class="themesflat-container w1320">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="flat-blog">
                                @forelse($posts as $post)
                                    <article class="entry format-standard">
                                        @if($post->imageUrl())
                                            <div class="feature-post">
                                                <a href="{{ route('blogs.show', $post->slug) }}">
                                                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}">
                                                </a>
                                            </div>
                                        @endif

                                        <div class="main-post">
                                            @if($post->published_at)
                                                <div class="entry-meta">
                                                    <span class="time line">
                                                        <i class="icon-uniE971"></i>
                                                        {{ $post->published_at->format('d.m.Y') }}
                                                    </span>
                                                </div>
                                            @endif
                                            <h2 class="entry-title">
                                                <a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a>
                                            </h2>
                                            @if(filled($post->excerpt))
                                                <p class="entry-des">{{ $post->excerpt }}</p>
                                            @endif
                                            <div class="btn-read-more">
                                                <a class="more-link" href="{{ route('blogs.show', $post->slug) }}">
                                                    <span>Читать далее</span>
                                                    <i class="icon-Path-90148"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                @empty
                                    <p>Пока нет опубликованных статей.</p>
                                @endforelse
                            </div>

                            @if($posts->hasPages())
                                <div class="tf-pagination mt-60">
                                    @if($posts->onFirstPage())
                                        <span class="prev page-numbers"><i class="icon-3"></i></span>
                                    @else
                                        <a class="prev page-numbers" href="{{ $posts->previousPageUrl() }}">
                                            <i class="icon-3"></i>
                                        </a>
                                    @endif

                                    @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                        @if($page == $posts->currentPage())
                                            <span class="page-numbers active">{{ $page }}</span>
                                        @else
                                            <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                                        @endif
                                    @endforeach

                                    @if($posts->hasMorePages())
                                        <a class="next page-numbers" href="{{ $posts->nextPageUrl() }}">
                                            <i class="icon--1"></i>
                                        </a>
                                    @else
                                        <span class="next page-numbers"><i class="icon--1"></i></span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            @include('blogs.partials.recent', ['recentPosts' => $recentPosts])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
