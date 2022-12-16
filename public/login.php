<?php 
    session_start();

    if(isset($_SESSION['accountname'])) {
        header('Location: ./index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- icons -->
    <link rel="stylesheet" href="../vendor/fontawesome/css/all.css">
    <!-- plugin css -->
    <link rel="stylesheet" href="../vendor/nprogress/nprogress.css">
    <link rel="stylesheet" href="../vendor/jquery-modal/jquery.modal.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="../dist/css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div id="page" class="h-screen md:flex">
        <div class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-r from-blue-700/80 to-indigo-700/90 i justify-around items-center hidden">
            <div class="absolute top-0 left-0 bottom-0 right-0 -z-50">
                <img class="w-full h-full object-cover" src="../dist/img/bg_rtu.png" alt="">
            </div>
            <div class="w-full max-w-md">
                <h1 class="text-white font-bold text-3xl">Enrollment Database</h1>
                <p class="text-white mt-1">School Enrollment System Manager</p>
                <button type="submit" class="block bg-white text-indigo-800 mt-6 py-2 px-4 font-bold mb-2 whitespace-nowrap rounded-full">Contact Admin</button>
            </div>
            <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        </div>
        <div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
            <form id="login" class="bg-white">
                <h1 class="text-gray-800 font-bold text-2xl mb-1">Hello Again!</h1>
                <p class="text-sm font-normal text-gray-600 mb-7">Welcome Back Admin</p>

                <div class="ml-2 mb-4 text-red-500 text-sm" data-error="general"></div>
                <!-- accountname -->
                <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-1">
                    <span class="w-5 text-gray-400" >
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input class="pl-2 outline-none border-none text-sm text-slate-700" type="text" name="accountname" id="" placeholder="Account" />
                </div>
                <!-- password -->
                <div class="mb-4 pl-2" data-error="accountname"></div>
                <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                    <span class="w-5 text-gray-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input class="pl-2 outline-none border-none text-sm text-slate-700" type="password" name="password" id="" placeholder="********" />
                </div>
                <div class="mb-4 pl-2" data-error="password"></div>
                <button type="submit" class="block w-full bg-indigo-600 hover:bg-indigo-800 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Login</button>
                <span class="text-sm ml-2 pt-3 text-slate-600 hover:text-blue-500 cursor-pointer">Forgot Password ?</span>
            </form>
        </div>
        <div class="absolute bottom-3 right-3 text-xs text-slate-600">Powered By: LLL GROUP</div>
    </div>


    <!-- core js -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/jquery-validation/jquery.validate.min.js"></script>

    <!-- plugin scripts -->
    <script src="../vendor/jquery-modal/jquery.modal.min.js"></script>
    <script src="../vendor/nprogress/nprogress.js"></script>
    <!-- custom scripts -->
    <script src="../dist/js/pageLoader.js"></script>
    <!-- inline scripts -->
    <script>
        $(document).ready(function(){
            var validator = $("#login").validate({
                    rules: {
                        accountname: {
                            required: true,
                        },
                        password: {
                            required: true
                        },
                    },
                    messages: {
                        accountname: {
                            required: "Please enter your account name",
                        },
                        password: {
                            required: "Please enter your password",
                        }
                    },
                    errorPlacement: function(error, element) {
                        var inputName = $(element).attr('name')
                        error.appendTo('[data-error="'+inputName+'"]');
                    },

                    submitHandler: function(form, event) {
                        event.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "../api/auth.php",
                            data: $(form).serialize() + '&action=login',
                            beforeSend: function(data) {
                                NProgress.start();
                                $('[data-error="general"]').text('')
                            },
                            success: function(data) {
                                NProgress.done()
                                console.log(data)
                                window.location.href = "./index.php"
                            },
                            error: function(xhr, status, error) {
                                NProgress.done()
                                if (xhr.status >= 400) {
                                    var err = xhr.responseJSON;
                                    $('[data-error="general"]').text(err.message)
                                }
                            },
                        });
                    }
                })
        })


    </script>
</body>

</html>