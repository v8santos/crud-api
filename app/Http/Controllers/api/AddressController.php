<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index($id)
    {
        $columns = ["logradouro","numero","bairro","cidade","estado"];
        $addresses = Address::where([
            'user_id'=>$id
        ])
        ->get($columns);

        return $addresses;
    }

    public function store($id)
    {
        $response = Address::handler($id,'post',$this->request);

        return $response;
    }

    public function show($addressID)
    {
        $response = Address::handler($addressID);

        return $response;
        
    }

    public function update($addressID)
    {
        $response = Address::handler($addressID,'put',$this->request);

        return $response;
    }

    public function destroy($addressID)
    {
        $response = Address::handler($addressID,'delete');

        return $response;
    }
}
