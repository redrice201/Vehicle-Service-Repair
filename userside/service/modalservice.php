
<div id="paymentModal" class="modal custom-modal" style="display:none">
  <div class="modal-content">
    <span class="close close-modal" data-close="paymentModal">&times;</span>
    <form method="POST" action="service/upload_payment.php" enctype="multipart/form-data">
      <h3>Upload Payment Screenshot</h3>
      <input type="hidden" name="order_id" id="paymentOrderID">

      <div class="form-group">
        <label for="payment_screenshot">Select Screenshot:</label>
        <input type="file" id="payment_screenshot" name="payment_screenshot" accept="image/*" required>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>
