<?php 

namespace App\Repositories;

use Illuminate\Http\Request;

interface CarModelRepositoryInterface
{
    public function all(Request $request);
}
