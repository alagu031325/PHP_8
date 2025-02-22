<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\TransactionService;

class HomeController
{
    public function __construct(private TemplateEngine $view, private TransactionService $transactionService)
    {
    }

    public function home()
    {
        //default page number set to 1
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        //Number of results that should be displayed on page
        $length = 3;
        $offset = ($page - 1) * $length;

        //if null http_build_query ignores this query parameter
        $searchTerm = $_GET['s'] ?? null;

        [$transactions, $count] = $this->transactionService->getUserTransactions($length, $offset);

        $lastPage = ceil($count / $length);
        //generate an array of page numbers
        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLinks = array_map(
            fn($pageNum) => http_build_query([
                'p' => $pageNum,
                's' => $searchTerm
            ]),
            $pages
        );

        echo $this->view->render("index.php", [
            'transactions' => $transactions,
            'currentPage' => $page,
            'previousPageQuery' => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm
            ]),
            'lastPage' => $lastPage,
            'nextPageQuery' => http_build_query([
                'p' => $page + 1,
                's' => $searchTerm
            ]),
            'pageLinks' => $pageLinks,
            'searchTerm' => $searchTerm
        ]);
    }
}
