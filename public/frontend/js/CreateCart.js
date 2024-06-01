var cart = JSON.parse(sessionStorage.getItem('cart'));
if (cart) {
    var cartContainer = document.querySelector('#list');
    cartContainer.innerHTML = " ";

    var cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    cart.reverse();
    cart.forEach(pro => {
        // console.log(pro.product_name);
        // console.log(pro.product_image);
        // console.log(pro.product_price);
        // console.log(pro.product_id);
        var currentURL = window.location.href;
        var lastSlashIndex = currentURL.lastIndexOf("/");
        var parentURL = currentURL.slice(0, lastSlashIndex);
        var proURL =parentURL+('/chi-tiet-san-pham/')+pro.product_id;

        const Item = document.createElement('div');
        Item.className = 'item';

        const Checkbox = document.createElement('input');
        Checkbox.type = 'checkbox';
        Checkbox.className = 'checkbox';

        const DivImg = document.createElement('div');
        DivImg.className = 'img_product';
        DivImg.text = "dsdfs";

        const taga = document.createElement('a');
        taga.href = proURL;

        const image = document.createElement('img');
        image.src = `public/uploads/product/${pro.product_image}`;
        image.className = 'product_img';
        image.alt = "sp";

        taga.appendChild(image);
        DivImg.appendChild(taga);

        const DivInfo = document.createElement('div');
        DivInfo.className = 'item-info';
        const name = document.createElement('div');
        name.className = 'name';
        const tagname = document.createElement('a');
        tagname.href=proURL;

        const proname = document.createElement('div');
        proname.textContent = pro.product_name;
        proname.className = 'product-name';
        tagname.appendChild(proname);
        const proid = document.createElement('input');
        proid.type = 'hidden';
        proid.className = 'product-id';
        proid.value = pro.product_id;

        name.appendChild(tagname);
        name.appendChild(proid);

        const decribe = document.createElement('div');
        decribe.className = "product-decribe";
        var t = document.createTextNode('(Màu: ');
        decribe.appendChild(t);
        const color = document.createElement('input');
        color.type = 'hidden';
        color.className = 'color';
        color.value = pro.product_color;
        decribe.appendChild(color);
        var t = document.createTextNode(pro.product_color + ", Kích cỡ: ");
        decribe.appendChild(t);
        const size = document.createElement('input');
        size.type = 'hidden';
        size.className = 'size';
        size.value = pro.product_size;
        decribe.appendChild(size);
        var t = document.createTextNode(pro.product_size + ')');
        decribe.appendChild(t);

        const product_price = document.createElement('div');
        product_price.className = 'product-price';

        const priceval = document.createElement('input');
        priceval.type = 'hidden';
        priceval.className = 'price';
        priceval.value = pro.product_price;
        product_price.appendChild(priceval);

        const price = pro.product_price;
        const formattedPrice = parseInt(price).toLocaleString();

        const pricetext = document.createElement('p');
        pricetext.className = 'price_text';
        pricetext.textContent = formattedPrice + "đ";
        product_price.appendChild(pricetext);

        const number_input = document.createElement('div');
        number_input.className = "number-input";

        const decrease_button = document.createElement('input');
        decrease_button.type = 'button';
        decrease_button.className = 'decrease_button';
        decrease_button.value = "-";
        number_input.appendChild(decrease_button);

        const inputElement = document.createElement('input');
        inputElement.type = 'number';
        inputElement.className = 'quantity_values';
        inputElement.name = 'quantity';
        if(parseInt(pro.product_quantity) > parseInt(pro.product_inventory)) inputElement.value = pro.product_inventory;
        else inputElement.value = pro.product_quantity;
        inputElement.setAttribute('aria-label', 'Product quantity');
        inputElement.size = '4';
        inputElement.min = '1';
        inputElement.step = '1';
        inputElement.setAttribute('inputmode', 'numeric');
        inputElement.autocomplete = 'off';

        number_input.appendChild(inputElement);

        const increaseButton = document.createElement('input');
        increaseButton.type = 'button';
        increaseButton.value = '+';
        increaseButton.className = 'increase_button';
        number_input.appendChild(increaseButton);

        const inventory = document.createElement('input');
        inventory.type = 'hidden';
        inventory.className = 'inventory';
        inventory.value = parseInt(pro.product_inventory);
        number_input.appendChild(inventory);

        product_price.appendChild(number_input);

        const sum = pro.product_price * pro.product_quantity;
        const formattedSum = parseInt(sum).toLocaleString();

        const total = document.createElement('p');
        total.className = 'total';
        total.textContent = formattedSum + "đ";
        product_price.appendChild(total);

        const removeParagraph = document.createElement('p');
        removeParagraph.className = 'remove';
        const icon = document.createElement('i');
        icon.className = 'fa-solid fa-trash';
        removeParagraph.appendChild(icon);
        var t = document.createTextNode('Xóa');
        removeParagraph.appendChild(t);

        // Thêm nội dung "Xóa" vào trong đối tượng paragraph
        // removeParagraph.textContent = ' Xóa';

        DivInfo.appendChild(name);
        DivInfo.appendChild(decribe);
        DivInfo.appendChild(product_price);
        DivInfo.appendChild(removeParagraph);

        Item.appendChild(Checkbox);
        Item.appendChild(DivImg);
        Item.appendChild(DivInfo);

        cartContainer.appendChild(Item);

    });
}