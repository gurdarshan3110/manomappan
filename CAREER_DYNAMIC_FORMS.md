# Career Dynamic Forms System

This system provides a flexible way to manage career information with different types of sections, each having their own dynamic form structure.

## Features

- **Dynamic Form Types**: 10 different section types with specific form structures
- **JSON Storage**: Form data is stored as JSON for flexibility
- **Filament Integration**: Beautiful admin interface with relationship manager
- **Frontend Components**: Blade components for rendering sections
- **Validation**: Custom validation rules for form data
- **Helper Classes**: Easy-to-use helper for rendering sections

## Available Section Types

1. **CAREER_SUMMARY** - Basic title/description items
2. **HOW_TO_START** - Basic title/description items
3. **ENTRANCE_EXAM** - Items plus difficulty level and preparation tips
4. **CAREER_PROSPECTS** - Basic title/description items
5. **CHALLENGES_AND_SKILL_SET_REQUIRED** - Separate challenges and skills sections
6. **FAQS** - Question/answer pairs
7. **TOP_COLLEGES_INSTITUTIONS_UNIVERSITIES** - Institution names and descriptions
8. **MARKET_TREND_AND_SALARY** - Basic title/description items
9. **PROS_AND_CONS** - Separate pros and cons sections
10. **STALWARTS_OF_THE_CAREER** - People with images and social links

## Usage

### Admin Interface

1. Go to Career resource in Filament admin
2. Edit any career
3. Navigate to "Sections" tab
4. Click "Add Section"
5. Select section type from dropdown
6. Fill in the dynamic form fields that appear
7. Save the section

### Frontend Display

```php
// In your controller
use App\Helpers\CareerSectionRenderer;

$career = Career::find(1);
$sections = CareerSectionRenderer::getAllSections($career);

return view('careers.show', compact('career', 'sections'));
```

```blade
{{-- In your Blade template --}}
@foreach($sections as $section)
    <x-career.section :section="$section" />
@endforeach
```

### API Usage

```php
// Get specific section type
$faqSection = CareerSectionRenderer::getSectionByType($career, 'FAQS');

// Get all sections
$allSections = CareerSectionRenderer::getAllSections($career);
```

## Database Structure

### career_sections table

- `id` - Primary key
- `career_id` - Foreign key to careers table
- `form_type` - Enum of section types
- `form_data` - JSON column storing dynamic form data
- `section_order` - Display order
- `created_at` / `updated_at` - Timestamps

### Legacy columns (for backward compatibility)

- `section_title` - Legacy title field
- `section_content` - Legacy content field
- `section_image` - Legacy image field

## Form Data Structure Examples

### Career Summary
```json
{
  "items": [
    {
      "title": "High Demand",
      "description": "Software engineering has high market demand..."
    }
  ]
}
```

### Entrance Exam
```json
{
  "items": [
    {
      "title": "JEE Main",
      "description": "Joint Entrance Examination..."
    }
  ],
  "difficulty_level": "<p>The difficulty level is moderate to high...</p>",
  "preparation_tips": "<ul><li>Start early preparation...</li></ul>"
}
```

### Challenges and Skills
```json
{
  "challenges": {
    "items": [
      {
        "title": "Rapid Technology Changes",
        "description": "Technology evolves quickly..."
      }
    ]
  },
  "skill_set_required": {
    "items": [
      {
        "title": "Programming Languages",
        "description": "Proficiency in multiple programming languages..."
      }
    ]
  }
}
```

## Extending the System

### Adding New Section Types

1. Add the new type to `CareerSection::CAREER_FORM_TYPE` constant
2. Add form schema in `CareerSection::getFormSchemaForType()` method
3. Add form fields in relationship manager's `getFormFieldsForType()` method
4. Create new Blade component for rendering
5. Update the main section component to handle new type

### Custom Validation

The system includes `ValidCareerSectionData` rule for validating form data based on the selected type.

```php
use App\Rules\ValidCareerSectionData;

$validated = $request->validate([
    'form_type' => 'required|string',
    'form_data' => ['required', 'array', new ValidCareerSectionData($request->form_type)],
]);
```

## Migration

Run the migration to add required columns:

```bash
php artisan migrate
```

## Notes

- Form data is stored as JSON for maximum flexibility
- Each section type has a predefined structure but can be extended
- The system maintains backward compatibility with legacy fields
- Frontend components use Tailwind CSS classes
- Rich text fields support HTML content for formatted text
