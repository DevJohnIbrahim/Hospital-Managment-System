<?php
// Decorative Design Pattern
abstract class Salary {
  public $Desc;
  public $WorkingHours;
  public $Salary;
  public $tax;
  public $incentives;

  public function getDescription(){
        return $Desc;
  }
	public abstract function calculateSalary();
}

abstract class SalaryDecorator extends Salary {
  public abstract function Description();
}

class PartTime extends Salary {

  public function __construct() {
          $this->Desc="PartTime employee salary";
          $this->WorkingHours=18;
          $this->Salary=5000;
          $this->tax=10;
          $this->incentives=25;
  }
  public function calculateSalary() {
			return (  $this->Salary)-(  $this->Salary*  $this->tax/100)+(  $this->Salary*  $this->incentives/100);
	}
  public function getTax() {
    return   $this->tax;
  }
  public function getIncentives() {
    return   $this->incentives;
  }
  public function getWorkinghours() {
		return   $this->WorkingHours;
	}
}
class FullTime extends Salary {

  public function __construct() {
      $this->Desc="FullTime employee salary";
      $this->WorkingHours=36;
      $this->Salary=10000;
      $this->tax=10;
      $this->incentives=35;
  }
	public function calculateSalary() {
			return (  $this->Salary)-(  $this->Salary*  $this->tax/100)+(  $this->Salary*  $this->incentives/100);
	}
  public function getTax() {
    return   $this->tax;
  }
  public function getIncentives() {
    return   $this->incentives;
  }
  public function getWorkinghours() {
		return   $this->WorkingHours;
	}
}

class bonusAddition extends SalaryDecorator {
	public $employee;

  public function __construct(Salary $employee) {
      $this->employee = $employee;
  }
	public function Description() {
		return "A bonus has been added to ".$this->getDescription();
	}
	public function calculateSalary() {
		return 1000 + $this->employee->calculateSalary();
	}
}

class bonusDeduction extends SalaryDecorator {
  public $employee;

  public function __construct(Salary $employee) {
      $this->employee = $employee;
  }
  public function Description() {
  	return "A bonus has been added to ".$this->getDescription();
  }
  public function calculateSalary() {
    return $this->employee->calculateSalary()-500;
  }
}


 ?>
