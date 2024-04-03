<?php

/**
 * 极简主题Calm
 *
 * @package Calm
 * @author 小胖脸
 * @version 0.3.0
 * @link http://xiaopanglian.com
 */

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;
?>
<!DOCTYPE HTML>
<html>

<?php $this->need('components/head.php'); ?>

<body>
    <div class="container w-full lg:3/4 xl:w-3/5 mt-16 sm:mt-0">
        <!--header部分-->
        <?php $this->need('header.php'); ?>

        <!--中间内容区-->
        <div class="mt-6 pl-5 pr-5 sm:pl-o sm:pr-0">
            <div class="leading-8 text-sm">
                <?php echo $this->options->description; ?>
            </div>

            <div>
                <h4 class="text-[#00b894] text-2xl mt-4 mb-4">
                    <?php
                    $rewrite = $this->options->rewrite;
                    $latestArchive = '/archive';
                    if ($rewrite == 0) {
                        $latestArchive = '/index.php' . $latestArchive;
                    }
                    ?>
                    <a href="<?php echo $latestArchive; ?>" class="text-[#00b894] no-underline">最新文章</a>
                </h4>
                <div>
                    <!--置顶文章-->
                    <?php
                    $topCids = getTopPost();
                    if ($topCids != null):
                        ?>
                        <?php foreach ($topCids as $topCid): ?>
                            <?php $this->widget("Widget_Archive@calm" . $topCid, "pageSize=1&type=post", "cid=" . $topCid)->to($item); ?>
                            <article class="flex flex-row h-12 items-center" itemscope itemtype="http://schema.org/BlogPosting">
                                <span class="text-red mr-2">
                                    <span class="bg-red-500 text-white rounded p-1 text-xs">置顶</span>
                                </span>
                                <span class="shrink-0 w-24 whitespace-nowrap">
                                    <?php $item->date(); ?>
                                </span>
                                <h2 class=" truncate overflow-ellipsis">
                                    <a itemprop="url" href="<?php $item->permalink() ?>" title="<?php $item->title() ?>"
                                        class="text-inherit font-thin underline underline-offset-4 hover:decoration-emerald-600 hover:decoration-2 text-base">
                                        <?php $item->title() ?>
                                    </a>
                                </h2>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <!--最新文章-->
                    <?php while ($this->next()): ?>
                        <article class="flex flex-row h-12 items-center" itemscope itemtype="http://schema.org/BlogPosting">
                            <span class="shrink-0 w-24 whitespace-nowrap">
                                <?php $this->date(); ?>
                            </span>
                            <h2 class=" truncate overflow-ellipsis">
                                <a itemprop="url" href="<?php $this->permalink() ?>" title="<?php $this->title() ?>"
                                    class="text-inherit font-thin underline underline-offset-4 hover:decoration-emerald-600 hover:decoration-2 text-base">
                                    <?php $this->title() ?>
                                </a>
                            </h2>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
            <div>
                <h4 class="text-[#00b894] text-2xl mt-4 mb-4">
                    <a href="/" class="text-[#00b894] no-underline">最新评论</a>
                </h4>
                <div>
                    <?php \Widget\Comments\Recent::alloc()->to($comments); ?>
                    <?php while ($comments->next()): ?>
                        <div class="flex flex-row h-12 items-center" itemscope itemtype="http://schema.org/BlogPosting">
                            <h2 class="mr-4">
                                <a href="<?php $comments->permalink(); ?>"
                                    class="text-inherit font-thin  underline underline-offset-4 hover:decoration-emerald-600 hover:decoration-2 text-base">
                                    <?php $comments->author(false); ?>
                                </a>：
                            </h2>
                            <span>
                                <?php $comments->excerpt(35, '...'); ?>
                            </span>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <!--footer部分-->
        <?php $this->need('footer.php'); ?>

    </div>
    <script type="text/javascript">
        <?php echo $this->options->script; ?>
    </script>
</body>

</html>