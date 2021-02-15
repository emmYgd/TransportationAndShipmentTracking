<?php

namespace App\Models;

/*use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;*/
use Illuminate\Database\Eloquent\Model;
/*use Laravel\Lumen\Auth\Authorizable;*/

class UserAbstraction extends Model /*implements AuthenticatableContract, AuthorizableContract*/
{
    //use Authenticatable, Authorizable, HasFactory;
    protected $table = 'user_entity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        
        'quoteQueryCount', 'quote_user_fullName', 'quote_org_company_name', 'quote_contact_phone', 'quote_email', 'quote_commodity', 'quote_place_of_origin', 'quote_port_of_origin', 'quote_destination', 'quote_mode', 'quote_weight_kgs', 'quote_weight_cubic', 'allocation', 'size_type', 'specify_to_get_quote', 'request_price'//this can only be set by the admin..
        
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    public function admin_abstraction(){
        $this->belongsTo(AdminAbstraction::class);
    }
}
