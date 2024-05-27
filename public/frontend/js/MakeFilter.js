// var xmlHttp=false;

// if(window.XMLHttpRequest)
// {
//     xmlHttp=new XMLHttpRequest();
// }

// function MakeFilter() {

//     var currentURL = window.location.href;// Tìm vị trí của dấu gạch chéo cuối cùng
//     var lastSlashIndex = currentURL.lastIndexOf('/');// Lấy phần cuối cùng của đường link (phần chứa số 11)
//     var numberString = currentURL.substring(lastSlashIndex + 1);// Chuyển đổi chuỗi số thành số nguyên
//     var number = parseInt(numberString);
//     console.log(number);

//     var obj = document.getElementById('products');
//     var filter = document.getElementsByClassName("checkbox_color");
//     var filter_checked = [];

//     var url;

//     //Bộ lọc theo màu
//     for (let i = 0; i < filter.length; i++) {
//         if (filter[i].checked) {
//             filter_checked.push(filter[i].value);
//         }
//     }

//     if (filter_checked.length > 0) 
//     {
//         let i = 0;
//         //url = "resources/views/pages/sanpham/ProductFilter.php?filter_checked[]=" + encodeURIComponent(filter_checked[i]);
//         url = encodeURIComponent(number) +"/resources/php/ProductFilter.php?filter_checked[]=" + encodeURIComponent(filter_checked[i]);
//         i++;
        

//         for (i; i < filter_checked.length; i++) 
//         {
//             url = url + "&filter_checked[]=" + encodeURIComponent(filter_checked[i]);
//         }

//         // if (!isNaN(number)) 
//         // {
//         //     url = url + "&cate=" + encodeURIComponent(number);
//         // }

//     }
//     else 
//     {
//         url = "resources/php/ProductFilter.php?";
//     }
    
//     url = url + "&min_price=" + encodeURIComponent(document.getElementById("price_from").value)
//     + "&max_price=" + encodeURIComponent(document.getElementById("price_to").value);


//     console.log(url);
//     xmlHttp.onreadystatechange = function () {
//         if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {

            
//             obj.innerHTML = xmlHttp.responseText
//         }
//         else {
//             console.log(xmlHttp.readyState);
//             console.log(xmlHttp.status);
//         }
//     }
//     xmlHttp.open("GET", url, true);
    
//     xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
//     xmlHttp.send();
// }


function MakeFilter() {
    alert("sdaa");
    var currentURL = window.location.href; // Tìm vị trí của dấu gạch chéo cuối cùng
    var lastSlashIndex = currentURL.lastIndexOf('/'); // Lấy phần cuối cùng của đường link (phần chứa số 11)
    var numberString = currentURL.substring(lastSlashIndex + 1); // Chuyển đổi chuỗi số thành số nguyên
    var number = parseInt(numberString);
    console.log(number);

    // var obj = document.getElementById('products');
    // var filter = document.getElementsByClassName("checkbox_color");
    // var filter_checked = [];

    // var url;

    // //Bộ lọc theo màu
    // for (let i = 0; i < filter.length; i++) {
    //     if (filter[i].checked) {
    //         filter_checked.push(filter[i].value);
    //     }
    // }
    
    // var min_price = document.getElementById("price_from").value;
    // var max_price = document.getElementById("price_to").value;
var g=100;
    //var token = $('meta[name="csrf-token"]').attr('content');


    $.ajax({
        url: "{{URL::to('/filter-products') }}",
        //url: '{{ URL::to("/filter-products") }}', // URL của route Laravel
        type: 'POST',
        contentType: 'application/json',
        // data: JSON.stringify({
        //     //_token: token, // Thêm CSRF token
        //     // filter_checked: filter_checked,
        min_price:g, 
        //     // min_price: min_price,
        //     // max_price: max_price,
        //     //additional_param: additionalParam // Thêm tham số tùy chọn
        // }),
        headers: ({
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }),

        success: function(response) {
            if (response.success) {
                //obj.innerHTML = response.data; // Cập nhật nội dung sản phẩm
                //obj.innerHTML = xmlHttp.responseText;

                obj.innerHTML = "asasdas";
            } else {
                alert('Failed to filter products');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('AJAX call failed: ' + textStatus + ', ' + errorThrown);
        }
    });
    // alert('s');
}