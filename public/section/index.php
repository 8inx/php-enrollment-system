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
    <title>Sections</title>
    <!-- icons -->
    <link rel="stylesheet" href="../../vendor/fontawesome/css/all.css">
    <!-- plugin css -->
    <link rel="stylesheet" href="../../vendor/nprogress/nprogress.css">
    <link rel="stylesheet" href="../../vendor/jquery-modal/jquery.modal.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="../../dist/css/style.css?v=<?php echo time(); ?>">
</head>

<body>
    <!-- page -->
    <div class="w-full h-screen relative overflow-auto hidden" id="page">

        <!-- sidebar -->
        <aside class="sticky top-0 w-72 h-screen flex flex-col bg-indigo-500">
            <div class="w-full h-16 mb-2 flex items-center border-b border-white border-opacity-40">
                <a href="../" class="px-6 flex items-center text-white">
                    <i class="fa-solid fa-rocket"></i>
                    <span class="font-semibold tracking-wider ml-4">LLL UNIVERSITY</span>
                </a>
            </div>
            <a href="../" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-chart-simple"></i>
                <span class="tracking-wider ml-4 text-sm">Dashboard</span>
            </a>
            <a href="../enrollments.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-envelope"></i>
                <span class="tracking-wider ml-4 text-sm">Enrollment</span>
            </a>
            <a href="../courses.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-graduation-cap"></i>
                <span class="tracking-wider ml-4 text-sm">Courses</span>
            </a>
            <a href="../sections.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-100 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-door-open"></i>
                <span class="tracking-wider ml-4 text-sm">Sections / <span title="id">0</span></span>
            </a>
            <a href="../subjects.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-book"></i>
                <span class="tracking-wider ml-4 text-sm">Subjects</span>
            </a>
            <a href="../students.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
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
                    <div class="text-blue-600">
                        <a href="../sections.php" class="text-sm text-blue-500 hover:text-slate-800">
                            Section /
                        </a>
                        <a href="#sectionTitle" class="text-sm text-slate-400 hover:text-slate-800">
                            <span title="code">CEIT-37-501A</span>
                        </a>
                    </div>
                    <a href="#" class="ml-auto text-gray-500 hover:text-slate-800">
                        <i class="fa-regular fa-bell fa-lg"></i>
                    </a>
                    <a href="#" class="ml-6 pl-6 flex itesuperkingms-center text-blue-500 hover:text-sky-500 border-l border-gray-300">
                        <img src="../../dist/img/profile.svg" class="w-8 h-8 rounded-full" alt="">
                        <span class="ml-2 font-bold text-sm"><?=$_SESSION['accountname']?></span>
                    </a>
                </div>
            </header>
            <!-- end of topbar -->

            <!-- main content-->
            <main class="w-full px-12 py-8">

                <div class="flex w-full items-center mb-8">
                    <div id="sectionTitle">
                        <h1 title="code" class="font-bold text-xl text-slate-700 pb-1 uppercase">CEIT-37-501A</h1>
                    </div>
                </div>

                <section class="w-full my-10">
                    <div class="mb-3 flex items-center">
                        <h2 class="text-lg text-slate-700 font-bold">Information</h2>
                        <a href="#composer" rel="modal:open" class="ml-4 px-2 py-1 text-sm text-sky-500 rounded">
                            <i class="fa-solid fa-pen-to-square fa-sm"></i></i> Edit
                        </a>
                    </div>

                    <div class="grid grid-cols-5">
                        <div class="col-span-1 text-sm text-slate-700 leading-8">Section Code</div>
                        <div class="col-span-4 text-sm text-slate-700 leading-8 uppercase" title="code">
                            CEIT-37-501A
                        </div>
                        <div class="col-span-1 text-sm text-slate-700 leading-8">Max Students</div>
                        <div class="col-span-4 text-sm text-slate-700 leading-8" title="maxStudents">
                            30
                        </div>
                    </div>
                </section>

                <section class="w-full my-8">
                    <div class="mb-3 flex items-center">
                        <h2 class="text-lg text-slate-700 font-bold">Section Subjects</h2>
                        <a href="#subjectsAvailable" rel="modal:open" class="ml-4 px-2 py-1 text-sm text-sky-500 rounded">
                            <i class="fa-solid fa-magnifying-glass-plus"></i> Add More
                        </a>
                    </div>
                </section>

                <!-- courses table -->
                <div class="w-full mb-8">
                    <table id="sectionSubjectsTable" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Units</th>
                                <th>Days</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Room</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <!-- danger zone delete -->
                <div class="w-full mb-20">
                    <div class="w-full mb-4">
                        <span class="text-sm font-bold text-slate-400">Danger Zone</span>
                    </div>
                    <a href="#delete" rel="modal:open" class="px-4 py-2 text-sm bg-red-500 text-white rounded">
                        <i class="fa-solid fa-trash-can mr-2"></i> Delete Section
                    </a>
                </div>
            </main>
            <!-- end of content -->
        </div>

        <!-- subjects modal -->
        <div id="subjectsAvailable" class="modal min-h-[500px]">
            <div class="w-full mb-1 mt-8 flex items-center">
                <i class="fa-solid fa-list fa-lg"></i>
                <h1 class="ml-2 text-xl font-bold text-slate-800">Subject Menu</h1>
            </div>
            <table id="subjectsAvailableTable" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Units</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- composer -->
        <div id="composer" class="modal">
            <div class="bg-white m-auto px-5 py-4 rounded-md">
                <div class="w-full mb-5 flex items-center">
                    <h1 class="text-xl font-bold text-slate-800">Edit Section Information</h1>
                </div>
                <!-- form -->
                <form id="edit" method="post" class="grid grid-cols-5 gap-4 max-w-xl">
                    <div class="col-start-2 col-span-4 text-green-500 text-sm"><span id="success"></span></div>
                    <!-- code -->
                    <div class="flex items-center justify-end text-sm text-gray-500">Section Code</div>
                    <div class="col-span-4">
                        <input type="text" name="code" placeholder="CEIT-37-501A" class="uppercase block w-full px-3 py-2 bg-white border border-slate-300 
                                text-sm text-gray-700 shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 
                                focus:ring-1 focus:ring-sky-500">
                    </div>
                    <!-- units -->
                    <div class="flex items-center justify-end text-sm text-gray-500">Max Students</div>
                    <div class="col-span-4">
                        <input type="number" min="1" step="1" value="30" name="maxStudents" placeholder="30" class="block w-full px-3 py-2 bg-white border border-slate-300 
                                text-sm text-gray-700 shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 
                                focus:ring-1 focus:ring-sky-500">
                    </div>
                    <!-- button submit -->
                    <div class="col-start-2">
                        <button name="edit" rel="ajax:modal" type="submit" class="block py-2 px-3 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-sm">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end of edit composer -->

        <!-- confirm delete -->
        <div id="delete" class="modal">
            <div class="bg-white m-auto px-5 py-4 rounded-md">
                <div class="w-full mb-5">
                    <h1 class="text-xl font-bold text-slate-800">Are you sure?</h1>
                </div>
                <div class="flex">
                    <button rel="ajax:modal" type="button" class="flex-1 py-2 px-3 bg-red-500 hover:bg-red-500 text-white font-bold rounded-sm">
                        Continue
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- core js -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/jquery-validation/jquery.validate.min.js"></script>

    <!-- plugin scripts -->
    <script src="../../vendor/jquery-modal/jquery.modal.min.js"></script>
    <script src="../../vendor/tabledit/jquery.tabledit.min.js" defer></script>
    <script src="../../vendor/datatables/jquery.dataTables.min.js" defer></script>
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../vendor/nprogress/nprogress.js"></script>

    <!-- custom scripts -->
    <script src="../../dist/js/utils.js"></script>
    <script src="../../dist/js/datatabledit.js"></script>
    <script src="../../dist/js/pageLoader.js"></script>

    <!-- inline scripts -->
    <script>
        $("#page").fadeIn(300).css("display", "hidden");
        NProgress.start()

        $(document).ready(function() {

            $.when(getSection()).done(async function(data) {
                // load page info
                let results = data.data
                if (results) {
                    initPageInfo(results)
                    const validator = handleSectionInfo(results.id)
                    handleDeleteSection(results.id)
                    // load current section subjects
                    var listCurrentSub = await listSectionSubject(results.id)
                    var listAvailSub = await listAvailableSub(results.id, listCurrentSub);
                    $('#subjectsAvailable').on($.modal.BEFORE_OPEN, function(event, modal) {
                        listAvailSub.ajax.reload();
                    });
                    $('#composer').on($.modal.BEFORE_OPEN, function(event, modal) {
                        $("#success").text('')
                        validator.resetForm()
                    });
                }
            });

            function initPageInfo(data) {
                for (const [key, val] of Object.entries(data)) {
                    $('[title="' + key + '"]').html(val)
                    $('[name="' + key + '"]').val(val)
                }
            }

            function listSectionSubject(sectionId) {
                var dt = $('#sectionSubjectsTable').Datatabledit({
                    get: "../../api/sectionSubjects.php?action=getSection&sectionId=" + sectionId,
                    post: "../../api/sectionSubjects.php",
                    dataSrc: "data",
                    lengthChange: false,
                    ordering: false,
                    searching: false,
                    paging: false,
                    columns: [{
                            data: "id",
                            identifier: true,
                            hidden: true
                        },
                        {
                            data: "code",
                        },
                        {
                            data: "description",
                        },
                        {
                            data: "units"
                        },
                        {
                            data: "days",
                            editable: true,
                            type: 'checkbox',
                            options: '{"M":"Monday", "T":"Tuesday", "W":"Wednesday", "H":"Thursday", "F":"Friday", "S":"Saturday", "U":"Sunday"}'

                        },
                        {
                            data: "timeIn",
                            editable: true,
                            type: 'time',
                            step: "900",
                        },
                        {
                            data: "timeOut",
                            editable: true,
                            type: 'time',
                            step: "900",
                        },
                        {
                            data: "room",
                            editable: true
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
                        console.log(action, serialize)
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

                return dt;
            }

            function listAvailableSub(contrastSectionId, dt2) {
                var dt = $('#subjectsAvailableTable').Datatabledit({
                    get: "../../api/subjects.php?action=avail&sectionId=" + contrastSectionId,
                    post: "../../api/subjects.php",
                    dataSrc: "data",
                    pageLength: 10,
                    columns: [{
                            data: "id",
                            identifier: true,
                            hidden: true
                        },
                        {
                            data: "code",
                            width: "25%"

                        },
                        {
                            data: "description"
                        },
                        {
                            data: "units"
                        },
                    ],
                    extraButtons: {
                        add: {
                            class: 'ml-auto px-3 py-2 ring-1 ring-slate-300 ring-inset bg-green-500 text-white',
                            html: '<i class="fa-solid fa-plus fa-lg"></i>',
                            action: 'add',
                            onClick: function(data, action) {
                                data.sectionId = contrastSectionId;
                                handleSubject(data, [dt, dt2])
                            },
                            showAt: function(data) {
                                return parseInt(data.exists) === 0
                            }
                        },
                        delete: {
                            class: 'ml-auto px-3 py-2 ring-1 ring-slate-300 ring-inset bg-red-500 text-white',
                            html: '<i class="fa-solid fa-minus fa-lg"></i>',
                            action: 'delete',
                            showAt: function(data) {
                                return parseInt(data.exists) > 0
                            },
                            onClick: function(data, action) {
                                data.sectionId = contrastSectionId;
                                handleSubject(data, [dt, dt2])
                            },
                        },
                    }
                })
                return dt;
            }

            function handleSubject(input, tables) {
                input.subjectId = input.id; // set subject id
                delete input.id
                $.ajax({
                    type: "POST",
                    url: "../../api/sectionSubjects.php",
                    dataType: 'json',
                    data: input,
                    beforeSend: function(data) {
                        NProgress.start();
                    },
                    success: function(data) {
                        NProgress.done()
                        for (dt of tables) {
                            dt.ajax.reload()
                        }
                        console.log(data)
                    },
                    error: function(xhr, status, error) {
                        NProgress.done()
                        for (dt of tables) {
                            dt.ajax.reload()
                        }
                        console.log(error)
                        if (xhr.status >= 400) {
                            var err = xhr.responseJSON;
                        }
                    },
                });
            }

            function handleSectionInfo(sectionId) {
                // edit section
                var validator = $("#edit").validate({
                    rules: {
                        code: {
                            required: true,
                            minlength: 4
                        },
                        units: {
                            required: true,
                            digits: true
                        }
                    },
                    messages: {
                        code: {
                            required: "Please enter a section code",
                            minlength: "Section code at least 4 characters"
                        },
                        units: {
                            required: "Please enter max students",
                            digits: "Must be a whole number"
                        }
                    },

                    submitHandler: function(form, event) {
                        event.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "../../api/sections.php",
                            data: $(form).serialize() + '&action=edit&id=' + sectionId,
                            beforeSend: function(data) {
                                NProgress.start();
                                $(form).find("#success").text('');
                                validator.resetForm()
                            },
                            success: function(data) {
                                NProgress.done()
                                initPageInfo(data.data)
                                $(form).find("#success").text(data.message);
                                validator.resetForm()
                            },
                            error: function(xhr, status, error) {
                                NProgress.done()
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
                return validator;
            }

            function handleDeleteSection(sectionId) {
                $('#delete button').click(function() {
                    $.ajax({
                        type: "POST",
                        url: "../../api/sections.php",
                        data: 'action=delete&id=' + sectionId,
                        beforeSend: function(data) {
                            NProgress.start();
                        },
                        success: function(data) {
                            window.location.href = "../sections.php"
                        },
                        error: function(xhr, status, error) {
                            NProgress.done()
                            alert(error)
                        },
                    });
                })
            }

            function getSection() {
                return $.ajax({
                    url: "../../api/sections.php?action=findOne&id=<?= $_GET['id'] ?>",
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data.data) {
                            $("#page").fadeIn(300).css("display", "flex");
                            NProgress.done()
                        } else {
                            window.location.href = '../error.php';
                        }
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