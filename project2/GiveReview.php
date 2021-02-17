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
            <div class="content">
            <?php
            $MovieID = $_GET["MovieID"];
            $viewer = $_GET["viewer"];
            $score = $_GET["score"];
            $comment = $_GET["comment"];
            if ($MovieID) {
                $db = new mysqli('localhost', 'cs143', '', 'cs143');
                if ($db->connect_errno > 0) {
                    die('Unable to connect to database [' . $db->connect_error . ']');
                }
                $query = "SELECT * FROM Movie WHERE id=" . $MovieID;
                if (!($rs = $db->query($query))) {
                    $errmsg = $db->error;
                    echo "Query failed: $errmsg <br/>";
                    $db->close();
                    exit(1);
                }
                $row = $rs->fetch_assoc();
            }
            ?>
            <form method="GET" id="userform">
                <h4><b>Add new comment here : </b></h4>
                <div class="form-group">
                    <label for="ID">Movie Title:</label>
                    <select  name="MovieID" id="ID">
                        <option value="<?php echo $MovieID; ?>">
                            <?php
                            $title="".$row["title"]."(".$row["year"].")";
                            echo $title;
                            ?>
                        </option>
                    </select></div>
                <div class="form-group">
                    <label for="title">Your name</label>
                    <input type="text" name="viewer"class="form-control" value="Mr. Anonymous" id="title">
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select  class="form-control" name="score" id="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="form-froup">
                  <textarea class="form-control" name="comment" rows="5" placeholder="no more than 500 characters"></textarea><br>
                </div>
                <button type="submit" class="btn btn-default">Rating it!</button>
            </form>
            <?php
            if ($MovieID && $viewer && $score && $comment) {
                $viewer = str_replace("'", "\'", $viewer);
                $viewer = str_replace("\"", "\"", $viewer);
                $comment = str_replace("'", "\'", $comment);
                $comment = str_replace("\"", "\"", $comment);
                $currentTime = date('Y-m-d G:i:s');
                $query = "INSERT INTO Review VALUES ('".$viewer."', '".$currentTime."', ".$MovieID.", ".$score.", '".$comment."');";
                if (!($rs = $db->query($query))) {
                    $errmsg = $db->error;
                    print "Query failed: $errmsg <br/>";
                    $db->close();
                    exit(1);
                }
                $db->close();
                echo "Successfully Added Review.<hr>";
                echo "Thanks for your comment!";
                echo "<a href='ShowMovie.php?id=".$MovieID."'>click this to go back to see the movie</a>";
            }
            ?>
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