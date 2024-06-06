document.addEventListener('DOMContentLoaded', function() {
    // Tìm tất cả các nút "Xóa"
    const removeButtons = document.querySelectorAll('.remove');

    removeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Tìm phần tử li chứa nút "Xóa" hiện tại
            const li = button.closest('li');
            if (li) {
                // Xóa phần tử li khỏi DOM
                li.remove();
            }
        });
    });
});

document.querySelectorAll('.decrease_button').forEach(button => {
  button.addEventListener('click', function() {
      const quantityInput = this.nextElementSibling;
      let quantity = parseInt(quantityInput.value);
      if (quantity > 1) {
          quantity--;
          quantityInput.value = quantity;
          quantityInput.dispatchEvent(new Event('input'));
      }
  });
});

document.querySelectorAll('.increase_button').forEach(button => {
  button.addEventListener('click', function() {
      const quantityInput = this.previousElementSibling;
      let quantity = parseInt(quantityInput.value);
      quantity++;
      quantityInput.value = quantity;
      quantityInput.dispatchEvent(new Event('input'));
  });
});