<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Các Dòng Ngôn Ngữ Xác Thực
    |--------------------------------------------------------------------------
    |
    | Các dòng ngôn ngữ sau đây chứa các thông báo lỗi mặc định được sử dụng bởi
    | lớp xác thực. Một số quy tắc này có nhiều phiên bản khác nhau như các quy tắc kích thước.
    | Bạn có thể điều chỉnh từng thông báo ở đây.
    |
    */

    'accepted' => 'Trường :attribute phải được chấp nhận.',
    'accepted_if' => 'Trường :attribute phải được chấp nhận khi :other là :value.',
    'active_url' => 'Trường :attribute phải là một URL hợp lệ.',
    'after' => 'Trường :attribute phải là một ngày sau :date.',
    'after_or_equal' => 'Trường :attribute phải là một ngày sau hoặc bằng :date.',
    'alpha' => 'Trường :attribute chỉ được chứa các chữ cái.',
    'alpha_dash' => 'Trường :attribute chỉ được chứa các chữ cái, số, dấu gạch nối và dấu gạch dưới.',
    'alpha_num' => 'Trường :attribute chỉ được chứa các chữ cái và số.',
    'array' => 'Trường :attribute phải là một mảng.',
    'ascii' => 'Trường :attribute chỉ được chứa các ký tự và ký hiệu một byte.',
    'before' => 'Trường :attribute phải là một ngày trước :date.',
    'before_or_equal' => 'Trường :attribute phải là một ngày trước hoặc bằng :date.',
    'between' => [
        'array' => 'Trường :attribute phải có từ :min đến :max mục.',
        'file' => 'Trường :attribute phải từ :min đến :max kilobytes.',
        'numeric' => 'Trường :attribute phải từ :min đến :max.',
        'string' => 'Trường :attribute phải từ :min đến :max ký tự.',
    ],
    'boolean' => 'Trường :attribute phải là true hoặc false.',
    'can' => 'Trường :attribute chứa một giá trị không được phép.',
    'confirmed' => 'Xác nhận trường :attribute không khớp.',
    'current_password' => 'Mật khẩu không chính xác.',
    'date' => 'Trường :attribute phải là một ngày hợp lệ.',
    'date_equals' => 'Trường :attribute phải là một ngày bằng :date.',
    'date_format' => 'Trường :attribute phải khớp với định dạng :format.',
    'decimal' => 'Trường :attribute phải có :decimal chữ số thập phân.',
    'declined' => 'Trường :attribute phải bị từ chối.',
    'declined_if' => 'Trường :attribute phải bị từ chối khi :other là :value.',
    'different' => 'Trường :attribute và :other phải khác nhau.',
    'digits' => 'Trường :attribute phải có :digits chữ số.',
    'digits_between' => 'Trường :attribute phải có từ :min đến :max chữ số.',
    'dimensions' => 'Trường :attribute có kích thước hình ảnh không hợp lệ.',
    'distinct' => 'Trường :attribute có một giá trị trùng lặp.',
    'doesnt_end_with' => 'Trường :attribute không được kết thúc bằng một trong những giá trị sau: :values.',
    'doesnt_start_with' => 'Trường :attribute không được bắt đầu bằng một trong những giá trị sau: :values.',
    'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'ends_with' => 'Trường :attribute phải kết thúc bằng một trong những giá trị sau: :values.',
    'enum' => ':attribute đã chọn không hợp lệ.',
    'exists' => ':attribute đã chọn không hợp lệ.',
    'extensions' => 'Trường :attribute phải có một trong những phần mở rộng sau: :values.',
    'file' => 'Trường :attribute phải là một tệp.',
    'filled' => 'Trường :attribute phải có một giá trị.',
    'gt' => [
        'array' => 'Trường :attribute phải có nhiều hơn :value mục.',
        'file' => 'Trường :attribute phải lớn hơn :value kilobytes.',
        'numeric' => 'Trường :attribute phải lớn hơn :value.',
        'string' => 'Trường :attribute phải lớn hơn :value ký tự.',
    ],
    'gte' => [
        'array' => 'Trường :attribute phải có :value mục hoặc nhiều hơn.',
        'file' => 'Trường :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Trường :attribute phải lớn hơn hoặc bằng :value.',
        'string' => 'Trường :attribute phải lớn hơn hoặc bằng :value ký tự.',
    ],
    'hex_color' => 'Trường :attribute phải là một màu hex hợp lệ.',
    'image' => 'Trường :attribute phải là một hình ảnh.',
    'in' => ':attribute đã chọn không hợp lệ.',
    'in_array' => 'Trường :attribute phải tồn tại trong :other.',
    'integer' => 'Trường :attribute phải là một số nguyên.',
    'ip' => 'Trường :attribute phải là một địa chỉ IP hợp lệ.',
    'ipv4' => 'Trường :attribute phải là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => 'Trường :attribute phải là một địa chỉ IPv6 hợp lệ.',
    'json' => 'Trường :attribute phải là một chuỗi JSON hợp lệ.',
    'lowercase' => 'Trường :attribute phải là chữ thường.',
    'lt' => [
        'array' => 'Trường :attribute phải có ít hơn :value mục.',
        'file' => 'Trường :attribute phải nhỏ hơn :value kilobytes.',
        'numeric' => 'Trường :attribute phải nhỏ hơn :value.',
        'string' => 'Trường :attribute phải nhỏ hơn :value ký tự.',
    ],
    'lte' => [
        'array' => 'Trường :attribute không được có nhiều hơn :value mục.',
        'file' => 'Trường :attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Trường :attribute phải nhỏ hơn hoặc bằng :value.',
        'string' => 'Trường :attribute phải nhỏ hơn hoặc bằng :value ký tự.',
    ],
    'mac_address' => 'Trường :attribute phải là một địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => 'Trường :attribute không được có nhiều hơn :max mục.',
        'file' => 'Trường :attribute không được lớn hơn :max kilobytes.',
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'string' => 'Trường :attribute không được lớn hơn :max ký tự.',
    ],
    'max_digits' => 'Trường :attribute không được có nhiều hơn :max chữ số.',
    'mimes' => 'Trường :attribute phải là một tệp loại: :values.',
    'mimetypes' => 'Trường :attribute phải là một tệp loại: :values.',
    'min' => [
        'array' => 'Trường :attribute phải có ít nhất :min mục.',
        'file' => 'Trường :attribute phải có ít nhất :min kilobytes.',
        'numeric' => 'Trường :attribute phải có ít nhất :min.',
        'string' => 'Trường :attribute phải có ít nhất :min ký tự.',
    ],
    'min_digits' => 'Trường :attribute phải có ít nhất :min chữ số.',
    'missing' => 'Trường :attribute phải bị thiếu.',
    'missing_if' => 'Trường :attribute phải bị thiếu khi :other là :value.',
    'missing_unless' => 'Trường :attribute phải bị thiếu trừ khi :other là :value.',
    'missing_with' => 'Trường :attribute phải bị thiếu khi :values có mặt.',
    'missing_with_all' => 'Trường :attribute phải bị thiếu khi :values có mặt.',
    'multiple_of' => 'Trường :attribute phải là bội số của :value.',
    'not_in' => ':attribute đã chọn không hợp lệ.',
    'not_regex' => 'Định dạng trường :attribute không hợp lệ.',
    'numeric' => 'Trường :attribute phải là một số.',
    'password' => [
        'letters' => 'Trường :attribute phải chứa ít nhất một chữ cái.',
        'mixed' => 'Trường :attribute phải chứa ít nhất một chữ cái viết hoa và một chữ cái viết thường.',
        'numbers' => 'Trường :attribute phải chứa ít nhất một số.',
        'symbols' => 'Trường :attribute phải chứa ít nhất một ký hiệu.',
        'uncompromised' => ':attribute đã cho đã xuất hiện trong một vụ rò rỉ dữ liệu. Vui lòng chọn một :attribute khác.',
    ],
    'present' => 'Trường :attribute phải có mặt.',
    'present_if' => 'Trường :attribute phải có mặt khi :other là :value.',
    'present_unless' => 'Trường :attribute phải có mặt trừ khi :other là :value.',
    'present_with' => 'Trường :attribute phải có mặt khi :values có mặt.',
    'present_with_all' => 'Trường :attribute phải có mặt khi :values có mặt.',
    'prohibited' => 'Trường :attribute bị cấm.',
    'prohibited_if' => 'Trường :attribute bị cấm khi :other là :value.',
    'prohibited_unless' => 'Trường :attribute bị cấm trừ khi :other có trong :values.',
    'prohibits' => 'Trường :attribute cấm :other xuất hiện.',
    'regex' => 'Định dạng trường :attribute không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_array_keys' => 'Trường :attribute phải chứa các mục cho: :values.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_if_accepted' => 'Trường :attribute là bắt buộc khi :other được chấp nhận.',
    'required_unless' => 'Trường :attribute là bắt buộc trừ khi :other có trong :values.',
    'required_with' => 'Trường :attribute là bắt buộc khi :values có mặt.',
    'required_with_all' => 'Trường :attribute là bắt buộc khi :values có mặt.',
    'required_without' => 'Trường :attribute là bắt buộc khi :values không có mặt.',
    'required_without_all' => 'Trường :attribute là bắt buộc khi không có mục nào trong :values có mặt.',
    'same' => 'Trường :attribute phải khớp với :other.',
    'size' => [
        'array' => 'Trường :attribute phải chứa :size mục.',
        'file' => 'Trường :attribute phải là :size kilobytes.',
        'numeric' => 'Trường :attribute phải là :size.',
        'string' => 'Trường :attribute phải là :size ký tự.',
    ],
    'starts_with' => 'Trường :attribute phải bắt đầu bằng một trong những giá trị sau: :values.',
    'string' => 'Trường :attribute phải là một chuỗi.',
    'timezone' => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'unique' => ':attribute đã được sử dụng.',
    'uploaded' => 'Trường :attribute đã không tải lên được.',
    'uppercase' => 'Trường :attribute phải viết hoa.',
    'url' => 'Trường :attribute phải là một URL hợp lệ.',
    'ulid' => 'Trường :attribute phải là một ULID hợp lệ.',
    'uuid' => 'Trường :attribute phải là một UUID hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Các Dòng Ngôn Ngữ Xác Thực Tùy Chỉnh
    |--------------------------------------------------------------------------
    |
    | Tại đây bạn có thể chỉ định các thông báo xác thực tùy chỉnh cho các thuộc tính sử dụng
    | quy ước "attribute.rule" để đặt tên cho các dòng. Điều này giúp bạn dễ dàng
    | chỉ định một dòng ngôn ngữ tùy chỉnh cho một quy tắc thuộc tính cụ thể.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Các Thuộc Tính Xác Thực Tùy Chỉnh
    |--------------------------------------------------------------------------
    |
    | Các dòng ngôn ngữ sau đâ y được sử dụng để thay thế chỗ của thuộc tính với
    | một cái tên dễ đọc hơn như "Địa chỉ E-Mail" thay vì "email". Điềunày giúp
    | chúng tôi làm cho thông điệp của mình rõ ràng hơn.
    |
    */

    'attributes' => [],

];
