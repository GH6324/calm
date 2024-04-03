<?php
if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

use Typecho\Common;
use Widget\Options;
use Utils\Helper;
use Widget\Notice;

function themeConfig($form)
{
    $LogoUrl = new Typecho\Widget\Helper\Form\Element\Text(
        'LogoUrl',
        null,
        null,
        _t('Logo地址'),
        _t('在这里填入一个图片 URL 地址')
    );

    $form->addInput($LogoUrl);

    $navbar = new Typecho\Widget\Helper\Form\Element\Textarea(
        'Navtar',
        null,
        '[{"name":"首页","url":"/"},{"name":"关于","url":"/about"}]',
        _t('导航菜单'),
        _t('这里是一个Json数组，使用示例请看这:[{"name":"首页","url":"/"},{"name":"关于","url":"/about.html"}]')
    );

    $form->addInput($navbar);

    $topPost = new Typecho\Widget\Helper\Form\Element\Text(
        "topPost",
        null,
        null,
        "置顶文章",
        "格式：文章的ID,文章的ID,文章的ID （中间使用英文逗号,分隔）"
    );
    $form->addInput($topPost);

    $beian = new Typecho\Widget\Helper\Form\Element\Text(
        'beian',
        null,
        null,
        _t('备案号'),
        _t('在这里填入备案号')
    );

    $form->addInput($beian);

    $script = new Typecho_Widget_Helper_Form_Element_Textarea(
        "script",
        null,
        null,
        "全局自定义JavaScript",
        "不用添加script标签"
    );
    $form->addInput($script);

    $css = new Typecho_Widget_Helper_Form_Element_Textarea(
        "css",
        null,
        null,
        "全局自定义CSS",
        "不用添加style标签"
    );
    $form->addInput($css);

    backupThemeData();
}


/**
 * 备份主题数据
 * @return void
 */
function backupThemeData()
{
    $name = "calm";
    $db = Typecho_Db::get();
    if (isset($_POST["type"])) {

        if ($_POST["type"] == "创建备份") {
            $value = $db->fetchRow(
                $db
                    ->select()
                    ->from("table.options")
                    ->where("name = ?", "theme:" . $name)
            )["value"];
            if (
                $db->fetchRow(
                    $db
                        ->select()
                        ->from("table.options")
                        ->where("name = ?", "theme:" . $name . "_backup")
                )
            ) {

                $db->query(
                    $db
                        ->update("table.options")
                        ->rows(["value" => $value])
                        ->where("name = ?", "theme:" . $name . "_backup")
                );
                Notice::alloc()->set("备份更新成功", "success");
                Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
            ?>
            <?php
            } else {
                ?>
                <?php if ($value) {

                    $db->query(
                        $db
                            ->insert("table.options")
                            ->rows(["name" => "theme:" . $name . "_backup", "user" => "0", "value" => $value])
                    );
                    Notice::alloc()->set("备份成功", "success");
                    Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
                ?>
                <?php
                }
            }
        }
        if ($_POST["type"] == "还原备份") {
            if (
                $db->fetchRow(
                    $db
                        ->select()
                        ->from("table.options")
                        ->where("name = ?", "theme:" . $name . "_backup")
                )
            ) {

                $_value = $db->fetchRow(
                    $db
                        ->select()
                        ->from("table.options")
                        ->where("name = ?", "theme:" . $name . "_backup")
                )["value"];
                $db->query(
                    $db
                        ->update("table.options")
                        ->rows(["value" => $_value])
                        ->where("name = ?", "theme:" . $name)
                );
                Notice::alloc()->set("备份还原成功", "success");
                Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
            ?>
            <?php
            } else {

                Notice::alloc()->set("无备份数据，请先创建备份", "error");
                Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
            ?>
            <?php
            } ?>
        <?php
        }
        ?>
        <?php if ($_POST["type"] == "删除备份") {
            if (
                $db->fetchRow(
                    $db
                        ->select()
                        ->from("table.options")
                        ->where("name = ?", "theme:" . $name . "_backup")
                )
            ) {

                $db->query($db->delete("table.options")->where("name = ?", "theme:" . $name . "_backup"));
                Notice::alloc()->set("删除备份成功", "success");
                Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
            ?>
            <?php
            } else {

                Notice::alloc()->set("无备份数据，无法删除", "success");
                Options::alloc()->response->redirect(Common::url("options-theme.php", Options::alloc()->adminUrl));
            ?>
            <?php
            } ?>
        <?php
        } ?>
    <?php
    }
    ?>

    </form>
    <?php echo '<br/><div class="message error">请先点击右下角的保存设置按钮，创建备份！<br/><br/><form class="backup" action="?calm_backup" method="post">
    <input type="submit" name="type" class="btn primary" value="创建备份" />
    <input type="submit" name="type" class="btn primary" value="还原备份" />
    <input type="submit" name="type" class="btn primary" value="删除备份" /></form></div>';
}


function themeFields($layout)
{
}


/**
 * 获取 Options
 * @return Options
 */
function getOptions(): Options
{
    return Helper::options();
}

function getDb()
{
    return Typecho_Db::get();
}

/**
 * 获取左边栏菜单
 */
function getLeftSidebarMenu()
{
    return json_decode(getOptions()->Navtar, true);
}

/**
 * 获取置顶文章
 */
function getTopPost(): array
{
  $top_Text = getOptions()->topPost;
  if (empty($top_Text)) {
    return [];
  }
  $top_ids = explode(",", strtr($top_Text, " ", ""));
  return $top_ids;
}