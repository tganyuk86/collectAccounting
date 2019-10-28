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

                    <div class="row">
                        <div class="col-md-6">
                            <p><a href="{{ route('income') }}">Income</a></p>
                            <p><a href="{{ route('expense') }}">Expenses</a></p>
                            <p><a href="{{ route('graph') }}">Graphs</a></p>
                            <p><a href="{{ route('report') }}">Reports</a></p>
                        </div>
                        <div class="col-md-6">
                            <p>Total Expenses: {{ \App\Data::getTotal('expense') }}</p>
                            <p>Total Income: {{ \App\Data::getTotal('income') }}</p>
                            <p>Total: {{ (\App\Data::getTotal('income')) - (\App\Data::getTotal('expense')) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
