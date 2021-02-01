
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CS143 Project 1c</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/project2.css" rel="stylesheet">

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
            <div class='content'><h2><b> Actor Information Page</b></h2>
            <hr>
            <h4><b>Actor Information is:</b></h4>
            <div class='table-responsive'>
                <?php
                $id = $_GET["id"];
                if ($id) {
                    $db = new mysqli('localhost', 'cs143', '', 'cs143');
                    if ($db->connect_errno > 0) {
                        die('Unable to connect to database [' . $db->connect_error . ']');
                    }

                    $query = "SELECT * FROM Actor WHERE id=".$id;

                    if (!($rs = $db->query($query))) {
                        $errmsg = $db->error;
                        echo "Query failed: $errmsg <br/>";
                        $db->close();
                        exit(1);
                    }

                    $result = "<table class=\"table\"><thead><tr><th scope=\"col\">Name</th><th scope=\"col\">Sex</th><th scope=\"col\">Date of Birth</th><th scope=\"col\">Date of Death</th></tr></thead>";
                    $result .= "<tbody>";
                    while($row = $rs->fetch_assoc()) {
                        $result .= "<tr>";
                        $result .= "<td>".$row['first']." ".$row['last']."</td>";
                        $result .= "<td>".$row['sex']."</td>";
                        $result .= "<td>".$row['dob']."</td>";
                        if ($row['dod']==""){
                            $result .= "<td>Still Alive</td>";
                        } else {
                            $result .= "<td>".$row['dod']."</td>";
                        }
                        $result .= "</tr>";
                    }
                    $result .= "</tbody></table><br/><br/>";
                    echo $result;
                }

                ?>
                <!--//          <table class='table table-bordered table-condensed table-hover'>-->
                <!--//             <thead>-->
                <!--//                 <tr><td>Name</td><td>Sex</td><td>Date of Birth</td><td>Date of Death</td></thead></tr>-->
                <!--//             <tbody><tr><td>Julia Roberts</td><td>Female</td><td>1967-10-28</td><td>Still Alive</td></tr></tbody>-->
                <!--//             </table></div><hr>-->
                <h4><b>Actors Movies and Role:</b></h4>
                <div class='table-responsive'>
                    <table class='table table-bordered table-condensed table-hover'>
                        <thead><tr><td>Role</td><td>Movie Title</td></thead></tr>
                        <tbody>
                        <?php
                        if ($id) {
                            $query = "SELECT * FROM MovieActor, Movie WHERE MovieActor.mid=Movie.id AND MovieActor.aid=" . $id;

                            if (!($rs = $db->query($query))) {
                                $errmsg = $db->error;
                                echo "Query failed: $errmsg <br/>";
                                $db->close();
                                exit(1);
                            }
                            $result = "";
                            while ($row = $rs->fetch_assoc()) {
                                $result .= "<tr>";
                                //                            $result .= "<td>".$row['first']." ".$row['last']."</td>";
                                $result .= "<td>" . $row['role'] . "</td>";
                                $result .= "<td><a href=\"ShowMovie.php?id=" . $row['mid'] . "\">" . $row['title'] . "</a></td>";
                                $result .= "</tr>";
                            }
                            echo $result;
                            $db->close();
                        }
                        ?>
                        <!--                        <tr><td>"Erin Brockovich"</td><td><a href=" Show_M.php?identifier=1274 ">Erin Brockovich</a></td></tr><tr><td>"Von"</td><td><a href=" Show_M.php?identifier=1317 ">Everyone Says I Love You</a></td></tr><tr><td>"Kathleen 'Kiki' Harrison"</td><td><a href=" Show_M.php?identifier=136 ">Americas Sweethearts</a></td></tr><tr><td>"Catherine/Francesca"</td><td><a href=" Show_M.php?identifier=1565 ">Full Frontal</a></td></tr><tr><td>"Mary Reilly"</td><td><a href=" Show_M.php?identifier=2616 ">Mary Reilly</a></td></tr><tr><td>"Samantha Barzel"</td><td><a href=" Show_M.php?identifier=2688 ">Mexican, The</a></td></tr><tr><td>"Julianne 'Jules' Potter"</td><td><a href=" Show_M.php?identifier=2831 ">My Best Friends Wedding</a></td></tr><tr><td>"Anna Scott"</td><td><a href=" Show_M.php?identifier=2966 ">Notting Hill</a></td></tr><tr><td>"Tess Ocean"</td><td><a href=" Show_M.php?identifier=2983 ">Oceans Eleven</a></td></tr><tr><td>"Maggie Carpenter"</td><td><a href=" Show_M.php?identifier=3537 ">Runaway Bride</a></td></tr><tr><td>"Grace"</td><td><a href=" Show_M.php?identifier=3856 ">Something to Talk About</a></td></tr><tr><td>"Isabel Kelly"</td><td><a href=" Show_M.php?identifier=3963 ">Stepmom</a></td></tr><tr><td>"Alice Sutton"</td><td><a href=" Show_M.php?identifier=812 ">Conspiracy Theory</a></td></tr>-->
                        </tbody>
                    </table>
                </div>
                <hr>
                <label for="search_input">Search:</label>
                <form class="form-group" action="index.php" method ="GET" id="usrform">
                    <input type="text" id="search_input"class="form-control" placeholder="Search..." name="result"><br>
                    <input type="submit" value="Click Me!" class="btn btn-default" style="margin-bottom:10px">
                </form>
            </div>
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
