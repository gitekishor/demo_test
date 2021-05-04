<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Organisation;
use App\Services\OrganisationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use app\Transformers\OrganisationTransformer; 
/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends ApiController
{
    /**
     * @param OrganisationService $service
     *
     * @return JsonResponse
     */
    public function create(OrganisationService $service): JsonResponse
    {
       
        /** @var Organisation $organisation */
      
        $organisation = $service->createOrganisation($this->request->all());

        return $this
            ->transformItem('organisation', $organisation, ['user'])
            ->respond();
    }

    public function listAll(OrganisationService $service)
    {
    //     $filter='';if(!empty($_GET['filter'])) $filter =  'subbed';//$_GET['filter'];
    //     //$filter =  $_GET['filter']?: false;
    
    //   //  $filter= (isset($_GET['filter'])) ? false : '';
    $where_o='';
    if(!empty($_GET['filter']))
    {
        if($_GET['filter']=='subbed')
        {
            $where_o='subbed';
        }
        if($_GET['filter']=='trial')
        {
            $where_o='trial';
        }
    }
    else
    {
        $where_o='';
    }
   
    $organisation = $service->showOrganisation($where_o);
  
    return $organisation;
    }
}
