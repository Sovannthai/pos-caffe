<!-- Modal -->
<div class="modal fade" id="checkout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div style="">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkpayment">CHECK PAYMENT</h5>
                </div>
                <div class="modal-body">
                        @csrf
                        <label for="">Input Amout Here</label>
                        <input type="number" step="any" class="form-control" name="total_paid" id="input-total">
                        <span class="text-danger d-none" id="max-value">
                            Error
                        </span>
                        <input type="hidden" name="subtotal">
                        <input type="hidden" name="total_qty">
                        <input type="hidden" name="customer_id">
                        <input type="hidden" name="table_id">
                        <input type="hidden" name="total">
                        <div>
                            <button type="button" class="btn mt-3 btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                            <button type="submit" class="btn mt-3 btn-primary">Finish</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
