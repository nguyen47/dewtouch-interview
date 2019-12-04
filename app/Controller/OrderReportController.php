<?php
class OrderReportController extends AppController
{
  public function index()
  {
    $this->setFlash('Multidimensional Array.');

    $this->loadModel('Order');
    $orders = $this->Order->find('all', array(
      'conditions' => array('Order.valid' => 1),
      'recursive' => 2
    ));
    // debug($orders);exit;

    $this->loadModel('Portion');
    $portions = $this->Portion->find('all', array(
      'conditions' => array('Portion.valid' => 1),
      'recursive' => 2
    ));
    // debug($portions);exit;

    // To Do - write your own array in this format
    $order_reports = array();
    foreach ($orders as $order) {
      $orderName = $order['Order']['name'];
      $order_reports[$orderName] = array();
      foreach ($order['OrderDetail'] as $orderDetail) {
        foreach ($portions as $portion) {
          if ($orderDetail['Item']['name'] == $portion['Item']['name']) {
            foreach ($portion['PortionDetail'] as $portionDetail) {
              $ingredientName = $portionDetail['Part']['name'];
              if (
                array_key_exists($ingredientName, $order_reports[$orderName])
              ) {
                $addValue = $portionDetail['value'] * $orderDetail['quantity'];
                $order_reports[$orderName][$ingredientName] += $addValue;
              } else {
                $inputValue =
                  $portionDetail['value'] * $orderDetail['quantity'];
                $order_reports[$orderName][$ingredientName] = $inputValue;
              }
            }
          }
        }
      }
    }

    // ...

    $this->set('order_reports', $order_reports);

    $this->set('title', __('Orders Report'));
  }

  public function Question()
  {
    $this->setFlash('Multidimensional Array.');

    $this->loadModel('Order');
    $orders = $this->Order->find('all', array(
      'conditions' => array('Order.valid' => 1),
      'recursive' => 2
    ));

    // debug($orders);exit;

    $this->set('orders', $orders);

    $this->loadModel('Portion');
    $portions = $this->Portion->find('all', array(
      'conditions' => array('Portion.valid' => 1),
      'recursive' => 2
    ));

    // debug($portions);exit;

    $this->set('portions', $portions);

    $this->set('title', __('Question - Orders Report'));
  }
}
