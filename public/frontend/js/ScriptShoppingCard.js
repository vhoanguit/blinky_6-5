
function updateAllTotal() {
  const orderItems = document.querySelectorAll('.order_item');
  let total = 0;
  orderItems.forEach(item => {
      const price = parseInt(item.querySelector('.order_price').textContent.replace(/\D/g, ''));
      total += price;
  });
  document.querySelector('.all_total').textContent = total.toLocaleString('en-US') + 'đ';
}

function createOrderItemNode(product) {
  const orderItem = document.createElement('div');
  orderItem.className = 'order_item';
  const productName = product.querySelector('.product-name').textContent;
  const productDescription = product.querySelector('.product-decribe').textContent;
  const productQuantity = product.querySelector('.quantity_values').value;
  const productPrice = product.querySelector('.price').value;

  orderItem.innerHTML = `
      <div class="order_name">${productName}</div>
      <div class="order_description">${productDescription}</div>
      <div class="order_quantity">SL: ${productQuantity}</div>
      <div class="order_price">Đơn giá: ${(productPrice * productQuantity).toLocaleString('en-US')}đ</div>
  `;
  return orderItem;
}

function updateOrderItemNode(product) {
  const productName = product.querySelector('.product-name').textContent;
  const productQuantity = product.querySelector('.quantity_values').value;
  const productPrice = product.querySelector('.price').value;

  const orderItems = document.querySelectorAll('.order_items');
  orderItems.forEach(item => {
      if (item.querySelector('.order_name').textContent === productName) {
          item.querySelector('.order_quantity').textContent = 'SL: ' +productQuantity;
          item.querySelector('.order_price').textContent ='Đơn giá: ' +(productPrice * productQuantity).toLocaleString('en-US') + 'đ';
      }
  });
}

document.querySelectorAll('.checkbox').forEach(checkbox => {
  checkbox.addEventListener('change', function() {
      const product = this.closest('.item');
     
      const orderContainer = document.querySelector('.order_items');
      if (this.checked) {
          const orderItem = createOrderItemNode(product);

          // orderItem.className="order";

          orderContainer.appendChild(orderItem);
      } else {
      
          const productName = product.querySelector('.product-name').textContent;
          const orderItems = document.querySelectorAll('.order_item');
          orderItems.forEach(item => {
              if (item.querySelector('.order_name').textContent === productName) {
                  orderContainer.removeChild(item);
              }
          });
      }
      updateAllTotal();
  });
});

document.querySelectorAll('.quantity_values').forEach(input => {
  input.addEventListener('input', function() {
      const product = this.closest('.item');
      const pricePerItem = parseInt(product.querySelector('.price').value);
      const quantity = parseInt(this.value) || 1; 
      const totalElement = product.querySelector('.total');
      totalElement.textContent = (pricePerItem * quantity).toLocaleString('en-US') + 'đ';
      if (product.querySelector('.checkbox').checked) {
          updateOrderItemNode(product);
          updateAllTotal();
      }
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

document.querySelectorAll('.remove').forEach(removeButton => {
  removeButton.addEventListener('click', function() {
      const product = this.closest('.item');
      const productName = product.querySelector('.product-name').textContent;
      const orderContainer = document.querySelector('.order_items');
      const checkbox = product.querySelector('.checkbox');
      if (checkbox.checked) {
          const orderItems = document.querySelectorAll('.order_item');
          orderItems.forEach(item => {
              if (item.querySelector('.order_name').textContent === productName) {
                  orderContainer.removeChild(item);
              }
          });
      }
      product.remove();
      updateAllTotal();
  });
});