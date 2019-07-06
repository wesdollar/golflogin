<?php
use Illuminate\Support\Facades\Auth;
use App\Services\LayoutService;

$user = Auth::user();
$userName = $user->first_name . ' ' . $user->last_name;
$activeGroup = $user->activeGroup->first();
$mainMenuItems = LayoutService::mainNavItems();
?>

@include('back.shared.header')

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">
                {{ config('app.name') }}
            </a>
            <a class="navbar-brand hidden" href="./">
                <i class="fa fa-beer"></i>
            </a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @foreach ($mainMenuItems as $item)
                    <li<?= (isset($item['subNav']) > 0) ? ' class="menu-item-has-children dropdown"' : '' ?>>
                        <a href="{{ LayoutService::printHref($item['route']) }}"
                           @if (isset($item['subNav']))
                               class="dropdown-toggle"
                               data-toggle="dropdown"
                               aria-haspopup="true"
                               aria-expanded="true"
                           @endif>

                            <i class="menu-icon fa fa-{{ $item['icon'] }}"></i>
                            {{ $item['title'] }}
                        </a>

                        @if (isset($item['subNav']))
                            <ul class="sub-menu children dropdown-menu">
                                @foreach ($item['subNav'] as $subNav)
                                    <li>
                                        <i class="fa fa-{{ $subNav['icon'] }}"></i>
                                        <a href="{{ LayoutService::printHref($subNav['route']) }}">
                                            {{ $subNav['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div><!-- // .navbar-collapse -->
    </nav>
</aside><!-- // left-panel -->

<div id="right-panel" class="right-panel">
    <header id="header" class="header">
        <div class="header-menu">
            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left">
                    <i class="fa fa fa-hand-o-left"></i>
                </a>
                <div class="header-left">
                    @if(isset($showSearch) && $showSearch === true)
                        <button class="search-trigger">
                            <i class="fa fa-search"></i>
                        </button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    @endif

                    <h3>
                        {{ $activeGroup->title }}
                    </h3>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="user-area dropdown float-right" style="margin-top: 9px;">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">

                        {{ $userName }}
                        <i class="fa fa-caret-down" style="margin-left: 8px;"></i>
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="#">
                            <i class="fa fa-user"></i>
                            Edit Profile
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fa fa-cog"></i>
                            Settings
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fa fa-power-off"></i>
                            Logout
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="col-sm-12">

            @if (session('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert-success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('alert-error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('alert-error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('alert-info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('alert-info') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

        </div>
    </div>

    <div class="content mt-30">
        @yield('content')
    </div>
</div><!-- // right-panel -->

@include('back.shared.footer')