<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment/Profile</title>
    <!-- fonts -->
    <link rel="stylesheet" href="../../vendor/googleFonts/fonts.css">
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
            <a href="../enrollments.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-100 hover:text-opacity-100 cursor-pointer whitespace-nowrap text-ellipsis overflow-hidden">
                <i class="fa-solid fa-envelope"></i>
                <span class="tracking-wider ml-4 text-sm">Enrollment / <span class="text-ellipsis text-white/60" title="lastName">0</span></span>
            </a>
            <a href="../courses.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-graduation-cap"></i>
                <span class="tracking-wider ml-4 text-sm">Courses</span>
            </a>
            <a href="../sections.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-door-open"></i>
                <span class="tracking-wider ml-4 text-sm">Sections</span>
            </a>
            <a href="../subjects.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
                <i class="fa-solid fa-book"></i>
                <span class="tracking-wider ml-4 text-sm">Subjects</span>
            </a>
            <a href="../students.php" class="w-full px-6 py-3 flex items-center text-white text-opacity-50 hover:text-opacity-100 cursor-pointer">
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
                    <div class="text-blue-600">
                        <a href="../enrollments.php" class="text-sm text-blue-500 hover:text-slate-800">
                            Enrollment /
                        </a>
                        <a href="#sec_information" class="text-sm text-slate-400 hover:text-slate-800">
                            <span>Information /</span>
                        </a>
                        <a href="#sec_subjects" class="text-sm text-slate-400 hover:text-slate-800">
                            <span>Subjects</span>
                        </a>
                    </div>
                    <a href="./" class="ml-auto text-gray-500 hover:text-slate-800">
                        <i class="fa-regular fa-bell fa-lg"></i>
                    </a>
                    <a href="./account.php" class="ml-6 pl-6 flex items-center text-blue-500 hover:text-sky-500 border-l border-gray-300">
                        <img src="../../dist/img/profile.svg" class="w-8 h-8 rounded-full" alt="">
                        <span class="ml-2 font-bold text-sm">superking</span>
                    </a>
                </div>
            </header>
            <!-- end of topbar -->

            <!-- main content-->
            <main class="w-full px-12 py-8">

                <section id="sec_information" class="w-full my-10">
                    <div class="mb-10 flex items-center">
                        <h2 class="text-lg text-slate-700 font-bold">Student Information</h2>
                        <div class="ml-2 px-2 py-1 text-sm text-slate-500 rounded enroll-status" title="ongoing">
                            <div class="enroll-status-ongoing text-amber-500">
                                <i class="fa-solid fa-circle-notch fa-spin"></i> ongoing
                            </div>
                            <div class="enroll-status-completed text-green-500">
                                <i class="fa-solid fa-circle-check"></i> completed
                            </div>
                        </div>
                    </div>

                    <form id="edit" method="post" class="grid grid-cols-5 gap-4 max-w-xl">
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="sectionId" value="">
                        <input type="hidden" name="studentId" value="">
                        <!-- fullname disabled -->
                        <div class="flex items-center justify-start text-sm text-gray-500">Student Name</div>
                        <div class="col-span-4">
                            <input name="fullName" disabled class="capitalize block w-full px-3 py-2 bg-white border read-only:border-green-300 
                                text-sm text-gray-700 shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 
                                focus:ring-1 focus:ring-sky-500">
                        </div>
                        <!-- corseCode  -->
                        <div class="flex items-center justify-start text-sm text-gray-500">Course</div>
                        <div class="col-span-4">
                            <input name="courseDescription" disabled class="block w-full px-3 py-2 bg-white border disabled:border-green-300 
                                text-sm text-gray-700 shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 
                                focus:ring-1 focus:ring-sky-500">
                        </div>
                        <!-- year -->
                        <div class="flex items-center justify-start text-sm text-gray-500">Academic Year</div>
                        <div class="col-span-4">
                            <input type="number" min="2000" step="1" name="year" placeholder="<?= date('Y') ?>" class="text-left w-full px-3 py-2 bg-white border border-slate-300 read-only:border-green-300 
                                text-sm text-gray-700 shadow-sm placeholder-slate-500 focus:outline-none focus:border-sky-500 
                                focus:ring-1 focus:ring-sky-500 placeholder:text-gray-400">
                        </div>
                        <!-- semester -->
                        <div class="flex items-center justify-start text-sm text-gray-500">Semester</div>
                        <div class="col-span-4">
                            <select name="semester" required class="text-left w-full px-3 py-2 bg-white border border-slate-300 disabled:border-green-400 
                                text-sm text-gray-700 shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 
                                focus:ring-1 focus:ring-sky-500 placeholder:text-slate-400">
                                <option value="" disabled selected>Select Semester</option>
                                <option value="1">1st Sem</option>
                                <option value="2">2nd Sem</option>
                            </select>
                        </div>
                        <!-- select section -->
                        <div class="flex items-center justify-start text-sm text-gray-500">Section</div>
                        <div class="col-span-4 row-span-1 relative">
                            <input name="sectionCode" readonly id="selectSection" placeholder="Select Section" class="text-left w-full px-3 py-2 bg-white border border-slate-300 
                                text-sm text-gray-700 shadow-sm placeholder-slate-400 focus:outline-none focus:border-sky-500 disabled:border-green-300 
                                focus:ring-1 focus:ring-sky-500">
                        </div>
                    </form>
                </section>

                <section id="sec_subjects" class="w-full my-8">
                    <div class="mb-3 flex items-center">
                        <h2 class="text-md text-slate-700 font-bold whitespace-nowrap">Section Subjects</h2>
                        <span class="ml-4 content-[''] w-full border-b border-slate-300"></span>
                    </div>
                </section>

                <!-- addtional info table -->
                <div class="w-full mb-12">
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
                    <div class="w-full flex items-center text-slate-500">
                        <span class="mr-3">Total Units:</span>
                        <span title="totalUnits" class="p-2 text-slate-700">0</span>
                    </div>
                </div>

                <div class="enroll-status" title="ongoing">
                    <div class="flex flex-wrap w-full mb-12 enroll-status-completed">
                        <div class="w-full mb-8 flex items-center">
                            <h2 class="text-md text-slate-700 font-bold whitespace-nowrap">Additional Information</h2>
                            <span class="ml-4 content-[''] w-full border-b border-slate-300"></span>
                        </div>
                        <div class="grid grid-cols-5 gap-3 w-full">
                            <div class="col-span-1 text-sm font-bold text-slate-500">Date Created</div>
                            <div class="col-span-4 text-sm  text-slate-500" title="dateCreated">Date Started</div>
                            <div class="col-span-1 text-sm font-bold text-slate-500">Date Enrolled</div>
                            <div class="col-span-4 text-sm  text-slate-500" title="dateEnrolled">Date Started</div>
                        </div>
                    </div>
                </div>

                <!-- actions info -->
                <section id="sec_actions" class="flex flex-wrap w-full mb-20 enroll-status" title="ongoing">
                    <div class="w-full mb-8 flex items-center">
                        <h2 class="text-md text-slate-700 font-bold whitespace-nowrap">Enrollment Actions</h2>
                        <span class="ml-4 content-[''] w-full border-b border-slate-300"></span>
                    </div>
                    <a href="../enrollments.php" class="px-4 py-2 text-sm bg-slate-400 text-white rounded hover:shadow-xl">
                        <i class="fa-solid fa-left-long"></i> Go Back
                    </a>
                    <div class="enroll-status-ongoing ml-1">
                        <button id="formSave" name="edit" class="px-4 py-2 text-sm bg-green-500 text-white rounded hover:shadow-xl">
                            <i class="fa-solid fa-check"></i> Save
                        </button>
                        <button id="formComplete" name="complete" class="px-4 py-2 text-sm bg-sky-500 text-white rounded">
                            <i class="fa-solid fa-check-to-slot"></i> Save and Complete
                        </button>
                    </div>
                    <div class="enroll-status-completed ml-1">
                        <button id="formPrint" name="print" class="px-4 py-2 text-sm bg-slate-700 text-white rounded">
                            <i class="fa-solid fa-print"></i> Print
                        </button>
                    </div>
                    <button id="formDelete" name="delete" class="ml-1 px-4 py-2 text-sm ring-1 ring-inset ring-red-500 text-red-500 rounded">
                        <i class="fa-solid fa-trash-can mr-2"></i> Delete Enrollment
                    </button>
                </section>
            </main>
            <!-- end of content -->
        </div>

        <!-- section modal -->
        <div id="sectionsAvailable" class="modal min-h-[500px]">
            <div class="w-full mb-1 mt-8 flex items-center">
                <i class="fa-solid fa-list fa-lg"></i>
                <h1 class="ml-2 text-xl font-bold text-slate-800">Select Section</h1>
            </div>
            <table id="sectionsAvailableTable" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Section Code</th>
                        <th>Max Students</th>
                        <th>Cur. Participants</th>
                        <th>No. of Subjects</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- composer -->
        <div id="composer" class="modal">
            <div class="bg-white m-auto px-5 py-4 rounded-md">
                <div class="w-full mb-5 flex items-center">
                    <h1 class="text-xl font-bold text-slate-800">Create New Section</h1>
                </div>
                <!-- form -->
                <form id="edit" method="post" class="grid grid-cols-5 gap-4 max-w-xl">
                    <div class="col-start-2 col-span-4"><span id="formFeedback"></span></div>
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
                    var listSection = await listSectionSubject(results.sectionId)
                    var validator = handleFormValidation();
                    var listAvailSection = await listAvailableSection(listSection);
                    $('#sectionsAvailable').on($.modal.BEFORE_OPEN, function(event, modal) {
                        validator.resetForm();
                    });
                    initEvents(results.id, validator)
                }
            });

            function initPageInfo(data) {
                console.log(data)
                for (const [key, val] of Object.entries(data)) {
                    $('[title="' + key + '"]').html(val)
                    $('[name="' + key + '"]').val(val);
                    if (val && data.status === 'completed') {
                        $('[name="' + key + '"]').attr('disabled', 'disabled')
                    }
                    if (key === 'dateCreated' || key === 'dateEnrolled') {
                        $('[title="' + key + '"]').html(formatDate(val))
                    }
                }
                $('.enroll-status').attr('title', data.status);
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
                    info: false,
                    columns: [{
                            data: "id",
                            identifier: true,
                            hidden: true
                        },
                        {
                            data: "code"
                        },
                        {
                            data: "description",
                        },
                        {
                            data: "units"
                        },
                        {
                            data: "days",
                        },
                        {
                            data: "timeIn",
                        },
                        {
                            data: "timeOut",
                        },
                        {
                            data: "room",
                        },
                    ],
                    drawCallback: function(data) {
                        var tolalUnits = this.api().columns(3).data()[0].reduce(function(a, b) {
                            return (parseInt(a) + parseInt(b))
                        }, 0);
                        $('[title="totalUnits"]').html(tolalUnits)

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

            function listAvailableSection(dt2) {
                var dt = $('#sectionsAvailableTable').Datatabledit({
                    get: "../../api/sections.php?action=all",
                    post: "../../api/sections.php",
                    dataSrc: "data",
                    pageLength: 10,
                    columns: [{
                            data: "id",
                            identifier: true,
                            hidden: true
                        },
                        {
                            data: "code"
                        },
                        {
                            data: "maxStudents"
                        },
                        {
                            data: "participantsCount"
                        },
                        {
                            data: "subjCount"
                        }
                    ],
                    extraButtons: {
                        addSection: {
                            class: 'ml-auto px-3 py-2 ring-1 ring-slate-300 ring-inset bg-green-500 text-white hover:bg-green-600',
                            html: '<i class="fa-solid fa-check"></i>',
                            action: 'addSection',
                            onClick: function(data, action) {
                                $('#edit input[name="sectionId"]').val(data.id)
                                $('#edit input[name="sectionCode"]').val(data.code)
                                dt2.ajax.url('../../api/sectionSubjects.php?action=getSection&sectionId=' + data.id).load()
                                //$('[title="totalUnits"]').html(sum)
                                $.modal.close()
                            },
                            showAt: function(data) {
                                return parseInt(data.maxStudents) > parseInt(data.participantsCount)
                            }
                        },
                        locked: {
                            class: 'ml-auto px-3 py-2 ring-1 ring-slate-300 ring-inset bg-slate-400 text-white',
                            html: '<i class="fa-solid fa-lock"></i>',
                            action: '',
                            showAt: function(data) {
                                return parseInt(data.maxStudents) <= parseInt(data.participantsCount)
                            }
                        },
                    }
                })
                return dt;
            }

            function handleFormValidation() {
                // edit section
                return $("#edit").validate({
                    rules: {
                        sectionId: {
                            required: true,
                        },
                        year: {
                            required: true,
                            digits: true
                        },
                        semester: {
                            required: true,
                            digits: true
                        },
                        sectionCode: {
                            required: true,
                        }
                    },
                    messages: {
                        year: {
                            required: "Please enter academic year",
                            digits: "Year must be a valid number"
                        },
                        semester: {
                            required: "Please select students semester",
                            digits: "Must be a valid semester"
                        },
                        sectionCode: {
                            required: "Please select a section",
                        }
                    },

                    submitHandler: function(form, event) {
                        event.preventDefault();
                    }
                })
            }

            function handleOnSubmit(enrollmentId, action, validator) {
                let valid = $('#edit').valid()
                if (valid) {
                    if (action === 'complete') {
                        action = 'edit&status=completed'
                    }
                    $.ajax({
                        type: "POST",
                        url: "../../api/enrollments.php",
                        data: $("#edit").serialize() + '&action=' + action + '&id=' + enrollmentId,
                        beforeSend: function(data) {
                            NProgress.start();
                        },
                        success: async function(data) {
                            NProgress.done()
                            var newVal = await getSection();
                            if (action === 'delete') {
                                window.location.href = '../enrollments.php'
                            }
                            initPageInfo(newVal.data)
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
            }

            function initEvents(enrollmentId, validator) {

                $('#formSave, #formComplete, #formDelete').click(function() {
                    var action = $(this).attr('name')
                    handleOnSubmit(enrollmentId, action, validator)
                })

                $("#selectSection").click(function() {
                    $("#sectionsAvailable").modal({
                        fadeDuration: 350,
                        fadeDelay: 0.5
                    })
                })

                $("#selectSection").keypress(function(e) {
                    if (e.which == 13) {
                        $("#sectionsAvailable").modal({
                            fadeDuration: 350,
                            fadeDelay: 0.5
                        })
                    }
                })
            }

            function getSection() {
                return $.ajax({
                    url: "../../api/enrollments.php?action=findOne&id=<?= $_GET['id'] ?>",
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
        })
    </script>
</body>

</html>