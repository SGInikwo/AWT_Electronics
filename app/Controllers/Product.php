<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;

class Product extends BaseController
{
    use ResponseTrait;

    public function index()
    {

    }


    function product()
    {
        echo view('templates/header');
        echo view('data/product');
        echo view('templates/footer');
    }

    // Adding product to database
    function add()
    {
        helper('form');
        $model = new ProductModel();

        if (!$this->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'brand' => 'required',
            'category' => 'required',
        ])) {
            $headerData = [
                'title' => 'Register'
            ];

            echo view('templates/header',$headerData);
            echo view('product/add');
            echo view('templates/footer');
        } else {
            $model->save([
                'name' => $this->request->getVar('name'),
                'price' => $this->request->getVar('price'),
                'description' => $this->request->getVar('description'),
                'brand' => $this->request->getVar('brand'),
                'image' => $this->request->getVar('image'),
                'category' => $this->request->getVar('category'),
            ]);
            return redirect()->to('/');
        }
        return false;
    }

    // Get product from database
    public function getproduct(){
            $productModel = new ProductModel();
            $nameString = $this->request->getPost('data');

            //return $this->respond($nameString);
            $dbProduct = $productModel->getProducts($nameString);

            return $this->respond($dbProduct);

    }
}
