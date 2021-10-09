<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>




<?php



if (isset($_POST['separator_words']) && isset($_POST['word_list']) > 0 && isset($_POST['choice']) && isset($_POST['separator'])){

    $words = $_POST['word_list'];



    echo "<hr>";
    echo "<div class='button_list'>";
    echo "<a href='download_json.php' class='button'>Download JSON</a>";
    echo "</div>";
    echo "<hr>";



    //Word Choice Operation
    switch ($_POST['choice']){
        case 'small_word':
            $words = strtolower($words);
            break;

        case 'big_word':
            $words = strtoupper($words);
            break;

        case 'capital_letter_word':
            $words = ucwords($words);
            break;

        case 'just_separate':
            echo "Your Choice \"Just Separate\""."<hr>";
            break;

        default:
            echo "NOT FOUND";
            break;
    }


    //Seperator Operation
    if ($_POST['separator'] == "myself" && strlen($_POST['another_separator']) == 0){
        die("Missing Separator");
    }
    else if ($_POST['separator'] != "myself" && strlen($_POST['another_separator']) > 0){
        die("Do not select more than one separator");
    }
    else if ($_POST['separator'] == "myself" && strlen($_POST['another_separator']) > 0){
        $separator = $_POST['another_separator'];
        $words = explode($separator, $words);
    }
    else{
        $separator = $_POST['separator'];
        switch ($separator){
            case 'space':
                $words = explode(" ", $words);
                break;

            case 'vertical_line':
                $words = explode("|", $words);
                break;

            case 'and':
                $words = explode("&", $words);
                break;
        }
    }



    echo "<pre>";
    print_r($words);
    echo "</pre>";
    die();








}




else{
    echo "Missing Information";
}

?>

</body>
</html>
