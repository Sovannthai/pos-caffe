  <!-- Modal -->
  <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Table</h5>
        </div>
        <div class="modal-body">
          <form action="{{ route('table.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="" style="position: relative; left:-390px">Table Name</label>
                <input type="text" name="table_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="" style="position: relative; left:-390px">Shot Name</label>
                <input type="text" name="shot_name" class="form-control">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
