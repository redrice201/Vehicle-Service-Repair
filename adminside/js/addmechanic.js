$(document).ready(function () {
  $(".data-table").DataTable({
    pageLength: 10,
    ordering: true,
    searching: true,
    lengthChange: true,
    responsive: true,
  });

  const box = document.getElementById("messageBox");
  if (box) {
    box.classList.add("show");
    setTimeout(() => {
      box.classList.remove("show");
      box.classList.add("hide");
      setTimeout(() => (box.style.display = "none"), 300);
    }, 3000);
  }

  const openAddBtn = document.getElementById("openAddMechanicModal");
  const addModal = document.getElementById("addMechanicModal");
  const addCloseBtns = addModal.querySelectorAll(".close");

  openAddBtn.addEventListener("click", () => {
    addModal.style.display = "flex";
  });

  addCloseBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      addModal.style.display = "none";
    });
  });

  window.addEventListener("click", (e) => {
    if (e.target === addModal) addModal.style.display = "none";
  });

  const editModal = document.getElementById("editMechanicModal");
  const editCloseBtns = editModal.querySelectorAll(".close");

  document.querySelectorAll(".btn-edit").forEach((button) => {
    button.addEventListener("click", function () {
      const row = this.closest("tr");
      const id = row.children[0].textContent;
      const full_name = row.children[1].textContent;
      const email = row.children[2].textContent;
      const phone = row.children[3].textContent;
      const specialization = row.children[4].textContent;
      const status = row.children[5].textContent;

      document.getElementById("edit_id").value = id;
      document.getElementById("edit_full_name").value = full_name;
      document.getElementById("edit_email").value = email;
      document.getElementById("edit_phone").value = phone;
      document.getElementById("edit_specialization").value = specialization;
      document.getElementById("edit_status").value = status;

      editModal.style.display = "flex";
    });
  });

  editCloseBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      editModal.style.display = "none";
    });
  });

  window.addEventListener("click", (e) => {
    if (e.target === editModal) editModal.style.display = "none";
  });

  let mechanicToDeleteId = null;
  const deleteModal = document.getElementById("deleteMechanicModal");
  const deleteCloseBtns = deleteModal.querySelectorAll(".close, #cancelDelete");
  const confirmDeleteBtn = document.getElementById("confirmDelete");

  document.querySelectorAll(".btn-delete").forEach((button) => {
    button.addEventListener("click", function () {
      const row = this.closest("tr");
      mechanicToDeleteId = row.children[0].textContent;
      deleteModal.style.display = "flex";
    });
  });

  deleteCloseBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      deleteModal.style.display = "none";
      mechanicToDeleteId = null;
    });
  });

  window.addEventListener("click", (e) => {
    if (e.target === deleteModal) {
      deleteModal.style.display = "none";
      mechanicToDeleteId = null;
    }
  });

  confirmDeleteBtn.addEventListener("click", () => {
    if (mechanicToDeleteId) {
      window.location.href =
        "mechanic/deletemechanic.php?id=" + mechanicToDeleteId;
    }
  });
});

$(document).on("click", ".edit-status-btn", function () {
  let row = $(this).closest("tr").data("full");

  $("#statusOrderID").val(row.id);
  $("#statusSelect").val(row.status);

  if (
    row.status === "Pending" &&
    (!row.mechanic_id || row.mechanic_id == null || row.mechanic_id == 0)
  ) {
    $("#mechanicSelectWrapper").show();
  } else {
    $("#mechanicSelectWrapper").hide();
  }

  openModal("statusModal");
});
