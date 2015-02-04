<html>
<head>
    <title>Title Lookup</title>
 <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>

<h3 id="statuses">Loading data...</h3>
<?php

     function load_data() {
         $myfile = fopen("./test_data/bookstore book List spring 2015 edited1.csv", "r") or die("Unable to open file!");
         $temp = array();
         $i = 0;
         while (!feof($myfile)) {
             $fields = fgetcsv($myfile);
             if ($i == 0) {
                 $i++;
                 continue;
             }
             $isbn_matches = $fields[9];
             $course_matches = $fields[2];
             $instructor_matches = $fields[3];
             $title_matches = $fields[6];
             if (count($title_matches) > 0) {
                 array_push($temp, $isbn_matches . "," . $course_matches . "," .  $instructor_matches . "," .$title_matches);
             } else {
                 //$j++;  // good place for test-driven-development code
             }
         }
         $temp = array_unique($temp);
         sort($temp);
         fclose($myfile);
         return $temp;
     }

$isbn_list = load_data();

?>



<div class="container">
<div class="row">
    <div class="col-md-7 well">
    <form role="form" name="form-abc" id="form-abc" method="post">
        <div class="form-group has-feedback">
            <label class="control-label col-md-2" for="isbn_array">ISBN to be Searched are:</label>
            <div class="col-md-10">
                <textarea class="form-control" id="isbn_array" name="isbn_array" rows="5"><?php echo implode(';', $isbn_list) ?></textarea>
                <i class="fa form-control-feedback"></i>
            </div>
        </div>

    </form>
        <div class="form-group has-feedback">
            <label class="control-label col-md-2" id="alert_current_count">Current count:     </label>
            <label class="control-label col-md-2" id="alert_total"></label>
        </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" id="table-list">
        </table>
    </div>
    <div class="col-md-5">
    </div>
</div>
</div>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script>
    $(document).ready(function(){
        var formData = "";
        formData = $('form').serialize();
        var str = "isbn_array=";
        var pos = formData.search(str);
        formData = formData.slice(pos+str.length);
        var isbn_n_more_list = formData.split("%3B"); // semicolon in hex
        $("#alert_total").text("Total count: " + isbn_n_more_list.length);
        for (i=0; i < isbn_n_more_list.length; i++) {
            //$("#alert_current_count").text("Current count: " + i );
            $.ajax({
                    type: 'POST',
                    url: 'rest_client_of_primo.php',
                    dataType: 'json',
                    data: {
                        isbn_n_more : isbn_n_more_list[i]
                    },
                    cache: true,
                    timeout: 5000000,
                    success: function(resp) {
                        if (resp.success == "1") {
                            str = resp.title;
                            pos = str.search("NOT FOUND");
                            if (pos > 0) {
                                $("#table-list").append("<tr><td>"+resp.course+"</td><td>"+resp.instructor+"</td><td>"+resp.title+"</td><td>"+resp.book_type+"</td><td>"+resp.book_format+"</td><td>"+resp.author+"</td><td>"+resp.year+"</td><td>"+resp.isbn+"</td></tr>");

                            } else {
                                $("#table-list").append("<tr><td>"+resp.course+"</td><td>"+resp.instructor+"</td><td><a href='http://primo-pmtna01.hosted.exlibrisgroup.com/CALS_USM:"+resp.calsusm+"&amp;tabs=viewOnlineTab' target='_blank'>"+resp.title+"</a></td><td>"+resp.book_type+"</td><td>"+resp.book_format+"</td><td>"+resp.author+"</td><td>"+resp.year+"</td><td>"+resp.isbn+"</td></tr>");
                            }
                        }
                    }
                }

            ).done(function(){
                    //
                    $.ajax({
                        type: 'POST',
                        url: 'write_DOM.php',
                        dataType: 'json',
                        data: {
                            DOM : $('#table-list')[0].innerHTML
                        },
                        cache: true,
                        success: function(response) {
                            //
                        }
                    });

                })
            ;

        }
    });

</script>
</body>
</html>
