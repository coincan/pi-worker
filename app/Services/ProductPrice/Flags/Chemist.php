<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: duan.li
 * Date: 11/1/19
 * Time: 4:21 PM
 */

namespace App\Services\ProductPrice\Flags;


use App\Services\ProductPrice\Contracts\Flag;
use Agilekeys\Priceline\Drivers\Chemist as ChemistDriver;

class Chemist implements Flag
{

    private $driver;

    public function __construct(string $url)
    {
        $this->driver = new ChemistDriver($url);
        $this->driver->connect();
    }

    public function preprocess()
    {
        return $this;
    }

    public function process(): array
    {
        return [
            'name' => $this->driver->filterName(),
            'price' => $this->driver->filterPrice()
        ];
    }

    public function postprocess()
    {
        return '';
    }
}
