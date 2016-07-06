<div id="content" class="span8">
<?php if (isset($wrongId)) : ?>
    <br>
    <div class="alert alert-error">
        <button class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo $wrongId; ?></strong>
    </div>
<?php else : ?>
    <h2><?php echo $blog->title; ?></h2>
    <div class="meta">
        <?php echo date("F d, Y g:i a", strtotime($blog->created)); ?>                  
    </div>
    <div class="entry">
        <?php echo $blog->body; ?>
    </div>
<?php endif; ?>
</div>