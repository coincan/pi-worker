<?php
namespace App\Contracts;

interface Flag
{
	public function preprocess();

	public function process(): array;

	public function postprocess();
}
