<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Языковые ресурсы для проверки значений
    |--------------------------------------------------------------------------
    |
    | Последующие языковые строки содержат сообщения по-умолчанию, используемые
    | классом, проверяющим значения (валидатором). Некоторые из правил имеют
    | несколько версий, например, size. Вы можете поменять их на любые
    | другие, которые лучше подходят для вашего приложения.
    |
    */

    'success'              => 'Сәтті',
    'accepted'             => 'Сіз :attribute қабылдауыңыз керек.',
    'active_url'           => ':attribute жарамсыз URL мекенжайы.',
    'after'                => ':attribute өрісінде :date күнінен кейінгі күн болуы керек.',
    'after_or_equal'       => ':attribute өрісінде :date күнінен кейінгі немесе тең күн болуы керек.',
    'alpha'                => ':attribute тек әріптерден тұруы керек.',
    'alpha_dash'           => ':attribute тек әріптерден, сандардан, сызықша мен астыңғы сызудан тұруы мүмкін.',
    'alpha_num'            => ':attribute тек әріптер мен сандардан тұруы керек.',
    'array'                => ':attribute массив болуы керек.',
    'before'               => ':attribute өрісінде :date күнінен ерте күн болуы керек.',
    'before_or_equal'      => ':attribute өрісінде :date күнінен ерте немесе тең күн болуы керек.',
    'between'              => [
        'numeric' => ':attribute мәні :min және :max аралығында болуы керек.',
        'file'    => ':attribute файл өлшемі :min және :max килобайт арасында болуы керек.',
        'string'  => ':attribute таңбалар саны :min және :max аралығында болуы керек.',
        'array'   => ':attribute элементтер саны :min және :max арасында болуы керек.',
    ],
    'boolean'              => ':attribute өрісі шын немесе жалған мән болуы керек.',
    'confirmed'            => ':attribute растауы сәйкес келмейді.',
    'date'                 => ':attribute жарамды күн емес.',
    'date_equals'          => ':attribute :date күніне тең болуы керек.',
    'date_format'          => ':attribute :format форматына сәйкес келмейді.',
    'different'            => ':attribute және :other әртүрлі болуы керек.',
    'digits'               => ':attribute ұзындығы :digits сан болуы керек.',
    'digits_between'       => ':attribute ұзындығы :min және :max сандар арасында болуы керек.',
    'dimensions'           => ':attribute жарамсыз кескін өлшемдеріне ие.',
    'distinct'             => ':attribute өрісінде қайталанатын мән бар.',
    'email'                => ':attribute жарамды электрондық пошта болуы керек.',
    'ends_with'            => ':attribute келесі мәндердің бірімен аяқталуы керек: :values',
    'exists'               => 'Таңдалған :attribute жарамсыз.',
    'file'                 => ':attribute файл болуы керек.',
    'filled'               => ':attribute өрісі міндетті түрде толтырылуы керек.',
    'gt'                   => [
        'numeric' => ':attribute :value мәнінен үлкен болуы керек.',
        'file'    => ':attribute файл өлшемі :value килобайттан үлкен болуы керек.',
        'string'  => ':attribute таңбалар саны :value мәнінен көп болуы керек.',
        'array'   => ':attribute элементтер саны :value мәнінен көп болуы керек.',
    ],
    'gte'                  => [
        'numeric' => ':attribute :value немесе одан үлкен болуы керек.',
        'file'    => ':attribute файл өлшемі :value килобайт немесе одан үлкен болуы керек.',
        'string'  => ':attribute таңбалар саны :value немесе одан көп болуы керек.',
        'array'   => ':attribute элементтер саны :value немесе одан көп болуы керек.',
    ],
    'image'                => ':attribute кескін болуы керек.',
    'in'                   => 'Таңдалған :attribute жарамсыз.',
    'in_array'             => ':attribute :other ішінде жоқ.',
    'integer'              => ':attribute бүтін сан болуы керек.',
    'ip'                   => ':attribute жарамды IP мекенжайы болуы керек.',
    'ipv4'                 => ':attribute жарамды IPv4 мекенжайы болуы керек.',
    'ipv6'                 => ':attribute жарамды IPv6 мекенжайы болуы керек.',
    'json'                 => ':attribute жарамды JSON жолы болуы керек.',
    'lt'                   => [
        'numeric' => ':attribute :value мәнінен аз болуы керек.',
        'file'    => ':attribute файл өлшемі :value килобайттан аз болуы керек.',
        'string'  => ':attribute таңбалар саны :value мәнінен аз болуы керек.',
        'array'   => ':attribute элементтер саны :value мәнінен аз болуы керек.',
    ],
    'lte'                  => [
        'numeric' => ':attribute :value немесе одан аз болуы керек.',
        'file'    => ':attribute файл өлшемі :value килобайт немесе одан аз болуы керек.',
        'string'  => ':attribute таңбалар саны :value немесе одан аз болуы керек.',
        'array'   => ':attribute элементтер саны :value немесе одан аз болуы керек.',
    ],
    'max'                  => [
        'numeric' => ':attribute :max мәнінен үлкен болмауы керек.',
        'file'    => ':attribute файл өлшемі :max килобайттан үлкен болмауы керек.',
        'string'  => ':attribute таңбалар саны :max мәнінен аспауы керек.',
        'array'   => ':attribute элементтер саны :max мәнінен аспауы керек.',
    ],
    'mimes'                => ':attribute келесі файл түрлерінің бірі болуы керек: :values.',
    'mimetypes'            => ':attribute келесі файл түрлерінің бірі болуы керек: :values.',
    'min'                  => [
        'numeric' => ':attribute кемінде :min болуы керек.',
        'file'    => ':attribute файл өлшемі кемінде :min килобайт болуы керек.',
        'string'  => ':attribute таңбалар саны кемінде :min болуы керек.',
        'array'   => ':attribute элементтер саны кемінде :min болуы керек.',
    ],
    'not_in'               => 'Таңдалған :attribute жарамсыз.',
    'not_regex'            => ':attribute форматы жарамсыз.',
    'numeric'              => ':attribute сан болуы керек.',
    'password'             => 'Қате құпиясөз.',
    'present'              => ':attribute өрісі болуы керек.',
    'regex'                => ':attribute форматы жарамсыз.',
    'required'             => ':attribute өрісі міндетті.',
    'required_if'          => ':attribute өрісі :other :value болғанда міндетті.',
    'required_unless'      => ':other :values мәндерінің бірі болмағанда :attribute өрісі міндетті.',
    'required_with'        => ':values болғанда :attribute өрісі міндетті.',
    'required_with_all'    => ':values болғанда :attribute өрісі міндетті.',
    'required_without'     => ':values болмағанда :attribute өрісі міндетті.',
    'required_without_all' => ':values мәндерінің ешқайсысы болмағанда :attribute өрісі міндетті.',
    'same'                 => ':attribute және :other сәйкес болуы керек.',
    'size'                 => [
        'numeric' => ':attribute :size болуы керек.',
        'file'    => ':attribute файл өлшемі :size килобайт болуы керек.',
        'string'  => ':attribute таңбалар саны :size болуы керек.',
        'array'   => ':attribute элементтер саны :size болуы керек.',
    ],
    'starts_with'          => ':attribute келесі мәндердің бірімен басталуы керек: :values',
    'string'               => ':attribute мәтін болуы керек.',
    'timezone'             => ':attribute жарамды уақыт белдеуі болуы керек.',
    'unique'               => ':attribute бұрыннан бар.',
    'uploaded'             => ':attribute жүктелмеді.',
    'url'                  => ':attribute жарамсыз URL мекенжайы.',
    'uuid'                 => ':attribute жарамды UUID болуы керек.',
];

