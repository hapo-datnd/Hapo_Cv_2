@extends('layouts.app_admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Hello <b>{{ Auth::guard('admin')->user()->name}}</b> !</div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        This is Admin Manager Page!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('top-right')
    @if(!Auth::guard('admin')->check())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin_login_form') }}">{{ __('Login') }}</a>
        </li>
    @elseif(Auth::guard('admin')->check())
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::guard('admin')->user()->name}} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @if( Auth::guard('admin')->user()->type === Auth::guard('admin')->user()::SUPER_ADMIN)
                    <a class="dropdown-item" href="{{ route('admins.create') }}">{{ __('Create admin') }}</a>
                @endif
                <a class="dropdown-item" href="{{ route('admin.change_password',Auth::guard('admin')->id()) }}">{{ __('Change password') }}</a>
                <a class="dropdown-item" href="{{ route('logout_admin') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout_admin') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endif
@endsection
@section('top-left')
    <li class="breadcrumb-item"><a href="{{route('admin_index')}}">List Admin</a></li>
    <li class="breadcrumb-item"><a href="{{route('users.index')}}">List User</a></li>
    <li class="breadcrumb-item"><a href="{{route('cvs.index')}}">List CV</a></li>
@endsection
