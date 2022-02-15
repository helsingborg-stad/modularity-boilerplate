@for ($i = 0; $i < $rekaiNumberOfRecommendation; $i++)
  @button([
    'size' => 'sm',
    'classList' => [
      'u-preloader',
      'recommend-linklist__item', 
      'recommend-linklist__preload-item',
      'c-button--pill'
    ],
    'attributeList' => [
      'style' => 'width: ' .rand(80, 250). 'px;'
    ]
  ])
  @endbutton
@endfor