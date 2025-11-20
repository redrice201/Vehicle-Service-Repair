function openModal(id) {
  document.getElementById(id).style.display = "flex";
}

function closeModal(id) {
  document.getElementById(id).style.display = "none";
}

$(document).ready(function () {
  $(document).on("click", ".view-btn", function () {
    let rowData = $(this).closest("tr").attr("data-full");
    let row = JSON.parse(rowData);

    let paymentHTML =
      row.payment_img && row.payment_img.toString().trim() !== ""
        ? `<img style="width:100%; max-height:300px; object-fit:cover;" src="../userside/uploads/${row.payment_img}" alt="payment">`
        : "<p>On Process</p>";

    let price = row.price ?? "";
    let priceHTML =
      price && price.toString().trim() !== "" && Number(price) !== 0
        ? price
        : "On Process";

    // Parts table
    let partsHTML = "<p>None</p>";
    if (row.used_parts && row.used_parts.length > 0) {
      partsHTML = `
      <table style="width:100%; border-collapse: collapse; margin-top:5px;">
        <thead>
          <tr>
            <th style="padding:5px; text-align:left;">Part Name</th>
            <th style="padding:5px; text-align:left;">Quantity</th>
            <th style="padding:5px; text-align:left;">Price</th>
          </tr>
        </thead>
        <tbody>
          ${row.used_parts
            .map(
              (p) => `
            <tr>
              <td style="padding:5px;">${p.part_name}</td>
              <td style="padding:5px;">${p.quantity_used}</td>
              <td style="padding:5px;">${p.unit_price ?? 0}</td>
            </tr>
          `
            )
            .join("")}
        </tbody>
      </table>
    `;
    }

    let html = `
    <hr>
    <h3>User Details</h3>
    <p><strong>User:</strong> ${row.full_name}</p>
    <p><strong>Contact:</strong> ${row.phone}</p>
    <p><strong>Address:</strong> ${row.address}</p>
    <hr>
    <h3>Vehicle Details</h3>
    <p><strong>Vehicle Model:</strong> ${row.vehicle_model}</p>
    <p><strong>Plate Number:</strong> ${row.plate_number}</p>
    <p><strong>Problem:</strong> ${row.problem}</p>
    <p><strong>Details:</strong> ${row.details}</p>
    <p><strong>Delivery Date:</strong> ${row.delivery_date}</p>
    <p><strong>Status:</strong> ${row.status}</p>
    <p><strong>Created At:</strong> ${row.created_at}</p>
    <hr>
    <h3>Price</h3>
    <p>${priceHTML}</p>
    <hr>
    <h3>Parts Used</h3>
    ${
      partsHTML && partsHTML !== "<p>None</p>" ? partsHTML : "<p>On Process</p>"
    }
    <hr>
    <h3>Payment Gcash</h3>
    ${paymentHTML}
  `;

    $("#viewContent").html(html);
    openModal("viewModal");
  });

  // EDIT STATUS modal
  $(document).on("click", ".edit-status-btn", function () {
    let row = $(this).closest("tr").data("full");

    const mechanicWrapper = $("#mechanicSelectWrapper");
    const partsWrapper = $("#partsSelectWrapper");
    const priceWrapper = $("#priceWrapper");
    const saveBtn = $("#saveBtn");

    $("#statusOrderID").val(row.id);
    $("#nextStatus").val("");
    mechanicWrapper.hide();
    partsWrapper.hide();
    priceWrapper.hide();
    saveBtn.show();
    $("#mechanicSelect").prop("required", false);
    $("#priceInput").prop("required", false);

    let nextStatus = "";

    switch (row.status) {
      case "Pending":
        nextStatus = "Ongoing";

        // Show mechanic selection
        mechanicWrapper.show();
        $("#mechanicSelect")
          .prop("required", true)
          .empty()
          .append('<option value="">-- Select Mechanic --</option>');
        $.getJSON("service/activemechanic.php", function (data) {
          data.forEach((mech) => {
            $("#mechanicSelect").append(
              `<option value="${mech.id}">${mech.full_name} (${mech.specialization})</option>`
            );
          });
        });

        // Show parts selection with previous quantities checked
        partsWrapper.show();
        $("#partsTableBody").empty();
        $.getJSON("service/get_parts_inventory.php", function (parts) {
          parts.forEach((part) => {
            let quantityUsed = 0;
            if (row.used_parts) {
              const used = row.used_parts.find((p) => p.part_id == part.id);
              if (used) quantityUsed = used.quantity_used;
            }
            const disabled = part.quantity <= 0 ? "disabled" : "";
            $("#partsTableBody").append(`
              <tr>
                <td style="padding:5px;">
                  <input type="checkbox" name="parts[]" value="${part.id}" ${
              quantityUsed > 0 ? "checked" : ""
            } ${disabled}>
                </td>
                <td style="padding:5px;">${part.part_name}</td>
                <td style="padding:5px;">${part.quantity}</td>
                <td style="padding:5px;">
                  <input type="number" name="quantity[${
                    part.id
                  }]" min="1" max="${part.quantity}" value="${
              quantityUsed > 0 ? quantityUsed : 1
            }" style="width:60px;" ${disabled}>
                </td>
              </tr>
            `);
          });
        });
        break;

      case "Ongoing":
        nextStatus = "Completed";
        priceWrapper.show();
        $("#priceInput").prop("required", true);
        if (row.price) $("#priceInput").val(row.price);
        break;

      case "Completed":
        nextStatus = "Ready for Release";
        break;

      case "Ready for Release":
        nextStatus = "Ready for Release";
        saveBtn.hide();
        break;

      default:
        nextStatus = "Pending";
    }

    $("#nextStatus").val(nextStatus);
    openModal("statusModal");
  });

  // Close modals
  $(document).on("click", ".close-modal", function () {
    closeModal($(this).data("close"));
  });

  $(".custom-modal").on("click", function (e) {
    if (e.target === this) $(this).hide();
  });
});
