<?php
    $tags = get_the_tags();
    $tags = is_array($tags) ? $tags : [];
    $total = count($tags);
    if(!empty($tags)): ?>
    <ul class="post-tags">
        <li><i class="fa fa-tags"></i></li>
        <?php foreach($tags as $tagKey => $tag): ?>
        <li>
            <a href="<?= esc_url(get_tag_link($tag->term_id)); ?>"><?= esc_html($tag->name) ?></a><?= ($tagKey + 1 < $total) ? ',' : '' ?>
        </li>
        <?php endforeach ?>
    </ul>
<?php endif; ?>