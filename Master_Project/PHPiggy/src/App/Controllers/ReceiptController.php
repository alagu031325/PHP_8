<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{TransactionService, ReceiptService};

class ReceiptController
{
    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService,
        private ReceiptService $receiptService
    )
    {
    }

    public function uploadView(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction($params['transactionId']);

        if (!$transaction)
        {
            redirectTo("/");
        }

        echo $this->view->render("receipts/create.php");
    }

    public function upload(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction($params['transactionId']);
        if (!$transaction)
        {
            redirectTo("/");
        }

        $receiptFile = $_FILES['receipt'] ?? null;
        $this->receiptService->validateFile($receiptFile);
        $this->receiptService->upload($receiptFile, $transaction['id']);

        redirectTo("/");
    }

    public function download(array $params)
    {
        $receipt = $this->validateRequestUrl($params);
        if (!empty($receipt))
            $this->receiptService->readFile($receipt);
    }

    public function delete(array $params)
    {
        $receipt = $this->validateRequestUrl($params);
        if (!empty($receipt))
            $this->receiptService->delete($receipt);
        redirectTo("/");
    }

    public function validateRequestUrl(array $params): array
    {
        if (!isset($params['transactionId']) && !isset($params['receiptId']))
        {
            return [];
        }

        $transaction = $this->transactionService->getUserTransaction($params['transactionId']);

        if (empty($transaction))
        {
            redirectTo("/");
        }

        $receipt = $this->receiptService->getReceipt($params['receiptId']);

        if (empty($receipt))
        {
            redirectTo("/");
        }

        if ($receipt['transaction_id'] !== $transaction['id'])
        {
            redirectTo("/");
        }

        return $receipt;
    }
}
