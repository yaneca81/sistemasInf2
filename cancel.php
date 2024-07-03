<?php
include 'db.php';

$id = $_GET['id'];
$event_id = $_GET['event_id'];
$sql = "DELETE FROM registrations WHERE id = $id";
$conn->query($sql);

header("Location: attendees.php?event_id=$event_id");
?>
