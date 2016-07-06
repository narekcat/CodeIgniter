<div id="content" class="span8">
<?php if (!empty($blogs)) : ?>
    <ul class="posts">
    <?php foreach ($blogs as $blog) : ?>
        <li class="post">
            <h2><?php echo $blog->title; ?></h2>
            <div class="meta">
                <?php echo date("F d, Y g:i a", strtotime($blog->created)); ?>
            </div>
            <div class="entry">
                <?php echo $blog->body; ?>
            </div>
            <a href="blogs/view/<?php echo $blog->id; ?>">Read More</a>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
</div>