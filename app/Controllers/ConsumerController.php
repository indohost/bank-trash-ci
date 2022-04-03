<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemTransactionModel;
use App\Models\TransactionModel;
use App\Models\UserModel;

class ConsumerController extends BaseController
{
    protected $userModel;
    protected $transactionModel;
    protected $itemTransactionModel;

    public function __construct()
    {
        if (session()->get('role') != "user") {
            echo 'Access denied';
            exit;
        }

        $this->userModel = new UserModel();
        $this->transactionModel = new TransactionModel();
        $this->itemTransactionModel = new ItemTransactionModel();
    }

    public function index()
    {
        $transactionCount = $this->transactionModel->where('consumer_id', session()->get('id'))->getCountTransaction();
        $itemTransactionCount = $this->transactionModel->where('consumer_id', session()->get('id'))->getTransaction();

        $incomeTransaction = 0;
        foreach ($itemTransactionCount as $d) {
            $trasaction = $this->itemTransactionModel->where('code_transaction', $d['code_transaction'])->getTrasaction();
            foreach ($trasaction as $e) {
                $codeTrasaction[] = $e['total'];
                $incomeTransaction = array_sum($codeTrasaction);
            }
        }

        $data = [
            'incomeTransaction' => $incomeTransaction,
            'transactionCount' => $transactionCount,
        ];

        return view("user/dashboard", $data);
    }
}
