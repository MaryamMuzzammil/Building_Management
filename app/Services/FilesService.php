<?php

namespace App\Services;

class FilesService
{
  
    public function saveFile($content, $path = 'storage/receipts/receipt.pdf')
    {
        // Ensure the directory exists
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        // Save the file
        file_put_contents($path, $content);
    }
}
