<html>
<head><title>Internet Movie Database: Search Page</title></head>
<body>
<?php
    $actor = $_GET['actor'];
    $movie = $_GET['movie'];

    if ($actor)
        $_POST["actor"] = $actor;
    else if ($movie)
        $_POST["movie"] = $movie;
    else if (!$actor && !$movie){ ?>
        <h3>Actor search</h3> 
            <p>
            <form method="GET">
            <input type="text" id="actor" name="actor" placeholder="Enter actor name"/>
            <input type="submit" value="Search actor"/>
            </form>
            </p>
        <h3>Movie search</h3>
            <p>
            <form method="GET">
            <input type="text" id="movie" name="movie" placeholder="Enter movie name"/>
            <input type="submit" value="Search movie" />
            </form>
            </p>
<?php }
?>

<?php
// error_reporting(-1);
// ini_set("display_errors", "1");
// ini_set("log_errors", 1);
// ini_set("error_log", "/tmp/php-error.log");
if($_POST["actor"]){
	$rawinput = $_POST["actor"]; 	
	$newinput = preg_replace('/\s+/', ' ', $rawinput); // case-insensitive reg ex
	$words = explode(" ", $newinput); 
	
    $db = new mysqli('localhost', 'cs143', '', 'class_db');
    if ($db->connect_errno > 0) 
        die('Unable to connect to database [' . $db->connect_error . ']');

    $input = array();
    foreach ($words as $w)
        array_push($input, mysqli_real_escape_string($db, $w));
    
    $actor_q = "SELECT DISTINCT first, last, dob, id FROM Actor WHERE";

    if (sizeof($input) == 1)
        $actor_q .= " first LIKE '%$input[0]%' OR last LIKE '%$input[0]%'";
    else {
        foreach ($input as $i)
            $actor_q .= " (first LIKE '%$i%' OR last LIKE '%$i%') AND";
        $actor_q = rtrim($actor_q, "AND");
    }
    $actor_q .= " ORDER BY last";

    echo "<h3> Actors: </h3>";
    $rs = $db->query($actor_q);
    if ($rs && mysqli_num_rows($rs) > 0){
        while ($row = $rs->fetch_assoc()){
            $first = $row['first'];
            $last = $row['last'];
            $dob = $row['dob'];
            $id = $row['id'];
            echo "<a href = './actor.php?id=$id'>$first $last</a>, born <a href = './actor.php?id=$id'>$dob";
            echo "<br/>";
        }
    } 
    else 
       echo "<p><b> No actor found with \"$rawinput\"</b></p>";
    $db->close();
}
elseif($_POST["movie"]){
	$rawinput = $_POST["movie"]; 	
	$newinput = preg_replace('/\s+/', ' ', $rawinput); // case-insensitive reg ex
	$words = explode(" ", $newinput); 
	
    $db = new mysqli('localhost', 'cs143', '', 'class_db');
    if ($db->connect_errno > 0) 
        die('Unable to connect to database [' . $db->connect_error . ']');

    $input = array();
    foreach ($words as $w)
        array_push($input, mysqli_real_escape_string($db, $w));
    
    $movie_q = "SELECT DISTINCT title, id, year FROM Movie WHERE";

    if (sizeof($input) == 1)
        $movie_q .= " title LIKE '%$input[0]%'";
    else {
        foreach ($input as $i)
            $movie_q .= " title LIKE '%$i%' AND";
        $movie_q = rtrim($movie_q, "AND");
    }
    $movie_q .= " ORDER BY title";

    echo "<h3> Movies: </h3>";
    $rs = $db->query($movie_q);
    if ($rs && mysqli_num_rows($rs) > 0){
        while ($row = $rs->fetch_assoc()){
            $title = $row['title'];
            $year = $row['year'];
            $id = $row['id'];
            echo "<a href = './movie.php?id=$id'>$title</a> (<a href = './movie.php?id=$id'>$year</a>)";
            echo "<br/>";
        }
    } 
    else 
        echo "<p><b> No movie found with \"$rawinput\"</b></p>";
    $db->close();
}
?>
</body>
</html>