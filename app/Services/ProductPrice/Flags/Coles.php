<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: duan.li
 * Date: 14/1/19
 * Time: 4:06 PM
 */

namespace App\Services\ProductPrice\Flags;


use App\Services\ProductPrice\Contracts\Flag;
use App\Services\ProductPrice\Dirvers\ColesHtml;

class Coles implements Flag
{
    private $driver;

    /**
     * Wools constructor.
     * @param string $url
     * @throws \Agilekeys\Priceline\Exceptions\CrawlerException
     */
    public function __construct(string $url)
    {
        $this->driver = new ColesHtml($url);
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
