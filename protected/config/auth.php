<?php
    return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    '1' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'user',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    '2' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'admin',
        'children' => array(
            'user',          // позволим админу всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    '3'=>array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'proger',
        'children' => array(
            'admin',          // позволим прогеру всё, что позволено админу
        ),
        'bizRule' => null,
        'data' => null
    ),
);