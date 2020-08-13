<?php 
function YoutubeWidget () {

    $channel_id = 'UCM_UL1FaZSgwR7pK-2zzQDg'; // put the channel id here
    $youtube = file_get_contents('https://www.youtube.com/feeds/videos.xml?channel_id='.$channel_id);
    $xml = simplexml_load_string($youtube, "SimpleXMLElement", LIBXML_NOCDATA);
    $json = json_encode($xml);
    $youtube = json_decode($json, true);
    $yt_vids = array();
    $count = 0;

    foreach ($youtube['entry'] as $k => $v) {
        if($count <= 2) {
            $yt_vids[$count]['id'] = str_replace('https://www.youtube.com/watch?v=', '', $v['link']['@attributes']['href']);
            $yt_vids[$count]['title'] = $v['title'];
            $videoID = $yt_vids[$count]['id'];
            $videoTitle = $v['title'];

            if($count == 0){
                echo "<div class='first-column yt-widget'><div class='youtube-video youtube-video-$count'><iframe src='https://www.youtube.com/embed/$videoID' frameborder='0' allowfullscreen></iframe></div></div>";
            }else{
                if( $count == 1 ){
                    echo "<div class='second-column yt-widget'>";
                }
                echo "<div class='youtube-video youtube-video-$count'><iframe src='https://www.youtube.com/embed/$videoID' frameborder='0' allowfullscreen></iframe></div>";
                if( $count == 2 ){
                  echo "</div>";
                }
            }
            $count++;
        }
    }
    return;
}
add_shortcode( 'yt-widget', 'YoutubeWidget' ); ?>
