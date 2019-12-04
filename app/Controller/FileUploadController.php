<?php

class FileUploadController extends AppController
{
  public function index()
  {
    $this->set('title', __('File Upload Answer'));

    if (!empty($this->request->data)) {
      $this->FileUpload->set($this->request->data);
      if ($this->FileUpload->validates(['fieldList' => ['file']])) {
        $dir = './csv/';
        $fileName =
          time() . "_" . $this->request->data['FileUpload']['file']['name'];
        $path = $dir . $fileName;
        if (
          move_uploaded_file(
            $this->request->data['FileUpload']['file']['tmp_name'],
            $path
          )
        ) {
          if (
            $this->FileUpload->save(
              ['name' => $fileName, 'email' => 'test@test.com'],
              ['validate' => false]
            )
          ) {
            $this->Session->setFlash(
              'Updated Successfully',
              'default',
              array('class' => 'alert alert-success'),
              'result'
            );
          } else {
            $this->Session->setFlash(
              'DB save error',
              'default',
              array('class' => 'alert alert-danger'),
              'result'
            );
          }
        } else {
          $this->Session->setFlash(
            'File moving error',
            'default',
            array('class' => 'alert alert-danger'),
            'result'
          );
        }
      } else {
        $this->Session->setFlash(
          'Validation error',
          'default',
          array('class' => 'alert alert-danger'),
          'result'
        );
      }
    }
    $file_uploads = $this->FileUpload->find('all');
    $this->set(compact('file_uploads'));
  }
}
