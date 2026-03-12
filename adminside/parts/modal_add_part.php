<div id="addPartModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeAddPartModal">&times;</span>

    <form id="addPartForm" action="parts/add_part_process.php" method="POST">
      <h3>Add New Part</h3>

      <div class="form-group">
        <label>Part Name</label>
        <input type="text" name="part_name" required>
      </div>

      <div class="form-group">
        <label>Category</label>
        <input type="text" name="category" required placeholder="e.g., Engine, Electrical">
      </div>

      <div class="form-group">
    <label>Quantity</label>
    <input type="number" name="quantity" min="0" max="1000" maxlength="4" required oninput="this.value=this.value.slice(0,this.maxLength);">
</div>

      <div class="form-group">
        <label>Unit Price</label>
        <input type="number" step="0.01" name="unit_price" min="0" required>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn-primary">Add Part</button>
      </div>
    </form>

  </div>
</div>
