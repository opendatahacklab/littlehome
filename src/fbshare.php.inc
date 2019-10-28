<p class="share">
<!-- see https://developers.facebook.com/docs/plugins/share-button/ -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v4.0"></script>
<div class="fb-share-button" data-href="<?=$uri?>" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode($uri)?>%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Condividi</a></div>
</p>

