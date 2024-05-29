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
        var imgsrc=document.getElementById('main_image').src;
        
        let currentIndex = -1; //Biểu thị main_image với index=-1
    
        function updateMainImage(index) {
            // Loại bỏ lớp active khỏi tất cả các hình ảnh phụ
            extraImages.forEach((img) => img.classList.remove('active'));
            
            if (index === -1) {
                
                mainImage.src=imgsrc;
                // alert("sad");
                // console.log(imgsrc)
                //mainImage.src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}"
                //mainImage.src = 'https://via.placeholder.com/460x460'; 
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
    let render = (amount) =>{
        amountElement.value = amount;
    }
    //Handle plus button
    let handlePlus= () =>{
        amount++;
        render(amount);
        // console.log(amount);
    }

    //Handle minus button
    let handleMinus= () =>{
        if (amount > 1)  
            amount--;
        render(amount);
        // console.log(amount);
    }

    amountElement.addEventListener('input', () => {
        amount= amountElement.value;
        amount= parseInt(amount);
        amount = (isNaN(amount)||amount==0)?1:amount;
        render(amount);
        console.log(amount);

    });

    const listcard=[...document.querySelectorAll('.carousel')];
    const nxtbtn=[...document.querySelectorAll('.nxt-btn')];
    const prebtn=[...document.querySelectorAll('.pre-btn')];
    
    
    // Related Products
    listcard.forEach((item,i)=>{
        let current=0;
        let length=listcard.length;
        nxtbtn[i].addEventListener('click', ()=>
        {
            if(current!=2)
            {
                current++;
                let width= item.offsetWidth;
                item.scrollLeft=width*current;
                
            }
            else
            {
                current=0;
                item.scrollLeft=0;  
            }
        });
        prebtn[i].addEventListener('click', ()=>
        {
            current--;
            let width= item.offsetWidth;
            item.scrollLeft=width*current;
        });
    
    })

    // Favorite button
    function toggleFavorite() {
        var heartSvg = document.getElementById("heart_svg");
        var heartPath = document.getElementById("heart_path");
    
        // Kiểm tra xem trạng thái hiện tại của biểu tượng
        if (heartSvg.classList.contains("bi-heart")) {
            // thay đổi sang biểu tượng trái tim đầy
            heartSvg.classList.remove("bi-heart");
            heartSvg.classList.add("bi-heart-fill");
            // Thay đổi dòng path để tô đậm trái tim
            heartPath.setAttribute("d", "M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314");
        } else {
            // Thay đổi sang biểu tượng trái tim rỗng
            heartSvg.classList.remove("bi-heart-fill");
            heartSvg.classList.add("bi-heart");
            // Thay đổi dòng path để trái tim trở về rỗng
            heartPath.setAttribute("d", "m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15");
        }
    }
    
    // Select color input type checkbox
    function selectOnlyThis(checkbox) {
        const checkboxes = document.querySelectorAll('.color_selection');
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false;
        });
    }
    
    
    
    // Size button
    function selectSize(button, size, sl) {

        var sldiv=document.querySelector('#quantity_of_product');
        sldiv.innerHTML='';

        var sizeButtons = document.querySelectorAll('.size');
    
        // Nếu button đã được chọn trước đó, bỏ chọn nó
        if (button.classList.contains('selected')) {
            button.classList.remove('selected');
        } else {
            // Loại bỏ lớp 'selected' từ tất cả các nút size
            sizeButtons.forEach(function(btn) {
                btn.classList.remove('selected');
            });
    
            // Thêm lớp 'selected' cho nút được nhấn
            button.classList.add('selected');
        }

        var newtext=document.createElement('p');
        var textsl = document.createTextNode(String(sl));
        var texttitle = document.createTextNode('  sản phẩm có sẵn');
        
        newtext.appendChild(textsl);
        newtext.appendChild(texttitle);
        
        sldiv.appendChild(newtext);

        // sldiv.innerHTML=textsl;

    }

 // Validate selection
 function validateSelection() {
    // alert("sda");
    // const colorSelected = document.querySelector('.color_selection:checked');
    
    const sizeSelected = document.querySelector('.size.selected');
    const quantity = parseInt(document.getElementById('amountnumber').value);

    // if (!colorSelected) {
    //     Swal.fire({
    //         icon: 'error',
    //         title: 'Lỗi',
    //         text: 'Vui lòng chọn màu sắc!'
    //     });
    //     return false;
    // }
    if (!sizeSelected) {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            text: 'Vui lòng chọn kích cỡ!'
        });
        return false;
    }
    if (quantity>100 || quantity < 1) {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi',
            text: 'Vui lòng nhập số lượng hợp lệ!'
        });
        return false;
    }

    return true;
}

