<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CS143 Project 1c</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/project2.css?v=2" rel="stylesheet">
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header navbar-defalt">
            <a class="navbar-brand" href="index.php">CS143 DataBase Query System</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class='content'>
            <h2><b>Searching Page</b></h2>
                <br>
<!--            <hr>-->
<!--            <h3 for="search_input">Search for Movie or Actor:</h3>-->
            <form class="form-group" method ="GET" id="usrform">
                <input type="text" id="search_input"class="form-control" placeholder="Search for Movie or Actor..." name="result"><br>
                <input type="submit" value="Click Me!"class="btn btn-default" style="margin-bottom:10px">
            </form>
            <!--php query start from here -->
            <?php
            $searchInfo = $_GET["result"];
            if ($searchInfo) {
                $db = new mysqli('localhost', 'cs143', '', 'cs143');
                if ($db->connect_errno > 0) {
                    die('Unable to connect to database [' . $db->connect_error . ']');
                }
                $searchInfo = str_replace("'", "\'", $searchInfo);
                $searchInfo = str_replace("\"", "\"", $searchInfo);
                $searchInfos = explode(' ', $searchInfo);
//                     $searchInfos = preg_split('/ +/', $searchInfo);

                // search for actors
                $query = "SELECT id, last, first, dob FROM Actor WHERE";

                $first_info = true;
                foreach($searchInfos as $info){
                    if($first_info == true){
                        $query .= " (first LIKE '%".$info."%' OR last LIKE '%".$info."%')";
                        $first_info = false;
                    }else{
                        $query .= " and (first LIKE '%".$info."%' OR last LIKE '%".$info."%')";
                    }
                }
                $query .= ";";

                if (!($rs = $db->query($query))) {
                    $errmsg = $db->error;
                    echo "Query failed: $errmsg <br/>";
                    $db->close();
                    exit(1);
                }

                $result = "<h2>Matched Actors</h2>";
                $result .= "<table class=\"table\"><thead><tr><th scope=\"col\">Name</th><th scope=\"col\">Date of Birth</th></tr></thead>";
                $result .= "<tbody>";
                while($row = $rs->fetch_assoc()) {
                    $result .= "<tr>";
                    $result .= "<td><a href=\"ShowActor.php?id=".$row['id']."\">".$row['first']." ".$row['last']."</a></td>";
                    $result .= "<td>".$row['dob']."</td>";
                    $result .= "</tr>";
                }
                $result .= "</tbody></table><br/><br/>";
                echo $result;

                // search for movies
                $first_info = true;
                $query = "SELECT id, title, year FROM Movie WHERE";
                foreach($searchInfos as $info){
                    if($first_info == true){
                        $query .= " title LIKE '%".$info."%'";
                        $first_info = false;
                    }else{
                        $query .= " and title LIKE '%".$info."%'";
                    }
                }
                $query .= ";";

                if (!($rs = $db->query($query))) {
                    $errmsg = $db->error;
                    echo "Query failed: $errmsg <br/>";
                    $db->close();
                    exit(1);
                }


                $result = "<table class=\"table\"><thead><tr><th scope=\"col\">Title</th><th scope=\"col\">Year</th></tr></thead>";
                $result .= "<tbody>";
                while($row = $rs->fetch_assoc()) {
                    $result .= "<tr>";
                    $result .= "<td><a href=\"browse1.php?id=".$row['id']."\">".$row['title']."</a></td>";
                    $result .= "<td>".$row['year']."</td>";
                    $result .= "</tr>";
                }
                $result .= "</tbody></table><br/><br/></div>";
                echo "<h2>Matched Movies</h2>";
                echo $result;


                $db->close();
            }
            ?>
            <!--php query end from here -->
        </div>
    </div>
</div>
    <footer>
        <div class="container" id="foot-cont">
            <p id='foo' class="m-0 text-center text-black-50">@Vincent Liu 2020. Author: Wenxuan Liu(Vincent) Powered by HTML&CSS&PHP with Apache Ubuntu Mysql server</p>
        </div>
    </footer>
</body>
</html>
