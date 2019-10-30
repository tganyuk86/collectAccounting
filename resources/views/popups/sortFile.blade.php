


<!-- Modal -->
  <div class="modal fade" id="sortFileModal" tabindex="-1" role="dialog" 
                 aria-labelledby="sortFileModalLabel" aria-hidden="true"> 
   <div class="modal-dialog modal-lg" role="document"> 
    <div class="modal-content"> 
     <div class="modal-header"> 
       <h6 class="modal-title" id="sortFileModalLabel" style="color:green;">Upload</h6> 
                       
       <!-- The title of the modal -->
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
       <span aria-hidden="true">×</span> 
      </button> 
     </div> 
     <div class="modal-body" id="sortFileModalContent">  

        <div class="row">
            <div class="col-md-4" id="sortFileModalImage">

            </div>

            <div class="col-md-8">

        <form action="{{ route('manager.sortFile') }}" method="POST" role="form" 
                     class="ajax-form" data-af-callback="sortFinish">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="id" id="fileID" value="">
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>
                            <div class="col-md-6">
                                <select name='cat'>
                                @foreach(\App\Category::all() as $cat)
                                    <option value="{{$cat->id}}">{{$cat->title}}</option>
                                @endforeach
                                </select>
                                <!-- <input id="category" type="text" class="form-control" name="category" value="" > -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="value" class="col-md-4 col-form-label text-md-right">Value $</label>
                            <div class="col-md-6">
                                <input id="value" type="text" class="form-control" name="value">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dated_at" class="col-md-4 col-form-label text-md-right">Dated At:</label>
                            <div class="col-md-6">
                                <input id="dated_at" type="date" class="form-control" name="dated_at" value="{{ now() }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dated_at" class="col-md-4 col-form-label text-md-right">Text Detected:</label>
                            <div class="col-md-6">
                                <textarea class="form-control" id="detectedText" ></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0 mt-5">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
    </div> 
    <!-- <div class="modal-footer"> 
     <button type="button" class="btn btn-secondary" 
                                             data-dismiss="modal">Close</button> 
                     --> 
      <!-- The close button in the bottom of the modal -->
     <!-- <button type="button" class="btn btn-primary">okay</button>  -->
       
      <!-- The save changes button in the bottom of the modal -->
    <!-- </div>  -->
   </div> 
  </div> 
 </div> 


<script type="text/javascript">
    function sortFinish(response)
    {
        console.log(response)


        window.location.reload();
    }

    function sortFilePopupPopulate(response)
    {
        $('#uploadFileModal').modal('hide'); 
        $('#sortFileModal').modal('show'); 

        $('#sortFileModalImage').html('<img src="/df/'+response.id+'" >');
        $('#fileID').val(response.id);
        $('#detectedText').html(response.text);
    }
</script>
