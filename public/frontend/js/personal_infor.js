function toggleSubMenu(event) {
    event.preventDefault();
    var subMenu = document.getElementById("subMenu");
    if (subMenu.style.display === "block") {
        subMenu.style.display = "none"; // Ẩn submenu nếu đã hiển thị
    } else {
        subMenu.style.display = "block"; // Hiển thị submenu nếu đang ẩn
    }
}