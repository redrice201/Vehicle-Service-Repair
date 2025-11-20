document.addEventListener("DOMContentLoaded", () => {
  const openAddBtn = document.getElementById("openAddPartModal");
  if (openAddBtn) {
    openAddBtn.addEventListener("click", () => {
      document.getElementById("addPartModal").style.display = "flex";
    });
  }

  const closeAddBtn = document.getElementById("closeAddPartModal");
  if (closeAddBtn) {
    closeAddBtn.addEventListener("click", () => {
      document.getElementById("addPartModal").style.display = "none";
    });
  }

  document.querySelectorAll(".btn-edit").forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.dataset.id;
      const name = this.dataset.name;
      const category = this.dataset.category;
      const quantity = this.dataset.quantity;
      const price = this.dataset.price;

      document.getElementById("edit_id").value = id;
      document.getElementById("edit_part_name").value = name;
      document.getElementById("edit_category").value = category;
      document.getElementById("edit_quantity").value = quantity;
      document.getElementById("edit_unit_price").value = price;

      document.getElementById("editPartModal").style.display = "flex";
    });
  });

  const closeEditBtn = document.getElementById("closeEditPartModal");
  if (closeEditBtn) {
    closeEditBtn.addEventListener("click", () => {
      document.getElementById("editPartModal").style.display = "none";
    });
  }

  document.querySelectorAll(".btn-delete").forEach((button) => {
    button.addEventListener("click", function () {
      const id = this.dataset.id;
      document.getElementById("delete_id").value = id;
      document.getElementById("deletePartModal").style.display = "flex";
    });
  });

  const closeDeleteBtn = document.getElementById("closeDeletePartModal");
  if (closeDeleteBtn) {
    closeDeleteBtn.addEventListener("click", () => {
      document.getElementById("deletePartModal").style.display = "none";
    });
  }

  const cancelDeleteBtn = document.getElementById("cancelDelete");
  if (cancelDeleteBtn) {
    cancelDeleteBtn.addEventListener("click", () => {
      document.getElementById("deletePartModal").style.display = "none";
    });
  }

  window.addEventListener("click", function (event) {
    const modals = ["addPartModal", "editPartModal", "deletePartModal"];
    modals.forEach((id) => {
      const modal = document.getElementById(id);
      if (modal && event.target === modal) {
        modal.style.display = "none";
      }
    });
  });
});
