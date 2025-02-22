<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;
use App\Config\Paths;

class ReceiptService
{
    public function __construct(private Database $db)
    {
    }

    //allows $file to have null values
    public function validateFile(?array $file)
    {
        //There is no error, the file uploaded with success if error is set to UPLOAD_ERR_OK
        if (!$file || $file['error'] !== UPLOAD_ERR_OK)
        {
            throw new ValidationException([
                'receipt' => ['Failed to upload file']
            ]);
        }

        //stores sizes in bytes - so convert MB to KB then KB to bytes 
        $maxFileSizeMB = 3 * 1024 * 1024;

        if ($file['size'] > $maxFileSizeMB)
        {
            throw new ValidationException([
                'receipt' => ['File upload is too large']
            ]);
        }

        //validating file names 
        $originalFileName = $file['name'];
        if (!preg_match('/^[A-Za-z0-9\s._-]+$/', $originalFileName))
        {
            throw new ValidationException([
                'receipt' => ['Invalid Filename']
            ]);
        }

        //validating file MIME types - stores type of file inside the file info - whereas extensions are added to the filenames and easy to spoof 
        $clientMimeType = $file['type'];
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (!in_array($clientMimeType, $allowedMimeTypes))
        {
            throw new ValidationException([
                'receipt' => ['Invalid file type']
            ]);
        }
    }

    public function upload(array $file, int $transaction)
    {
        //Generate unique file names
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        //bin2hex - returns a readable string from the bytes generated 
        $newFilename = bin2hex(random_bytes(16)) . "." . $fileExtension;

        //full system path to store file
        $uploadPath = Paths::STORAGE_UPLOADS . "/" . $newFilename;

        if (!move_uploaded_file($file['tmp_name'], $uploadPath))
        {
            throw new ValidationException([
                'receipt' => ['Failed to upload file, Try again later']
            ]);
        }

        $this->db->query(
            "INSERT INTO receipts(transaction_id, original_filename, storage_filename, media_type)
            VALUES(:transaction_id, :original_filename, :storage_filename, :media_type)",
            [
                "transaction_id" => $transaction,
                "original_filename" => $file['name'],
                "storage_filename" => $newFilename,
                "media_type" => $file['type']
            ]
        );
    }

    public function getReceipt(string $receiptId)
    {
        $receipt = $this->db->query(
            "SELECT * FROM receipts WHERE id=:id",
            ['id' => $receiptId]
        )->find();

        return $receipt;
    }

    public function readFile(array $receipt)
    {
        $filePath = Paths::STORAGE_UPLOADS . "/" . $receipt['storage_filename'];

        if (!file_exists($filePath))
        {
            redirectTo("/");
        }

        //servers send response generally in plain text or html - we want to send file contents - inline informs browser to show file within them - and attachment tells them 
        header("Content-Disposition: inline;filename={$receipt['original_filename']}");
        header("Content-Type: {$receipt['media_type']}");

        //actual file contents should be sent through request body
        readfile($filePath);
    }

    public function delete(array $receipt)
    {
        $filePath = Paths::STORAGE_UPLOADS . "/" . $receipt['storage_filename'];

        //deletes file from the system
        unlink($filePath);

        //delete the record from database
        $this->db->query(
            "DELETE FROM receipts WHERE id = :id",
            ["id" => $receipt['id']]
        );
    }
}
