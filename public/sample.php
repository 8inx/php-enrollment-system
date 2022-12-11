<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
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
    <table id="table" class="table table-bordered m-auto" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Days</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Color</th>
                <th>Time</th>
                <th>Datetime</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
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
                get: "../api/sample.php?action=all",
                post: "../api/sample.php",
                dataSrc: "data",
                columns: [{
                        data: "id",
                        identifier: true,
                        hidden: true,
                    },
                    {
                        data: "name",
                        editable: true,
                    },
                    {
                        data: "email",
                        editable: true,
                        type: "email",
                        redirect: true
                    },
                    {
                        data: "days",
                        editable: true,
                        type: 'checkbox',
                        options: '{"M":"Monday","T":"Tuesday","W":"W","H":"H","F":"F","S":"S","U":"U"}',
                    },
                    {
                        data: "mobile",
                        editable: true,
                        type: 'tel',
                        pattern: '[0-9]{3}-[0-9]{3}-[0-9]{4}'
                    },
                    {
                        data: "gender",
                        editable: true,
                        type: 'select',
                        options: '{"0":"Female","1":"Male"}'
                    },
                    {
                        data: "color",
                        editable: true,
                        type: 'color',
                    },
                    {
                        data: "time",
                        editable: true,
                        type: 'time',
                        min: "9:00",
                        max: "18:00"
                    },
                    {
                        data: "datetime",
                        editable: true,
                        type: "date",
                        min: "2018-01-01",
                        max: "2018-12-31"
                    },
                    {
                        data: "country",
                        editable: true,
                        type: "select",
                        options: '{"0":"Female","1":"Male"}'
                    },
                ],
                buttons: {
                    edit: {
                        class: "px-3 py-2 ring-1 ring-slate-300 ring-inset text-blue-500 bg-white",
                        html: '<i class="fa-solid fa-pencil"></i>',
                        action: "edit",
                    },
                    delete: {
                        class: "px-3 py-2 ring-1 ring-slate-300 ring-inset text-red-500 bg-white",
                        html: '<i class="fa-solid fa-trash"></i>',
                        action: "delete",
                    },
                    save: {
                        class: "px-3 py-2 bg-green-500 text-white",
                        html: "Save",
                    },
                    confirm: {
                        class: "px-3 py-2 bg-red-500 text-white",
                        html: "Are you sure?",
                    },
                },
                extraButtons: {
                    add: {
                        class: "px-3 py-2 bg-green-500 text-white",
                        html: '<i class="fa-solid fa-plus"></i>',
                        action: 'add',
                        prepend: true,
                        showAt: function(data) {
                            return parseInt(data.gender) === 1
                        },
                        onClick: function(data, action) {
                            console.log(data, action)
                        }
                    },
                    remove: {
                        class: "px-3 py-2 bg-red-500 text-white",
                        html: '<i class="fa-solid fa-plus"></i>',
                        action: 'remove',
                        prepend: true,
                        showAt: function(data) {
                            return parseInt(data.gender) === 0
                        },
                        onClick: function(data, action) {
                            console.log(data, action)
                        }
                    }
                },
                onAjax: function(action, serialize) {

                    console.log(action, serialize);
                    NProgress.start();
                },
                onSuccess: function(data, textStatus, jqXHR) {
                    console.log('s', data);
                    dt.ajax.reload();
                    NProgress.done();
                },
                onFail: function(jqXHR, textStatus, errorThrown) {
                    NProgress.done();
                    console.log('e', jqXHR);
                    dt.ajax.reload();
                },
            })
        })
    </script>
</body>

</html>