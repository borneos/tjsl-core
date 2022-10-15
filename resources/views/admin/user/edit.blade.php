@extends('layouts.app-main')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>
                        Edit Master User
                        <div class="page-title-subheading">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}"
                                    class="form-control">
                                @error('name')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" value="{{ $user->email }}"
                                    class="form-control">
                                @error('email')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" id="password" onkeyup="checkMatching()" name="password"
                                        class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-light"><i
                                                class="fa fa-eye-slash"></i></button>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <div class="input-group" id="show_hide_password_confirm">
                                    <input type="password" id="confirmPassword" onkeyup="checkMatching()"
                                        name="confirmPassword" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-light"><i
                                                class="fa fa-eye-slash"></i></button>
                                    </div>
                                </div>
                                <span class="text-danger mt-2" id="messageMatching"></span>
                                @error('confirmPassword')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-right mt-2">
                                <a href="{{ route('admin.user.index') }}" class="mb-2 mr-2 btn btn-icon btn-light btn-lg"><i
                                        class="pe-7s-back btn-icon-wrapper"></i>Back</a>
                                <button type="submit" id="buttonSubmit"
                                    class="mb-2 mr-2 btn btn-icon btn-primary btn-lg"><i
                                        class="pe-7s-diskette btn-icon-wrapper"></i>Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script>
            $(document).ready(function() {
                //toggle password hide
                $("#show_hide_password button").on('click', function(event) {
                    event.preventDefault();
                    if ($('#show_hide_password input').attr("type") == "text") {
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass("fa-eye-slash");
                        $('#show_hide_password i').removeClass("fa-eye");
                    } else if ($('#show_hide_password input').attr("type") == "password") {
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass("fa-eye-slash");
                        $('#show_hide_password i').addClass("fa-eye");
                    }
                });
                //toggle confirm password hide
                $("#show_hide_password_confirm button").on('click', function(event) {
                    event.preventDefault();
                    if ($('#show_hide_password_confirm input').attr("type") == "text") {
                        $('#show_hide_password_confirm input').attr('type', 'password');
                        $('#show_hide_password_confirm i').addClass("fa-eye-slash");
                        $('#show_hide_password_confirm i').removeClass("fa-eye");
                    } else if ($('#show_hide_password_confirm input').attr("type") == "password") {
                        $('#show_hide_password_confirm input').attr('type', 'text');
                        $('#show_hide_password_confirm i').removeClass("fa-eye-slash");
                        $('#show_hide_password_confirm i').addClass("fa-eye");
                    }
                });
            });

            function checkMatching() {
                if (document.getElementById('password').value === document.getElementById('confirmPassword').value) {
                    document.getElementById('messageMatching').innerHTML = '';
                    document.getElementById('buttonSubmit').disabled = false;
                } else {
                    document.getElementById('messageMatching').innerHTML = 'Password does not match';
                    document.getElementById('buttonSubmit').disabled = true;
                }
            }
        </script>
    @endsection
