@extends('admin.layout.master-mini')
@section('content')
    <div class="content-wrapper d-flex align-items-center justify-content-center auth theme-one"
         style="background-image: url({{ url('assets/images/auth/login_1.jpg') }}); background-size: cover;">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <div class="auto-form-wrapper mb-4">
                    <div class="mb-5 text-center">
                        <h4>ADMIN LOGIN</h4>
                    </div>
                    <form method="POST" action="{{ route('admin.login.execute') }}">
                        @csrf
                        @if(isset($isError))
                            <span class="d-block text-danger mb-3">Email or Password invalid!</span>
                        @endif
                        <div class="form-group">
                            <label class="label">Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email" name="email" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                      <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <label class="label">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="*********" name="password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                      <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
