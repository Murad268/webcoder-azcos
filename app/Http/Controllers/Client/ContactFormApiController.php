<?php

namespace App\Http\Controllers\Client;

use App\Facades\TranslateUtility;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Parameters\ParameterService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;


class ContactFormApiController extends Controller
{
    public $lang;

    public function __construct(public ParameterService $parameterService)
    {
        $this->lang = $this->parameterService->getLang();
    }

public function send(Request $request)
{
    $lang = $this->lang;
    try {
            $messages = [
                'contactName.required' => TranslateUtility::getTranslate('validation', 'contact_name_required', $lang),
                'contactName.string' => TranslateUtility::getTranslate('validation', 'contact_name_string', $lang),
                'contactName.max' => TranslateUtility::getTranslate('validation', 'contact_name_max', $lang),
                'contactEmail.required' => TranslateUtility::getTranslate('validation', 'contact_email_required', $lang),
                'contactEmail.email' => TranslateUtility::getTranslate('validation', 'contact_email_valid', $lang),
            ];

            // Validation
            $validatedData = $request->validate([
                'contactName' => 'required|string|max:255',
                'contactEmail' => 'required|email',
            ], $messages);

        // Email data
        $data = [
            'contactName' => $validatedData['contactName'],
            'contactEmail' => $validatedData['contactEmail'],
            'text' => $request->input('text')
        ];

        $emailContent = TranslateUtility::getTranslate('response', 'send_main_name', $lang) . ": " . $data['contactName'] . "\n" .
                        TranslateUtility::getTranslate('response', 'send_main_email', $lang) . ": " . $data['contactEmail'] . "\n" .
                        TranslateUtility::getTranslate('response', 'send_main_text', $lang) . ": " . $data['text'];

        $subject = TranslateUtility::getTranslate('response', 'send_main_title', $lang);
        $recipientEmail = 'info@azcosmetics.az';

        Mail::raw($emailContent, function ($message) use ($subject, $recipientEmail) {
            $message->to($recipientEmail)->subject($subject);
        });

        return response()->json([
            'success' => true,
            'message' => TranslateUtility::getTranslate('response', 'contact_form_success_send_message', $lang)
        ]);

    } catch (ValidationException $e) {
        $errors = [];
        foreach ($e->validator->errors()->getMessages() as $key => $message) {
            $errors[$key] = $message[0];
        }

        return response()->json([
            'success' => false,
            'errors' => $errors
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false, // Changed from true to false
            'message' => $e->getMessage()
        ]);
    }
}

}
