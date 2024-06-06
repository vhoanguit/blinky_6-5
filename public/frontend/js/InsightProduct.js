//Image slider

//Event for slider
document.addEventListener('DOMContentLoaded', () => {
    const mainImage = document.getElementById('main_image');
    const extraImages = document.querySelectorAll('.extra_image');

    extraImages.forEach(image => {
        image.addEventListener('click', () => {
            mainImage.src = image.src;
            mainImage.style.width = '460px';
            mainImage.style.height = '460px';
            mainImage.style.objectFit = 'cover'; // Hình ảnh đc cover toàn bộ
        });
    });
});

//Left and right button 
document.addEventListener('DOMContentLoaded', () => {
    const mainImage = document.getElementById('main_image');
    const extraImages = document.querySelectorAll('.extra_image');
    const leftBtn = document.querySelector('.left_btn');
    const rightBtn = document.querySelector('.right_btn');
    var imgsrc = document.getElementById('main_image').src;

    let currentIndex = -1; //Biểu thị main_image với index=-1

    function updateMainImage(index) {
        // Loại bỏ lớp active khỏi tất cả các hình ảnh phụ
        extraImages.forEach((img) => img.classList.remove('active'));

        if (index === -1) {
            mainImage.src = imgsrc;
        } else {
            mainImage.src = extraImages[index % extraImages.length].src;
            // Thêm lớp active vào hình ảnh phụ tương ứng
            extraImages[index % extraImages.length].classList.add('active');
        }
        mainImage.style.width = '460px';
        mainImage.style.height = '460px';
        mainImage.style.objectFit = 'cover';
    }

    rightBtn.addEventListener('click', () => {
        currentIndex++;
        if (currentIndex === extraImages.length) {
            currentIndex = -1; // Reset về main_image
        }
        updateMainImage(currentIndex);
    });

    leftBtn.addEventListener('click', () => {
        currentIndex--;
        if (currentIndex < -1) {
            currentIndex = extraImages.length - 1; // Lặp cho tới extra_image cuối
        }
        updateMainImage(currentIndex);
    });

    extraImages.forEach((image, index) => {
        image.addEventListener('click', () => {
            currentIndex = index; // Cập nhật currentIndex khi người dùng nhấn vào hình ảnh
            updateMainImage(currentIndex);
        });
    });

    //Khởi tạo tiếp main_image và tiếp tục vòng lặp
    updateMainImage(currentIndex);
});

//Tăng số lượng
let amountElement = document.getElementById('amountnumber');
let amount = amountElement.value;
// console.log(amount);
let render = (amount) => {
    amountElement.value = amount;
    let iven=sessionStorage.getItem('inventory');
    if(amount > parseInt(iven)) amountElement.value = parseInt(iven);
}
//Handle plus button
let handlePlus = () => {
    amount++;
    render(amount);
    // console.log(amount);
}

//Handle minus button
let handleMinus = () => {
    if (amount > 1)
        amount--;
    render(amount);
    // console.log(amount);
}

amountElement.addEventListener('input', () => {
    amount = amountElement.value;
    amount = parseInt(amount);
    amount = (isNaN(amount) || amount == 0) ? 1 : amount;
    render(amount);
});

const listcard = [...document.querySelectorAll('.carousel')];
const nxtbtn = [...document.querySelectorAll('.nxt-btn')];
const prebtn = [...document.querySelectorAll('.pre-btn')];


// Related Products
listcard.forEach((item, i) => {
    let current = 0;
    let length = listcard.length;
    nxtbtn[i].addEventListener('click', () => {
        if (current != 2) {
            current++;
            let width = item.offsetWidth;
            item.scrollLeft = width * current;

        }
        else {
            current = 0;
            item.scrollLeft = 0;
        }
    });
    prebtn[i].addEventListener('click', () => {
        current--;
        let width = item.offsetWidth;
        item.scrollLeft = width * current;
    });

})

// Select color input type checkbox
function selectOnlyThis(checkbox) {
    const checkboxes = document.querySelectorAll('.color_selection');
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false;
    });
}

// Size button
function selectSize(button, size, sl) {

    var sldiv = document.querySelector('#quantity_of_product');
    sldiv.innerHTML = '';

    var sizeButtons = document.querySelectorAll('.size');

    // Nếu button đã được chọn trước đó, bỏ chọn nó
    if (button.classList.contains('selected')) {
        button.classList.remove('selected');
        sessionStorage.setItem('inventory', 0);
        let iven=document.getElementById('total_inventory').value;
        var textsl = document.createTextNode(String(iven));
        
       document.querySelector('#amountnumber').value=1;
       
    } else {
        // Loại bỏ lớp 'selected' từ tất cả các nút size
        sizeButtons.forEach(function (btn) {
            btn.classList.remove('selected');
        });

        // Thêm lớp 'selected' cho nút được nhấn
        button.classList.add('selected');
        sessionStorage.setItem('inventory', sl);
        var textsl = document.createTextNode(String(sl));
    }

    var newtext = document.createElement('p');
    
    var texttitle = document.createTextNode('  sản phẩm có sẵn');

    newtext.appendChild(textsl);
    newtext.appendChild(texttitle);

    sldiv.appendChild(newtext);

    // sldiv.innerHTML=textsl;

}

// Validate selection
function validateSelection() {

    const sizeSelected = document.querySelector('.size.selected');
    const quantity = parseInt(document.getElementById('amountnumber').value);
    let inventory = sessionStorage.getItem('inventory');
    // var cart = JSON.parse(sessionStorage.getItem('cart'));
    // var bf=cart.product_quantity;

    if (!sizeSelected) {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            text: 'Vui lòng chọn kích cỡ!'
        });
        return false;
    }
    if (quantity > inventory || quantity < 1) {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            text: 'Số lượng chọn không hợp hợp lệ!'
        });
        return false;
    }

    return true;
}



// Add to cart
function addToCart() {
    // alert('n'); 

    if (validateSelection()) {
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: 'Sản phẩm đã được thêm vào giỏ hàng!',
        }
        ).then(() => {
            var customer=document.getElementById('customer-id').value;
            if(!customer)
            {
                var sizeSelected = document.querySelector('.size.selected');

                var proid = $('#productid_hidden').val();
                var proname = $('#productname_hidden').val();
                var proimg = $('#productimage_hidden').val();
                var procolor = $('#productcolor_hidden').val();
                var proprice = $('#productprice_hidden').val();
                var prosize = sizeSelected.value;
                var proquantity = $('#amountnumber').val();
                var inventory=sessionStorage.getItem('inventory');
                

                var cart = { product_id: proid, product_size: prosize, product_image: proimg, product_name: proname, product_color: procolor, product_price: proprice, product_quantity: proquantity, product_inventory: inventory };
                changequantity(cart);
                countProductsInCart();
            }
        });
    }
}

function changequantity(product)//hàm để tăng số lượng nếu chọn trùng
{
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

    let existingProduct = cart.find(item => (item.product_id === product.product_id && item.product_size === product.product_size));

    if (existingProduct) {
        existingProduct.product_quantity = parseInt(existingProduct.product_quantity) + parseInt(product.product_quantity);
    } else {
        cart.push(product);
    }
    sessionStorage.setItem('cart', JSON.stringify(cart));
  
}


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