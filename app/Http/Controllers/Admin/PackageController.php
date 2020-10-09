<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Contracts\PackageContract;

class PackageController extends BaseController
{
    /**
     * @var PackageContract
     */
    protected $PackageRepository;

    /**
     * PackageController constructor.
     * 
     * @param PackageContract $PackageRepository
     */
    public function __construct(PackageContract $PackageRepository)
    {
        $this->PackageRepository = $PackageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = $this->PackageRepository->listPackages();
        $this->setPageTitle('Package', 'List of all Packages');
        return view('admin.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('Package', 'Create Package');
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required|max:160',
            'valid_upto' =>  'required',
            'price' =>  'required',
            'offered_price' =>  'required',
        ]);

        $params = $request->except('_token');

        $Package = $this->PackageRepository->createPackage($params);

        if (!$Package) {
            return $this->responseRedirectBack('Error occurred while creating Package.', 'error', true, true);
        }
        return $this->responseRedirect('admin.packages.index', 'Package has been added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $package = $this->PackageRepository->findPackageById($id);
        
        $this->setPageTitle('Package', 'Edit Package : '.$package->name);
        return view('admin.package.edit', compact('package'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required|max:160',
            'valid_upto' =>  'required',
            'price' =>  'required',
            'offered_price' =>  'required',
        ]);

        $params = $request->except('_token');

        //dd($params);

        $Package = $this->PackageRepository->updatePackage($params);

        if (!$Package) {
            return $this->responseRedirectBack('Error occurred while updating Package.', 'error', true, true);
        }
        return $this->responseRedirectBack('Package updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $Package = $this->PackageRepository->deletePackage($id);

        if (!$Package) {
            return $this->responseRedirectBack('Error occurred while deleting Package.', 'error', true, true);
        }
        return $this->responseRedirect('admin.packages.index', 'Package deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $Package = $this->PackageRepository->updateStatus($params);

        if ($Package) {
            return response()->json(array('message'=>'Package status successfully updated'));
        }
    }

    public function getSubscriptions(){
        $subscriptions = $this->PackageRepository->fetchAllSubscriptions();
        $this->setPageTitle('All Subscriptions', 'List of all subscriptions');
        return view('admin.package.all_subscriptions', compact('subscriptions'));
    }
}