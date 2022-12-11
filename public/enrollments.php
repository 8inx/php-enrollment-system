<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollments</title>
    <!-- fonts -->
    <link rel="stylesheet" href="../vendor/googleFonts/fonts.css">
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
            <a href="./enrollments.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-100 hover:text-opacity-100 cursor-pointer">
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
            <a href="./students.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-user"></i>
                <span class="tracking-wider ml-4 text-sm">Students</span>
            </a>
            <a class="w-full mt-auto px-6 py-3 flex items-center border-t border-white border-opacity-40 text-white cursor-pointer">
                <i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>
                <span class="tracking-wider ml-4 text-sm">Logout</span>
            </a>
        </aside>
        <!-- end of sidebar -->

        <!-- content -->
        <div class="flex-1 overflow-auto">
            <!-- topbar -->
            <header class="sticky top-0 w-full h-16 bg-white drop-shadow-md z-10">
                <div class="flex items-center h-full px-6">
                    <a href="./" class="ml-auto text-gray-500 hover:text-slate-800">
                        <i class="fa-regular fa-bell fa-lg"></i>
                    </a>
                    <a href="./account.php" class="ml-6 pl-6 flex items-center text-blue-500 hover:text-sky-500 border-l border-gray-300">
                        <img src="../dist/img/profile.svg" class="w-8 h-8 rounded-full" alt="">
                        <span class="ml-2 font-bold text-sm">superking</span>
                    </a>
                </div>
            </header>
            <!-- end of topbar -->

            <!-- main content-->
            <main class="w-full px-12 py-8">

                <div class="flex w-full items-center mb-8">
                    <div>
                        <h1 class="font-bold text-2xl text-slate-700 pb-1">Enrollments</h1>
                        <span class="text-sm text-slate-700">Manage Student Enrollment</span>
                    </div>
                    <a href="#composer" rel="modal:open" class="ml-auto px-4 py-2 text-sm bg-blue-500 text-white rounded">
                        <i class="fa-solid fa-user-graduate"></i> Enroll Student
                    </a>
                </div>

                <!-- courses table -->
                <div class="w-full mb-8">
                    <table id="enrollmentsTable" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name of Student</th>
                                <th>Date Start</th>
                                <th>Date Finished</th>
                                <th>Status</th>
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
                    <h1 class="text-xl font-bold text-slate-800">Enter Student</h1>
                </div>
                <!-- form -->
                <form id="create" method="post" class="grid grid-cols-5 gap-4 max-w-xl">
                    <div class="col-start-2 col-span-4"><span id="formFeedback"></span></div>
                    <!-- studentId -->
                    <div class="flex items-center justify-end text-sm text-gray-500">Student Id</div>
                    <div class="col-span-4">
                        <input type="text" name="studentId" placeholder="Student Id" class="capitalize block w-full px-3 py-2 bg-white border border-slate-300 
                                text-sm text-gray-700 shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 
                                focus:ring-1 focus:ring-sky-500">
                    </div>
                    <!-- button submit -->
                    <div class="col-start-2 flex">
                        <button type="submit" title="Start enrollment for the given student id" class="block py-2 px-3 bg-blue-500 hover:bg-blue-700 text-sm text-white font-bold whitespace-nowrap rounded-sm">
                            Start Enrollment
                        </button>
                        <button id="openList" type="button" class="ml-4 block py-2 px-3 ring-2 ring-inset ring-slate-500/40  hover:ring-slate-500 text-slate-500 hover:text-slate-700 text-sm font-bold whitespace-nowrap rounded-sm">
                            <i class="mr-2 fa-solid fa-magnifying-glass"></i> Find Student
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- studentList -->
        <div id="studentList" class="modal">
            <div class="w-full mb-1 mt-8 flex items-center">
                <i class="fa-solid fa-list fa-lg"></i>
                <h1 class="ml-2 text-xl font-bold text-slate-800">Student List</h1>
            </div>
            <div class="max-w-3xl">
                <table id="studentsTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Course</th>
                            <th>Last Enrolled</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
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
    <script src="../dist/js/utils.js"></script>
    <script src="../dist/js/datatabledit.js"></script>
    <script src="../dist/js/pageLoader.js"></script>

    <!-- inline scripts -->
    <script>
        $(document).ready(function() {
            // init table
            listStudents()

            var dt = $('#enrollmentsTable').Datatabledit({
                get: "../api/enrollments.php?action=all&latest=1",
                post: "../api/enrollments.php",
                dataSrc: "data",
                columns: [{
                        data: "id",
                        identifier: true,
                        hidden: true,
                    },
                    {
                        data: "fullName",
                        "width": "30%"
                    },
                    {
                        data: "startEnroll",
                        render: function(data) {
                            return formatDate(data)
                        }
                    },
                    {
                        data: "lastEnrolled",
                        render: function(data) {
                            return formatDate(data)
                        }
                    },
                    {
                        data: "status",
                    }
                ],
                rowCallback: function(row, data) {
                    console.log(data.status)
                    if (data.status === "completed") {
                        $('td:eq(4)', row).addClass('capsule-success');
                    } else {
                        $('td:eq(4)', row).addClass('capsule-warning');
                    }
                    $('td:eq(4)', row).html('<span class="tabledit-span">' + data.status + '</span>')
                },
                extraButtons: {
                    view: {
                        class: 'ml-auto px-3 py-2 ring-1 ring-slate-300 ring-inset bg-emerald-400 text-white',
                        html: '<i class="fa-solid fa-magnifying-glass"></i> View',
                        action: 'view',
                        onClick: function(data, action, table) {
                            window.location.href = "./enrollment/?id=" + data.id
                        },
                    },
                }
            })

            function listStudents() {
                var dt = $('#studentsTable').Datatabledit({
                    get: "../api/students.php?action=all",
                    post: "../api/subjects.php",
                    dataSrc: "data",
                    pageLength: 10,
                    columns: [{
                            data: "id",
                            identifier: true,
                            hidden: true
                        },
                        {
                            data: "firstName"
                        },
                        {
                            data: "lastName"
                        },
                        {
                            data: "course"
                        },
                        {
                            data: "lastEnrolled",
                            render: function(data) {
                                return formatDate(data)
                            }
                        }
                    ],
                    extraButtons: {
                        add: {
                            class: 'ml-auto px-3 py-2 ring-1 ring-slate-300 ring-inset bg-slate-700 hover:bg-slate-800 text-white',
                            html: 'Select',
                            action: 'add',
                            onClick: function(data, action) {
                                $('#create input[name="studentId"]').val(data.id)
                                $.modal.close();
                            }
                        },
                    }
                })
                return dt;
            }

            // start enrollment
            var validator = $("#create").validate({
                rules: {
                    studentId: {
                        required: true,
                    }
                },
                messages: {
                    studentId: {
                        required: "Please Enter Student Id",
                    }
                },

                submitHandler: function(form, event) {
                    event.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "../api/enrollments.php",
                        data: $(form).serialize() + '&action=create',
                        beforeSend: function(data) {
                            NProgress.start();
                        },
                        success: function(data) {
                            NProgress.done()
                            window.location.href = "./enrollment/?id=" + data.data.id;
                        },
                        error: function(xhr, status, error) {
                            NProgress.done()
                            console.log(xhr.responseJSON)
                            if (xhr.status >= 400) {
                                var err = xhr.responseJSON;
                                if (xhr.status === 409) {
                                    validator.showErrors({
                                        [err.path]: err.message
                                    })
                                } else if (xhr.status === 404) {
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

            $('#openList').click(function() {
                $('#studentList').modal({
                    closeExisting: false
                });
            })

            // events
        })
    </script>
</body>

</html>