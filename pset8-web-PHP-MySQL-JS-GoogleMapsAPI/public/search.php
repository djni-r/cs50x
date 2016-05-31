<?php

    require(__DIR__ . "/../includes/config.php");
    require(__DIR__ . "/../includes/states.php");
    
    // numerically indexed array of places
    $places = [];

    // split geo into array for convenience
    $geo_array = preg_split("(,+\s*|\s+)", $_GET["geo"]);
    
    // the final string to search
    $result = '';
    for ($x = 0; $x < count($geo_array); $x++) {
        // if state is an abbreviation, replace it with full name for search purposes
        if (preg_match("/.*(\b[a-zA-Z]{2}\b).*/", $geo_array[$x], $state_abbr)) {

            $i = mb_strtoupper($state_abbr[0]);
            if ($i == "US") 
            {
                continue;
            }
            else if (isset($us_state_abbrevs_names[$i]))
            {
                $geo_array[$x] = $us_state_abbrevs_names[$i];
            }
        }
        // concatenate everything into result and add + at the beginning 
        // of every word for boolean search
        $result = $result . " +" . $geo_array[$x];            
    }
    
    // add the wildcard char
    $result = $result . "*";
    // search database for places matching "geo"
    $places = CS50::query("SELECT * FROM places WHERE MATCH (place_name, admin_name1, admin_code1, postal_code) AGAINST (? IN BOOLEAN MODE)", $result);

    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>