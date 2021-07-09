<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Speaker extends Model
{
    public const ReadyToConfirmStatus = 0;
    public const OnCheckStatus = 1;
    public const ConfirmedStatus = 2;
    public const NotEditableStatus = 3; // based on $speakerStatusItem
    public const ReadonlyStatus = 4; // based on $speakerStatusItem

    public static $photoPath = '/images/speaker';
    public static $hideTag = [
        'AR/VR',
        'Blockchain',
        'Quant',
        'Security',
        'Data Science',
        'Panel',
        'FinTech',
        'QA',
    ];
    public static $tagItem = [
        'AI',
        'AR/VR',
        'Blockchain',
        'Cloud',
        'DevOps',
        'IoT',
        'Mobile App',
        'Startup',
        'UI/UX',
        'Web',
        'Quant',
        'Security',
        'Cross-platform',
        'Data Science',
        'Agile',
        'Panel',
        'FinTech',
        'QA',
        'Data Analyzing',
        '5G / 6G',
        'Business Thinking',
        '社會參與',
        '職涯發展',
        '數位轉型',
        '遠距',
        'Community',
        'Open Source',
    ];
    public static $levelItem = [
        'Basic-外行人可以藉此入門',
        'Normal-歡迎略懂略懂有基本基礎的會眾',
        'Expert-建議在該領域中有研究經驗的人入場',
    ];
    public static $licenseItem = [
        '授予 MOPCON 演講時錄影，後製與上傳至公開線上影音平台之權利。',
        '以 CC BY 3.0 姓名標示方式授權。',
        '以 CC BY-SA 3.0 姓名標示-相同方式授權。',
        '以 CC BY-NC 3.0 姓名標示-非商業性方式授權。',
        '謝絕所有錄音錄影，但接受 MOPCON 工作人員文字紀錄。',
        '同意授予後製及上傳預錄影片及 Q&A 影片',
        '同意授予後製及上傳預錄影片'
    ];
    public static $tshirtSizeItem = [
        'XS',
        'S',
        'M',
        'L',
        'XL',
        '2XL',
        '3XL',
        '4XL',
    ];
    public static $mealPreferenceItem = [
        '葷',
        '全素',
        '奶蛋素',
    ];
    public static $speakerStatusItem = [
        self::ReadyToConfirmStatus => '待確認',
        self::OnCheckStatus => '確認中',
        self::ConfirmedStatus => '已確認',
        self::NotEditableStatus => '下架',
        self::ReadonlyStatus => '關閉前台修改',
    ];
    public static $speakerTypeItem = [
        '贊助商',
        'CFP',
        'CFR',
        '內推',
        '其他',
    ];
    protected $table = 'speakers';
    protected $fillable = [
        "name",
        "name_e",
        "real_name",
        "company",
        "job_title",
        "bio",
        "bio_e",
        "link_fb",
        "link_github",
        "link_twitter",
        "link_other",
        "link_slide",
        "link_video",
        "link_pre_video",
        "topic",
        "topic_e",
        "summary",
        "summary_e",
        "tag",
        "level",
        "target_audience",
        "prerequisites",
        "agree_record",
        "agree_act_change",
        "license",
        "promotion",
        "will_forward_posts",
        "tshirt_size",
        "need_parking_space",
        "year",
        "has_dinner",
        "meal_preference",
        "has_companion",
        "speaker_status",
        "speaker_type",
        "is_keynote",
        "note",
        "last_edited_by",
        "company_e",
        "job_title_e",
        "contact_phone",
        "contact_email"
    ];
    protected $appends = [
        'tag_text',
        'level_text',
        'license_text',
        'tshirt_size_text',
        'meal_preference_text',
        'speaker_status_text',
        'speaker_type_text',
        'external_link',
        'editable',
        'readonly',
    ];
    protected $casts = ['tag' => 'array'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->speaker_status = 0;
            $model->access_key = Str::uuid();
            $model->access_secret = Str::random(20);
            $model->year = (int) date('Y');
            $model->agree_record = 1;
        });
    }

    public function getTagTextAttribute()
    {
        $tmp_collection = collect($this->tag);
        $new_collection = $tmp_collection->map(function ($item) {
            return self::$tagItem[$item] ?? '';
        })->reject(function ($item) {
            return empty($item);
        });

        return $new_collection->all();
    }

    public function getLevelTextAttribute()
    {
        return self::$levelItem[$this->level] ?? '';
    }

    public function getLicenseTextAttribute()
    {
        return self::$licenseItem[$this->license] ?? '';
    }

    public function getTshirtSizeTextAttribute()
    {
        return self::$tshirtSizeItem[$this->tshirt_size] ?? '';
    }

    public function getMealPreferenceTextAttribute()
    {
        return self::$mealPreferenceItem[$this->meal_preference] ?? '';
    }

    public function getSpeakerStatusTextAttribute()
    {
        return self::$speakerStatusItem[$this->speaker_status] ?? '';
    }

    public function getSpeakerTypeTextAttribute()
    {
        return self::$speakerTypeItem[$this->speaker_type] ?? '';
    }

    public function getExternalLinkAttribute()
    {
        return $this->access_key ? (url("/speaker/form/{$this->access_key}")) : '';
    }

    public function getEditableAttribute()
    {
        return $this->speaker_status !== self::NotEditableStatus;
    }

    public function getReadonlyAttribute()
    {
        return $this->speaker_status === self::ReadonlyStatus;
    }
}
