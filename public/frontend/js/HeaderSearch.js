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