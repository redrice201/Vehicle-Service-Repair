$(document).ready(function () {
  var $grid = $("#serviceGrid").isotope({
    itemSelector: ".service-item",
    layoutMode: "vertical",
  });

  $(".filter-btn").on("click", function () {
    $(".filter-btn").removeClass("active");
    $(this).addClass("active");
    var filterValue = $(this).attr("data-filter");
    $grid.isotope({ filter: filterValue });
    currentPage = 1;
    paginateItems();
  });

  var itemsPerPage = 5;
  var currentPage = 1;

  function paginateItems() {
    var $items = $grid.isotope("getFilteredItemElements");
    var totalPages = Math.ceil($items.length / itemsPerPage);
    currentPage = Math.min(currentPage, totalPages) || 1;

    $($items)
      .hide()
      .slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage)
      .show();
    $grid.isotope("layout");

    var pageNumbers = "";
    for (var i = 1; i <= totalPages; i++) {
      pageNumbers +=
        '<button class="btn btn-sm btn-light page-btn" data-page="' +
        i +
        '">' +
        i +
        "</button> ";
    }
    $("#pageNumbers").html(pageNumbers);
  }

  $(document).on("click", ".page-btn", function () {
    currentPage = parseInt($(this).data("page"));
    paginateItems();
  });

  $(".prev").click(function () {
    if (currentPage > 1) {
      currentPage--;
      paginateItems();
    }
  });
  $(".next").click(function () {
    var $items = $grid.isotope("getFilteredItemElements");
    var totalPages = Math.ceil($items.length / itemsPerPage);
    if (currentPage < totalPages) {
      currentPage++;
      paginateItems();
    }
  });

  paginateItems();
});
$(document).ready(function () {
  // Open modal function
  function openModal(id) {
    $("#" + id)
      .fadeIn(200)
      .css("display", "flex");
  }

  // Close modal function
  function closeModal(id) {
    $("#" + id).fadeOut(200);
  }

  // Click payment button
  $(document).on("click", ".payment-btn", function (e) {
    e.stopPropagation();
    let orderId = $(this).data("order-id");
    $("#paymentOrderID").val(orderId);
    openModal("paymentModal");
  });

  // Close modal
  $(document).on("click", ".close-modal", function () {
    let modalID = $(this).data("close");
    closeModal(modalID);
  });

  // Click outside modal content to close
  $(".custom-modal").on("click", function (e) {
    if (e.target === this) {
      closeModal($(this).attr("id"));
    }
  });
});
