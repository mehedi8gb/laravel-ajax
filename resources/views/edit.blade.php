<!--Data Insert modal here-->
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
      	<h4 class="modal-title" id="myModalLabel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">

       	@csrf
           {{ method_field('PATCH') }}
         <div class="form-group">
         <input type="hidden" name="Id" id="id">
           <label for="name">Name</label>
           <input type="text" class="form-control" name="name" id="name" required="" autofocus="">
         </div>
         <div class="form-group">
           <label for="email">Email </label>
           <input type="text" class="form-control" name="email" id="email" required="" autofocus="">
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" onclick="saveData()" data-dismiss="modal" class="btn btn-primary" id="insertbutton">Save</button>
      </div>

    </div>
  </div>
</div>


