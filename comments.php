<?php if (!defined('__TYPECHO_ROOT_DIR__'))
    exit; ?>
<?php function threadedComments($comments, $options)
{
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
        }
    }
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
    ?>
    <li id="li-<?php $comments->theId(); ?>" class="<?php
      if ($comments->_levels > 0) {
          echo ' comment-child';
          $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
      } else {
          echo ' comment-parent border border-solid border-[#e8e8e8] mt-5 p-2';
      }
      $comments->alt(' comment-odd', ' comment-even');
      echo $commentClass;
      ?> list-none p-0">
        <div id="<?php $comments->theId(); ?>" class="comment-net border-none border-solid">
            <div class="flex flex-row">
                <cite class="comment-author">
                    <?php $comments->author(); ?>
                </cite>
            </div>
            <div class="flex flex-row mt-1 mb-1">
                <a href="<?php $comments->permalink(); ?>" class="text-sm primary-color none-decoration">
                    <?php $comments->date('Y-m-d H:i'); ?>
                </a>
                <span class="text-sm ml-4 primary-color none-decoration">
                    <?php $comments->reply('回复'); ?>
                </span>
            </div>
            <?php $comments->content(); ?>
        </div><!-- 单条评论者信息及内容 -->
        <div class="comment-children">
            <!-- 嵌套评论相关 -->
            <?php if ($comments->children) { ?> <!--是否嵌套评论判断开始-->
                <div class="comment-children">
                    <?php $comments->threadedComments($options); ?> <!--嵌套评论所有内容-->
                </div>
            <?php } ?> <!--是否嵌套评论判断结束-->
        </div>
    </li>

<?php } ?>

<div id="comments" class="p-2">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
        <h3>
            <?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?>
        </h3>

        <?php $comments->listComments(); ?>

        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>

    <?php endif; ?>

    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply primary-color none-decoration">
                <?php $comments->cancelReply(); ?>
            </div>

            <h3 id="response" class="mt-3 mb-3">
                <?php _e('添加新评论'); ?>
            </h3>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <?php if ($this->user->hasLogin()): ?>
                    <p>
                        <?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>" class="text-black no-underline">
                            <?php $this->user->screenName(); ?>
                        </a>. <a href="<?php $this->options->logoutUrl(); ?>" class="text-black no-underline" title="Logout">
                            <?php _e('退出'); ?> &raquo;
                        </a>
                    </p>
                <?php else: ?>
                    <p>
                        <label for="author" class="w-12 text-gray-500 inline-block">
                            <?php _e('称呼'); ?>
                        </label>
                        <input type="text" name="author" id="author" class="outline-none border-[#00b894] border border-solid"
                            value="<?php $this->remember('author'); ?>" required />
                    </p>
                    <p>
                        <label for="mail" class="w-12 text-gray-500 inline-block">
                            <?php _e('Email'); ?>
                        </label>
                        <input type="email" name="mail" id="mail" class="outline-none border-[#00b894] border border-solid"
                            value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?>
                                required<?php endif; ?> />
                    </p>
                    <p>
                        <label for="url" class="w-12 text-gray-500 inline-block">
                            <?php _e('网站'); ?>
                        </label>
                        <input type="url" name="url" id="url" class="outline-none border-[#00b894] border border-solid"
                            placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </p>
                <?php endif; ?>
                <p>
                    <label for="textarea" class="w-20 text-gray-500">
                        <?php _e('内容'); ?>
                    </label>
                    <textarea rows="8" name="text" id="textarea"
                        class="outline-none border-[#00b894] border resize-none w-full border-solid"
                        required><?php $this->remember('text'); ?></textarea>
                </p>
                <p>
                    <button type="submit" class="bg-[#00b894] text-white pl-2 pr-2 pt-1 pb-1 text-sm border-none">
                        <?php _e('提交评论'); ?>
                    </button>
                </p>
            </form>
        </div>
    <?php else: ?>
        <h3>
            <?php _e('评论已关闭'); ?>
        </h3>
    <?php endif; ?>
</div>