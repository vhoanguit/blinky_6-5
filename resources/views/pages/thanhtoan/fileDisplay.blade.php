<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Display</title>
</head>
<body>
    <div id="file_display_container"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileURL = '{{ $fileURL }}';
            const fileType = '{{ $fileType }}';
            const fileName = '{{ $fileName }}';

            const container = document.getElementById('file_display_container');
            container.innerHTML = ''; // Clear previous content

            document.title = fileName; // Set the title of the page to the file name

            if (fileType.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = fileURL;
                img.alt = fileName;
                img.style.maxWidth = '100%';
                container.appendChild(img);
            } else {
                const link = document.createElement('a');
                link.href = fileURL;
                link.download = fileName;
                link.style.display = 'none';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
    </script>
</body>
</html>