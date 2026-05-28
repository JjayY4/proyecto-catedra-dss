<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'string'   => 'El campo :attribute debe ser un texto.',
    'max' => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max.',
        'file'    => 'El archivo :attribute no debe pesar más de :max kilobytes.',
        'string'  => 'El campo :attribute no debe ser mayor a :max caracteres.',
    ],
    'size' => [
        'string'  => 'El campo :attribute debe tener exactamente :size caracteres.',
    ],
    'unique'    => 'El valor de :attribute ya está registrado.',
    'image'     => 'El campo :attribute debe ser una imagen.',
    'mimes'     => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'alpha_num' => 'El campo :attribute solo puede contener letras y números.',
    'uppercase' => 'El campo :attribute debe estar en mayúsculas.',
    'attributes' => [
        'name'        => 'nombre',
        'iata_code'   => 'código IATA',
        'description' => 'descripción',
        'logo'        => 'logo',
    ],
];