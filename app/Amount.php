<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    /**
     * @var mixed|string
     */
    private $currency;
    /**
     * @var mixed
     */
    private $total;

    // Constructor
   /* public function __construct( String $curr, $tot){
        $this->currency = $curr;
        $this->total = $tot;

    }*/

}
