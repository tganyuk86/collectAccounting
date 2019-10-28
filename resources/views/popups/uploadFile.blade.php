
@section('uploadFilePopup-btn')
    <button type="button" class="btn btn-primary" data-toggle="modal" 
                      data-target="#uploadFileModal">Upload</button> 
   
@endSection


@section('uploadFilePopup-btn2')
    <button type="button" class="btn btn-primary" data-toggle="modal" 
                      data-target="#uploadFileModal">Quick Add</button> 
   
@endSection


@section('uploadFilePopup')

<!-- Modal -->
  <div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" 
                 aria-labelledby="uploadFileModalLabel" aria-hidden="true"> 
   <div class="modal-dialog" role="document"> 
    <div class="modal-content"> 
     <div class="modal-header"> 
       <h6 class="modal-title" id="uploadFileModalLabel" style="color:green;"> 
                                                         Upload</h6> 
                       
       <!-- The title of the modal -->
      <button type="button" class="close" data-dismiss="modal"aria-label="Close"> 
       <span aria-hidden="true">×</span> 
      </button> 
     </div> 
     <div class="modal-body">  
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
    <div class="modal-footer"> 
     <button type="button" class="btn btn-secondary" 
                                             data-dismiss="modal">Close</button> 
                     
      <!-- The close button in the bottom of the modal -->
     <button type="button" class="btn btn-primary">okay</button> 
       
      <!-- The save changes button in the bottom of the modal -->
    </div> 
   </div> 
  </div> 
 </div> 


<script type="text/javascript">
    function uploadFinish(response)
    {
        console.log(response)

        sortFilePopupPopulate(response);
        // $('form').append('<img src="/df/'+response.id+'" >');
    }
</script>

@endSection