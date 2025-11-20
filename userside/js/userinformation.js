const toggleBtn = document.getElementById("togglePassword");
const passwordFields = document.getElementById("passwordFields");

toggleBtn.addEventListener("click", function () {
  passwordFields.style.display =
    passwordFields.style.display === "none" ? "block" : "none";
});
document
  .getElementById("userInfoForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("loginuser/profile.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        showMessage(data.message, data.status);

        if (data.status === "success") {
          passwordFields.style.display = "none";
          toggleBtn.textContent = "Change Password";

          passwordFields.querySelectorAll("input").forEach((input) => {
            input.value = "";
          });
          setTimeout(() => {
            location.reload();
          }, 1500);
        }
      })
      .catch((err) => {
        showMessage("AJAX error: " + err, "error");
      });
  });
