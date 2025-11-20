const problemSelect = document.getElementById("problemSelect");
const otherProblemField = document.getElementById("otherProblemField");
const otherInput = otherProblemField.querySelector("input");

problemSelect.addEventListener("change", function () {
  if (this.value === "Others") {
    otherProblemField.style.display = "block";
    otherInput.required = true;
  } else {
    otherProblemField.style.display = "none";
    otherInput.required = false;
    otherInput.value = "";
  }
});

document
  .getElementById("bookServiceForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const messageBox = document.getElementById("messageBox1");

    fetch("service/submitservice.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        messageBox.style.display = "block";
        messageBox.style.padding = "15px";
        messageBox.style.marginBottom = "10px";
        messageBox.style.borderRadius = "5px";
        messageBox.style.color = "#fff";
        messageBox.style.backgroundColor =
          data.status === "success" ? "#28a745" : "#dc3545";
        messageBox.textContent = data.message;

        if (data.status === "success") {
          this.reset();
          otherProblemField.style.display = "none";
        }

        setTimeout(() => {
          messageBox.style.display = "none";
        }, 3000);
      })
      .catch(() => {
        messageBox.style.display = "block";
        messageBox.style.backgroundColor = "#dc3545";
        messageBox.textContent = "An unexpected error occurred.";
        setTimeout(() => (messageBox.style.display = "none"), 3000);
      });
  });
