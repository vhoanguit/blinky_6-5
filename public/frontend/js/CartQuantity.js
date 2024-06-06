// window.onload = function() 

function countProductsInCart_Customer() 
{
    var customer=document.getElementById('this-customer').value;
    console.log(customer);
    var cart=document.getElementById('number_of_cart').value;
    console.log(cart);
    if(parseInt(cart)<99)
    {
        document.querySelector('#cart-shopping-quantity').innerHTML=cart;
    } 
    else
    {
        document.querySelector('#cart-shopping-quantity').innerHTML='99+';
    }
};

function countProductsInCart() 
{
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    let productCount = {};

    cart.forEach(item => 
    {
            productCount[item.product_id] = 1;
    });

    let totalItems = Object.values(productCount).reduce((sum, count) => sum + count, 0);
    console.log(totalItems);

    if(totalItems<99)
    {
        document.querySelector('#cart-shopping-quantity').innerHTML=totalItems;
    }
    else
    {
        document.querySelector('#cart-shopping-quantity').innerHTML='99+';
    }

}

const searchInput = document.getElementById('search-bar-input');
const searchIcon = document.getElementById('search_icon');
const searchForm = document.getElementById('search-form');
searchIcon.addEventListener('click', function(event) 
{
    alert("sdads");
    searchForm.submit();
});
searchInput.addEventListener('keypress', function(event) 
{
    if (event.key === 'Enter') {
        event.preventDefault(); // Ngăn chặn hành động mặc định của phím "Enter" (submit form)
        searchForm.submit(); // Gửi form
    }
});