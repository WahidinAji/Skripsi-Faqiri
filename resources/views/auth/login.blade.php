@extends('layouts.main')
@section('main-content')
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9 p-0">
            <div class="row align-items-center m-0">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="col-lg-6">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" aria-live="polite" aria-atomic="true"  data-delay="50000">
                        {{ $error }}
                            <div type="button" class="close" data-dismiss="alert">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-backspace-fill"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2V3zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8 5.829 5.854z" />
                            </svg>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <style>
                            .bg-mylogin{
                                background-image: url('{{ asset("assets/img/logo.png") }}');
                                background-position: center;
                                background-repeat: no-repeat;
                            }
                        </style>
                        <div class="col-lg-6 d-none d-lg-block bg-mylogin"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                @guest
                                <form class="user" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter username..." name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <hr>
                                </form>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
