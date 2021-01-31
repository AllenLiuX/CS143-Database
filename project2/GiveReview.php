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
    <link href="css/project1c.css" rel="stylesheet">
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header navbar-defalt">
          <a class="navbar-brand" href="index.php">CS143 DataBase Query System (Demo)</a>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row">
         <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <form method="GET" id="userform">
 <h4><b>Add new comment here : </b></h4> <div class="form-group"><label for="ID">Movie Title:</label><select  name="MovieID" id="ID">
                        <option value="2632">Matrix, The(1999)</option></select></div>                <div class="form-group">
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
                  <textarea class="form-control" name="comment" rows="5"  placeholder="no more than 500 characters" >
                  </textarea><br> 
                </div>
                <button type="submit" class="btn btn-default">Rating it!</button>
        </form>
         </div>
      </div>
    </div>
</body>
</html>