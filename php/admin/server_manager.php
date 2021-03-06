<?php
session_start();
require_once('../config/config.php');
require_once('../config/admin_theme.php');
require_once('checkuser.php');
require_once('../config/functions.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php mduiHead($lang['adminServermanagertitle']); ?>
</head>
<?php mduiBody(); mduiHeader($lang['adminServermanagerHeader']); mduiMenu(); ?>
<h1 class="mdui-text-color-theme"><?php echo $lang['adminServermanagerT1']; ?></h1>

<button class="mdui-btn mdui-color-theme-accent mdui-ripple" mdui-dialog="{target: '#createserver'}"><?php echo $lang['adminServermanagerT22']; ?></button>

<div class="mdui-dialog" id="createserver">
    <form name="addnode" method="post" action="server_manager.php">
        <div class="mdui-dialog-content">
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label"><?php echo $lang['adminServermanagerT2']; ?></label>
                <input class="mdui-textfield-input" name="add-servername" type="text" />
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label"><?php echo $lang['adminServermanagerT3']; ?></label>
                <input class="mdui-textfield-input" type="text" name="add-serverport" />
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label"><?php echo $lang['adminServermanagerT4']; ?></label>
                <input class="mdui-textfield-input" type="text" name="add-rconport" />
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label"><?php echo $lang['adminServermanagerT5']; ?></label>
                <input class="mdui-textfield-input" type="text" name="add-queryport" />
            </div>
            <div class="mdui-p-t-5">
                <label class="mdui-textfield-label"><?php echo $lang['adminServermanagerT6']; ?></label>
                <label class="mdui-slider mdui-slider-discrete">
                    <input type="range" step="1" min="0" max="200" name="add-maxplayers" />
                </label>
            </div>
            <label class="mdui-textfield-label"><?php echo $lang['adminServermanagerT7']; ?></label>
            <select class="mdui-select" name="add-bynode" mdui-select>
                <?php echo adminListallnodeselect($db_con); ?>
            </select>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label"><?php echo $lang['adminServermanagerT8']; ?></label>
                <input class="mdui-textfield-input" type="text" name="add-byuser" />
            </div>
            <div class="mdui-textfield">
                <label class="mdui-textfield-label"><?php echo $lang['adminServermanagerT9']; ?></label>
                <input class="mdui-textfield-input" type="date" name="add-date" />
            </div>
        </div>
        <div class="mdui-dialog-actions">
            <span class="mdui-btn mdui-ripple" mdui-dialog-close><?php echo $lang['adminServermanagerT10']; ?></span>
            <input type="submit" class="mdui-btn mdui-ripple" value="<?php echo $lang['adminServermanagerT11']; ?>" />
        </div>
    </form>
</div>
<table class="mdui-table" style="margin-top: 1%">
    <thead>
        <tr>
            <th><?php echo $lang['adminServermanagerT12']; ?></th>
            <th><?php echo $lang['adminServermanagerT13']; ?></th>
            <th><?php echo $lang['adminServermanagerT14']; ?></th>
            <th><?php echo $lang['adminServermanagerT23']; ?></th>
            <th><?php echo $lang['adminServermanagerT15']; ?></th>
            <th><?php echo $lang['adminServermanagerT16']; ?></th>
            <th><?php echo $lang['adminServermanagerT17']; ?></th>
            <th><?php echo $lang['adminServermanagerT18']; ?></th>
            <th><?php echo $lang['adminServermanagerT19']; ?></th>
            <th><?php echo $lang['adminServermanagerT20']; ?></th>
            <th><?php echo $lang['adminServermanagerT21']; ?></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // 返回当前服务器列表
        adminListallserver($db_con);
        ?>
    </tbody>
</table>
<?php
    // 判断登录，防止无中生有
    if (!$_SESSION['admin_login'] == 1) {
        header('Location: /index.php');
        return '*';
    }
    // 接收创建服务器数据
    if (!empty($_POST['add-servername'])||!empty($_POST['add-serverport'])||!empty($_POST['add-rconport'])||!empty($_POST['add-maxplayers'])||!empty($_POST['add-queryport'])||!empty($_POST['add-bynode'])||!empty($_POST['add-byuser'])) {
        echo adminCreateserver($_POST['add-servername'], $_POST['add-serverport'], $_POST['add-rconport'], $_POST['add-queryport'], $_POST['add-maxplayers'], $_POST['add-byuser'], $_POST['add-bynode'], $_POST['add-date'], $db_con);
    }
    // 接收删除服务器数据
    if (!empty($_REQUEST['del-serverid'])) {
        echo adminDelserver($_REQUEST['del-serverid'], $db_con);
    }
    // 接收初始化服务器数据
    if (!empty($_REQUEST['intl-serverid'])) {
        echo adminInitserver($_REQUEST['intl-serverid'], $_SESSION['userid'], $db_con);
    }
?>

</body>

</html>