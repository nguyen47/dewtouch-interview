<?php
class Record extends AppModel
{
  public $hasMany = array('RecordItem');

  public function getRecords($offset)
  {
    $total = $this->find('count');
    $records = $this->find('list', array(
      'offset' => $offset,
      'limit' => 10
    ));
    $result = array(
      'iTotalRecords' => $total,
      'iTotalDisplayRecords' => $total,
      'aaData' => []
    );
    foreach ($records as $id => $name) {
      $result['aaData'][] = ['id' => $id, 'name' => $name];
    }
    return json_encode($result);
  }
}
