<?php

//include DB config
include('config.php');

//Communication between php with session
session_start();

//PHP charset UTF-8
header('Content-Type: text/html; charset=utf-8');

//MYSQL Charset UTF-8
mysqli_set_charset('utf8', $conn);

//Get variables previously saved in session
$name = $_SESSION["hero"];
$topic = $_SESSION["topic"];
$count_quests = $_SESSION["quests"];
$quest_no = $_SESSION["active_quest"];
$quest_text = $_SESSION["active_quest_text"];
$choices_array = $_SESSION["active_quest_choices"];
$quest_array = $_SESSION["quest_array"];

//Get hero name & topic
//escape special symbols for security (SQL injection)
$name = mysqli_real_escape_string($conn, $_POST['hero_name']);
$topic = mysqli_real_escape_string($conn, $_POST['hero_topic']);

//Get Quests for current topic
$quest_array = array();
$count_quests = 0;
$sql = "SELECT question FROM quests WHERE topic = '$topic'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $count_quests++;
        array_push($quest_array,$row['question']);
    }
}

//Get Choices for current topic
$choices_array = array();
$sql = "SELECT choices FROM quests WHERE topic = '$topic'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       $choices_row = explode(",",$row['choices']);
       array_push($choices_array,$choices_row);
    }
}

//Choices for current question
$choices = $choices_array[0];

//Check if its a new hero or same with different topic
$sql = "SELECT * FROM heroes WHERE name = '$name' AND test='$topic'";
$result = $conn->query($sql);

if($result->num_rows > 0) {
  
$notnew = 'existing';
  
//OLD HERO - Get hero questing progress
//Check current points

$sql = "SELECT points FROM heroes WHERE name = '$name' AND test='$topic'";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$points = $row[0];  
  
$sql = "SELECT quest FROM heroes WHERE name='$name' AND test='$topic'";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$quest_no = $row[0];
  
//Already known hero - SET Active Quest
$quest_text = $quest_array[$quest_no-1];
  
//Already known hero - SET choices for current question
$choices = $choices_array[$quest_no-1];
} 

else {
//NEW HERO - set stats to default
$quest_no = '1';
$quest_text = $quest_array[$quest_no-1];
  
$sql = "INSERT INTO heroes (name, test, quest, points)
VALUES ('$name', '$topic', '1', '0')";
$_SESSION["finished"] = '';
$result = $conn->query($sql);
}

//Store variables in session for later use
$_SESSION["hero"] = $name;
$_SESSION["topic"] = $topic;
$_SESSION["quests"] = $count_quests;
$_SESSION["quest_array"] = $quest_array;
$_SESSION["active_quest"] = $quest_no;
$_SESSION["active_quest_text"] = $quest_text;
$_SESSION["active_quest_choices"] = $choices_array;


//Ajax Response for FRONTEND
echo json_encode(array($name,$topic,$count_quests,$quest_no,$quest_text,$choices,$points,$notnew));
$conn->close();

?>
