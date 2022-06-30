@extends('layouts.app')
@section('ubahpass', 'active')
@section('content')
<div class="content-wrapper">
    <section class="section">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Ubah Password</h2>
                <hr>
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
            <form method="POST" action="{{route("ubah-password.store")}}">
            @csrf
            <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="col-md-4 control-label"> Password Sekarang</label>
                        <div class="col-md-12">
                            <input id="current-password" type="password" class="form-control" name="current-password" required>
                            @if ($errors->has('current-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="col-md-4 control-label"> Password Baru</label>
                        <div class="col-md-12">
                            <input id="new-password" type="password" class="form-control" name="new-password" required>
                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new-password-confirm" class="col-md-4 control-label">Konfirmas Password</label>
                        <div class="col-md-12">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 ml-2">
                <button type="submit" class="btn btn-primary">Ubah Password</button>
            </div>
            </div>
            </form>
            <div class="card-footer">
            </div>
        </div>
    </section>
</div>
@endsection
