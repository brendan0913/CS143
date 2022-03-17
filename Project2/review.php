<html>
<head><title>Internet Movie Database: Review Page</title></head>
<body>
<h1>Add your new review here</h1>
<form method="POST">
    <input type ="hidden" name="clicked" value="no" />
    <input type="text" name="name" placeholder="Enter your name"/><br>
    <select name="rating" id="rating">
    <option value=1>1</option>
    <option value=2>2</option>
    <option value=3>3</option>
    <option value=4>4</option>
    <option value=5>5</option>
    </select><br>
    <input type="text" name="comment" placeholder="Enter your comment"/><br>
    <input type ="hidden" name="clicked" value="yes"/>
    <input type="submit"/>
</form>
<?php
    $id = $_GET['id'];
    
    $mid = $_GET['mid'];
    $name = $_GET['name'];
    $rating = $_GET['rating'];
    $comment = $_GET['comment'];
    if ($id && $_POST["name"] && $_POST["rating"] && $_POST["comment"] && ($_POST["clicked"]=="yes"))
    {
        $name = $_POST["name"];
        $rating = $_POST["rating"];
        $comment = $_POST["comment"];

        $db = new mysqli('localhost', 'cs143', '', 'class_db');
        if ($db->connect_errno > 0) die('Unable to connect to database [' . $db->connect_error . ']');

        $query = "INSERT INTO Review VALUES ('$name', NOW(), $id, $rating, '$comment')";
        if ($db->query($query) === TRUE)
            echo "New review created successfully";
        else
            echo "Error: " . $query . "<br>" . $db->error;
          
        $db->close();
    }
    else if ($mid && $name && $rating && $comment)
    {
        $db = new mysqli('localhost', 'cs143', '', 'class_db');
        if ($db->connect_errno > 0) die('Unable to connect to database [' . $db->connect_error . ']');

        $query = "INSERT INTO Review VALUES ('$name', NOW(), $mid, $rating, '$comment')";
        if ($db->query($query) === TRUE)
            echo "New review (via URL) created successfully";
        else
            echo "Error: " . $query . "<br>" . $db->error;
          
        $db->close();
    }
    else if (!$id)
    {
        echo "No ID input";
    }
?>
</body>
</html>
