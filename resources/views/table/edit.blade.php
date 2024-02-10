  <!-- Modal -->
  <div class="modal fade" id="edit-{{ $table->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit New Table</h5>
        </div>
        <div class="modal-body">
          <form action="{{ route('table.update',['id'=>$table->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Table Name</label>
                <input type="text" name="table_name" class="form-control" value="{{ $table->table_name }}">
            </div>
            <div class="form-group">
                <label for="">Shot Name</label>
                <input type="text" name="shot_name" class="form-control" value="{{ $table->shot_name }}">
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
