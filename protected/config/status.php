<?php
    return array(
    'none' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    '1' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'group',
        'children' => array(
            'none', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    '2' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'individual',
        'children' => array(
            'group',          // позволим админу всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    '3'=>array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'vip',
        'children' => array(
            'individual',          // позволим прогеру всё, что позволено админу
        ),
        'bizRule' => null,
        'data' => null
    ),
);