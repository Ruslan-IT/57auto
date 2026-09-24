@extends('layouts.main')

@section('seo_title', $page->title . ' — Intercar')
@section('seo_description', $page->title)
@section('seo_keywords', '')

@section('content')
    <div id="wrapper">
        <div id="page" class="clearfix">
            <div class="tf-page-title mt-10">
                <div class="themesflat-container full">
                    <div class="page-title t-al-center">
                        <span>Intercar</span>
                        <h1 class="main-title">{{ $page->title }}</h1>
                    </div>
                </div>
            </div>

            <div class="flat-blog-list main-content">
                <div class="themesflat-container w1320">
                    <div class="legal-container">
                        <div class="legal-section">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
