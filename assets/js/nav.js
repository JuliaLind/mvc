export default () => {
  let myNav = document.getElementById("myTopnav");
  let hamburger = document.getElementById("nav-toggle");
  hamburger.addEventListener("click", function () {
    console.log("clicked");
    if (myNav.className === "topnav") {
      myNav.className += " responsive";
    } else {
      myNav.className = "topnav";
    }
  })

  console.log("tester");
}
