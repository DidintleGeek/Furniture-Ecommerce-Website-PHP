function toggleSidebar() {
  console.log("Sidebar toggle triggered");
  document.getElementById("sidebar").classList.toggle("open");
}

document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.querySelector(".like-toggle");
  if (toggleBtn) {
    console.log("Like icon found");
    toggleBtn.addEventListener("click", function (e) {
      e.preventDefault(); // prevent jump
      toggleSidebar();
    });
  } else {
    console.log("❌ Like icon not found");
  }
});


