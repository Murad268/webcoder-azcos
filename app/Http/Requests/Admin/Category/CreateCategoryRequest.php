<?php

namespace App\Http\Requests\Admin\Category;

use App\Repositories\LangRepository;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function __construct(LangRepository $langRepository)
    {
        parent::__construct();
        $this->langRepository = $langRepository;
    }
    public function rules(): array
    {
        $rules = [
        ];

        // Hər bir dil üçün inputları valide etmək üçün qaydaları əlavə edirik
        foreach ($this->langRepository->all_active() as $lang) {
            $rules['title.' . $lang->code] = 'required|string|max:255';
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

        ];

        // Hər bir dil üçün xüsusi xətaları təyin edirik
        foreach ($this->langRepository->all_active() as $lang) {
            $messages['title.' . $lang->code . '.required'] = 'Tərcümə ' . $lang->code . ' sahəsi məcburidir.';
            $messages['title.' . $lang->code . '.string'] = 'Tərcümə ' . $lang->code . ' sahəsi mətn formatında olmalıdır.';
            $messages['title.' . $lang->code . '.max'] = 'Tərcümə ' . $lang->code . ' sahəsi 255 simvoldan artıq ola bilməz.';
        }

        return $messages;
    }

    /**
     * Get the data for validation.
     *
     * @return array
     */
    public function validationData(): array
    {
        return $this->all();
    }
}
