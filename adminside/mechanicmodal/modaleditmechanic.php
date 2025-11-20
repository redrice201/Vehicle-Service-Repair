<div id="editMechanicModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="editMechanicForm" action="mechanic/editmechanic.php" method="POST">
      <h3>Edit Mechanic</h3>

      <input type="hidden" name="id" id="edit_id">

      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="full_name" id="edit_full_name" required>
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" id="edit_email" required>
      </div>

      <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" id="edit_phone">
      </div>

      <div class="form-group">
        <label>Specialization</label>
        <input type="text" name="specialization" id="edit_specialization">
      </div>

      <div class="form-group">
        <label>Status</label>
        <select name="status" id="edit_status">
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
        </select>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>
