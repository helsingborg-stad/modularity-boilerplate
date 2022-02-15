@button([
    'text' => $text,
    'style' => 'outlined',
    'color' => 'primary',
    'href' => $href,
    'size' => 'sm',
    'context' => ['module.recommend', 'module.recommend.button'],
    'classList' => [
        'recommend-linklist__item', 
        'recommend-linklist__' . $type . '-item',
        'c-button--pill'
    ],
])
@endbutton