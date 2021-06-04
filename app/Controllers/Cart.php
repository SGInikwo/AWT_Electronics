<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\CartEntity;
use App\Entities\CartProductEntity;
use App\Entities\ProductEntity;
use App\Entities\UserEntity;
use App\Models\CartModel;
use App\Models\CartProductModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class Cart extends BaseController
{
    use ResponseTrait;
    // Display cart or basket in view
	public function index()
	{
        if (!$this->session->get('loggedIn') == true) {
            return redirect()->back()->with('error', 'Please log in');
        }

        $data['title'] = 'Cart';

        $model = new CartModel();
        $cartModel = new CartProductModel();

        $userEn = new UserEntity([
            'id' => $this->session->get('userID')
        ]);

        // If user found in cartModel
        if($model->getCardByID($userEn)){

            $cart = $model->getCardByID($userEn);

            $cpEn = new CartEntity([
                'id' => $cart->id
            ]);
            //$products = $cartModel->getCartjoin($cpEn);

            $total = 0;

            // Join tables together
            $productInBasket = $cartModel->getCartjoin($cpEn);
            foreach ($productInBasket as $product) {
                $newPrice= $product['price'] * $product['quantity'];
                $total += $newPrice;
            }
            $productData = [
                "title" => "Products",
                'products' => $productInBasket,
                'total' => $total
            ];
        }else{
            return redirect()->back()->with('error', 'Basket is Empty');
        }

        echo view('templates/header',$data);
        echo view('cart/cart',$productData);
        echo view('templates/footer');
	}

	// Process of adding to cart
	public function tocart(){
        if (!$this->session->get('loggedIn') == true) {
            return $this->respond('Please LogIn');
        }
        // Get the user model and cart model
        $cartModel = new CartModel();
        $productModel = new ProductModel();
        $productInCart = new CartProductModel();

        // Get the product Name
        $nameString = $this->request->getPost('data');
        $quantity = $this->request->getPost('quantity');

        //return $this->respond($nameString . " " . $quantity);

        // Current user ID
        $userId = $this->session->get('userID');

        // Set empty entity with userID
        $userEn = new UserEntity(['id'=>$userId]);

        // find the correct cart
        $cart = $cartModel->getCart($userEn);
        //$cartEn = new CartEntity();

        // find the product
        $product = $productModel->findProduct($nameString);
        //$productEn = new ProductEntity($product);

        // get price
        $price = $product->price;
        // Add product to cart
        $hiii = $productInCart->addProducts($cart,$product, $quantity, $price);

        return $this->respond($hiii);
    }


    // Checkout set purchased_at to current time
    public function checkout(){
        if (!$this->session->get('loggedIn') == true) {
            return redirect()->to('/');
        }

        $model = new CartModel();
        $cartModel = new CartProductModel();

        $userEn = new UserEntity([
            'id' => $this->session->get('userID')
        ]);
        $cart = $model->getCardByID($userEn);

        if($model->getCardByID($userEn)){
            $cart = $model->getCardByID($userEn);
            $cart->purchased_at = date("Y-m-d h:i:s H");
            if($model->save($cart)){
                return redirect()->to('/');
            }
        }
    }
}
