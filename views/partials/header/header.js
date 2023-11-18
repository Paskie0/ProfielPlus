// deze functie wordt geroepen in de html om het dropdown menu te openen/sluiten
function openMenu() {
  // selecteer 2 elementen met de id's als variables
  const headerDropdown = document.querySelector("#headerDropdown");
  const menuButton = document.querySelector("#menuButton");

  if (menuButton.ariaExpanded === "false") {
    // ariaExpanded is een html attribuut om aan te geven of een element wel of niet open is
    menuButton.ariaExpanded = "true";
    menuButton.disabled = true;
    // dit zorgt ervoor dat we de height kunnen animaten met transition omdat dat met "auto" niet kan
    headerDropdown.style.maxHeight = headerDropdown.scrollHeight + "px";
    headerDropdown.style.visibility = "visible";
    // de volgende code wordt pas uitgevoerd als alle transitions zijn afgerond
    headerDropdown.addEventListener("transitionend", () => {
      headerDropdown.style.visibility = "visible";
      menuButton.disabled = false;
    });
  } else {
    menuButton.ariaExpanded = "false";
    menuButton.disabled = true;
    // i.p.v. het element te verwijderen maken de height: 0 zodat we transitions kunnen gebruiken
    headerDropdown.style.maxHeight = "0";
    headerDropdown.addEventListener("transitionend", () => {
      headerDropdown.style.visibility = "hidden";
      menuButton.disabled = false;
    });
  }
}

const navLinks = document.querySelectorAll("#headerNav li a");
// creër een nieuw element in de html, op dit moment staat dit element nog nergens
const navBackground = document.createElement("div");
// voeg een class toe aan het nieuwe element
navBackground.classList.add("nav-background");
// plaats het nieuwe element als child van headerNav
document.getElementById("headerNav").appendChild(navBackground);

navLinks.forEach((link) => {
  // hiermee halen we de grootte van het element op als variable
  const linkRect = link.getBoundingClientRect();
  // om het dynamisch te maken bewegen we de background op basis van hoe groot de huidige link is
  const offsetLeft = linkRect.left - navLinks[0].getBoundingClientRect().left;
  navBackground.style.width = linkRect.width + "px";
  // activeer te styles op het moment dat je met de muis over een van de links beweegt
  link.addEventListener("mouseenter", () => {
    navBackground.style.translate = offsetLeft + "px";
    navBackground.style.width = linkRect.width + "px";
    navBackground.style.opacity = 0.5;
  });

  link.addEventListener("mouseout", () => {
    navBackground.style.left = 0;
    navBackground.style.opacity = 0;
  });
});
