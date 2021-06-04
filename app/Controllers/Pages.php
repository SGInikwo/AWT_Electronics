<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\ProductEntity;
use App\Models\ProductModel;

class Pages extends BaseController
{
    // Show main page
    public function index()
    {
        //$model = new ProductModel();
        //$data['lists'] = $model->getProducts();
        $data['title'] = 'Home';

        echo view('templates/header', $data);
        echo view('pages/home');
        echo view('templates/footer');

    }

    function brand($brand)
    {
        $product = new ProductEntity(['brand' => $brand]);

        $productModel = new ProductModel();

        echo '<pre>';
        print_r($productModel->findByBrand($product));
        echo '</pre>';
    }
}
