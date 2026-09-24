@extends('layouts.main')

@section('seo_title', $post->title . ' — Intercar')
@section('seo_description', $post->excerpt ?: $post->title)
@section('seo_keywords', '')

@section('content')
    <div id="wrapper">
        <div id="page" class="clearfix">
            <div class="tf-page-title mt-10">
                <div class="themesflat-container full">
                    <div class="page-title t-al-center">
                        <span>Блог</span>
                        <h1 class="main-title">{{ $post->title }}</h1>
                    </div>
                </div>
            </div>

            <section class="flat-blog-list main-content">
                <div class="themesflat-container w1320">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="post-wrap">
                                <article class="entry format-standard-details">
                                    @if($post->imageUrl())
                                        <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="imge-blog-details mb-25">
                                    @endif
                                    @if($post->published_at)
                                        <div class="entry-meta horizontal">
                                            <span class="author line">
                                                <i class="icon-1"></i>
                                                {{ $post->published_at->format('d.m.Y') }}
                                            </span>
                                        </div>
                                    @endif
                                    <h2 class="entry-title mb-20">{{ $post->title }}</h2>
                                    <div class="blog-post-content">
                                        {!! $post->content !!}
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            @include('blogs.partials.recent', ['recentPosts' => $recentPosts])
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
