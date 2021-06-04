<?php
class Battery {
  public $ID;
  public $status;
  public $columnsList;
  public $floorRequestButtonsList;
  public $amountOfColumns;
  public $amountOfFloors;
  public $amountOfElevatorPerColumn;
  public $amountOfBasements;

  public function __construct($id, $amountOfColumns, $amountOfFloors, $amountOfElevatorPerColumn, $amountOfBasements) {
    $this->ID = $id;
    $this->status = "idle";
    $this->columnsList = [];
    $this->floorRequestButtonsList = [];
    $this->amountOfColumns = $amountOfColumns;
    $this->amountOfFloors = $amountOfFloors;
    $this->amountOfElevatorPerColumn = $amountOfElevatorPerColumn;
    $this->amountOfBasements = $amountOfBasements;
  }
  
////////////////////// CREATE COLUMN ///////////////////////  

    function createColumn($amountOfColumns, $amountOfFloors, $amountOfElevators) {
        
        for ($i = 0; $i <= $amountOfColumns - 1; $i++) {
            $column = new Column($i, $amountOfFloors, $amountOfElevators);
            array_push($this->columnsList, $column);
            $this->columnsList[0]->isBasement = true;
            if ($this->columnsList[$i]->isBasement == false) {
                $servedFloorMin = ($i - 1) * ($amountOfFloors / ($this->amountOfColumns - 1));
                $servedFloorMax = $i * ($amountOfFloors / ($this->amountOfColumns - 1));
                array_push($this->columnsList[$i]->servedFloors, 0);
                array_push($this->columnsList[$i]->servedFloors, $servedFloorMin);
                array_push($this->columnsList[$i]->servedFloors, $servedFloorMax);
            } else {
                $servedFloorMin = $i;
                $servedFloorMax = $i - $this->amountOfBasements;
                array_push($this->columnsList[$i]->servedFloors, 0);
                array_push($this->columnsList[$i]->servedFloors, $servedFloorMin);
                array_push($this->columnsList[$i]->servedFloors, $servedFloorMax);
            }
            
        }

    }

