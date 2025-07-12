<?php

namespace App\Rules;

use App\Models\CareerSection;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCareerSectionData implements ValidationRule
{
    protected string $formType;

    public function __construct(string $formType)
    {
        $this->formType = $formType;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $schema = CareerSection::getFormSchemaForType($this->formType);
        
        if (empty($schema)) {
            $fail('The form type is not supported.');
            return;
        }

        $data = is_array($value) ? $value : json_decode($value, true);
        
        if (!is_array($data)) {
            $fail('The form data must be a valid array or JSON.');
            return;
        }

        $this->validateSchema($data, $schema, $fail);
    }

    private function validateSchema(array $data, array $schema, Closure $fail): void
    {
        foreach ($schema as $key => $rules) {
            if ($key === 'items' && is_array($rules)) {
                // Validate repeater items
                if (!isset($data['items']) || !is_array($data['items'])) {
                    continue; // Items can be optional
                }

                foreach ($data['items'] as $index => $item) {
                    if (!is_array($item)) {
                        $fail("Item at index {$index} must be an array.");
                        continue;
                    }

                    foreach ($rules as $fieldName => $fieldType) {
                        if ($fieldType === 'string' && isset($item[$fieldName]) && !is_string($item[$fieldName])) {
                            $fail("Field '{$fieldName}' in item {$index} must be a string.");
                        }
                    }
                }
            } elseif (is_array($rules)) {
                // Validate nested structure (like challenges/skills)
                if (isset($data[$key])) {
                    $this->validateSchema($data[$key], $rules, $fail);
                }
            } elseif ($rules === 'rich_text' && isset($data[$key]) && !is_string($data[$key])) {
                $fail("Field '{$key}' must be a string.");
            }
        }
    }
}
