@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile infomation</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session()->has('message'))
                        <div class="alert alert-success" role="alert">
                            <div class="alert-text">{{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <form action="{{ url('update-profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        Your name:
                        <input class="form-control" type="text" value="{{ $userInfo->name }}" name="name">
                        <br/>
                        Email:
                        <input class="form-control" type="text" value="{{ $userInfo->email }}" name="email">
                        <br/>
                        Phone:
                        <input class="form-control" type="text" value="{{ $userInfo->phone }}" name="phone">
                        <br/>
                        Address:
                        <input class="form-control" type="text" value="{{ $userInfo->address }}" name="address">

                        <button type="submit" class="btn btn-primary" style="margin-top: 20px; float: right;">
                            {{ __('Update') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
