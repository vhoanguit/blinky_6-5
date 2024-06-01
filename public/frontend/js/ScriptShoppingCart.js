// 

function updateAllTotal() {
    const orderItems = document.querySelectorAll('.order_item');
    let total = 0;
    orderItems.forEach(item => {
        // alert("sa");
        const price = parseInt(item.querySelector('.order_price').textContent.replace(/\D/g, ''));
        total += price;
    });
    document.querySelector('.all_total').textContent = total.toLocaleString() + 'đ';
}

function createOrderItemNode(product) {
    const orderItem = document.createElement('div');
    orderItem.className = 'order_item';
    const productName = product.querySelector('.product-name').textContent;
    const productDescription = product.querySelector('.product-decribe').textContent;
    const productQuantity = product.querySelector('.quantity_values').value;
    const productPrice = product.querySelector('.price').value;
    const productId = product.querySelector('.product-id').value;
    const productSize = product.querySelector('.size').value;

    orderItem.innerHTML = `
      <div class="order_name">${productName}</div>
      <input type="hidden" class="order_id" value="${productId}"\>
      <input type="hidden" class="order_size" value="${productSize}"\>
      <div class="order_description">${productDescription}</div>
      <div class="order_quantity">SL: ${productQuantity}</div>
      <div class="order_price">Đơn giá: ${(productPrice * productQuantity).toLocaleString()}đ</div>
  `;
    return orderItem;
}

function updateOrderItemNode(product) {
    const productName = product.querySelector('.product-name').textContent;
    const productQuantity = product.querySelector('.quantity_values').value;
    const productPrice = product.querySelector('.price').value;
    const productid = product.querySelector('.product-id').value;
    const productsize = product.querySelector('.size').value;

    const orderItems = document.querySelectorAll('.order_item');
    orderItems.forEach(item => {

        if ((item.querySelector('.order_id').value == productid) && (item.querySelector('.order_size').value == productsize)) 
        {
            
            item.querySelector('.order_quantity').textContent = 'SL: ' + productQuantity;
            item.querySelector('.order_price').textContent = 'Đơn giá: ' + (productPrice * productQuantity).toLocaleString() + 'đ';
        }

    });
}

document.querySelectorAll('.checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const product = this.closest('.item');

        const orderContainer = document.querySelector('.order_items');
        if (this.checked) {
            const orderItem = createOrderItemNode(product);

            orderContainer.appendChild(orderItem);
        } else {

            const productid = product.querySelector('.product-id').value;
            const productsize = product.querySelector('.size').value;

            const orderItems = document.querySelectorAll('.order_item');
            orderItems.forEach(item => {
                if ((item.querySelector('.order_id').value == productid) && (item.querySelector('.order_size').value == productsize)) {
                    orderContainer.removeChild(item);
                }
            });
        }
        updateAllTotal();
    });
});

document.querySelectorAll('.quantity_values').forEach(input => {
    input.addEventListener('input', function () {
        const product = this.closest('.item');

        const this_inventory = parseInt(product.querySelector('.inventory').value);
        const amountElement = product.querySelector('.quantity_values');
        let amount = parseInt(amountElement.value);
        amount = (isNaN(amount) || amount == 0) ? 1 : amount;
        amount = (amount > this_inventory) ? this_inventory : amount;
        amountElement.value = amount;

        const pricePerItem = parseInt(product.querySelector('.price').value);
        const totalElement = product.querySelector('.total');
        totalElement.textContent = (pricePerItem * amount).toLocaleString() + 'đ';
        if (product.querySelector('.checkbox').checked) {
            updateOrderItemNode(product);
            updateAllTotal();
        }
        let cart = JSON.parse(sessionStorage.getItem('cart'));
        if(cart) UpdatSession(this,cart,amount);
    });
});



document.querySelectorAll('.decrease_button').forEach(button => {
    button.addEventListener('click', function () {
        const quantityInput = this.nextElementSibling;
        let quantity = parseInt(quantityInput.value);

        if (quantity > 1) {
            quantity--;
            quantityInput.value = quantity;
            quantityInput.dispatchEvent(new Event('input'));

            let cart = JSON.parse(sessionStorage.getItem('cart'));
            if(cart) UpdatSession(this,cart,quantity);
        }

    });
});

document.querySelectorAll('.increase_button').forEach(button => {
    button.addEventListener('click', function () {

        const quantityInput = this.previousElementSibling;
        let quantity = parseInt(quantityInput.value);

        const next = this.nextElementSibling;

        let inventory = parseInt(next.value);

        if (quantity < inventory) {
            quantity++;
            quantityInput.value = quantity;
            quantityInput.dispatchEvent(new Event('input'));

            let cart = JSON.parse(sessionStorage.getItem('cart'));
            if(cart) UpdatSession(this,cart,quantity);
        }
    });
});
function UpdatSession(node , cart, quantity)
{
        const product = node.closest('.item');
        const productid = product.querySelector('.product-id').value;
        const productsize = product.querySelector('.size').value;
        let existingProduct = cart.find(item => (item.product_id === productid && item.product_size === productsize));
        if (existingProduct) existingProduct.product_quantity = quantity;
        sessionStorage.setItem('cart', JSON.stringify(cart));
}

document.querySelectorAll('.remove').forEach(removeButton => {
    removeButton.addEventListener('click', function () {
        const product = this.closest('.item');
        const productid = product.querySelector('.product-id').value;
        const productsize = product.querySelector('.size').value;
        // const productName = product.querySelector('.product-name').textContent;

        const orderContainer = document.querySelector('.order_items');
        const checkbox = product.querySelector('.checkbox');
        if (checkbox.checked) {
            const orderItems = document.querySelectorAll('.order_item');
            orderItems.forEach(item => {
                if (
                    (item.querySelector('.order_id').value == productid) && (item.querySelector('.order_size').value == productsize)
                ) {

                    orderContainer.removeChild(item);
                }
            });
        }
        product.remove();
        updateAllTotal();
        
        var cart = JSON.parse(sessionStorage.getItem('cart'));
        if(cart)
        {
            cart = cart.filter(item => !(item.product_id === productid && item.product_size === productsize)) ;
            sessionStorage.setItem('cart', JSON.stringify(cart));
        }
    });
});



