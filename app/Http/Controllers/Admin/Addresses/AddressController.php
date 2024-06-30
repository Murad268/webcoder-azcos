<?php

namespace App\Http\Controllers\Admin\Addresses;

use App\Facades\TranslateUtility;
use App\Http\Controllers\Controller;
use App\Repositories\AddressRepository;
use App\Repositories\LangRepository;
use App\Services\AddressService;
use App\Services\Parameters\ParameterService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public $lang;
    public function __construct(public LangRepository $langRepository, public AddressRepository $addressRepository, public AddressService $addressService,  public ParameterService $parameterService)
    {
        $this->lang = $this->parameterService->getLang();
    }
    public function index($lang)
    {
        $q = request()->q;
        if ($q) {
            $addresses = $this->addressRepository->search($q, $lang, 60);
        } else {
            $addresses = $this->addressRepository->all(60);
        }
        $activeCount = $this->addressRepository->all_active()->count();
        return view('admin.address.index', compact('lang', 'q', 'addresses', 'activeCount'));
    }


    public function create($lang)
    {
        $langs = $this->langRepository->all_active();

        return view('admin.address.create', compact('lang', 'langs'));
    }

    public function store(Request $request, $lang)
    {
        $main_model = $this->addressRepository->getClassCategories();
        $translate_model = $this->addressRepository->getClassCategoriesTranslates();
        try {
            $this->addressService->simple_create($main_model, $translate_model, $request);
            return redirect()->route("admin.address.index", ['lang' => $lang])->with('success', TranslateUtility::getTranslate('response', 'success_create', $lang));
        } catch (\Exception $e) {
            return redirect()->route("admin.address.index", ['lang' => $lang])->with('error', TranslateUtility::getTranslate('response', 'error_create', $lang, $e->getMessage()));
        }
    }

    public function edit($lang, $id)
    {
        $address = $this->addressRepository->findWith($id, 'translates');
        $langs = $this->langRepository->all_active();
        return view('admin.address.edit', compact('lang', 'langs', 'address'));
    }

    public function update(Request $request, $lang, $id)
    {
        try {
            $address = $this->addressRepository->findWith($id, 'translates');
            $translate_model = $this->addressRepository->getClassCategoriesTranslates();
            $this->addressService->simple_update($address, $translate_model, $request, $id);
            return redirect()->route("admin.address.index", ['lang' => $lang])->with('success', TranslateUtility::getTranslate('response', 'success_update', $lang));
        } catch (\Exception $e) {
            return redirect()->route("admin.address.index", ['lang' => $lang])->with('error', TranslateUtility::getTranslate('response', 'error_update', $lang, $e->getMessage()));
        }
    }


    public function delete_selected_addresses(Request $request)
    {
        try {
            $models = $this->addressRepository->findWhereInGet($request->ids);
            $this->addressService->deleteWhereIn($models);
            return response(['success' => TranslateUtility::getTranslate('response', 'success_delete', $this->lang)]);
        } catch (\Exception $e) {
            return response(['error' => TranslateUtility::getTranslate('response', 'error_update', $this->lang, $e->getMessage())]);
        }
    }


    public function changeStatusTrue($id)
    {
        try {
            $model = $this->addressRepository->find($id);
            $this->addressService->changeStatusTrue($model);
            return redirect()->back()->with('success', TranslateUtility::getTranslate('response', 'success_update', $this->lang));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_update', $this->lang, $e->getMessage()));
        }
    }

    public function changeStatusFalse($id)
    {
        try {
            $model = $this->addressRepository->find($id);
            $this->addressService->changeStatusFalse($model);
            return redirect()->back()->with('success', TranslateUtility::getTranslate('response', 'success_update', $this->lang));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_update', $this->lang, $e->getMessage()));
        }
    }


    public function changeOrder(Request $request)
    {
        try {
            $this->addressService->changeOrder($request->all(), $this->addressRepository);
            return response(['success'=> TranslateUtility::getTranslate('response', 'success_update', $this->lang)]);
        } catch (\Exception $e) {
            return response(['error' => TranslateUtility::getTranslate('response', 'error_update', $this->lang, $e->getMessage())]);
        }
    }


    public function add_images(Request $request, $type, $id)
    {
        try {
            $images_model = $this->addressRepository->getClassImage();
            $this->addressService->handleImages($request, $images_model, $id, 'categories', $type);

            return redirect()->back()->with('success', TranslateUtility::getTranslate('response', 'success_create', $this->lang));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_create', $this->lang, $e->getMessage()));
        }
    }

    public function delete_image($id)
    {
        try {
            $result = $this->addressService->deleteImage($id, $this->addressRepository->getClassImage());

            if ($result['success']) {
                return redirect()->back()->with('success', TranslateUtility::getTranslate('response', 'success_delete', $this->lang));
            } else {
                return redirect()->back()->with('error', TranslateUtility::getTranslate('response', 'error_create', $this->lang, $result['success']));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}

