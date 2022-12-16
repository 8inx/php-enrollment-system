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
    <title>Subjects</title>
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
            <a href="./subjects.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-100 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-book"></i>
                <span class="tracking-wider ml-4 text-sm">Subjects</span>
            </a>
            <a href="./students.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
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
                        <h1 class="font-bold text-2xl text-slate-700 pb-1">Subjects</h1>
                        <span class="text-sm text-slate-700">Manage Subjects Offered</span>
                    </div>
                    <a href="#composer" rel="modal:open" class="ml-auto px-4 py-2 text-sm bg-blue-500 text-white rounded">
                        <i class="fa-solid fa-feather mr-1"></i> New Subject
                    </a>
                </div>

                <!-- courses table -->
                <div class="w-full mb-8">
                    <table id="table" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Units</th>
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
                    <h1 class="text-xl font-bold text-slate-800">Create New Subject</h1>
                </div>
                <!-- form -->
                <form id="create" method="post" class="grid grid-cols-5 gap-4 max-w-xl">
                    <div class="col-start-2 col-span-4"><span id="formFeedback"></span></div>
                    <!-- code -->
                    <div class="flex items-center justify-end text-sm text-gray-500">Code</div>
                    <div class="col-span-4">
                        <input type="text" name="code" placeholder="ITP311" class="uppercase block w-full px-3 py-2 bg-white border border-slate-300 
                                text-sm text-gray-700 shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 
                                focus:ring-1 focus:ring-sky-500">
                    </div>
                    <!-- description -->
                    <div class="flex items-start pt-2 justify-end text-sm text-gray-500">Description</div>
                    <div class="col-span-4">
                        <textarea type="textarea" name="description" rows="2" placeholder="Fundamentals of Database Systems" class="block w-full px-3 py-2 bg-white border border-slate-300 
                                text-sm text-gray-700 shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 
                                focus:ring-1 focus:ring-sky-500"></textarea>
                    </div>
                    <!-- units -->
                    <div class="flex items-center justify-end text-sm text-gray-500">Units</div>
                    <div class="col-span-4">
                        <input type="number" min="1" step="1" value="1" name="units" placeholder="1" class="block w-full px-3 py-2 bg-white border border-slate-300 
                                text-sm text-gray-700 shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 
                                focus:ring-1 focus:ring-sky-500">
                    </div>
                    <!-- button submit -->
                    <div class="col-start-2">
                        <button name="create" rel="ajax:modal" type="submit" class="block py-2 px-3 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-sm">
                            Publish
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!--  -->

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

            var dt = $('#table').Datatabledit({
                get: "../api/subjects.php?action=all",
                post: "../api/subjects.php",
                dataSrc: "data",
                columns: [{
                        data: "id",
                        identifier: true,
                        hidden: true,
                    },
                    {
                        data: "code",
                        editable: true,
                    },
                    {
                        data: "description",
                        editable: true,
                        type: "email",
                        redirect: true
                    },
                    {
                        data: "units",
                        editable: true,
                    },
                ],
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
                    console.log(action, serialize);
                    NProgress.start();
                },
                onSuccess: function(data, textStatus, jqXHR) {
                    console.log(data);
                    dt.ajax.reload();
                    NProgress.done();
                },
                onFail: function(jqXHR, textStatus, errorThrown) {
                    NProgress.done();
                    console.log(jqXHR);
                    dt.ajax.reload();
                },
            })

            // create subject
            var validator = $("#create").validate({
                rules: {
                    code: {
                        required: true,
                        minlength: 2
                    },
                    description: {
                        required: true,
                        minlength: 6
                    },
                    units: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    code: {
                        required: "Please enter a subject code",
                        minlength: "Subject code at least 2 characters"
                    },
                    description: {
                        required: "Please enter a subject description",
                        minlength: "Subject description at least 6 characters"
                    },
                    units: {
                        required: "Please enter subject units",
                        digits: "Units must be a whole number"
                    }
                },

                submitHandler: function(form, event) {
                    event.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "../api/subjects.php",
                        data: $(form).serialize() + '&action=create',
                        beforeSend: function(data) {
                            NProgress.start();
                        },
                        success: function(data) {
                            NProgress.done()
                            console.log(data)
                            dt.ajax.reload()
                            $(form).find("input[type=text], textarea").val("");
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