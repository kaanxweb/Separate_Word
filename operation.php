<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php



if (isset($_POST['word_list']) > 0 && isset($_POST['choice']) && isset($_POST['separator'])){
    $words = $_POST['word_list'];

    //Word Choice Operation
    switch ($_POST['choice']){
        case 'small_word':
            $words = strtolower($words);
            break;

        case 'big_word':
            $words = strtoupper($words);
            break;

        case 'capital_letter_word':
            $words = mb_convert_case($words, MB_CASE_TITLE, "UTF-8");
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

            case 'line_break':
                $words = explode("\n", $words);
                break;
        }
    }

    if (isset($_POST['download_json'])){
        $words = json_encode($words);
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename=data.json');
        file_put_contents('php://output', $words);
    }
    else if (isset($_POST['print_data'])){
        print_r($words);
    }
    else if (isset($_POST['print_with_pre'])){
        echo "<pre>";
        print_r($words);
        echo "</pre>";
    }
}




else{
    echo "Missing Information";
}

?>

</body>
</html>
