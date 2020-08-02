<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','description','purchase_price','sale_price','available',
        'category_id'];
    /**
     * @var mixed
     */
    private $description;
    /**
     * @var mixed
     */
    private $name;
    /**
     * @var mixed
     */
    private $purchase_price;
    /**
     * @var mixed
     */
    private $sale_price;
    /**
     * @var mixed
     */
    private $available;
    /**
     * @var int|mixed
     */
    private $category_id;
    /**
     * @var mixed
     */
    private $productimg;

}
