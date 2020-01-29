<?php

return array(
    'validInputFileExtensions' => array(
        'csv'
    ),
    'fileReader' => array(
        'csv' => '\PSFee\File\Reader\CSV'
    ),
    'commission' => array(
        'cash_in' => array(
            'fee_percentage' => 0.03,
            'max_fee' => 5
        ),
        'legal' => array(
            'fee_percentage' => 0.03,
            'min_fee' => 0.5
        ),
        'natural' => array(
            'fee_percentage' => 0.3,
            'discount' => array(
                'operation_count' => 3,
                'operation_sum' => 1000,
            )
        )
    )
);
