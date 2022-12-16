<?php 
    session_start();

    if(!isset($_SESSION['accountname'])) {
        header('Location: ./login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <!-- icons -->
    <link rel="stylesheet" href="../vendor/fontawesome/css/all.css">
    <!-- plugin css -->
    <link rel="stylesheet" href="../vendor/nprogress/nprogress.css">
    <link rel="stylesheet" href="../vendor/jquery-modal/jquery.modal.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="../dist/css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- page -->
    <div class="w-full h-screen relative overflow-auto hidden" id="page">

        <!-- sidebar -->
        <aside class="sticky top-0 w-72 h-screen flex flex-col bg-indigo-500">
            <div class="w-full h-16 mb-2 flex items-center border-b border-white border-opacity-40">
                <a href="./" class="px-6 flex items-center text-white">
                    <i class="fa-solid fa-rocket"></i>
                    <span class="font-semibold tracking-wider ml-4">LLL UNIVERSITY</span>
                </a>
            </div>
            <a href="./" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-chart-simple"></i>
                <span class="tracking-wider ml-4 text-sm">Dashboard</span>
            </a>
            <a href="./enrollments.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-envelope"></i>
                <span class="tracking-wider ml-4 text-sm">Enrollment</span>
            </a>
            <a href="./courses.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-graduation-cap"></i>
                <span class="tracking-wider ml-4 text-sm">Courses</span>
            </a>
            <a href="./sections.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-door-open"></i>
                <span class="tracking-wider ml-4 text-sm">Sections</span>
            </a>
            <a href="./subjects.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-book"></i>
                <span class="tracking-wider ml-4 text-sm">Subjects</span>
            </a>
            <a href="./students.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-100 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-user"></i>
                <span class="tracking-wider ml-4 text-sm">Students</span>
            </a>
            <button id="logout" class="w-full mt-auto px-6 py-3 flex items-center border-t border-white border-opacity-40 text-white cursor-pointer">
                <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>
                <span class="tracking-wider ml-4 text-sm">Logout</span>
            </button>
        </aside>
        <!-- end of sidebar -->

        <!-- content -->
        <div class="flex-1 overflow-auto">
            <!-- topbar -->
            <header class="sticky top-0 w-full h-16 bg-white drop-shadow-md z-10">
                <div class="flex items-center h-full px-6">
                    <a href="#" class="ml-auto text-gray-500 hover:text-slate-800">
                        <i class="fa-regular fa-bell fa-lg"></i>
                    </a>
                    <a href="#" class="ml-6 pl-6 flex items-center text-blue-500 hover:text-sky-500 border-l border-gray-300">
                        <img src="../dist/img/profile.svg" class="w-8 h-8 rounded-full" alt="">
                        <span class="ml-2 font-bold text-sm"><?=$_SESSION['accountname']?></span>
                    </a>
                </div>
            </header>
            <!-- end of topbar -->

            <!-- main content-->
            <main class="w-full px-12 py-8">

                <div class="flex w-full items-center mb-8">
                    <div>
                        <h1 class="font-bold text-2xl text-slate-700 pb-1">Students</h1>
                        <span class="text-sm text-slate-700">Manage Student Database</span>
                    </div>
                    <a href="#composer" rel="modal:open" class="ml-auto px-4 py-2 text-sm bg-blue-500 text-white rounded">
                        <i class="fa-solid fa-user-plus mr-2"></i>Add Student
                    </a>
                </div>

                <!-- courses table -->
                <div class="w-full mb-8">
                    <table id="table" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Course</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </main>
            <!-- end of content -->
        </div>

        <!-- composer -->
        <div id="composer" class="modal">
            <div class="bg-white m-auto px-5 py-4 rounded-md">
                <div class="w-full mb-5 flex items center">
                    <h1 class="text-xl font-bold text-slate-800">Create New Student</h1>
                </div>
                <!-- form -->
                <form id="create" method="post" class="">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- firstname -->
                        <div class="mb-3">
                            <label for="firstName" class="block mb-1 font-bold text-xs text-sky-500">
                                First name
                            </label>
                            <input type="text" id="firstName" name="firstName" placeholder="John" class="capitalize block w-full px-3 
                                    py-2 bg-white border border-slate-300 text-sm shadow-sm placeholder-slate-400 
                                    focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
                        </div>

                        <!-- lastname -->
                        <div class="mb-3">
                            <label for="lastName" class="block mb-1 font-bold text-xs text-sky-500">
                                Last name
                            </label>
                            <input type="text" id="lastName" name="lastName" placeholder="Doe" class="capitalize block w-full px-3 
                                    py-2 bg-white border border-slate-300 text-sm shadow-sm placeholder-slate-400 
                                    focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- email -->
                        <div class="mb-3">
                            <label for="email" class="block mb-1 font-bold text-xs text-sky-500">
                                Email
                            </label>
                            <input type="email" id="email" name="email" placeholder="lllgroup@rtu.edu.ph" class="block w-full px-3 
                                    py-2 bg-white border border-slate-300 text-sm shadow-sm placeholder-slate-400 
                                    focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500">
                        </div>

                        <!-- lastname -->
                        <div class="mb-3">
                            <label for="gender" class="block mb-1 font-bold text-xs text-sky-500">
                                Gender
                            </label>
                            <div class="flex items-center py-2">
                                <div class="flex items-center mr-4">
                                    <input id="gender-radio1" type="radio" value="male" name="gender" checked class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300  focus:ring-blue-500 focus:ring-0 ">
                                    <label for="gender-radio1" class="ml-2 text-sm font-medium text-slate-600">Male</label>
                                </div>
                                <div class="flex items-center mr-4">
                                    <input id="gender-radio2" type="radio" value="female" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-0">
                                    <label for="gender-radio2" class="ml-2 text-sm font-medium text-slate-600">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- course -->
                    <div class="mb-6">
                        <label for="course" class="block mb-1 font-bold text-xs text-sky-500">
                            Select course
                        </label>
                        <select id="course" name="courseId" required class="block w-full px-3 py-2 bg-white border border-slate-300
                                        text-sm shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 
                                        focus:ring-1 focus:ring-sky-500">
                            <option value="" selected disabled>Select course</option>
                        </select>
                    </div>
                    <div class="col-start-2">
                        <button name="create" type="submit" class="block py-2 px-3 bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold">
                            Create New
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end of composer -->

        <!-- notify -->
        <div class="modal text-green-500" id="notify">
            Success! <i class="fa-solid fa-circle-check"></i>
        </div>

    </div>

    <!-- core js -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/jquery-validation/jquery.validate.min.js"></script>

    <!-- plugin scripts -->
    <script src="../vendor/jquery-modal/jquery.modal.min.js"></script>
    <script src="../vendor/tabledit/jquery.tabledit.min.js" defer></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js" defer></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/nprogress/nprogress.js"></script>

    <!-- custom scripts -->
    <script src="../dist/js/datatabledit.js"></script>
    <script src="../dist/js/pageLoader.js"></script>

    <!-- inline scripts -->
    <script>
        $(document).ready(function() {
            /* get all available courses */
            $.when(getCourse()).done(async function(data) {
                let courses = {};
                $.each(data.data, function(i, item) {
                    $("#course").append('<option value="' + item.id + '">' + item.description + '</span>');
                    courses[item.id] = item.code;
                })

                var dt = $('#table').Datatabledit({
                    get: "../api/students.php?action=all",
                    post: "../api/students.php",
                    dataSrc: "data",
                    columns: [{
                            data: "id",
                            identifier: true,
                        },
                        {
                            data: "firstName",
                            editable: true,
                            className: 'capitalize'
                        },
                        {
                            data: "lastName",
                            editable: true,
                            className: 'capitalize'
                        },
                        {
                            data: "email",
                            editable: true
                        },
                        {
                            data: "gender",
                            editable: true,
                            type: 'select',
                            options: '{"male": "male","female": "female"}'
                        },
                        {
                            data: "course",
                            editable: true,
                            type: 'select',
                            options: JSON.stringify(courses)
                        },
                    ],
                    rowCallback: function(row, data) {
                        if (data.gender === "male") {
                            $('td:eq(4)', row).addClass('capsule-accent');
                        } else {
                            $('td:eq(4)', row).addClass('capsule-hot');
                        }
                    },
                    buttons: {
                        edit: {
                            class: 'px-3 py-2 ring-1 ring-slate-300 ring-inset text-blue-500 bg-white',
                            html: '<i class="fa-solid fa-pencil"></i>',
                            action: 'edit'
                        },
                        delete: {
                            class: 'px-3 py-2 ring-1 ring-slate-300 ring-inset text-red-500 bg-white',
                            html: '<i class="fa-solid fa-trash"></i>',
                            action: 'delete'
                        },
                        save: {
                            class: 'px-3 py-2 bg-green-500 text-white',
                            html: 'Save'
                        },
                        confirm: {
                            class: 'px-3 py-2 bg-red-500 text-white',
                            html: 'Are you sure?'
                        },
                    },
                    onAjax: function(action, serialize) {
                        NProgress.start();
                    },
                    onSuccess: function(data, textStatus, jqXHR) {
                        console.log(data);
                        dt.ajax.reload();
                        NProgress.done();
                    },
                    onFail: function(jqXHR, textStatus, errorThrown) {
                        NProgress.done();
                        console.log(jqXHR)
                        dt.ajax.reload();
                    },
                })

                // create student
                var validator = $("#create").validate({
                    rules: {
                        firstName: {
                            required: true,
                            minlength: 2
                        },
                        lastName: {
                            required: true,
                            minlength: 2
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        gender: {
                            required: true,
                        },
                        courseId: {
                            required: true
                        }
                    },
                    messages: {
                        firstName: {
                            required: "Please enter first name",
                            minlength: "First name at least 2 characters"
                        },
                        lastName: {
                            required: "Please enter last name",
                            minlength: "Last name at least 2 characters"
                        },
                        email: {
                            required: "Please enter student email",
                            email: "Please enter a valid email"
                        },
                        gender: {
                            required: "Please student gender",
                        },
                        courseId: {
                            required: "Please select a course"
                        }
                    },

                    submitHandler: function(form, event) {
                        event.preventDefault();

                        $.ajax({
                            type: "POST",
                            url: "../api/students.php",
                            data: $(form).serialize() + '&action=create',
                            beforeSend: function(data) {
                                console.log(data);
                                NProgress.start();
                                $(form).find('button[type="submit"]').attr('disabled')
                            },
                            success: function(data) {
                                NProgress.done()
                                console.log(data)
                                dt.ajax.reload()
                                $(form).find("input, textarea").val("");
                            },
                            error: function(xhr, status, error) {
                                NProgress.done()
                                dt.ajax.reload()
                                if (xhr.status >= 400) {
                                    var err = xhr.responseJSON;
                                    if (xhr.status === 409) {
                                        validator.showErrors({
                                            [err.path]: err.message
                                        })
                                    } else {
                                        alert(err.message)
                                    }
                                }
                            },
                        });
                    }
                })
            })


            function getCourse() {
                return $.ajax({
                    type: "GET",
                    url: "../api/courses.php?action=all&status=available",
                    success: function(data) {

                    },
                });
            }

            $('#logout').click(function() {
                console.log('dsaddsa');
                $.ajax({
                    type: "POST",
                    url: "../api/auth.php",
                    data: '&action=logout',
                    beforeSend: function(data) {
                        NProgress.start();
                    },
                    success: function(data) {
                        NProgress.done()
                        window.location.href = "./login.php"
                    },
                    error: function(xhr, status, error) {
                        NProgress.done()
                        if (xhr.status >= 400) {
                            var err = xhr.responseJSON;
                            alert(error)
                        }
                    },
                });
            })
        })
    </script>
</body>

</html>