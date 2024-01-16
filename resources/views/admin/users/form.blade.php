@extends('layouts.admin')
@section('title','users')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">@if($model->exists) Edit @else Tambah @endif  @yield('title')</div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert with-close alert-danger mb-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <form action="@if($model->exists) {{ route('users.update', $model->id) }} @else {{ route('users.store') }} @endif" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($model->exists ? 'PUT' : 'POST')

                        <div class="form-group">
                            <label class="small mb-1">Name <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="name" type="text" placeholder="Name" value="{{ old('name', $model->name) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Email <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="email" type="email" placeholder="Email" value="{{ old('email', $model->email) }}" />
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">Password <span class="text-danger">*</span></label>
                            <input class="form-control form-control-solid" name="password" type="password" placeholder="Password" id="inputPassword"/>
                        </div>
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" onclick="myFunction()"/>
                                <span></span>&nbsp;Tampilkan Password</label>
                        </div>
                        <div class="form-group">
                            <label class="small mb-1">User Role <span class="text-danger">*</span></label>
                            <select name="role_id" id="" class="form-select form-control">
                                <option value="">Select user role </option>
                                    <option value="1" {{ old('role_id', $model->role_id) == 1 ? 'selected' : '' }}>
                                        Admin
                                    </option>
                                    <option value="2" {{ old('role_id', $model->role_id) == 2 ? 'selected' : '' }}>
                                        Customer
                                    </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right" type="submit"><i class="far fa-save mr-1"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- START AUTO HIDDEN PASS --}}
<script>
    function myFunction() {
        var x = document.getElementById("inputPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
{{-- END AUTO HIDDEN PASS --}}
@endsection
