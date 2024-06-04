// file_upload_handling.js
$(document).ready(function() {
    $('#file_input').on('change', function() {
        const fileInput = this;
        const fileNameSpan = $('#file_name');
        const fileLink = $('#file_link');

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            fileNameSpan.text(file.name);

            if (file.type.startsWith('image/')) { // Đảm bảo định dạng file là ảnh
                const reader = new FileReader();
                reader.onload = function(event) {
                    const fileDataURL = event.target.result;
                    $('#file_display_container').html(`<img src="${fileDataURL}" alt="${file.name}" style="max-width: 100%;">`);
                };
                reader.readAsDataURL(file);
            } else {
                fileLink.attr('href', '#');
                fileLink.off('click').on('click', function(e) {
                    e.preventDefault();
                    const fileURL = URL.createObjectURL(file);
                    window.open(fileURL);
                });
            }
        } else {
            fileNameSpan.text('Chưa có ảnh nào được chọn');
            fileLink.attr('href', '#');
            $('#file_display_container').html(''); // Clear previous content
        }
    });
});