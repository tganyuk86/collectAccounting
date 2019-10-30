@extends('layouts.internal')
@extends('popups.uploadFile')
@extends('popups.sortFile')


@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{$type == 'income' ? 'Income' : 'Expense' }}</div>

                <div class="card-body">
                    <!-- <input type="search" id="example" class="form-control"> -->
                    <div id="mytree"></div>
                </div>

                <div class="card-footer">
                    <button type="button" class="btn btn-primary" data-toggle="modal" 
                      data-target="#uploadFileModal">Upload</button> 
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <!-- 
 -->
                    <div class="filemanager">

                        <div class="search">
                            <input type="search" placeholder="Find a file.." />
                        </div>

                        <div class="breadcrumbs"></div>

                        <ul class="data"></ul>

                        <div class="nothingfound">
                            <div class="nofiles"></div>
                            <span>No files here.</span>
                        </div>

                    </div>
          <!--          
                </div>
            </div> -->
        </div>
    </div>
</div>
@yield('uploadFilePopup')
@yield('sortFilePopup')
@endsection

@section('css-links')
<link href="{{ asset('css/manager.css') }}" rel="stylesheet">
<link href="{{ asset('css/simpleTree.css') }}" rel="stylesheet">
@endsection


@section('js-links')
<script type="text/javascript">
    managerEndpointURL = '{{ route('manager.'.$type.'.data') }}';
    managerListEndpointURL = '{{ route('manager.'.$type.'.list') }}';
</script>
<script src="{{ asset('js/simpleTree.js') }}" ></script>
<script src="{{ asset('js/manager.js') }}" ></script>
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

    // $('#mytree').simpleTree(options, data);
    $.get('{{ route('manager.'.$type.'.list') }}', {}, function(dd) {

        $('#mytree').simpleTree(options, dd).on('simpleTree:change', function(event, selectedNode){
            console.log(selectedNode);
            window.location.href = '#'+selectedNode.value;
        });

    });
        

        

});
</script>

@endsection
