<div id="deletePartModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeDeletePartModal">&times;</span>

    <form id="deletePartForm" action="parts/delete_part_process.php" method="POST">
      <h3>Delete Part</h3>

      <p>Are you sure you want to delete this part?</p>

      <input type="hidden" name="delete_id" id="delete_id">

      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Yes</button>
        <button type="button" class="btn btn-secondary" id="cancelDelete">Cancel</button>
      </div>
    </form>

  </div>
</div>