    function assignElevator($requestedFloor, $direction) {
        
        // create column
        $this->createColumn($this->amountOfColumns, $this->amountOfFloors, $this->amountOfElevatorPerColumn );
        
        // create elevator
        for ($i = 0; $i <= $this->amountOfColumns - 1; $i++) {
            $this->columnsList[$i]->createElevator($this->amountOfFloors, $this->amountOfElevatorPerColumn);
        }

        $selectedColumnNumber = $this->findBestColumn($requestedFloor, $this->columnsList);
        echo "\nColone ${selectedColumnNumber} is selected";
        $selectedColumn = $this->columnsList[$selectedColumnNumber];

        // Set floor on scenario

        $this->columnsList[1]->elevatorsList[0]->currentFloor = 20;
        $this->columnsList[1]->elevatorsList[1]->currentFloor = 3;
        $this->columnsList[1]->elevatorsList[2]->currentFloor = 13;
        $this->columnsList[1]->elevatorsList[3]->currentFloor = 15;
        $this->columnsList[1]->elevatorsList[4]->currentFloor = 6;

        

        // find best elevator

        for ($i = 0; $i <= $this->amountOfElevatorPerColumn; $i++) {
            if ($selectedColumn->elevatorsList[$i]->currentFloor == $requestedFloor) {
                array_push($selectedColumn->elevatorsList[$i]->floorRequestList, $requestedFloor);
                $selectedColumn->status = "busy";
                break;
            }
        }
        if ($selectedColumn->status == "online") {
            for ($i = 0; $i <= $this->amountOfElevatorPerColumn; $i++) {
                if ($selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor >= -1 && $selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor <= 1) {
                    array_push($selectedColumn->elevatorsList[$i]->floorRequestList, $requestedFloor);
                    $selectedColumn->status = "busy";
                    break;
                }
            }
        }
        if ($selectedColumn->status == "online") {
            for ($i = 0; $i <= $this->amountOfElevatorPerColumn; $i++) {
                if ($selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor >= -2 && $selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor <= 2) {
                    array_push($selectedColumn->elevatorsList[$i]->floorRequestList, $requestedFloor);
                    $selectedColumn->status = "busy";
                    break;
                }
            }
        }
        if ($selectedColumn->status == "online") {
            for ($i = 0; $i <= $this->amountOfElevatorPerColumn; $i++) {
                if ($selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor >= -3 && $selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor <= 3) {
                    array_push($selectedColumn->elevatorsList[$i]->floorRequestList, $requestedFloor);
                    $selectedColumn->status = "busy";
                    break;
                }
            }
        }
        if ($selectedColumn->status == "online") {
            for ($i = 0; $i <= $this->amountOfElevatorPerColumn; $i++) {
                if ($selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor >= -4 && $selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor <= 4) {
                    array_push($selectedColumn->elevatorsList[$i]->floorRequestList, $requestedFloor);
                    $selectedColumn->status = "busy";
                    break;
                }
            }
        }
        if ($selectedColumn->status == "online") {
            for ($i = 0; $i <= $this->amountOfElevatorPerColumn; $i++) {
                if ($selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor >= -5 && $selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor <= 5) {
                    array_push($selectedColumn->elevatorsList[$i]->floorRequestList, $requestedFloor);
                    $selectedColumn->status = "busy";
                    break;
                }
            }
        }
        if ($selectedColumn->status == "online") {
            for ($i = 0; $i <= $this->amountOfElevatorPerColumn; $i++) {
                if ($selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor >= -10 && $selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor <= 10) {
                    array_push($selectedColumn->elevatorsList[$i]->floorRequestList, $requestedFloor);
                    $selectedColumn->status = "busy";
                    break;
                }
            }
        }
        if ($selectedColumn->status == "online") {
            for ($i = 0; $i <= $this->amountOfElevatorPerColumn; $i++) {
                if ($selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor >= -20 && $selectedColumn->elevatorsList[$i]->currentFloor - $requestedFloor <= 20) {
                    array_push($selectedColumn->elevatorsList[$i]->floorRequestList, $requestedFloor);
                    $selectedColumn->status = "busy";
                    break;
                }
            }
        }
   



        // mouvement

        for ($i = 0; $i <= $this->amountOfElevatorPerColumn - 1; $i++) {
            if (count($selectedColumn->elevatorsList[$i]->floorRequestList) > 0) {
                    $selectedColumn->elevatorsList[$i]->door->status = "closed";
                    $selectedColumn->elevatorsList[$i]->status = "moving";
                    if ($selectedColumn->elevatorsList[$i]->currentFloor < $requestedFloor) {
                        $selectedElevator = $selectedColumn->elevatorsList[$i];
                        $selectedElevator->direction = "up";
                        echo "\nElevator ", $selectedColumn->elevatorsList[$i]->ID, " is ", $selectedColumn->elevatorsList[$i]->status, " ", $selectedColumn->elevatorsList[$i]->direction;
                        for ($i = $selectedElevator->currentFloor; $i <= $requestedFloor - 1; $i++) {
                            $selectedElevator->currentFloor = $selectedElevator->currentFloor + 1;
                            echo "\nFloor :", $selectedElevator->currentFloor;
                        }
                        //// ouverture des porte  
                        @$selectedColumn->elevatorsList[$i]->door->status = "opened";
                        echo "\nThe door is ", $selectedColumn->elevatorsList[$i]->door->status;
                    } else if ($selectedColumn->elevatorsList[$i]->currentFloor > $requestedFloor) {
                        $selectedElevator = $selectedColumn->elevatorsList[$i];
                        $selectedElevator->direction = "down";
                        echo "\nElevator ", $selectedColumn->elevatorsList[$i]->ID, " is ", $selectedColumn->elevatorsList[$i]->status, " ", $selectedColumn->elevatorsList[$i]->direction;
                        for ($i = $selectedElevator->currentFloor -1; $i >= $requestedFloor; $i--) {
                            $selectedElevator->currentFloor = $selectedElevator->currentFloor - 1;
                            echo "\nFloor :", $selectedElevator->currentFloor;
                        }
                        //// ouverture des porte  
                        @$selectedColumn->elevatorsList[$i]->door->status = "opened";
                        echo "\nThe door is ", $selectedColumn->elevatorsList[$i]->door->status;
                    } else {
                        @$selectedColumn->elevatorsList[$i]->door->status = "opened";
                        echo "\nThe door is ", $selectedColumn->elevatorsList[$i]->door->status;
                    }
                }
        }

    }

////////////////////////////// FIND BEST COLUMN //////////////////////////////

