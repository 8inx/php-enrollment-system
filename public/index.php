<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            <a href="./" class="w-full px-6 py-3 flex items-center text-white text-opacity-100 hover:text-opacity-100 cursor-pointer">
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

            <!-- main content-->
            <main class="w-full px-12 py-8">

                <div class="w-full mb-8">
                    <h1 class="font-bold text-2xl text-slate-700 pb-1">Dashboard</h1>
                    <span class="text-sm text-slate-700">Enrollment Database</span>
                </div>

                <!-- stats cards -->
                <div class="grid grid-cols-4 gap-4 mb-12">
                    <!-- card: enrolled -->
                    <div class="flex items-center p-4 rounded border-l-4 border-blue-500 bg-white drop-shadow-md">
                        <div class="flex-1">
                            <small class="font-bold text-blue-500 tracking-wider">Enrolled</small>
                            <p id="cnt_enrolled" class="font-extrabold text-xl text-slate-800">500</p>
                        </div>
                        <span class="text-gray-300">
                            <i class="fa-solid fa-clipboard-list fa-xl"></i>
                        </span>
                    </div>
                    <!-- card: students -->
                    <div class="flex items-center p-4 rounded border-l-4 border-green-500 bg-white drop-shadow-md">
                        <div class="flex-1">
                            <small class="font-bold text-green-500 tracking-wider">Students</small>
                            <p id="cnt_students" class="font-extrabold text-xl text-slate-800">1000</p>
                        </div>
                        <span class="text-gray-300">
                            <i class="fa-solid fa-user-graduate fa-xl"></i>
                        </span>
                    </div>
                    <!-- card: course -->
                    <div class="flex items-center p-4 rounded border-l-4 border-pink-500 bg-white drop-shadow-md">
                        <div class="flex-1">
                            <small class="font-bold text-pink-500 tracking-wider">Courses</small>
                            <p id="cnt_courses" class="font-extrabold text-xl text-slate-800">12</p>
                        </div>
                        <span class="text-gray-300">
                            <i class="fa-solid fa-hand-holding-heart fa-xl"></i>
                        </span>
                    </div>
                    <!-- card: pending -->
                    <div class="flex items-center p-4 rounded border-l-4 border-yellow-400 bg-white drop-shadow-md">
                        <div class="flex-1">
                            <small class="font-bold text-yellow-400 tracking-wider">Ongoing Enrollment</small>
                            <p id="cnt_ongoing" class="font-extrabold text-xl text-slate-800">30</p>
                        </div>
                        <span class="text-gray-300">
                            <i class="fa-regular fa-clock fa-xl"></i>
                        </span>
                    </div>
                </div>
                <!-- end of cards -->

                <!-- charts -->
                <div class="grid grid-cols-3 gap-4">

                    <!-- line chart enrollment -->
                    <div class="col-span-2 bg-white shadow-lg rounded">
                        <div class="flex flex-col w-full rounded overflow-hidden">
                            <div class="px-3 py-4 bg-gray-100 flex items-center">
                                <h1 class="font-bold text-sky-500">Enrollment</h1>
                                <span class="ml-2 text-xs text-slate-400">Student for the past 6 years</span>
                            </div>
                            <div class="flex items-center justify-center w-full h-80">
                                <canvas id="enrollmentLineChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- pie chart courses -->
                    <div class="col-span-1 bg-white shadow-lg rounded">
                        <div class="flex flex-col items-stretch w-full rounded overflow-hidden">
                            <div class="px-3 py-4 bg-gray-100 flex items-center">
                                <h1 class="font-bold text-sky-500">Courses</h1>
                                <span class="ml-2 text-xs text-slate-400"> Students Count Per Course</span>
                            </div>
                            <div class="h-80">
                                <canvas id="coursesPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end of content -->
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
            // course pie chart initializer
            $.when(getCoursesStats()).done(function(res) {
                var data = []
                var labels = []
                $.each(res.data, function(i, val) {
                    data.push(val.studentCount)
                    labels.push(val.code)
                })
                createCoursePieChart(labels, data, getColorSet(data.length))
            })

            // enrollment line chart  initializer
            $.when(getEnrollmentStats()).done(function(res) {
                var data = []
                var labels = []
                $.each(res.data, function(i, val) {
                    data.push(val.count)
                    labels.push(val.year)
                })
                createEnrollmentsLineChart(labels, data)
            })

            // initialize numbers
            $.when(
                countAllTimeEnrolled(),
                countAllStudents(),
                countCourses(),
                countOngoingEnrollments()
            ).done(function(res1, res2, res3, res4) {
                $('#cnt_enrolled').text(res1[0].data.length)
                $('#cnt_students').text(res2[0].data.length)
                $('#cnt_courses').text(res3[0].data.length)
                $('#cnt_ongoing').text(res4[0].data.length)
            })

            /* enrollment line chart */
            function createEnrollmentsLineChart(labels, data) {
                const lineCtx = $('#enrollmentLineChart')[0].getContext('2d')
                const enrollmentLineChart = new Chart(lineCtx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Enrolled',
                            data: data,
                            lineTension: 0.3,
                            pointRadius: 3,
                            borderColor: "rgba(78, 115, 223, 1)",
                        }]
                    },
                    options: {
                        legend: {
                            display: false,
                            labels: {
                                fontColor: '#334155',
                                defaultFontFamily: "Inter"
                            }
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        layout: {
                            padding: {
                                left: 30,
                                right: 30,
                                top: 30,
                                bottom: 30
                            }
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    drawBorder: false
                                },
                                ticks: {
                                    maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    maxTicksLimit: 5,
                                    padding: 10,
                                },
                                gridLines: {
                                    color: "#cbd5e1",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [5],
                                    zeroLineBorderDash: [2]
                                }
                            }],
                        },
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10,

                        }
                    }
                })
            }

            function getEnrollmentStats() {
                return $.ajax({
                    url: "../api/enrollments.php?action=stats",
                    method: "GET",
                    dataType: "json"
                });
            }

            /* courses pie chart */
            function createCoursePieChart(labels, data, colorSet) {
                const pieCtx = $('#coursesPieChart')[0].getContext('2d')
                const coursesPieChart = new Chart(pieCtx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Number of Student',
                            data: data,
                            backgroundColor: colorSet,
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        maintainAspectRatio: false,
                        responsive: true,
                        layout: {
                            padding: {
                                left: 10,
                                right: 10,
                                top: 30,
                                bottom: 30
                            }
                        },
                        cutoutPercentage: 70,
                        tooltips: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            titleMarginBottom: 10,
                            titleFontColor: '#6e707e',
                            titleFontSize: 14,
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            intersect: false,
                            mode: 'index',
                            caretPadding: 10
                        }
                    }
                })

            }

            function getCoursesStats() {
                return $.ajax({
                    url: "../api/courses.php?action=stats",
                    method: "GET",
                    dataType: "json"
                });
            }

            /* numbers */
            function countAllTimeEnrolled() {
                return $.ajax({
                    url: "../api/enrollments.php?action=all",
                    method: "GET",
                    dataType: "json"
                });
            }

            function countAllStudents() {
                return $.ajax({
                    url: "../api/students.php?action=all",
                    method: "GET",
                    dataType: "json"
                });
            }

            function countCourses() {
                return $.ajax({
                    url: "../api/courses.php?action=all",
                    method: "GET",
                    dataType: "json"
                });
            }

            function countOngoingEnrollments() {
                return $.ajax({
                    url: "../api/enrollments.php?action=all&status=ongoing",
                    method: "GET",
                    dataType: "json"
                });
            }

        })
    </script>
</body>

</html>