// Add to cart

// function addToCart() {
    
//     if (validateSelection()) {
//         Swal.fire({
//             icon: 'success',
//             title: 'Thành công',
//             text: 'Sản phẩm đã được thêm vào giỏ hàng!'
//         }).then(() => {
            
//         });
//     }
// }

// $(document).ready(function(){
//     $('#add_product_to_cart').click(function(){
//         var id=$(this).data('id');
//         alert(id);

//     });
// });
function addToCart() {
    if (validateSelection()) {
        // const productId = document.getElementById('productid_hidden').value;
        // const quantity = document.getElementById('amountnumber').value;
        // const name = document.getElementById('title').value;
        // const price = document.getElementById('price_of_product_hihi').value;

        // const size = document.querySelector('.size.selected').textContent.trim();
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // }); 
        var id = $(this).data('id');
        var cart_product_id = $('.cart_product_id_'+id).val();
        var cart_product_name = $('.cart_product_name_'+id).val();
        var cart_product_image = $('.cart_product_image_'+id).val();
        var cart_product_price = $('.cart_product_price_'+id).val();
        var cart_product_quantity = $('.cart_product_quantity_'+id).val();
        var cart_product_size = $('.cart_product_size_'+id).val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '/add-to-cart',
            method: 'POST',
            data: {
                
                cart_product_id:cart_product_id,
                cart_product_name:cart_product_name,
                cart_product_image:cart_product_image,
                cart_product_price:cart_product_price,
                cart_product_quantity:cart_product_quantity,
                cart_product_size:cart_product_size,
                _token:_token
            },
            success: function() {          
                swal({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Sản phẩm đã được thêm vào giỏ hàng!',
                    // showCanCelButton:true,
                    // cancelButtonText:"Xem tiep",
                    // confirmButtonClass:"btn-success",
                    // confirmButtonText:"Di den gio hang",
                    // buttons: {
                    //     confirm: {
                    //         text: 'Di den gio hang',
                    //         className: 'btn-success'
                    //     }
                    // },
                    // closeOnConfirm:false
                },
                function (){
                    window.location.href="{{url('/shopping-cart')}}"
                });
                
            },
            error: function() {
                swal({
                    title: 'Lỗi!',
                    text: 'Đã xảy ra lỗi, vui lòng thử lại.',
                    icon: 'error',
                    // confirmButtonText: 'OK'
                });
            }
        });
    }
}
// Buy now
function buynow() {
    // alert('v');
    if (validateSelection()) {
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: 'Bạn đang được chuyển đến trang thanh toán!'
        }).then(() => {
            // Mua ngay (href=/checkout)
        });
    }
}


// AddtoCart button
// document.getElementById("add_to_cart").addEventListener("click", function() {
//     if (checkSelection()) {
//         var xhr = new XMLHttpRequest();
//         xhr.open("POST", "addToCart.php", true);
//         xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
//         xhr.onreadystatechange = function() {
//             if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
//                 var response = JSON.parse(xhr.responseText);
//                 alert(response.message);
//             }
//         };
//         var data = { type: "add_to_cart" };
//         xhr.send(JSON.stringify(data));
//     }
// });

// document.getElementById("buy_now").addEventListener("click", function() {
//     if (checkSelection()) {
//         var xhr = new XMLHttpRequest();
//         xhr.open("POST", "buynow.php", true);
//         xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
//         xhr.onreadystatechange = function() {
//             if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
//                 var response = JSON.parse(xhr.responseText);
//                 alert(response.message);
//                 // Điều hướng tới trang thanh toán nếu cần
//             }
//         };
//         var data = { type: "buy_now" };
//         xhr.send(JSON.stringify(data));
//     }
// });

    
// $(document).ready(function() {
//     $('#add_product_to_cart').click(function() {
//         addToCart();
//     });

//     $('#buy_now').click(function() {
//         buynow();
//     });
// });
