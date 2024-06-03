
document.addEventListener('DOMContentLoaded', function() {
    var selectedColorsInput = document.getElementById('selectedColors');
    var selectedColors = JSON.parse(selectedColorsInput.value);
    var checkboxes = document.querySelectorAll('.checkbox_color');
    
    checkboxes.forEach(function(checkbox) {
        if (selectedColors.includes(checkbox.value)) {
            checkbox.checked = true;
        }
    });
});


// document.addEventListener('DOMContentLoaded', function() {
//     var productTitles = document.querySelectorAll('.product-title');

//     productTitles.forEach(function(productTitle) {
//         var maxWidth = parseInt(window.getComputedStyle(productTitle).maxWidth);

//         // Nếu chiều rộng của tiêu đề lớn hơn chiều rộng tối đa
//         if (productTitle.scrollWidth > maxWidth) {
//             // Thêm thuộc tính title để hiển thị tiêu đề đầy đủ khi di chuột qua
//             productTitle.setAttribute('title', productTitle.innerText);
//         }
//     });
// });
document.addEventListener('DOMContentLoaded', function() {
    var productNames = document.querySelectorAll('.product-name');

    productNames.forEach(function(productName) {
        // var maxWidth = parseInt(window.getComputedStyle(productName).maxWidth);

        // // Nếu chiều rộng của tiêu đề lớn hơn chiều rộng tối đa
        // if (productName.scrollWidth > maxWidth) {
            // Thêm thuộc tính title để hiển thị tiêu đề đầy đủ khi di chuột qua
            productName.setAttribute('title', productName.innerText);
        // }
    });
});