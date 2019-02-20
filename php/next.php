<?php

//include DB config
include('config.php');

//Communication between php with session
session_start();

//Get variables previously saved in session
$name = $_SESSION["hero"];
$topic = $_SESSION["topic"];
$count_quests = $_SESSION["quests"];
$quest_no = $_SESSION["active_quest"];
$quest_text = $_SESSION["active_quest_text"];
$choices_array = $_SESSION["active_quest_choices"];
$quest_array = $_SESSION["quest_array"];

//Hero clicked choice
$choice = $_POST['choice'];

//Check current points
$sql = "SELECT points FROM heroes WHERE name = '$name' AND test='$topic'";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$points = $row[0];

//Advance question variable
$quest_no++;
$_SESSION["active_quest"] = $quest_no;
$_SESSION["active_quest_text"] = $quest_array[$quest_no-1];

//Advance if quiest count less or equal to questions
//Otherwise set mark as finished
if ($quest_no-1 <= $count_quests)
{

//Check answer
$sql = "SELECT correct FROM quests WHERE question='$quest_text'";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$answer = $row[0];

if ($choice == $answer)
{
//Increment hero points by 10
$points +=10;
$quest_text = $quest_array[$quest_no-1];
$choices = $choices_array[$quest_no-1];
 
$round = $quest_no-1;

$outcome = "Bingo!";
  
$sql = "UPDATE heroes SET points = '$points' WHERE name = '$name' AND test='$topic'";
$result = $conn->query($sql);
//Increment active quest by 1
$sql = "UPDATE heroes SET quest = '$round' WHERE name = '$name' AND test='$topic'";
$result = $conn->query($sql);

} else
{

$quest_text = $quest_array[$quest_no-1];
$choices = $choices_array[$quest_no-1];  
$outcome = "Missed It!";
  
//Increment active quest by 1
$sql = "UPDATE heroes SET quest = '$round' WHERE name = '$name' AND test='$topic'";
$result = $conn->query($sql);
}

}

echo json_encode(array($choice,$answer,$quest_no,$count_quests,$quest_text,$choices,$points));
$conn->close();

?>