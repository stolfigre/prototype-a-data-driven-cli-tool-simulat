<?php

// API Specification for Data-Driven CLI Tool Simulator

class DataDrivenCLIToolSimulator {
  private $commands = array();
  private $dataStore = array();

  // Register a new command
  public function registerCommand($commandName, $commandHandler) {
    $this->commands[$commandName] = $commandHandler;
  }

  // Register data store for later use
  public function registerData($dataKey, $dataValue) {
    $this->dataStore[$dataKey] = $dataValue;
  }

  // Run a command with optional arguments
  public function runCommand($commandName, $args = array()) {
    if (isset($this->commands[$commandName])) {
      $commandHandler = $this->commands[$commandName];
      return $commandHandler($args, $this->dataStore);
    } else {
      return "Command Not Found";
    }
  }

  // Get data from data store
  public function getData($dataKey) {
    if (isset($this->dataStore[$dataKey])) {
      return $this->dataStore[$dataKey];
    } else {
      return "Data Not Found";
    }
  }
}

// Example Usage:

$simulator = new DataDrivenCLIToolSimulator();

// Register a command that returns a greeting
$simulator->registerCommand("hello", function($args, $dataStore) {
  return "Hello, " . $args["name"];
});

// Register some data
$simulator->registerData("favorite_color", "blue");

// Run the command
echo $simulator->runCommand("hello", array("name" => "John")) . "\n";

// Get data from data store
echo "Favorite color: " . $simulator->getData("favorite_color") . "\n";

?>