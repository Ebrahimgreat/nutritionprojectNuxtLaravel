<?php
namespace App\traits;
use Illuminate\Support\Facades\Auth;

trait authTrait{
    public function getAuthenticatedUser()
    {
        return auth::guard('sanctum')->user();

    }
    public function getUserProfileId()
    {
        $user=$this->getAuthenticatedUser();
        $userProfileId=$user->profile()->first()->id;
        return $userProfileId;

    }

}