    function findBestColumn($requestedFloor, $columnsList) {
        for ($i = 0; $i <= count($columnsList) - 1; $i++) {
            if ($columnsList[$i]->servedFloors[1] <= $requestedFloor && $columnsList[$i]->servedFloors[2] >= $requestedFloor || $columnsList[$i]->servedFloors[1] >= $requestedFloor && $columnsList[$i]->servedFloors[2] <= $requestedFloor) {
                $selectedColumn = $i;
                return $selectedColumn;
            }
        }
    }


  
}

class Column {
  public $ID;
  public $status;
  public $servedFloors;
  public $isBasement;
  public $elevatorsList;
  public $callButtonsList;
  public $amountOfElevators;

  public function __construct($id, $amountOfFloors, $amountOfElevators) {
    $this->ID = $id;
    $this->status = "online";
    $this->servedFloors = [];
    $this->isBasement = false;
    $this->elevatorsList = [];
    $this->callButtonsList = [];
    $this->amountOfElevators = $amountOfElevators;
  }

////////////////////////////// Create ELEVATOR //////////////////////////////     

  function createElevator($amountOfFloors, $amountOfElevators) {
    for ($i = 0; $i <= $amountOfElevators; $i++) {
        $elevator = new Elevator($i, $amountOfFloors);
        array_push($this->elevatorsList, $elevator);
    }
  }

////////////////////////////// requestElevator //////////////////////////////    

  function requestElevator($requestedFloor, $direction) {
    for ($i = 0; $i <= $this->amountOfElevators -1; $i++) {
        if (count($this->elevatorsList[$i]->floorRequestList) > 0) {
            if ($this->elevatorsList[$i]->currentFloor < $requestedFloor) {
                @$this->elevatorsList[$i]->door->status = "closed";
                echo "\nThe door is ", $this->elevatorsList[$i]->door->status;
                $selectedElevator = $this->elevatorsList[$i];
                $selectedElevator->direction = "up";
                echo "\nElevator ", $selectedElevator->ID, " is ", $selectedElevator->status, " ", $selectedElevator->direction;
                for ($i = $selectedElevator->currentFloor; $i <= $requestedFloor -1; $i++) {
                    $selectedElevator->currentFloor = $selectedElevator->currentFloor + 1;
                    echo "\nFloor :", $selectedElevator->currentFloor;
                }
                // ouverture des portes
                @$this->elevatorsList[$i]->door->status = "open";
                echo "\nThe door is ", $this->elevatorsList[$i]->door->status;
            } else if ($this->elevatorsList[$i]->currentFloor > $requestedFloor) {
                @$this->elevatorsList[$i]->door->status = "closed";
                echo "\nThe door is ", $this->elevatorsList[$i]->door->status;
                $selectedElevator = $this->elevatorsList[$i];
                $selectedElevator->direction = "down";
                echo "\nElevator ", $selectedElevator->ID, " is ", $selectedElevator->status, " ", $selectedElevator->direction;
                for ($i = $selectedElevator->currentFloor - 1; $i >= $requestedFloor; $i--) {
                    $selectedElevator->currentFloor = $i;
                    echo "\nFloor :", $selectedElevator->currentFloor;
                }
                // ouverture des portes
                @$this->elevatorsList[$i]->door->status = "open";
                echo "\nThe door is ", $this->elevatorsList[$i]->door->status;
            }
            
        }

    }
  }

}

class Elevator {
  public $ID;
  public $status;
  public $currentFloor;
  public $direction;
  public $door;
  public $floorRequestList;

  public function __construct($id, $amountOfFloors) {
    $this->ID = $id;
    $this->status = "idle";
    $this->currentFloor = 0;
    $this->direction = "idle";
    $this->door = new Door($id); 
    $this->floorRequestList = [];
  }
}

class Door {
  public $ID;
  public $status;

  public function __construct($id) {
    $this->ID = $id;
    $this->status = "opened";
  }
}

class CallButton {
  public $ID;
  public $status;
  public $floor;
  public $direction;

  public function __construct($id, $floor, $direction) {
    $this->ID = $id;
    $this->status = "idle";
    $this->floor = $floor;
    $this->direction = $direction;
  }
}

class FloorRequestButtons {
  public $ID;
  public $status;
  public $floor;


  public function __construct($id, $floor) {
    $this->ID = $id;
    $this->status = "idle";
    $this->floor = $floor;
  }
}

$battery1 = new Battery(1, 4, 60, 5, 6);

$battery1->assignElevator(19, "up");
$battery1->columnsList[1]->requestElevator(0, "down")







?>
