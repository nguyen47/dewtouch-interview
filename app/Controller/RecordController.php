<?php
class RecordController extends AppController
{
  public function index()
  {
    ini_set('memory_limit', '256M');
    set_time_limit(0);

    $this->setFlash('Listing Record page is better now.');

    $this->set('title', __('List Record'));
  }

  public function getAjaxRecords()
  {
    $this->autoRender = false;
    $offset = $this->params['url']['iDisplayStart'];
    $records = $this->Record->getRecords($offset);
    return $records;
  }

  // 		public function update(){
  // 			ini_set('memory_limit','256M');

  // 			$records = array();
  // 			for($i=1; $i<= 1000; $i++){
  // 				$record = array(
  // 					'Record'=>array(
  // 						'name'=>"Record $i"
  // 					)
  // 				);

  // 				for($j=1;$j<=rand(4,8);$j++){
  // 					@$record['RecordItem'][] = array(
  // 						'name'=>"Record Item $j"
  // 					);
  // 				}

  // 				$this->Record->saveAssociated($record);
  // 			}

  // 		}
}
