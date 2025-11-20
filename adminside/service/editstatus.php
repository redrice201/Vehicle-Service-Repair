<div id="statusModal" class="modal custom-modal">
  <div class="modal-content">
    <span class="close close-modal" data-close="statusModal">&times;</span>
    <form method="POST" action="service/update_status.php">
      <h3>Edit Status</h3>

      <input type="hidden" name="order_id" id="statusOrderID">
      <input type="text" name="next_status" id="nextStatus" readonly>

      <div class="form-group" id="mechanicSelectWrapper" style="display:none;">
        <label>Assign Mechanic (for Ongoing):</label>
        <select name="mechanic_id" id="mechanicSelect">
          <option value="">-- Select Mechanic --</option>
        </select>
      </div>

      <div class="form-group" id="partsSelectWrapper" style="display:none; margin-top:10px;">
        <label>Parts to Use:</label>
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th>Select</th>
              <th>Part Name</th>
              <th>Available Quantity</th>
              <th>Quantity to Use</th>
            </tr>
          </thead>
          <tbody id="partsTableBody">
          </tbody>
        </table>
      </div>

      <div class="form-group" id="priceWrapper" style="display:none; margin-top:10px;">
        <label>Price (for Completed):</label>
        <input type="number" name="price" id="priceInput" placeholder="Enter Price" min="0" step="0.01">
      </div>

      <div class="modal-footer" style="margin-top:15px;">
        <button class="btn btn-primary" type="submit" id="saveBtn">Save</button>
      </div>
    </form>
  </div>
</div>
