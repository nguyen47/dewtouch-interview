<?php

class FileUpload extends AppModel
{
  public $validate = [
    'file' => [
      'upload-file' => [
        'rule' => ['uploadError'],
        'message' => 'Error uploading file'
      ],
      'mimetype' => [
        'rule' => ['mimeType', ['text/csv', 'text/plain']],
        'message' => 'MIME type error'
      ]
    ]
  ];
}
