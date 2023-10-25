function openMenu() {
  let headerDropdown = document.querySelector("#headerDropdown");
  let menuButton = document.querySelector("#menuButton");

  if (menuButton.ariaExpanded === "false") {
    menuButton.ariaExpanded = "true";
    menuButton.disabled = true;
    headerDropdown.style.maxHeight = headerDropdown.scrollHeight + "px";
    headerDropdown.style.visibility = "visible";
    headerDropdown.addEventListener("transitionend", () => {
      headerDropdown.style.visibility = "visible";
      menuButton.disabled = false;
    });
  } else {
    menuButton.ariaExpanded = "false";
    menuButton.disabled = true;
    headerDropdown.style.maxHeight = "0";
    headerDropdown.addEventListener("transitionend", () => {
      headerDropdown.style.visibility = "hidden";
      menuButton.disabled = false;
    });
  }
}
const navLinks = document.querySelectorAll("#headerNav a");
const navBackground = document.createElement("div");
navBackground.classList.add("nav-background");
document.getElementById("headerNav").appendChild(navBackground);

navLinks.forEach((link) => {
  const linkRect = link.getBoundingClientRect();
  const offsetLeft = linkRect.left - navLinks[0].getBoundingClientRect().left;
  navBackground.style.width = linkRect.width + "px";
  link.addEventListener("mouseenter", () => {
    navBackground.style.translate = offsetLeft + "px";
    navBackground.style.width = linkRect.width + "px";
    navBackground.style.opacity = 0.5;
  });

  link.addEventListener("mouseout", () => {
    navBackground.style.translate = 0;
    navBackground.style.left = 0;
    navBackground.style.opacity = 0;
  });
});
