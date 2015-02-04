<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Lookup</title>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="css/local.css">
</head>
<?php
/**
 * Created by PhpStorm.
 * User: kvu
 * Date: 1/14/2015
 * Time: 9:36 AM
 */
function load_table() {
    $filename = "./result_set.html";
    $myfile = fopen($filename, "r") or die("Unable to open file!");
    $temp = fread($myfile, filesize($filename));
    fclose($myfile);
    return $temp;
}

$contents = load_table();
echo $contents;
?>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function()
        {
            $("#lookup_result").dataTable({
                "dom": '<"top"fli>rt<"bottom"ifp>',
                "order": [[ 0, "asc" ]],
                "lengthMenu": [[-1, 25, 50, 100, 200], ["All", 25, 50, 100, 200]]
            });
        }
    );
</script>
</body>
</html>