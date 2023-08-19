@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Welcome Admin CMS Keubitbit</span>
                    <div>
                        <span class="text-primary">You are login as: <b>{{Auth::user()->name}}</b></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
