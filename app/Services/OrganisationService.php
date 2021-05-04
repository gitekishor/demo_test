<?php

declare(strict_types=1);

namespace App\Services;

use App\Organisation;
use app\Transformers\OrganisationTransformer; 
/**
 * Class OrganisationService
 * @package App\Services
 */
class OrganisationService
{
    /**
     * @param array $attributes
     *
     * @return Organisation
     */
    public function createOrganisation(array $attributes): Organisation
    {
      
        $organisation = new Organisation();
        $organisation->name = $attributes['name'];
        $organisation->owner_user_id = $attributes['owner_user_id'];
        $organisation->trial_end = $attributes['trial_end'];
        $organisation->subscribed = $attributes['subscribed'];
        $organisation->save();
        return $organisation;
//return fractal()->collection($organisation)->transformWith(new OrganisationTransformer)->toArray();
    }

    public function showOrganisation($where_o)
    {
     
        $organisation=Organisation::orderBy("id","DESC");
        if($where_o=='subbed')
        {
            $organisation->where("subscribed",1);
        }
        if($where_o=='trial')
        {
            
            $organisation->where("subscribed",0);
        }
        
        $organisation = $organisation->get();
       
        return  $organisation;
    }

}
