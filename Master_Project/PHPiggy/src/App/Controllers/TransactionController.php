<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, TransactionService};

class TransactionController
{
    public function __construct(private TemplateEngine $view, private ValidatorService $validatorService, private TransactionService $transactionService)
    {
    }

    public function createView()
    {
        echo $this->view->render("transactions/create.php");
    }

    public function create()
    {
        $this->validatorService->validateTransaction($_POST);
        $this->transactionService->create($_POST);

        redirectTo('/');
    }

    public function editView(array $params)
    {
        // dd($params);
        $transaction = $this->transactionService->getUserTransaction($params['transactionId']);

        if (!$transaction)
        {
            redirectTo('/');
        }

        echo $this->view->render('transactions/edit.php', [
            'transaction' => $transaction
        ]);
    }

    public function edit(array $params)
    {
        //If the user doesnt have permission to edit the transaction they will be redirected
        $transaction = $this->transactionService->getUserTransaction($params['transactionId']);

        if (!$transaction)
        {
            redirectTo('/');
        }

        //validate form data
        $this->validatorService->validateTransaction($_POST);

        $this->transactionService->update($_POST, $transaction['id']);

        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function delete(array $params)
    {
        $this->transactionService->delete((int) $params['transactionId']);

        redirectTo("/");
    }
}
