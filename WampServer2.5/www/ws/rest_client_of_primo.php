<?php
/**
 * Created by PhpStorm.
 * User: kvu
 * Date: 1/9/2015
 * Time: 11:30 AM
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $str = $_POST["isbn_n_more"];
    $isbn_n_more = preg_split("/%2C/", $str);  // comma in hex
    $isbn_num = $isbn_n_more[0];
    $course_num = $isbn_n_more[1];
    $course_num = str_replace("+", " ", $course_num);
    $instructor = $isbn_n_more[2];
    $instructor = str_replace("+", " ", $instructor);
    $itemtitle = $isbn_n_more[3];
    $string = "http://primo-pmtna01.hosted.exlibrisgroup.com/PrimoWebServices/xservice/search/brief?institution=CALS_USM&onCampus=true&query=any,contains,".$itemtitle."&indx=1&bulkSize=10";
    $string = file_get_contents($string);
    $itemtitle = str_replace("+", " ", $itemtitle);
    display_result($isbn_num, $string, $course_num, $instructor, $itemtitle);
}

function replace_hex($subject) {
    $patterns = array(
        '/%20/','/%21/','/%22/','/%23/','/%24/','/%25/','/%26/','/%27/','/%28/','/%29/','/%2A/','/%2B/','/%2C/','/%2D/','/%2E/','/%2F/',
        '/%3A/','/%3B/','/%3C/','/%3D/','/%3E/','/%3F/',
        '/%40/',
        '/%5B/','/%5C/','/%5D/','/%5E/','/%5F/',
        '/%60/',
        '/%7B/','/%7C/','/%7D/','/%7E/',
    );
    $replacements = [
        ' ','!','"','#','$','%','&',"'",'(',')','*','+',',','-','.','/',
        ':',';','<','=','>','?',
        '@',
        '[','\\',']','^','_',
        '`',
        '{','|','}','~',
    ];
    return preg_replace($patterns, $replacements, $subject);
}

function find_element($element, $xml_string) {
    $element_len = strlen($element);
    $start_position = strpos($xml_string, $element) + $element_len;
    $element = "</" . substr($element, 1, $element_len - 1);
    $end_position = strpos($xml_string, $element);
    if ($end_position)
        return substr($xml_string, $start_position, $end_position - $start_position);
    else
        return "";
}

function display_result($isbn_no, $xml, $course_no, $instructor_name, $title_as_key) {
    $author = find_element("<author>", $xml);
    $title = find_element("<title>", $xml);
    $year = find_element("<creationdate>", $xml);
    $calsusm = find_element("<recordid>", $xml);
    $book_type = find_element("<type>", $xml);
    $book_format = find_element("<format>", $xml);
    if (strlen($title) == 0) {
        $title = $title_as_key;
        $title = replace_hex($title);
        $title = ucwords(strtolower($title));
        $title = $title . ": NOT FOUND";
        $isbn_no = "";
    }
    echo json_encode(
        array(
            "success" => 1,
            "course" => $course_no,
            "instructor" => $instructor_name,
            "title" => $title,
            "book_type" => $book_type,
            "book_format" => $book_format,
            "author" => $author,
            "year" => $year,
            "calsusm" => $calsusm,
            "isbn" => $isbn_no,
        )
    );
}

?>