<?php
// PHP code to fetch the latest sensor data for the selected device
include('db.php');

$device_id = $_GET['device_id'];

$sql_devices = "SELECT id, name FROM devices";
$result_devices = fetch($sql_devices, $connection, true);

$sql_sensor1 = "SELECT timestamp, value FROM sensor WHERE device_id = $device_id AND sensor_type = 'Humidity' ORDER BY timestamp";
$sql_sensor2 = "SELECT timestamp, value FROM sensor WHERE device_id = $device_id AND sensor_type = 'Ph' ORDER BY timestamp";

$result_sensor1 = fetch($sql_sensor1, $connection, true);
$result_sensor2 = fetch($sql_sensor2, $connection, true);


$data = array();

foreach ($result_devices as $row_device) {
  $device_id = $row_device["id"];
  $device_name = $row_device["name"];

  // Get the latest sensor data for Sensor1 for this device
  $sql_sensor1_latest = "SELECT value FROM sensor WHERE device_id = $device_id AND sensor_type = 'Humidity' ORDER BY timestamp";
  $sensor1_latest = fetch($sql_sensor1_latest, $connection, true);

  foreach ($sensor1_latest as $row_sensor1_latest) {
    $data[$device_id]["latest_sensor1_value"] = $row_sensor1_latest["value"];
  }

  // Get the latest sensor data for Sensor2 for this device
  $sql_sensor2_latest = "SELECT value FROM sensor WHERE device_id = $device_id AND sensor_type = 'Ph' ORDER BY timestamp";
  $sensor2_latest = fetch($sql_sensor2_latest, $connection, true);

  foreach ($sensor2_latest as $row_sensor2_latest) {
    $data[$device_id]["latest_sensor2_value"] = $row_sensor2_latest["value"];
  }

  $data[$device_id]["device_name"] = $device_name;
}



foreach ($result_sensor1 as $row1) {
  $data["sensor1"][] = array($row1["value"], $row1["timestamp"]);
}

foreach ($result_sensor2 as $row2) {
  $data["sensor2"][] = array($row2["value"], $row2["timestamp"]);
}

echo json_encode($data);
