<?php

namespace App\Models;

use App\Entities\CartEntity;
use App\Entities\CartProductEntity;
use App\Entities\ProductEntity;
use App\Entities\UserEntity;
use CodeIgniter\Model;
use CodeIgniter\API\ResponseTrait;

class CartProductModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'cartproduct';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'App\Entities\CartProductEntity';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['cart_id', 'product_id', 'price', 'quantity'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	// Adding product with the correct cart in the cartproduct
    public function addProducts( CartEntity $cart, ProductEntity $product, $quantity , $price)
    {
        $cartProductEn = new CartProductEntity([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $price
        ]);

        if(!$this->findID($cartProductEn)){
            return $this->save($cartProductEn);
        }else{

            $newcartProductEn = $this->findID($cartProductEn);

            $newcartProductEn->quantity += $quantity;

            //return $newcartProductEn;
            try {
                return $this->update($newcartProductEn->id,$newcartProductEn);
            } catch (\ReflectionException $e) {
                return $e;
            }
        }
    }

    // Find cartproduct
    public function findID(CartProductEntity $cartProductEn)
    {
        // TODO: Show this in report.
        return $this
            ->select()
            ->where('cart_id', $cartProductEn->cart_id)
            ->where('product_id', $cartProductEn->product_id)
            ->first();
    }

    // Get all cart
    public function getCart(int $cartProductEn){
        return $this->select()->where('cart_id', $cartProductEn)->findAll();
    }

    // Join product and cartproduct
    public function getCartjoin(CartEntity $cartProductEn){
        return $this
            ->asArray()
            ->select()
            ->where('cart_id', $cartProductEn->id)
            ->join('product', 'cartproduct.product_id = product.id')
            ->findAll();
    }

}
