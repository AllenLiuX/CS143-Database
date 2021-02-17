<?php
# get the id parameter from the request
$id = intval($_GET['id']);

# set the Content-Type header to JSON, so that the client knows that we are returning a JSON data
header('Content-Type: application/json');

if($id){
    $res = "{";
    $db = new mysqli('localhost', 'cs143', '', 'cs143');
    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    $query = "SELECT * FROM People WHERE id=".$id;
    if (!($rs = $db->query($query))) {
        $errmsg = $db->error;
        echo "Query failed: $errmsg <br/>";
        $db->close();
        exit(1);
    }
    while($row = $rs->fetch_assoc()){
        $res .= '"id":"'.$row['id'].'", ';
        $res .= '"givenName":{"en":"'.$row['givenName'].'"}, ';
        $res .= '"familyName":{"en":"'.$row['familyName'].'"}, ';
        $res .= '"gender":"'.$row['gender'].'", ';
        $res .= '"birth":{"date":"'.$row['birthDate'].'", ';
        $res .= '"place":{"city":{"en":"'.$row['birthCity'].'"}, ';
        $res .= '"country":{"en":"'.$row['birthCountry'].'"}}}, ';
    }


    $query = "SELECT * FROM Organization WHERE id=".$id;
    if (!($rs = $db->query($query))) {
        $errmsg = $db->error;
        echo "Query failed: $errmsg <br/>";
        $db->close();
        exit(1);
    }
    while($row = $rs->fetch_assoc()){
        $res .= '"id":"'.$row['id'].'", ';
        $res .= '"orgName":{"en":"'.$row['orgName'].'"}, ';
        $res .= '"founded":{"date":"'.$row['foundDate'].'", ';
        $res .= '"place":{"city":{"en":"'.$row['foundCity'].'"}, ';
        $res .= '"country":{"en":"'.$row['foundCountry'].'"}}}, ';
    }

    $query = "SELECT * FROM Prize WHERE id=".$id;
    if (!($rs = $db->query($query))) {
        $errmsg = $db->error;
        echo "Query failed: $errmsg <br/>";
        $db->close();
        exit(1);
    }
    $res .= '"nobelPrizes":[';
    $first1 = true;
    while($row = $rs->fetch_assoc()){
        if(!first1){
                    $res .= ',';
                }
                $first1 = false;
        $res .= '{"awardYear":"'.$row['awardYear'].'", ';
        $res .= '"category":{"en":"'.$row['category'].'"}, ';
        $res .= '"sortOrder":"'.$row['sortOrder'].'", ';
        $res .= '"portion":"'.$row['portion'].'", ';
        $res .= '"dateAwarded":"'.$row['dateAwarded'].'", ';
        $res .= '"prizeStatus":"'.$row['prizeStatus'].'", ';
        $res .= '"motivation":{"en":"'.$row['motivation'].'"}, ';
        $res .= '"prizeAmount":'.$row['prizeAmount'].', ';
        $res .= '"affiliations":[';

        $query2 = "SELECT * FROM Affiliation WHERE id=".$id." AND seq=".$row['seq'];;
        if (!($rs2 = $db->query($query2))) {
            $errmsg = $db->error;
            echo "Query failed: $errmsg <br/>";
            $db->close();
            exit(1);
        }
        $first2 = true;
        while($row2 = $rs2->fetch_assoc()){
            if(!first2){
                $res .= ',';
            }
            $first2 = false;
            $res .= '{"name":{"en":"'.$row2['name'].'"}, ';
            $res .= '"city":{"en":"'.$row2['city'].'"}, ';
            $res .= '"country":{"en":"'.$row2['country'].'"}}';
        }
        $res .= ']}';
    }

    $res .= ']}';
    echo $res;
}


# send a fake JSON data for the given id
// echo '{ "id":"' . $id . '", "givenName":{ "en":"A. Michael" }, "familyName":{ "en":"Spence" } }'
?>
