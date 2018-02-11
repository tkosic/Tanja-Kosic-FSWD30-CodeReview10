<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
exit;
}

// select logged-in users detail
$res=mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Welcome to Big Library</title>
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>
<style>
.navbar {
  background: #1a1a1a;
}

.nav-tabs {
  margin: 0 auto;
  border-bottom: none;
}

.nav-tabs .nav-link {
  border: 0 solid transparent;
}

.nav-tabs .nav-link {
  color: white;
  text-align: center;
  font-size: 18px;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
  color: white;
  background-color: #1a1a1a;
  border-color: #1a1a1a;
}

.btn {
  background: white;
}

#logo {
  font-size: 30px;
}

#sign {
  color: white;
}

a {
  color: black;
  text-decoration: none;
}

a:hover {
  color: red;
  text-decoration: none;
}

nav p {
  margin: 0 10px;
}

.jumbotron {
  background: linear-gradient(rgba(26, 26, 26, 0.3),rgba(26, 26, 26, 0.3)),url("img/home.jpg");
  background-size: cover;
  height: 400px;
}

body {
  background: #f2f2f2;
}

.card {
  height: 700px;
  margin: 35px 20px 20px 20px ;
  text-align: center;
}

.card-text {
  max-height: 120px;
}

.card img {
  height: 280px;
}

.footer h4 {
  color:  white;
  background-color: #1a1a1a;
  margin-bottom: 0;
  padding: 30px 0;
}
</style>
<body>
<!-- Start of Navigation Section -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <div><a class="navbar-brand" href="home.php" id="logo">Big Library</a></div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link" id="home-tab" data-toggle="tab" href="#all">ALL</a></li>
            <li class="nav-item"><a class="nav-link" id="contact-tab" data-toggle="tab" href="#book">BOOK</a></li>
            <li class="nav-item"><a class="nav-link" id="contact-tab" data-toggle="tab" href="#dvd">DVD</a></li>
            <li class="nav-item"><a class="nav-link" id="contact-tab" data-toggle="tab" href="#cd">CD</a></li>
        </ul>
        <p><a class="navbar-brand" id="sign">Signed in as<br><?php echo $userRow['first_name']." ".$userRow['last_name']; ?> <i class="far fa-user"></i></a></p>
        <button class="btn btn-default"><a href="logout.php?logout">Sing Out</a></button>
    </div>
</nav>
<!-- End of Navigation Section -->

<!-- Start of Jumbotron Section -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
      
    </div>
</div>
<!-- End of Jumbotron Section -->


<!-- Start of the Big Library Section-->
<div class="tab-content">
  <div class="tab-pane fade show active" id="all">
    <?php

    $sql_all = "SELECT img, title, type, description, ISBN, name, media_list
                FROM media
                INNER JOIN author ON media.fk_author_id = author.author_id";
    $result_all = $conn->query($sql_all);

    if ($result_all->num_rows > 0) {
      echo '
      <main role="main" class="main">
        <div class="album py-5 ">
          <div class="container">
            <div class="row">
              ';

        while($row1 = $result_all->fetch_assoc()) {
          echo '
       
              <div class="col-md-4">
                <div class="card">
                <img class="card-img-top" src='. $row1["img"] . ' alt="Media Image">
                  <div class="card-body">
                    <h4 class="card-title">' . $row1["title"] . '</h4>
                    <p class="card-text">' . $row1["description"] . '</p>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">' . $row1["type"] . '</li>
                    <li class="list-group-item">' . $row1["name"] . '</li>
                    <li class="list-group-item">' . $row1["media_list"] . '</li>   
                  </ul>
                  </div>
              </div>
                ';
        }
           echo "
            </div>
          </div>
        </div>
      </main>";
      } else {
        echo "0 results";
    }
    ?>
</div>
<!-- End of Big Library Section -->

