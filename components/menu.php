<nav id="nav-menu" class="flex flex-row height-sm" role="navigation">
    <?php $menus = getLeftSidebarMenu(); ?>
    <?php if (!empty($menus)) : ?>
        <?php foreach ($menus as $menu) : ?>
            <div class="menu-li mr-5 h-4 flex justify-center items-center">
                <a class="text-[#00b894] text-sm mr-5 h-4 font-bold no-underline hover:underline underline-offset-2" href="<?php echo $menu["url"]; ?>"><?php echo $menu["name"]; ?></a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</nav>