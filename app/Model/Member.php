<?php
class Member extends AppModel
{
  public $hasMany = array(
    'Transaction' => array(
      'conditions' => array('Transaction.valid' => 1)
    )
  );
  public function resetAutoIncrement()
  {
    $this->query("ALTER TABLE members AUTO_INCREMENT = 1;");
  }
}
