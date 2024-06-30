<?php

namespace App\Http\Controllers\Admin\Socials;

use App\Facades\TranslateUtility;
use App\Http\Controllers\Controller;
use App\Repositories\SocialRepository;
use App\Services\SocialService;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function __construct(public SocialRepository $SocialRepository, public SocialService $socialService)
    {
    }

    public function edit($lang, $id)
    {
        $social = $this->SocialRepository->find($id);
        return view('admin.socials.edit', compact('social', 'lang'));
    }

    public function update($lang, $id, Request $request )
    {
        try {
            $number = $this->SocialRepository->find($id);

            $this->socialService->simple_update($number, $request->all());
            return redirect()->route("admin.socials.edit", ['lang' => $lang, 'social' => $id])->with('success', TranslateUtility::getTranslate('response', 'success_update', $lang));
        } catch (\Exception $e) {
            return redirect()->route("admin.socials.edit", ['lang' => $lang, 'social' => $id])->with('error', TranslateUtility::getTranslate('response', 'success_update', $lang, $e->getMessage()));
        }
    }

}
