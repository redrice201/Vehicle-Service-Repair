<div id="addMechanicModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form action="mechanic/add_mechanic.php" method="POST">
      <h3>Add New Mechanic</h3>

      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="full_name" required>
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" required>
      </div>

      <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone">
      </div>

      <div class="form-group">
        <label>Specialization</label>
        <input type="text" name="specialization">
      </div>

      <div class="form-group">
        <label>Status</label>
        <select name="status">
          <option value="Active" selected>Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn-primary">Add Mechanic</button>
      </div>
    </form>
  </div>
</div>