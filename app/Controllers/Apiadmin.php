<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Exception;
use Faker\Calculator\Ean;

class Apiadmin extends BaseController
{
    use ResponseTrait;
    function __construct()
    {
        $this->model = new UserModel();
    }
    function upload() {}
}
