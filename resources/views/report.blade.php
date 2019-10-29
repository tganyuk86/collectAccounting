@extends('layouts.internal')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Reports</div>

                <div class="card-body">
                    <!-- <input type="search" id="example" class="form-control"> -->
                    <div id="mytree"></div>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Options</div>

                <div class="card-body">
                    <form action="{{ route('manager.generateReport') }}" method="POST" role="form" 
                     class="" data-af-callback="generateFinish">
                        @csrf
                        <input type="hidden" name="exportType" value="">
                        <input type="hidden" name="id" id="" value="">

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Type</label>
                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Year</label>
                            <div class="col-md-6">
                                <input id="year" type="text" class="form-control" name="year" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Month</label>
                            <div class="col-md-6">
                                <input id="month" type="text" class="form-control" name="month" value="">
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0 mt-5">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" name="export" value="files" class="btn btn-primary typeSetter">Export Files</button>
                                <button type="submit" name="export" value="pdf" class="btn btn-primary typeSetter">Export PDF</button>
                                <button type="button" id="previewReport" class="btn btn-primary">Preview Report</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css-links')
<link href="{{ asset('css/simpleTree.css') }}" rel="stylesheet">
@endsection


@section('js-links')
<script type="text/javascript">
    managerListEndpointURL = '{{ route('manager.reports.list') }}';
</script>
<script src="{{ asset('js/simpleTree.js') }}" ></script>
<script type="text/javascript">


var options = {
        // Optionally provide here the jQuery element that you use as the search box for filtering the tree. simpleTree then takes control over the provided box, handling user input
        searchBox: $('#example'),

        // Search starts after at least 3 characters are entered in the search box
        searchMinInputLength: 2,

        // Number of pixels to indent each additional nesting level
        indentSize: 25,

        // Show child count badges?
        childCountShow: true,

        // Symbols for expanded and collapsed nodes that have child nodes
        symbols: {
            collapsed: '▶',
            expanded: '▼'
        },

        // these are the CSS class names used on various occasions. If you change these names, you also need to provide the corresponding CSS class
        css: {
            childrenContainer: 'simpleTree-childrenContainer',
            childCountBadge: 'simpleTree-childCountBadge badge badge-pill badge-secondary',
            highlight: 'simpleTree-highlight',
            indent: 'simpleTree-indent',
            label: 'simpleTree-label',
            mainContainer: 'simpleTree-mainContainer',
            nodeContainer: 'simpleTree-nodeContainer',
            selected: 'simpleTree-selected',
            toggle: 'simpleTree-toggle'
        }
    };

    // $.get('{{ route('manager.income.list') }}', function(dd) {

    //     console.log('Data:',dd);


    // });

$(function(){

    $('.typeSetter').click(function(){
        $('[name="exportType"]').val($(this).val());
        console.log($(this).val());
    });
    // $('#mytree').simpleTree(options, data);
    $.get('{{ route('manager.reports.list') }}', {}, function(dd) {

        $('#mytree').simpleTree(options, dd).on('simpleTree:change', function(event, selectedNode){
            console.log(selectedNode);

            data = selectedNode.value.split('/');

            $('#type'). val(data[0]);
            $('#year'). val(data[1] ? data[1] : 'All');
            $('#month'). val(data[2] ? data[2] : 'All');

        });

    });
        

        

});
</script>

@endsection
