<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show {{ request()->routeIs('app.pos.*') ? 'c-sidebar-minimized' : '' }}" id="sidebar">
    <style>
        .c-sidebar-brand {
            justify-content: flex-start !important;
            padding-left: 1rem !important;
            background: transparent !important;
        }
        .c-sidebar-minimized .c-sidebar-brand {
            justify-content: center !important;
            padding-left: 0 !important;
        }
    </style>
    <div class="c-sidebar-brand d-md-down-none">
        <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none c-sidebar-brand-full">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" width="34" height="34">
            <span class="ml-2 text-white font-weight-bold" style="font-size: 1.15rem; letter-spacing: -0.3px;">Quant<span style="color: #4ade80;">ivo</span></span>
        </a>
        <a href="{{ route('home') }}" class="c-sidebar-brand-minimized">
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" width="30" height="30">
        </a>
    </div>
    <ul class="c-sidebar-nav">
        @include('layouts.menu')
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 692px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 369px;"></div>
        </div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
