<?php

namespace App\Models;

use App\Entities\ProductEntity;
use CodeIgniter\Model;
use CodeIgniter\API\ResponseTrait;

class ProductModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\ProductEntity';
    protected $useSoftDelete = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'price', 'description', 'brand', 'image', 'category'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    // Search by brand this is done through ajax
    public function getProducts($product = NULL)
    {
        //return $product;
        if ($product == "All") {
            //return $product;
            return $this->findAll();
            //return $this->where('brand', $product)->findAll();
        }else{
            return $this->where('brand', $product)
                ->findAll();
        }

    }

    // Normal search by brand
    public function findByBrand(ProductEntity $product)
    {
        return $this
            ->where('brand', $product->brand)
            ->findAll();
    }

    // Search by name
    public function findProduct($name)
    {
        return $this
            ->where('name', $name)
            ->first();
    }

    // Search by price and id
    public function getPrice(ProductEntity $product){
        return $this
            ->select('price')
            ->where('id', $product->id)
            ->first();

    }


}
