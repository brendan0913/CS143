<html>
<head><title>Internet Movie Database: Actor Page</title></head>
<body>
<h1>Actor Information Page</h1>
<h2>Actor information is:</h2>
<?php
    $id = $_GET['id'];
    
    $db = new mysqli('localhost', 'cs143', '', 'class_db');
    if ($db->connect_errno > 0) die('Unable to connect to database [' . $db->connect_error . ']');

    $query = "SELECT * FROM Actor WHERE id = $id";
    $rs = $db->query($query);
    while ($row = $rs->fetch_assoc()) { 
        $first = $row['first']; 
        $last = $row['last'];
        $sex = $row['sex']; 
        $dob = $row['dob']; 
        $dod = $row['dod'] ?? 'Still Alive';
        print "Name: $first $last<br>Sex: $sex<br>Date of Birth: $dob<br>Date of Death: $dod<br>"; 
    }
    $rs->free();
?>
<h2>Actor's Movies and Roles:</h2>
<?php
    $query = "SELECT * FROM MovieActor INNER JOIN Movie ON mid = id WHERE aid = $id";
    $rs = $db->query($query);
    while ($row = $rs->fetch_assoc()) { 
        $role = $row['role']; 
        $title = $row['title'];
        $mid = $row['mid'];
        print "\"$role\" in ";
        echo <<<HTML
        <a href="./movie.php?id=$mid">$title</a><br>
        HTML;
    }
    $rs->free();
?>
</body>
</html>
