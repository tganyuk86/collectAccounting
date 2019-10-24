@extends('layouts.internal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p><a href="{{ route('income') }}">Income</a></p>
                    <p><a href="{{ route('expense') }}">Expenses</a></p>
                    <p><a href="{{ route('graph') }}">Graphs</a></p>
                    <p><a href="{{ route('report') }}">Reports</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
