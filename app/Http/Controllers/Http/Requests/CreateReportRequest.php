<?php

namespace App\Http\Requests;

use App\Models\Report;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title
 * @property string $content
 */
class CreateReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "required|string|max:255",
            "content" => "required|string|max:255",
        ];
    }

    public function toReport()
    {
        $report = new Report();
        $report->user_id = $this->user_id;
        $report->title = $this->title;
        $report->content = $this->content;
        $report->address = $this->address;
        $report->lat = $this->lat;
        $report->lng = $this->lng;
        return $report;
    }
}
