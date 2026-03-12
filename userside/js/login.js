function setupModal(
  modalId,
  openBtnSelector,
  closeSelector,
  otherModalIds = []
) {
  const modal = document.getElementById(modalId);
  if (!modal) return null;

  let openBtns = [];
  try {
    openBtns = Array.from(document.querySelectorAll(openBtnSelector));
  } catch (e) {
    openBtns = [];
  }

  if (openBtns.length === 0) {
    if (openBtnSelector && openBtnSelector[0] === "#") {
      const el = document.getElementById(openBtnSelector.slice(1));
      if (el) openBtns = [el];
    } else {
      const byClass = Array.from(
        document.querySelectorAll("." + openBtnSelector)
      );
      const byId = document.getElementById(openBtnSelector);
      openBtns = byClass.concat(byId ? [byId] : []);
    }
  }

  const closeBtn = modal.querySelector(closeSelector);

  const openHandler = (e) => {
    if (e) e.preventDefault();
    otherModalIds.forEach((id) => {
      const m = document.getElementById(id);
      if (m) m.style.display = "none";
    });
    modal.style.display = "block";
  };

  openBtns.forEach((btn) => {
    if (btn) btn.addEventListener("click", openHandler);
  });

  if (closeBtn)
    closeBtn.addEventListener("click", () => (modal.style.display = "none"));

  const outsideClickHandler = (event) => {
    if (event.target === modal) modal.style.display = "none";
  };
  window.addEventListener("click", outsideClickHandler);

  return modal;
}

const loginModal = setupModal("loginModal", ".openLoginModal", ".close", [
  "registerModal1",
  "forgotPasswordModal",
]);

const registerModal = setupModal("registerModal1", ".openRegister", ".close", [
  "loginModal",
  "forgotPasswordModal",
]);

const forgotModal = setupModal("forgotPasswordModal", ".openForgot", ".close", [
  "loginModal",
  "registerModal1",
]);

document.querySelectorAll(".backToLogin").forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    if (forgotModal) forgotModal.style.display = "none";
    if (registerModal) registerModal.style.display = "none";
    if (loginModal) loginModal.style.display = "block";
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const inputs = document.querySelectorAll(".wrapper form .field input");

  inputs.forEach((input) => {
    if (input.type !== "submit") {
      function checkValue() {
        const label = input.nextElementSibling;
        if (label && label.tagName === "LABEL") {
          if (input.value || document.activeElement === input) {
            label.classList.add("active");
          } else {
            label.classList.remove("active");
          }
        }
      }

      checkValue();

      input.addEventListener("input", checkValue);
      input.addEventListener("focus", checkValue);
      input.addEventListener("blur", checkValue);
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const contactInput = document.querySelector('input[name="contact"]');

  if (contactInput) {
    contactInput.addEventListener("input", function (e) {
      let value = this.value.replace(/\D/g, "");

      if (value.length > 11) {
        value = value.substring(0, 11);
      }

      if (!value.startsWith("09") && value.length > 0) {
        value = "09" + value.substring(2);
      }

      this.value = value;

      const label = this.nextElementSibling;
      if (label && label.tagName === "LABEL") {
        if (this.value || document.activeElement === this) {
          label.classList.add("active");
        } else {
          label.classList.remove("active");
        }
      }
    });

    contactInput.addEventListener("blur", function () {
      if (this.value.length > 0 && !this.value.match(/^09[0-9]{9}$/)) {
        alert("Please enter a valid Philippine mobile number (09XXXXXXXXX)");
        this.focus();
      }
    });
  }

  const inputs = document.querySelectorAll(".wrapper form .field input");

  inputs.forEach((input) => {
    if (input.type !== "submit") {
      function checkValue() {
        const label = input.nextElementSibling;
        if (label && label.tagName === "LABEL") {
          if (input.value || document.activeElement === input) {
            label.classList.add("active");
          } else {
            label.classList.remove("active");
          }
        }
      }

      checkValue();

      input.addEventListener("input", checkValue);
      input.addEventListener("focus", checkValue);
      input.addEventListener("blur", checkValue);
    }
  });

  const registerForm = document.getElementById("registerForm");
  if (registerForm) {
    registerForm.addEventListener("submit", function (e) {
      const contactField = this.querySelector('input[name="contact"]');
      if (contactField && !contactField.value.match(/^09[0-9]{9}$/)) {
        e.preventDefault();
        alert("Please enter a valid Philippine mobile number (09XXXXXXXXX)");
        contactField.focus();
        return false;
      }
    });
  }
});
