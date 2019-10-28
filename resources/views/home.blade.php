@extends('layouts.internal')
@extends('popups.uploadFile')
@extends('popups.sortFile')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Total: {{ (\App\Data::getTotal('income')) - (\App\Data::getTotal('expense')) }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row homeIcons">
                        <div class="col-md-6">
                            <p><a href="{{ route('income') }}"><img src="/img/Income.png">Income</a></p>
                            <p><a href="{{ route('report') }}"><img src="/img/reports.png">Reports</a></p>
                            
                        </div>
                        <div class="col-md-6">
                            <p><a href="{{ route('expense') }}"><img src="/img/expenses.png">Expenses</a></p>
                            <p><a href="{{ route('graph') }}"><img src="/img/Graphs.png">Graphs</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
