@extends('layouts.app')

@section('content')
    <div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100 bg-plum-plate bg-animation">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="app-logo-inverse mx-auto mb-3"></div>
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <form id="form" class="" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="h5 modal-title text-center">
                                            <h4 class="mt-2">
                                                <div>Welcome back,</div>
                                                <span>Please sign in to your account below.</span>
                                            </h4>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="email" id="email" placeholder="Email here..."
                                                        type="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input name="password" id="password" placeholder="Password here..."
                                                        type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="position-relative form-check">
                                <input name="check" id="exampleCheck" type="checkbox" class="form-check-input">
                                <label for="exampleCheck" class="form-check-label">Keep me logged in</label>
                              </div> -->

                                        <!-- <div class="divider"></div>
                              <h6 class="mb-0">No account? <a href="javascript:void(0);" class="text-primary">Sign up now</a>
                              </h6> -->
                                    </div>
                                    <div class="modal-footer clearfix">
                                        <!-- <div class="float-left">
                                <a href="javascript:void(0);" class="btn-lg btn btn-link">Recover Password</a>
                              </div> -->
                                        <div class="float-right">
                                            <button id="buttonSubmit" class="btn btn-primary btn-lg">Login to
                                                Dashboard</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="text-center text-white opacity-8 mt-3">TJSL Core Content Management System - By Borneos
                            Technology</div>
                    </div>
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
        document.getElementById('form').onkeyup = function(e) {
            if (e.keyCode === 13) {
                document.getElementById('buttonSubmit').click();
            }
            return true;
        }
    </script>
@endsection
