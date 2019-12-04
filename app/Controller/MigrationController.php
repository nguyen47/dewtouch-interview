<?php
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
require ROOT . '/vendor/phpoffice/phpspreadsheet/src/Bootstrap.php';

class MigrationController extends AppController
{
  public function q1()
  {
    $this->setFlash('Question: Migration of data to multiple DB table');
    $this->set('title', __('Question: Migration of data to multiple DB table'));

    $this->loadModel('Member');
    $this->loadModel('Transaction');
    $this->loadModel('TransactionItem');
    if ($this->request->is('POST')) {
      if (!empty($this->request->data)) {
        if (!empty($this->request->data['MigrationFile']['file']['name'])) {
          $file = $this->request->data['MigrationFile']['file'];
          if (is_file($file['tmp_name'])) {
            // delete sample data
            $this->Member->deleteAll(['1=1']);
            $this->Member->resetAutoIncrement();
            $this->Transaction->resetAutoIncrement();
            $this->TransactionItem->resetAutoIncrement();

            $memberArray = array();
            $transactionArray = array();
            $transactionItemArray = array();

            $extension = substr(strtolower(strrchr($file['name'], '.')), 1);
            if ($extension == 'xlsx') {
              $excel = IOFactory::createReader("Xlsx");
              $excelSheet = $excel->load($file['tmp_name']);
              $sheetData = $excelSheet
                ->getActiveSheet()
                ->toArray(null, true, true, true);
              $total = count($sheetData);
              for ($i = 2; $i <= $total; $i++) {
                //create member array
                $member = explode(' ', $sheetData[$i]['D']);
                $member_type = $member[0];
                $memberNo = preg_replace('/[^0-9]/', '', $member[1]);
                $memberName = $sheetData[$i]['C'];

                $memberArray[$i]['type'] = $member_type;
                $memberArray[$i]['no'] = $memberNo;
                $memberArray[$i]['name'] = $memberName;
                $memberArray[$i]['company'] = $sheetData[$i]['F'];

                //create transaction array
                $date_array = explode('/', $sheetData[$i]['A']);

                $transactionArray[$i]['member_id'] = $i - 1;
                $transactionArray[$i]['member_name'] = $sheetData[$i]['C'];
                $transactionArray[$i]['member_paytype'] = $sheetData[$i]['E'];
                $transactionArray[$i]['member_company'] = $sheetData[$i]['F'];
                $transactionArray[$i]['date'] = date(
                  'Y-m-d',
                  strtotime($sheetData[$i]['A'])
                );
                $transactionArray[$i]['year'] = $date_array[2];
                $transactionArray[$i]['month'] = $date_array[0];
                $transactionArray[$i]['ref_no'] = $sheetData[$i]['B'];
                $transactionArray[$i]['receipt_no'] = $sheetData[$i]['I'];
                $transactionArray[$i]['payment_method'] = $sheetData[$i]['G'];
                $transactionArray[$i]['renewal_year'] = $sheetData[$i]['L'];
                $transactionArray[$i]['batch_no'] = $sheetData[$i]['H'];
                $transactionArray[$i]['cheque_no'] = $sheetData[$i]['J'];
                $transactionArray[$i]['payment_type'] = $sheetData[$i]['K'];
                $transactionArray[$i]['subtotal'] = $sheetData[$i]['M'];
                $transactionArray[$i]['tax'] = $sheetData[$i]['N'];
                $transactionArray[$i]['total'] = $sheetData[$i]['O'];

                //create transaction item array
                $transactionItemArray[$i]['transaction_id'] = $i - 1;
                $transactionItemArray[$i]['description'] =
                  "Being Payment for:" .
                  $sheetData[$i]['K'] .
                  ":" .
                  $sheetData[$i]['L'];
                $transactionItemArray[$i]['quantity'] = 1;
                $transactionItemArray[$i]['unit_price'] = $sheetData[$i]['M'];
                $transactionItemArray[$i]['sum'] =
                  $transactionItemArray[$i]['quantity'] *
                  $transactionItemArray[$i]['unit_price'];
                $transactionItemArray[$i]['table'] = "Member";
                $transactionItemArray[$i]['table_id'] = $i - 1;
              }
              if (!$this->Member->saveAll($memberArray)) {
                $this->Session->setFlash(
                  'Error insert members table',
                  'default',
                  array('class' => 'alert alert-danger'),
                  'result'
                );
              } elseif (!$this->Transaction->saveAll($transactionArray)) {
                $this->Session->setFlash(
                  'Error insert transactions table',
                  'default',
                  array('class' => 'alert alert-danger'),
                  'result'
                );
              } elseif (
                !$this->TransactionItem->saveAll($transactionItemArray)
              ) {
                $this->Session->setFlash(
                  'Error insert transaction_items table',
                  'default',
                  array('class' => 'alert alert-danger'),
                  'result'
                );
              } else {
                $this->Session->setFlash(
                  'Migrated successfully',
                  'default',
                  array('class' => 'alert alert-success'),
                  'result'
                );
              }
            } else {
              $this->Session->setFlash(
                'File is NOT xlsx file',
                'default',
                array('class' => 'alert alert-danger'),
                'result'
              );
            }
          }
        }
      }
    }
  }

  public function q1_instruction()
  {
    $this->setFlash('Question: Migration of data to multiple DB table');
  }
}
