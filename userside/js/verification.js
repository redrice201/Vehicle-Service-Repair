//forgot password

$(document).ready(function () {
  $("#forgotPasswordForm").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "forgotpassword/forgot_password.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        showMessage(
          response.message,
          response.status === "success" ? "success" : "error"
        );

        if (response.status === "success") {
          $("#forgotVerifyEmail").val(
            $("#forgotPasswordForm input[name='email']").val()
          );
          $("#forgotPasswordModal").hide();
          $("#forgotVerifyModal").show();
        }
      },
      error: function (xhr, status, error) {
        showMessage("AJAX Error: " + error, "error");

        console.log("AJAX Error: " + error, "error1");
      },
    });
  });
  $("#forgotVerifyForm").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "forgotpassword/forgot_verify.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        showMessage(
          response.message,
          response.status === "success" ? "success" : "error"
        );

        if (response.status === "success") {
          $("#forgotVerifyModal").hide();
          $("#changeForgotPasswordModal").show();
        }
      },
      error: function (xhr, status, error) {
        showMessage("AJAX Error: " + error, "error");

        console.log("AJAX Error: " + error, "error2");
      },
    });
  });

  $("#changeForgotPasswordForm").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "forgotpassword/changepass.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        showMessage(
          response.message,
          response.status === "success" ? "success" : "error"
        );

        if (response.status === "success") {
          $("#changeForgotPasswordModal").hide();
          $("#loginModal").show();
        }
      },
      error: function (xhr, status, error) {
        showMessage("AJAX Error: " + error, "error");
      },
    });
  });

  $(".close").click(function () {
    $(this).closest(".modal").hide();
  });
});

function showMessage(message, type = "info") {
  const box = document.getElementById("messageBox");
  box.textContent = message;

  switch (type) {
    case "success":
      box.style.backgroundColor = "#28a745";
      break;
    case "error":
      box.style.backgroundColor = "#dc3545";
      break;
    default:
      box.style.backgroundColor = "#007bff";
  }

  box.style.display = "block";
  box.classList.remove("hide");
  box.classList.add("show");

  setTimeout(() => {
    box.classList.remove("show");
    box.classList.add("hide");
    setTimeout(() => (box.style.display = "none"), 300);
  }, 3000);
}

//register password

$(document).ready(function () {
  $("#registerForm").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "verification/registeremailverify.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        console.log(response);

        if (response.status === "verify") {
          $("#registerModal1").hide();
          $("#verifyEmail").val(response.email);
          $("#verifyModal").show();
          showMessage("Verification code sent. Check your email.", "success");
        } else if (response.status === "error") {
          showMessage(response.message, "error");
        }
      },
      error: function (xhr, status, error) {
        showMessage("AJAX error: " + error, "error");
      },
    });
  });

  $("#verifyForm").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "verification/verify.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        showMessage(
          response.message,
          response.status === "success" ? "success" : "error"
        );

        if (response.status === "success") {
          $("#verifyModal").hide();
        }
      },
      error: function (xhr, status, error) {
        showMessage("AJAX Error: " + error, "error");
      },
    });
  });

  $(".close").click(function () {
    $(this).closest(".modal").hide();
  });
});

function showMessage(message, type = "info") {
  const box = document.getElementById("messageBox");
  box.textContent = message;

  switch (type) {
    case "success":
      box.style.backgroundColor = "#28a745";
      break;
    case "error":
      box.style.backgroundColor = "#dc3545";
      break;
    default:
      box.style.backgroundColor = "#007bff";
  }

  box.style.display = "block";
  box.classList.remove("hide");
  box.classList.add("show");

  setTimeout(() => {
    box.classList.remove("show");
    box.classList.add("hide");
    setTimeout(() => (box.style.display = "none"), 300);
  }, 3000);
}

$(document).ready(function () {
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "loginuser/login.php",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        showMessage(
          response.message,
          response.status === "success" ? "success" : "error"
        );

        if (response.status === "success") {
          $("#loginModal").hide();

          setTimeout(() => {
            if (response.is_admin == 1) {
              window.location.href = "../adminside/dashboard.php";
            } else {
              location.reload();
            }
          }, 1200);
        }
      },
      error: function (xhr, status, error) {
        showMessage("AJAX Error: " + error, "error");
      },
    });
  });
});
