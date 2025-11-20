<div id="editPartModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeEditPartModal">&times;</span>

    <form id="editPartForm" action="parts/edit_part_process.php" method="POST">
      <h3>Edit Part</h3>

      <input type="hidden" name="id" id="edit_id">

      <div class="form-group">
        <label>Part Name</label>
        <input type="text" name="part_name" id="edit_part_name" required>
      </div>

      <div class="form-group">
        <label>Category</label>
        <input type="text" name="category" id="edit_category" required placeholder="e.g., Engine, Electrical">
      </div>

      <div class="form-group">
        <label>Quantity</label>
        <input type="number" name="quantity" id="edit_quantity" min="0" required>
      </div>

      <div class="form-group">
        <label>Unit Price</label>
        <input type="number" step="0.01" name="unit_price" id="edit_unit_price" min="0" required>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn-primary">Update Part</button>
      </div>
    </form>

  </div>
</div>
