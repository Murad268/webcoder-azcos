<?php

namespace App\Http\Requests\Admin\Translates;

use App\Repositories\LangRepository;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTranslateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $langRepository;

    public function __construct(LangRepository $langRepository)
    {
        parent::__construct();
        $this->langRepository = $langRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Form müraciətinə icazə veririk
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'group' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ];

        // Hər bir dil üçün inputları valide etmək üçün qaydaları əlavə edirik
        foreach ($this->langRepository->all_active() as $lang) {
            $rules['locale.' . $lang->code] = 'required|string|max:255';
        }

        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $messages = [
            'group.required' => 'Tərcümə qrupu sahəsi məcburidir.',
            'group.string' => 'Tərcümə qrupu sahəsi mətn formatında olmalıdır.',
            'group.max' => 'Tərcümə qrupu sahəsi 255 simvoldan artıq ola bilməz.',
            'code.required' => 'Tərcümə kodu sahəsi məcburidir.',
            'code.string' => 'Tərcümə kodu sahəsi mətn formatında olmalıdır.',
            'code.max' => 'Tərcümə kodu sahəsi 255 simvoldan artıq ola bilməz.',
        ];

        // Hər bir dil üçün xüsusi xətaları təyin edirik
        foreach ($this->langRepository->all_active() as $lang) {
            $messages['locale.' . $lang->code . '.required'] = 'Tərcümə ' . $lang->code . ' sahəsi məcburidir.';
            $messages['locale.' . $lang->code . '.string'] = 'Tərcümə ' . $lang->code . ' sahəsi mətn formatında olmalıdır.';
            $messages['locale.' . $lang->code . '.max'] = 'Tərcümə ' . $lang->code . ' sahəsi 255 simvoldan artıq ola bilməz.';
        }

        return $messages;
    }

}
