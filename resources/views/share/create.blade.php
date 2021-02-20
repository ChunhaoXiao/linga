<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>

    <!-- add to document <head> -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <!-- add before </body> -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
</head>
<body>
    <input type="file" data-max-files="10" name="filepond" multiple>

    <script>
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create( inputElement, {
            server: {
                process: {
                    url: '/upload',
                    method: 'POST',
                    withCredentials: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    timeout: 7000,
                    onLoad: res => {console.log(res)}
                
                },
            
            },
            maxFiles: 10,  
            allowMultiple:true,  
        });
    </script>
</body>
</html>