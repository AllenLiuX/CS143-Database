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
                <h2><b> Movie Information Page</b></h2>
                <?php
                $id = $_GET["id"];
                if ($id) {
                    ?>
                    <hr>
                    <h4><b> Movie Information is:</b></h4>
                    <?php
                    $db = new mysqli('localhost', 'cs143', '', 'cs143');
                    if ($db->connect_errno > 0) {
                        die('Unable to connect to database [' . $db->connect_error . ']');
                    }

//                    $query = "SELECT * FROM Movie, MovieGenre, MovieDirector, Director WHERE Movie.id=".$id." AND Movie.id=MovieGenre.mid AND Movie.id=MovieDirector.mid AND Director.id=MovieDirector.did";
                    $query = "SELECT * FROM Movie WHERE Movie.id=".$id;

                    if (!($rs = $db->query($query))) {
                        $errmsg = $db->error;
                        echo "Query failed: $errmsg <br/>";
                        $db->close();
                        exit(1);
                    }
                    $row = $rs->fetch_assoc();
                    $result = "Title: ".$row["title"]."(".$row["year"].")<br>";
                    $result .= "Producer: ".$row["company"]."<br>";
                    $result .= "MPAA Rating: ".$row["rating"]."<br>";

                    $query = "SELECT * FROM Movie, MovieGenre WHERE Movie.id=".$id." AND Movie.id=MovieGenre.mid";
                    if (!($rs = $db->query($query))) {
                        $errmsg = $db->error;
                        echo "Query failed: $errmsg <br/>";
                        $db->close();
                        exit(1);
                    }

                    $genres = "";
                    $first = True;
                    while ($row = $rs->fetch_assoc()) {
                        if(!$first){
                            $genres .= ", ";
                        }
                        $genres .= $row['genre'];
                        $first = False;
                    }

                    $query = "SELECT * FROM Movie, MovieDirector, Director WHERE Movie.id=".$id." AND Movie.id=MovieDirector.mid AND Director.id=MovieDirector.did";
                    if (!($rs = $db->query($query))) {
                        $errmsg = $db->error;
                        echo "Query failed: $errmsg <br/>";
                        $db->close();
                        exit(1);
                    }

                    $director = "";
                    while ($row = $rs->fetch_assoc()) {
                        $director .= $row['first']." ".$row['last']."(".$row["dob"].")";
                    }

                    $result .= "Director: ".$director."<br>";
                    $result .= "Genre: ".$genres."<br>";
                    echo $result;
                    ?>
                    <!--            Title :Green Mile, The(1999)<br>Producer :Castle Rock Entertainment<br>MPAA Rating :R<br>Director :Frank Darabont(1959-01-28)<br>Genre :Drama-->

                    <h4><b> Actors in this Movie:</b></h4>
                    <div class='table-responsive'>
                        <table class='table table-bordered table-condensed table-hover'>
                            <thead><tr><td>Name</td><td>Role</td></thead></tr>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM MovieActor, Actor WHERE MovieActor.aid=Actor.id AND MovieActor.mid=" . $id;

                            if (!($rs = $db->query($query))) {
                                $errmsg = $db->error;
                                echo "Query failed: $errmsg <br/>";
                                $db->close();
                                exit(1);
                            }
                            $result = "";
                            while ($row = $rs->fetch_assoc()) {
                                $result .= "<tr>";
                                $result .= "<td><a href=\"ShowActor.php?id=".$row['aid']."\">".$row['first']." ".$row['last']."</a></td>";
                                $result .= "<td>\"" . $row['role'] . "\"</td>";
                                $result .= "</tr>";
                            }
                            echo $result;
                            ?>
                            <!--                    <tr><td><a href=" Show_A.php?identifier=12104 ">Patricia Clarkson</td><td>"Melinda Moores"</td></tr><tr><td><a href=" Show_A.php?identifier=13799 ">James Cromwell</td><td>"Warden Hal Moores"</td></tr><tr><td><a href=" Show_A.php?identifier=15503 ">Jeffrey DeMunn</td><td>"Harry Terwilliger"</td></tr><tr><td><a href=" Show_A.php?identifier=24349 ">Dabbs Greer</td><td>"Old Paul Edgecomb"</td></tr><tr><td><a href=" Show_A.php?identifier=25722 ">Tom Hanks</td><td>"Paul Edgecomb"</td></tr><tr><td><a href=" Show_A.php?identifier=26484 ">Phil Hawn</td><td>"Police Photographer"</td></tr><tr><td><a href=" Show_A.php?identifier=28959 ">Bonnie Hunt</td><td>"Jan Edgecomb"</td></tr><tr><td><a href=" Show_A.php?identifier=29111 ">Doug Hutchison</td><td>"Percy Wetmore"</td></tr><tr><td><a href=" Show_A.php?identifier=30381 ">Michael Jeter</td><td>"Eduard 'Del' Delacroix"</td></tr><tr><td><a href=" Show_A.php?identifier=35873 ">Scotty Leavenworth</td><td>"Caleb Hammersmith"</td></tr><tr><td><a href=" Show_A.php?identifier=43933 ">David Morse</td><td>"Brutus 'Brutal' Howell"</td></tr><tr><td><a href=" Show_A.php?identifier=48585 ">Barry Pepper</td><td>"Dean Stanton"</td></tr><tr><td><a href=" Show_A.php?identifier=52983 ">Sam Rockwell</td><td>"William 'Wild Bill' Wharton"</td></tr><tr><td><a href=" Show_A.php?identifier=54320 ">William Sadler</td><td>"Klaus Detterick"</td></tr><tr><td><a href=" Show_A.php?identifier=57721 ">Gary Sinise</td><td>"Burt Hammersmith"</td></tr><tr><td><a href=" Show_A.php?identifier=65335 ">Edrie Warner</td><td>"Lady in Nursing Home"</td></tr><tr><td><a href=" Show_A.php?identifier=8308 ">Brent Briscoe</td><td>"Bill Dodge"</td></tr>-->
                            </tbody>
                        </table>
                    </div><hr>
                    <h3><b>User Review :</b></h3>
                    <?php
                    $avg_str="Average score for this Movie is ";
                    $query = "SELECT AVG(rating) AS avg_score, COUNT(rating) AS count_score FROM Review WHERE Review.mid=" . $id;
                    if (!($rs = $db->query($query))) {
                        $errmsg = $db->error;
                        echo "Query failed: $errmsg <br/>";
                        $db->close();
                        exit(1);
                    }

                    $review_count = 0;
                    while ($row = $rs->fetch_assoc()) {
                        $avg_str .= $row['avg_score'];
                        $review_count .= $row['count_score'];
                    }

                    $avg_str .="/5 based on ".$review_count." people's reviews<br>";
                    $avg_str .="<a href='GiveReview.php?MovieID=".$id."'>Leave your review as well!</a><br><hr>";

                    if ($review_count!=0){
                        echo $avg_str;
                    } else{
                        echo "<a href='GiveReview.php?MovieID=".$id."'>By now, nobody ever rates this movie. Be the first one to give a review</a>";
                    }
                    ?>
                    <!--            Average score for this Movie is 1.8250/5 based on 40 people's reviews<br>-->
                    <br><br>
                    <button type="button" onclick="{location.href='<?php
                    $review_url = "GiveReview.php?MovieID=".$id;
                    echo $review_url;
                    ?>'}">Add Review</button>
                    <h4><b> Comment detials shown below :</b></h4>
                    <?php
                    $query = "SELECT * FROM Review WHERE Review.mid=" . $id;
                    if (!($rs = $db->query($query))) {
                        $errmsg = $db->error;
                        echo "Query failed: $errmsg <br/>";
                        $db->close();
                        exit(1);
                    }

                    $review_str = "";
                    $review_exist = False;
                    while ($row = $rs->fetch_assoc()) {
                        $review_exist = True;
                        $review_str .= "<p><font color='red'><b>".$row['name']."</b></font>";
                        $review_str .= " rates the this movie with score ";
                        $review_str .= $row['rating'];
                        $review_str .= " and left a review at ";
                        $review_str .= $row['time'];
                        $review_str .= "<br>Comments:<br>";
                        $review_str .= $row['comment'];
                        $review_str .= "<br><br></p>";
                    }
                    echo $review_str;
                    $db->close();
                    ?>
                    <!--            <p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2019-11-19 23:49:34 <br>comment:<br><br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>5</b></font> and left a review at 2019-11-22 20:23:13 <br>comment:<br>Best movie ever!<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2019-11-24 12:47:44 <br>comment:<br>This movie sucks!<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-18 23:18:37 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-18 23:22:35 <br>comment:<br>                  dsaada<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-18 23:22:38 <br>comment:<br>                  dadadsa<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-18 23:22:40 <br>comment:<br>                  dadadas<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>3</b></font> and left a review at 2021-01-22 19:59:19 <br>comment:<br>              poggers-->
                    <!--                <br></p><p><font color="red"><b>Mr. Anonymous;</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-22 20:32:53 <br>comment:<br>                 test <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-23 16:27:20 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>3</b></font> and left a review at 2021-01-24 11:31:04 <br>comment:<br>              poggers-->
                    <!--                <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-24 22:08:34 <br>comment:<br>                  baa<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>3</b></font> and left a review at 2021-01-25 13:49:48 <br>comment:<br>                  <br></p><p><font color="red"><b>Your Mom</b></font> rates the this movie with score <font color="blue"><b>5</b></font> and left a review at 2021-01-26 12:43:33 <br>comment:<br>              Poggers<br></p><p><font color="red"><b></b></font> rates the this movie with score <font color="blue"><b>2</b></font> and left a review at 2021-01-26 13:16:14 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>4</b></font> and left a review at 2021-01-26 17:05:49 <br>comment:<br>                  <br></p><p><font color="red"><b>Jungkook</b></font> rates the this movie with score <font color="blue"><b>4</b></font> and left a review at 2021-01-26 20:41:49 <br>comment:<br>                  BOOOO<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-26 21:25:27 <br>comment:<br>JP<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-27 14:55:00 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-27 15:07:00 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>5</b></font> and left a review at 2021-01-27 18:00:45 <br>comment:<br>                  Thanks, T. Hanks!<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 00:41:32 <br>comment:<br>                  asdf<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 00:41:53 <br>comment:<br>                  hello this is a test<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 00:42:07 <br>comment:<br>hi                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 14:43:12 <br>comment:<br>                  hhjjkjkk<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 14:43:20 <br>comment:<br>                  k<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 15:30:56 <br>comment:<br>                  asdasd<br></p><p><font color="red"><b></b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 15:40:55 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 17:45:04 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 17:57:04 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 18:26:31 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 18:28:30 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 18:54:20 <br>comment:<br>sss<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 19:15:20 <br>comment:<br>d                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-29 23:18:48 <br>comment:<br>hi i love tom                  <br></p><p><font color="red"><b>hi</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-30 05:11:51 <br>comment:<br>asdf<br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-30 14:19:48 <br>comment:<br>                  <br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>5</b></font> and left a review at 2021-01-30 15:43:34 <br>comment:<br><br></p><p><font color="red"><b>Mr. Anonymous</b></font> rates the this movie with score <font color="blue"><b>1</b></font> and left a review at 2021-01-30 16:22:15 <br>comment:<br>                  fdjlsljf<br></p><p><font color="red"><b>:)</b></font> rates the this movie with score <font color="blue"><b>5</b></font> and left a review at 2021-01-31 01:59:35 <br>comment:<br>Movie good.<br></p>-->
                    <?php
                }
                ?>
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


