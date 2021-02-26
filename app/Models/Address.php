<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mockery\Undefined;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifier','logradouro','numero','bairro','cidade','estado','user_id'
    ];

    /**
     * error Handling & CRUD response
     * 
     * @param int $id
     * @param string $method
     * @param object $request
     */
    public static function handler(int $id,$method = 'get',$request = null)
    {
        $address = Address::find($id);
        $columns = ["logradouro","numero","bairro","cidade","estado"];
        
        if($method === 'post'){
            $requestValues = $request->all(); // api request without user_id
            if(!$requestValues){
                return '404 - User Not Found';
            }
        }else if(!$address){
            return '404 - Address Not Found';
        }

        switch ($method){
            case 'post':

                $requestValues["user_id"]=$id;
                Address::create($requestValues);
                return 'Address created';

            ;case 'get':
                
                return $address->only($columns);

            ;case 'put':

                $idOld = $address->id;
                $address->update($request->all());
                return "Address $idOld altered";

            ;case 'delete':

                $address->delete();
                return 'Register Deleted!';

            ;
        }

    }
}
