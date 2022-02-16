@if (!$hideTitle)
    @typography([
        'element' => "h2",
        'classList' => ['u-margin--0']
    ])
        {{ $postTitle }}
    @endtypography
@endif

@notice([
    'type' => 'info',
    'message' => [
        'text' => $lang->info,
        'size' => 'sm'
    ],
    'icon' => [
        'name' => 'report',
        'size' => 'md',
        'color' => 'white'
    ]
])
@endnotice