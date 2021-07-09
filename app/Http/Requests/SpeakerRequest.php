<?php

namespace App\Http\Requests;

use App\Speaker;
use Illuminate\Contracts\Validation\Validator;

class SpeakerRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'name_e' => 'nullable|string|max:100',
            'real_name' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:100',
            'company_e' => 'nullable|string|max:100',
            'job_title' => 'nullable|string|max:100',
            'job_title_e' => 'nullable|string|max:100',
            'contact_email' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'bio' => 'nullable|string|max:120',
            'bio_e' => 'nullable|string|max:240',
            'file' => 'nullable|image',
            'link_fb' => 'nullable|url',
            'link_github' => 'nullable|url',
            'link_twitter' => 'nullable|url',
            'link_other' => 'nullable|url',
            'link_slide' => 'nullable|url',
            'link_video' => 'nullable|url',
            'link_pre_video' => 'nullable|url',
            'agree_act_change' => 'nullable|boolean',
            'topic' => 'nullable|string|max:32',
            'topic_e' => 'nullable|string|max:64',
            'summary' => 'nullable|string|max:480',
            'summary_e' => 'nullable|string|max:480',
            'tag' => 'nullable|array',
            'level' => 'nullable|integer|min:0|max:' . (count(Speaker::$levelItem) - 1),
            'target_audience' => 'nullable|string|max:64',
            'prerequisites' => 'nullable|string|max:120',
            'agree_record' => 'nullable|integer|min:0|max:1',
            'license' => 'nullable|integer|min:0|max:' . (count(Speaker::$licenseItem) - 1),
            'promotion' => 'nullable|boolean',
            'will_forward_posts' => 'nullable|boolean',
            'tshirt_size' => 'nullable|integer|min:0|max:' . (count(Speaker::$tshirtSizeItem) - 1),
            'need_parking_space' => 'nullable|boolean',
            'year' => 'nullable|integer|min:1911',
            'has_dinner' => 'nullable|boolean',
            'meal_preference' => 'nullable|integer|min:0|max:' . (count(Speaker::$mealPreferenceItem) - 1),
            'has_companion' =>  'nullable|integer|min:0|max:10',
            'speaker_status' => 'nullable|integer|min:0|max:' . (count(Speaker::$speakerStatusItem) - 1),
            'speaker_type' => 'nullable|integer|min:0|max:' . (count(Speaker::$speakerTypeItem) - 1),
            'is_keynote' => 'boolean',
            'note' => 'nullable|string',
            'last_edited_by' => 'nullable|string',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => __('speaker.name'),
            'name_e' => __('speaker.name_e'),
            'real_name' => __('speaker.real_name'),
            'company' => __('speaker.company'),
            'company_e' => __('speaker.company_e'),
            'job_title' => __('speaker.job_title'),
            'job_title_e' => __('speaker.job_title_e'),
            'concat_email' => __('speaker.concat_email'),
            'concat_phone' => __('speaker.concat_phone'),
            'concat_address' => __('speaker.concat_address'),
            'bio' => __('speaker.introduction'),
            'bio_e' => __('speaker.introduction_e'),
            'photo' => __('speaker.photo'),
            'link_fb' => 'Facebook',
            'link_github' => 'Github',
            'link_twitter' => 'Twitter',
            'link_other' => '其他(如Website/Blog)',
            'link_slide' => __('speaker.link_slide'),
            'link_video' => '錄影檔影片連結',
            'link_pre_video' => __('speaker.link_pre_video'),
            'agree_act_change' => __('speaker.agree_act_change'),
            'topic' => __('speaker.topic'),
            'topic_e' => __('speaker.topic_e'),
            'summary' => __('speaker.summary'),
            'summary_e' => __('speaker.summary_e'),
            'tag' => __('speaker.tag'),
            'level' => __('speaker.difficulty'),
            'target_audience' => __('speaker.target_audience'),
            'prerequisites' => __('speaker.prerequisites'),
            'agree_record' => __('speaker.agree_record'),
            'license' => __('speaker.license'),
            'promotion' => __('speaker.promote'),
            'will_forward_posts' =>  __('speaker.will_forward_posts'),
            'tshirt_size' => __('speaker.tshirt_size'),
            'need_parking_space' => __('speaker.need_parking_space'),
            'year' => __('speaker.year'),
            'has_dinner' => __('speaker.has_dinner'),
            'meal_preference' => __('speaker.meal_preference'),
            'has_companion' => __('speaker.has_companion'),
            'speaker_status' => '狀態',
            'speaker_type' => '類型',
            'note' => '備註',
            'last_edited_by' => '最後更新者',
        ];
    }
}
