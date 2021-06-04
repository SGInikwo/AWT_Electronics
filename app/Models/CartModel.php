<?php

namespace App\Models;

use App\Entities\UserEntity;
use CodeIgniter\Model;
use CodeIgniter\API\ResponseTrait;

class CartModel extends Model
{
	protected $table                = 'cart';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $returnType           = 'App\Entities\CartEntity';
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['user_id', 'purchased_at'];

//	// Dates
//	protected $useTimestamps        = true;
//	protected $dateFormat           = 'timestamp';
//	protected $createdField         = 'created_at';
//	protected $updatedField         = 'updated_at';
//	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

    public function thishasUser(CartEntity $cart)
    {
        if ($this->exists($cart)) {
            $db = $this
                ->select()
                ->where('number', $cart->number)
                ->first();
            if (password_verify($cart->user_id, $db->user_id)) {
                return $db;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    // Does model have user
    public function hasUser(UserEntity $user): bool
    {
        if ($this->findID($user)) {
            return true;
        } else {
            return false;
        }
    }

    // Find user by ID
    public function findID(UserEntity $user)
    {
        // TODO: Show this in report.
        return $this
            ->select()
            ->where('user_id', $user->id)
            ->first();
    }

    // Get correct cart
    public function getCart(UserEntity $userEn){
        $cartProduct = new CartProductModel();
        $productModel = new ProductModel();

        if(!$this->getCardByID($userEn)){

            $this->save([
                'user_id' => $userEn->id,
            ]);
            return $this->getCardByID($userEn);

            //$productEn = $productModel->findProduct($productName);

            //$cartProduct->addProducts($userEn,$cartEn,$productEn);
        }else{

            return $this->getCardByID($userEn);

            //$cartProduct->addProducts($userEn,$cartEn, $productName);
        }
    }

    private function addProduct(UserEntity $user, Product $product, int $quantity)
    {
        $cart = $this->getCart($user);
        $cartProductModel = new CartProductModel();
        return $cartProductModel->createProduct($cart, $product, $quantity);
    }

//    public function findCartByUserID(UserEntity $userEn)
//    {
//        return $this
//            ->where('user_id', $userEn->id)
//            ->where('purchased_at', NULL)
//            ->first();
//    }

    // Find cart where purchased is null
    public function getCardByID(UserEntity $user){
        return $this
            ->select()
            ->where('user_id', $user->id)
            ->where('purchased_at', NULL)
            ->first();
    }

}
