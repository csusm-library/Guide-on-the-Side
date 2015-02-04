<?php
/**
 * Created by PhpStorm.
 * User: kvu
 * Date: 1/13/2015
 * Time: 4:40 PM
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST["DOM"];
    date_default_timezone_set('America/Los_Angeles');
    $today = date('l jS \of F Y h:i:s A');

    $html_well_formed = <<<EOD
<!DOCTYPE html>
<html>
<head>
    <title>Title Lookup</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
    <h1>SEARCH RESULTS IN PRIMO BY TITLE</h1>
    <h2>Created: $today</h2>
<!--    <table id="lookup_result" class="tablesorter-bootstrap" cellspacing="1" border="1"> -->
    <table id="lookup_result" class="table" border="1">
        <thead>
        <tr>
            <th class="header" width="20%">Course</th>
            <th class="header" width="20%">Instructor</th>
            <th class="header" width="28%">Title</th>
            <th class="header" width="24%">Type</th>
            <th class="header" width="24%">Format</th>
            <th class="header" width="28%">Author</th>
            <th class="header" width="24%">Created</th>
            <th class="header" width="20%">ISBN</th>
        </tr>
        </thead>
       $table
    </table>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
</body>
</html>
EOD;

    writeDOM($html_well_formed);
}

function writeDOM($dom) {
    $myfile = fopen("./test_data/result_set.html", "w") or die("Unable to open file!");
    fwrite($myfile, $dom);
    fclose($myfile);
    echo json_encode(
        array(
        success => 1
        )
    );
}
?>