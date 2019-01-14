<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: duan.li
 * Date: 11/1/19
 * Time: 4:12 PM
 */

namespace App\Services\ProductPrice\Contracts;


interface Flag
{
    public function preprocess();

    public function process();

    public function postprocess();
}