<!-- Start of Book Section -->
<div class="tab-pane fade" id="book">
    <?php
      $sql_books = "SELECT img, title, description, ISBN, name, media_list
                    FROM media
                    INNER JOIN author ON media.fk_author_id = author.author_id
                    WHERE type = 'Book'";
      $result_books = $conn->query($sql_books);

        if ($result_books->num_rows > 0) {
        echo '
          <main role="main" class="main">
            <div class="album py-5 ">
              <div class="container">
                <div class="row">
                      ';

        while($row2 = $result_books->fetch_assoc()) {
              echo '
                  <div class="col-md-4">
                    <div class="card">
                    <img class="card-img-top" src=' . $row2["img"] . ' alt="Media Image">
                      <div class="card-body">
                        <h4 class="card-title">' . $row2["title"] . '</h4>
                        <p class="card-text">' . $row2["description"] . '</p>
                      </div>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">ISBN: ' . $row2["ISBN"] . '</li>
                        <li class="list-group-item">' . $row2["name"] . '</li>
                        <li class="list-group-item">' . $row2["media_list"] . '</li>
                      </ul>
                    </div>
                  </div>
                  ';
                }
          echo '
                </div>
              </div>
            </div>
          </main>';
        } else {
          echo "0 results";
      }
    ?>
</div>
<!-- End of Books Section -->

<!-- Start of DVD Section -->
<div class="tab-pane fade" id="dvd">
    <?php
      $sql_dvds = "SELECT img, title, description, ISBN, name, media_list
                    FROM media
                    INNER JOIN author ON media.fk_author_id = author.author_id
                    WHERE type = 'DVD'";
      $result_dvds = $conn->query($sql_dvds);

        if ($result_dvds->num_rows > 0) {
        echo '
          <main role="main" class="main">
            <div class="album py-5">
              <div class="container">
                <div class="row">
              ';
        while($row3 = $result_dvds->fetch_assoc()) {
              echo '
                  <div class="col-md-4">
                    <div class="card">
                    <img class="card-img-top" src=' . $row3["img"] . ' alt="Media Image">
                      <div class="card-body">
                        <h4 class="card-title">' . $row3["title"] . '</h4>
                        <p class="card-text">' . $row3["description"] . '</p>
                      </div>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">Length: ' . $row3["ISBN"] . ' min</li>
                        <li class="list-group-item">' . $row3["name"] . '</li>
                      </ul>
                    </div>
                  </div>
                  ';
                }
                echo '
                </div>
              </div>
            </div>
          </main>';
        } else {
          echo "0 results";
      }
    ?>
</div>
<!-- End of DVD Section -->

<!-- Start of CD Section -->
<div class="tab-pane fade" id="cd">
    <?php
      $sql_cds = "SELECT img, title, description, ISBN, name, media_list
                    FROM media
                    INNER JOIN author ON media.fk_author_id = author.author_id
                    WHERE type = 'CD'";
      $result_cds = $conn->query($sql_cds);

        if ($result_cds->num_rows > 0) {
        echo '
          <main role="main" class="main">
            <div class="album py-5 ">
              <div class="container">
                <div class="row">
        ';
        while($row4 = $result_cds->fetch_assoc()) {
              echo '
                  <div class="col-md-4">
                    <div class="card">
                    <img class="card-img-top" src=' . $row4["img"] . ' alt="Media Image">
                      <div class="card-body">
                        <h4 class="card-title">' . $row4["title"] . '</h4>
                        <p class="card-text">' . $row4["description"] . '</p>
                      </div>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">Length: ' . $row4["ISBN"] . ' min</li>
                        <li class="list-group-item">' . $row4["name"] . '</li>
                      </ul>
                    </div>
                  </div>
                  ';
                }
                echo '
                </div>
              </div>
            </div>
          </main>';
        } else {
          echo "0 results";
      }
    ?>
</div>
<!-- End of CD Section -->

<!-- Start of Footer Section -->
<div class="footer">
    <h4 class="text-center">Kosic Tanja CoderReview 10</h4>
</div>
<!-- End of Footer Section -->


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php ob_end_flush(); ?>