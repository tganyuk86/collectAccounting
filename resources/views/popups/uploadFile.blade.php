
@section('uploadFilePopup')
<div class="card">
    <div class="card-header">Upload File</div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('manager.uploadFile') }}" method="POST" role="form" 
                    enctype="multipart/form-data" class="ajax-form" data-af-callback="uploadFinish">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type }}">
                        <!-- <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}">
                            </div>
                        </div> -->
                        <!-- <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" disabled>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="myImage">
                            </div>
                        </div>
                        <div class="form-group row mb-0 mt-5">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Upload Image</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function uploadFinish(response)
    {
        console.log(response)

        $('form').append('<img src="/df/'+response.id+'" >');
    }
</script>

@end