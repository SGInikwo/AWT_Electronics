<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\CartProductEntity;
use App\Models\CartProductModel;
use CodeIgniter\API\ResponseTrait;

class Api extends BaseController
{
    use ResponseTrait;

    // Find order by id
	public function order(int $orderID = NULL)
	{
	    if($orderID != NULL) {
            if ($this->session->isAdmin == true) {
                $cartEn = new CartProductEntity([
                    'cart_id' => $orderID
                ]);
                $cart = new CartProductModel();
                if ($cart->find($cartEn)) {

                    return $this->respond($cart->getCart($orderID));
                } else {
                    return $this->failNotFound("Order doesn't exist");
                }
            } else {
                return $this->failUnauthorized("You are not Authorized");
            }
        }
	    return $this->failNotFound("No order supplied");
	}
}
