<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate QR Code for College</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            background-color: #161B7F;
            color: yellow;
            text-align: center;
            padding: 20px;
            margin: 0;
            border-bottom: 4px solid #000;
        }

        select, button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px auto;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        button {
            cursor: pointer;
            transition: background-color 0.3s ease;
            color: #fff;
        }

        #departments_button {
            background-color: red;
        }

        #departments_button:hover {
            background-color: darkred;
        }

        #green_campus_button {
            background-color: green;
        }

        #green_campus_button:hover {
            background-color: darkgreen;
        }

        #options {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        #departments_container, #green_campus_container {
            background-color: #f0f0f5;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h2 {
            font-size: 20px;
            color: #161B7F;
            margin-bottom: 10px;
            text-align: left;
        }

        #qr_code {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
    </style>
    <script>
    $(document).ready(function() {
        $.get('process.php?action=get_colleges', function(data) {
            $('#colleges').html(data);
        });

        $('#colleges').on('change', function() {
            var college_id = $(this).val();
            $('#departments, #labs, #systems, #components, #campus_parts, #trees').html('');
            $('#qr_code').html('');
            $.get('process.php?action=get_departments&college_id=' + college_id, function(data) {
                $('#departments').html(data);
            });
            $.get('process.php?action=get_campus_parts', function(data) {
                $('#campus_parts').html(data);
            });
            $('#options').show();
        });

        $('#departments_button').on('click', function() {
            $('#departments_container').show();
            $('#green_campus_container').hide();
        });

        $('#green_campus_button').on('click', function() {
            $('#green_campus_container').show();
            $('#departments_container').hide();
        });

        $('#departments').on('change', function() {
            var department_id = $(this).val();
            $('#labs').html('');
            $('#systems').html('');
            $('#components').html('');
            $('#qr_code').html('');
            $.get('process.php?action=get_labs&department_id=' + department_id, function(data) {
                $('#labs').html(data);
            });
        });

        $('#labs').on('change', function() {
            var lab_id = $(this).val();
            $('#systems').html('');
            $('#components').html('');
            $('#qr_code').html('');
            $.get('process.php?action=get_systems&lab_id=' + lab_id, function(data) {
                $('#systems').html(data);
            });
        });

        $('#systems').on('change', function() {
            var system_id = $(this).val();
            $('#components').html('');
            $('#qr_code').html('');
            $.get('process.php?action=get_components&system_id=' + system_id, function(data) {
                $('#components').html(data);
            });
        });

        $('#components').on('change', function() {
            var component_id = $(this).val();
            $('#qr_code').html('');
            $.get('process.php?action=generate_qr_component&component_id=' + component_id, function(data) {
                $('#qr_code').html(data);
            });
        });

        $('#campus_parts').on('change', function() {
            var campus_part_id = $(this).val();
            $('#trees').html('');
            $('#qr_code').html('');
            $.get('process.php?action=get_trees&campus_part_id=' + campus_part_id, function(data) {
                $('#trees').html(data);
            });
        });

        $('#trees').on('change', function() {
            var tree_id = $(this).val();
            $('#qr_code').html('');
            $.get('process.php?action=generate_qr_tree&tree_id=' + tree_id, function(data) {
                $('#qr_code').html(data);
            });
        });
    });
    </script>
</head>
<body>
    <center>
        <h1>College Name</h1>
        <select id="colleges"></select>
        <div id="options" style="display:none;">
            <button id="departments_button">Departments</button>
            <button id="green_campus_button">Green Campus</button>
        </div>
        <div id="departments_container" style="display:none;">
            <h2>Select Department</h2>
            <select id="departments"></select>
            <h2>Select Lab</h2>
            <select id="labs"></select>
            <h2>Select System</h2>
            <select id="systems"></select>
            <h2>Select Component</h2>
            <select id="components"></select>
        </div>
        <div id="green_campus_container" style="display:none;">
            <h2>Select Part of Campus</h2>
            <select id="campus_parts"></select>
            <h2>Select Tree</h2>
            <select id="trees"></select>
        </div>
        <div id="qr_code"></div>
    </center>
</body>
</html>
