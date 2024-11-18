<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="{{ URL('/') }}/css/auth.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"/>
        <title>{{$title}} - Link4Sub.com</title>
    </head>
    <body>
        
        @yield('content')
        
    </body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordIcons = document.querySelectorAll('.toggle-password');
        
            togglePasswordIcons.forEach(function(toggleIcon) {
                toggleIcon.addEventListener('click', function() {
                    const passwordInput = this.previousElementSibling;
                    const showIcon = this.querySelector('.show-icon');
                    const hideIcon = this.querySelector('.hide-icon');
        
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        showIcon.style.display = 'none';
                        hideIcon.style.display = 'block';
                    } else {
                        passwordInput.type = 'password';
                        showIcon.style.display = 'block';
                        hideIcon.style.display = 'none';
                    }
                });
            });
        });
    </script>
</html>

