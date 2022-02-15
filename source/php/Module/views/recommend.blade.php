@if (!$hideTitle)
    @typography([
        'element' => "h2",
        'classList' => ['u-margin--0']
    ])
        {{ $postTitle }}
    @endtypography
@endif

@if($enableRekAI)
    <div id="{{$recommendUid}}" class="mod-recommend__items">
        @if($recommendLinkList) 
            @foreach($recommendLinkList as $recommendLink)
                @include('partials.button', [
                    "text" => $recommendLink->recommendLinkLabel,
                    "href" => $recommendLink->recommendLinkTarget,
                    "type" => "static",
                ])
            @endforeach
        @endif

        <!-- Preloader -->
        @include('partials.preload', [
            'rekaiNumberOfRecommendation' => $rekaiNumberOfRecommendation
        ])
    </div>
    <script>
        window.addEventListener("rekai.load", function(){
            function renderHtml(data) {
                
                let rekAiInputString = '';
                let targetId = document.getElementById("{{$recommendUid}}");
                
                if(targetId) {

                    //Remove the preloader
                    let preloaderItems = targetId.querySelectorAll(".u-preloader");
                    if(preloaderItems) {
                        preloaderItems.forEach(function(item) {
                            item.remove();
                        });
                    }

                    //Append content
                    for(var i = 0; i < data.predictions.length; i++) {
                        rekAiInputString = '<?php echo modularity_recommend_render_blade_view("partials.button", ["href"=> "{MOD_RECOMMEND_HREF}", "text" => "{MOD_RECOMMEND_TITLE}", "type" => "dynamic"]); ?> ';
                    
                        rekAiInputString = rekAiInputString.replace("{MOD_RECOMMEND_HREF}", data.predictions[i].url); 
                        rekAiInputString = rekAiInputString.replace("{MOD_RECOMMEND_TITLE}", data.predictions[i].title); 

                        targetId.insertAdjacentHTML("beforeend", rekAiInputString);
                    }
                }
            }

            window.__rekai.predict({
                overwrite: {
                    addcontent: true,
                    userootpath: true,
                    nrofhits: {{$rekaiNumberOfRecommendation}},
                }
            }, renderHtml);
        });
    </script>
@else
    @if($recommendLinkList) 
        <div id="{{$recommendUid}}" class="mod-recommend__items">
            @foreach($recommendLinkList as $recommendLink)
                @include('partials.button', [
                    "text" => $recommendLink->recommendLinkLabel,
                    "href" => $recommendLink->recommendLinkTarget,
                    "type" => "static",
                ])
            @endforeach
        </div>
    @else
        @notice([
            'type' => 'info',
            'message' => [
                'text' => $lang->noData,
            ],
            'icon' => [
                'name' => 'report',
                'size' => 'md',
                'color' => 'white'
            ]
        ])
        @endnotice
    @endif
@endif