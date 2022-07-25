<?php

namespace App\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getDrivingLicenceAttribute() {
        if($this->attributes['driving_licence'] == "") {
            return null;
        }
        return url('/uploads/driver/documents/'.$this->attributes['driving_licence']);
    }
    public function getVehicleInsuranceAttribute() {
        if($this->attributes['vehicle_insurance'] == "") {
            return null;
        }
        return url('/uploads/driver/documents/'.$this->attributes['vehicle_insurance']);
    }

     public function getBackgroudCheckAttribute() {
        if($this->attributes['backgroud_check'] == "") {
            return null;
        }
        return url('/uploads/driver/documents/'.$this->attributes['backgroud_check']);
    }
     public function getFillOutW9Attribute() {
        if($this->attributes['fill_out_w9'] == "") {
            return null;
        }
        return url('/uploads/driver/documents/'.$this->attributes['fill_out_w9']);
    }

    public function getAgreeContractorTermsAttribute() {
        if($this->attributes['agree_contractor_terms'] == "") {
            return null;
        }
        return url('/uploads/driver/documents/'.$this->attributes['agree_contractor_terms']);
    }

  
    public function getlocation() {
        return $this->hasOne('App\Models\Location', 'id', 'location');
    }
    // public function getLocationAttribute($value=''){
    //     return Location::select(['id', 'location_name'])->find($this->attributes['location']);
    // }


}
