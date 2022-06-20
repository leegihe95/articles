<div class="news">
    <h3><?php echo htmlspecialchars($data->title).' // Posted at: '.htmlspecialchars($data->date_creation)?></h3>
    <p>
        <?php echo htmlspecialchars($data->content);?>
        <br>
        <?php // (index.php) if the request is on a URL that does not contain 'id', then display href
        if(!isset($_REQUEST['id'])) {
        ?>
            <a href="comments.php?id=<?php echo $data->id?>"><em>See article</em></a>
        <?php
        }
        ?>
    </p>
</div>