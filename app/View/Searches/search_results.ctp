<div style="margin-top: 43px">&nbsp;</div>
<?php
if (isset($results) && count($results) != 0) {
    foreach ($results as $result) {
        //pr($results);
?>
        <blockquote style="margin-top: 10x">
            <p><a href="<?php echo $this->Html->Url(array("controller"=>"Searches","action"=>"viewResult", "?" => array("url" => $result['link'])),false); ?>"><?php echo $result['resultTitle']; ?></a></p>
            <small style="display: block; width: 60%"><?php echo $result['resultText']; ?></small>
        </blockquote>
<?php     
    }
} else {
?>

        <div class="well well-large">
            F&uuml;r den Suchbegriff: <b><?php echo isset($searchToken)?urldecode($searchToken):""; ?></b> konnte leider nichts gefunden werden.
        </div>

<?php }?>