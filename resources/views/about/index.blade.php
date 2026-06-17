@extends('layouts.main')


@section('seo_title', '')
@section('seo_description', '')
@section('seo_keywords', '')


@section('content')

    <!-- /#page -->
    <div id="wrapper">
        <div id="page" class="clearfix">

            <!-- Main Page Title -->
            <div class="tf-page-title mt-10">
                <div class="themesflat-container full">
                    <div class="page-title t-al-center">
                        <span>Save up to 15%</span>
                        <h1 class="main-title">Seller Profile</h1>
                    </div>
                </div>
            </div>
            <!-- End Page Title -->

            <div class="widget-dealer-single">
                <div class="themesflat-container">
                    <div class="dealer-single">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="seller-profile">

                                    <div class="dealer-author-content">
                                        <div class="dealer-author-item">
                                            <div class="dealer-author-icon">
                                                <i class="icon-Group-14"></i>
                                            </div>
                                            <div class="dealer-content-info-box">
                                                <p class="label-dealer-content">Телефон</p>
                                                <span class="dealer-title"> {{ $settings->phone }} </span>
                                            </div>
                                        </div>

                                        <div class="dealer-author-item">
                                            <div class="dealer-author-icon">
                                                <i class="icon-Group2"></i>
                                            </div>
                                            <div class="dealer-content-info-box">
                                                <p class="label-dealer-content"> Email</p>
                                                <a class="dealer-title" href="mailto: {{ $settings->email }}">
                                                    {{ $settings->email }}
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mb-60">
                            <div class="col-xl-9 col-md-12">
                                <div class="dealer-description mb-60">
                                    <h3 class="dealer-title mb-25">О компании</h3>
                                    <p>
                                        О компании
                                    </p>
                                </div>

                            </div>

                    </div>
                </div>
            </div>


        </div>

    </div>
    <!-- /#page -->

    <!-- Button Top -->
    <a id="scroll-top" class="button-go"></a>
    <!-- Button Top -->

@endsection

