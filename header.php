<?php if (!defined('__TYPECHO_ROOT_DIR__'))
    exit; ?>
<header class="container flex-row h-16 hidden sm:flex mt-8">
    <div>
        <img src="<?php $this->options->LogoUrl() ?>" class="w-16" />
    </div>
    <div class="flex flex-col justify-between ml-5">
        <h1 class="text-3xl">
            <?php $this->options->title(); ?>
        </h1>
        <div>
            <?php $this->need('components/menu.php'); ?>
        </div>
    </div>

</header>

<header class="fixed top-0 sm:hidden w-full p-2 bg-[#f1f2f6] box-border shadow">
    <div class="w-full h-12 flex flex-row justify-between">
        <div class="flex flex-row">
            <img src="<?php $this->options->LogoUrl() ?>" class="h-12" />
            <h1 class="text-3xl">
                <?php $this->options->title(); ?>
            </h1>
        </div>
        <div class="h-12 w-12 flex justify-center items-center" id="mobile-menu-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </div>
    </div>
</header>

<div id="mobile-menus-bg"
    class="hidden fixed top-0 left-0 z-[999] bg-gray-500/50 dark:bg-[#0a0c19]/50 w-full min-h-screen"></div>
<div id="mobile-menus"
    class="hidden fixed top-0 left-0 z-[1000] translate-x-[-1000px] w-4/5 duration-300 !translate-x-0">
    <div class="jasmine-primary-color bg-stone-100 min-h-screen flex flex-col gap-y-14 px-5 pt-14 dark:bg-[#161829]">
        <ul class="flex flex-col items-center gap-y-3">
            <?php $menus = getLeftSidebarMenu(); ?>
            <?php if (!empty($menus)): ?>
                <?php foreach ($menus as $menu): ?>
                    <li class="bg-white rounded w-full dark:bg-gray-700 ">
                        <a title="首页" href="<?php echo $menu["url"]; ?>" class="w-full block px-4 py-2">
                            <?php echo $menu["name"]; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>