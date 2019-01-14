<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: duan.li
 * Date: 11/1/19
 * Time: 4:13 PM
 */

namespace App\Services\ProductPrice\Flags;


use Agilekeys\Priceline\Drivers\Wools as WoolsDriver;
use App\Services\ProductPrice\Contracts\Flag;

class Wools implements Flag
{
    private $driver;

    /**
     * Wools constructor.
     * @param string $url
     * @throws \Agilekeys\Priceline\Exceptions\CrawlerException
     */
    public function __construct(string $url)
    {
        $this->driver = new WoolsDriver($url);
        $this->driver->connect();
    }

    /**
     * @return $this
     */
    public function preprocess()
    {
        return $this;
    }

    /**
     * @return array\
     */
    public function process(): array
    {
        return [
            'name' => $this->driver->filterName(),
            'price' => $this->driver->filterPrice()
        ];
    }

    public function postprocess()
    {
        return null;
    }
}
