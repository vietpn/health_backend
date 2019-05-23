<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    "accepted" => "Tùy chọn :attribute phải được chấp nhận.",
    "active_url" => " :attribute không phải là một URL hợp lệ.",
    "after" => ":attribute phải là một ngày sau ngày :date.",
    "alpha" => "Thuộc tính :attribute chỉ được chứa các chữ cái.",
    "alpha_dash" => "Thuộc tính :attribute chỉ được chứa các cữ cái, số và dấu gạch ngang.",
    "alpha_num" => ":attribute chỉ chứa kí tự và số.",
    "array" => "Thuộc tính :attribute phải là một mảng.",
    "before" => "Thuộc tính :attribute phải là một ngày trước ngày :date.",
    "between" => array(
        "numeric" => "Số :attribute phải nằm trong khoảng :min và :max.",
        "file" => "File :attribute phải có kích thước trong khoảng :min và :max KB.",
        "string" => "Chuỗi :attribute phải có độ dài từ :min đến :max ký tự.",
        "array" => "Mảng :attribute phải có từ :min đến :max phần tử.",
    ),
    "confirmed" => " :attribute kiểm tra không chính xác.",
    "date" => "Thuộc tính :attribute không phải là một ngày hợp lệ.",
    "date_format" => ":attribute không đúng định dạng :format.",
    "different" => "Thuộc tính :attribute và :other phải khác nhau.",
    "digits" => "Thuộc tính :attribute phải có :digits số.",
    "digits_between" => "Thuộc tính :attribute phải có từ :min đến :max số.",
    "email" => ":attribute không hợp lệ",
    "exists" => "Thuộc tính :attribute được chọn không hợp lệ.",
    "image" => ":attribute phải là một hình ảnh.",
    "in" => "Thuộc tính :attribute được chọn không hợp lệ.",
    "integer" => ":attribute phải là một số nguyên.",
    "ip" => "Thuộc tính :attribute phải là một địa chỉ IP.",
    "max" => array(
        "numeric" => "Thuộc tính :attribute không thể lớn hơn :max.",
        "file" => ":attribute phải có kích thước nhỏ hơn :max kilobytes.",
        "string" => "Chuỗi :attribute phải ngắn hơn :max kí tự.",
        "array" => "Thuộc tính :attribute không được có nhiều hơn :max phần tử.",
    ),
    "mimes" => "File :attribute phải thuộc các loại sau: :values.",
    "min" => array(
        "numeric" => ":attribute phải lớn hơn :min.",
        "file" => ":attribute ít nhất phải :min kilobytes.",
        "string" => ":attribute ít nhất phải là :min kí tự ",
        "array" => "Thuộc tính :attribute phải có ít nhất :min phần tử.",
    ),
    "not_in" => "Thuộc tính :attribute không hợp lệ.",
    "numeric" => ":attribute phải là một số.",
    "regex" => ":attribute không hợp lệ",
    "required" => ":attribute không được bỏ trống",
    "required_if" => "Thuộc tính :attribute là bắt buộc khi :other là :value.",
    "required_with" => "Thuộc tính :attribute là bắt buộc khi :values tồn tại.",
    "required_with_all" => "Thuộc tính :attribute là bắt buộc khi :values tồn tại.",
    "required_without" => "Thuộc tính :attribute là bắt buộc khi :values không tồn tại.",
    "required_without_all" => "Thuộc tính :attribute là bắt buộc khi không tồn tại :values .",
    "same" => ":attribute và :other phải giống nhau.",
    "size" => array(
        "numeric" => "Thuộc tính :attribute phải nhỏ hơn :size.",
        "file" => "File :attribute phải nhỏ hơn :size KB.",
        "string" => "Chuỗi :attribute phải ngắn hơn :size ký tự.",
        "array" => "Mảng :attribute phải chứa ít hơn :size phần tử.",
    ),
    "unique" => ":attribute đã tồn tại",
    "url" => ":attribute đường dẫn không hợp lệ",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],
    "array_string_required" => "The :attribute không được để trống",
    "array_array_string_required" => ":attribute phải chọn ít nhất một giá trị",
    "array_price_numeric" => ":attribute phải là số không âm",
    "date_long_time" => ":attribute phải nhỏ hơn ngày hiện tại",
    "float" => ":attribute phải là kiểu float",
    "unique_with" => ":attribute đã tồn tại",

];

