<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer id="footer" role="contentinfo" class="container mt-8 flex flex-col sm:flex-row justify-between text-[#747d8c] p-2 text-center items-center box-border">
    <div class="flex flex-col sm:flex-row">
        <div>Copyright &copy; <?php echo date('Y'); ?> All Rights Reserved .</div>
        <div><?php _e('Theme <a href="https://xiaopanglian.com" class="text-gray-600 no-underline">Calm</a> .'); ?></div>
        <div><?php _e('<a href="https://beian.miit.gov.cn/" class="text-gray-600 no-underline">'.$this->options->beian.'</a>'); ?></div>
    </div>
    <div class="flex flex-row justify-center sm:justify-end mt-2 sm:mt-0 items-center">
        <?php $menus = getLeftSidebarMenu(); ?>
        <?php if (!empty($menus)) : ?>
            <?php foreach ($menus as $menu) : ?>
                <div class="menu-li mr-5 h-4 flex justify-center items-center">
                    <a class="text-sm mr-5 h-4 text-gray-600 no-underline" href="<?php echo $menu["url"]; ?>"><?php echo $menu["name"]; ?></a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</footer><!-- end #footer -->

<?php $this->footer(); ?>