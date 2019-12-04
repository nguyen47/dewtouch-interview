<?php
class TransactionItem extends AppModel
{
  public $belongsTo = array('Transaction');
  public function resetAutoIncrement()
  {
    $this->query("ALTER TABLE transaction_items AUTO_INCREMENT = 1;");
  }
}
