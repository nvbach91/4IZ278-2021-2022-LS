<?php 

class Cart {
    function __construct($productId, $productQty) 
    {
        $this->$productId = $productId;
        $this->$productQty = $productQty;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getProductQty() {
        return $this->productQty;
    }
}

?>