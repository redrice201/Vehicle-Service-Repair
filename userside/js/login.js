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
