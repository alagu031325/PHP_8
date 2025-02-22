<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
    HomeController,
    AboutController,
    AuthController,
    TransactionController,
    ReceiptController
};
use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction', [TransactionController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction', [TransactionController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transactionId}', [TransactionController::class, 'editView'])->add(AuthRequiredMiddleware::class);;
    $app->delete('/transaction/{transactionId}', [TransactionController::class, 'delete'])->add(AuthRequiredMiddleware::class);;
    $app->post('/transaction/{transactionId}', [TransactionController::class, 'edit'])->add(AuthRequiredMiddleware::class);;
    $app->get('/transaction/{transactionId}/receipt', [ReceiptController::class, 'uploadView'])->add(AuthRequiredMiddleware::class);;
    $app->post('/transaction/{transactionId}/receipt', [ReceiptController::class, 'upload'])->add(AuthRequiredMiddleware::class);;
    $app->get('/transaction/{transactionId}/receipt/{receiptId}', [ReceiptController::class, 'download'])->add(AuthRequiredMiddleware::class);;
    $app->delete('/transaction/{transactionId}/receipt/{receiptId}', [ReceiptController::class, 'delete'])->add(AuthRequiredMiddleware::class);;
}
