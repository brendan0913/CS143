<html>
<head><title>Internet Movie Database: Movie Page</title></head>
<body>
<h1>Movie Information Page</h1>
<h2>Movie information is:</h2>
<?php
    $id = $_GET['id'];
    
    $db = new mysqli('localhost', 'cs143', '', 'class_db');
    if ($db->connect_errno > 0) die('Unable to connect to database [' . $db->connect_error . ']');

    $query = "SELECT title, year, rating, company FROM Movie WHERE id = $id";
    $genre_query = "SELECT genre FROM Movie INNER JOIN MovieGenre ON mid = id WHERE id = $id";
    $rs = $db->query($query);
    $genre_rs = $db->query($genre_query);
    while ($row = $rs->fetch_assoc()) { 
        $title = $row['title']; 
        $year = $row['year'];
        $rating = $row['rating']; 
        $company = $row['company'];
    }
    $array = array();
    $genre_string = "";
    while ($row = $genre_rs->fetch_array()) {
        $genre_string .= $row[0] . "/";
    }
    if (substr($genre_string, -1) == "/"){
        $genre_string = rtrim($genre_string, "/");
    }
    print "Title: $title<br>Year: $year<br>Rating: $rating<br>Company: $company<br>Genre: $genre_string<br>"; 
    $rs->free();
?>
<h2>Actors in this Movie:</h2>
<?php
    $query = "SELECT * FROM MovieActor INNER JOIN Actor ON aid = id WHERE mid = $id";
    $rs = $db->query($query);
    while ($row = $rs->fetch_assoc()) { 
        $aid = $row['aid'];
        $first = $row['first']; 
        $last = $row['last'];
        $role = $row['role']; 
        echo <<<HTML
        <a href="./actor.php?id=$aid">$first $last</a>
        HTML;
        print " as \"$role\"<br>";
    }
    $rs->free();
?>
<h2>Reviews:</h2>
<?php
    $query = "SELECT AVG(rating) as avg FROM Review WHERE mid = $id";
    $rs = $db->query($query);
    while ($row = $rs->fetch_assoc()) { 
        $avg = $row['avg'];
        if ($avg)
        {
            print "Average score: $avg";
            echo "<br><br>";
        }
    }

    $query = "SELECT * FROM Review WHERE mid = $id";
    $rs = $db->query($query);
    while ($row = $rs->fetch_assoc()) { 
        $name = $row['name'];
        $rating = $row['rating']; 
        $comment = $row['comment'];
        $time = $row['time'];
        print "$name at $time<br>Rating: $rating<br>\"$comment\"";
        echo "<br><br>";
    }
    $rs->free();
    echo <<<HTML
        <a href="./review.php?id=$id">add Comment</a>
        HTML;
?>
</body>
</html>
