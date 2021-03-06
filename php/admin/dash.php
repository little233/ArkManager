<?php
require_once('../config/config.php');
require_once('../config/admin_theme.php');
require_once('checkuser.php');
require_once('../config/functions.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php mduiHead($lang['adminDashTitle']); ?>
</head>
<?php mduiBody(); mduiHeader($lang['adminDashheader']); mduiMenu(); ?>
<h1 class="mdui-text-color-theme"><?php echo $lang['adminDashT1']; ?></h1>
<form name="adduser" method="post" action="dash.php">
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label"><?php echo $lang['adminDashT2']; ?></label>
        <input class="mdui-textfield-input" type="text" name="add-username" required />
    </div>
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label"><?php echo $lang['adminDashT3']; ?></label>
        <input class="mdui-textfield-input" type="password" name="add-password" required />
    </div>
    <input type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" value="添加" />
</form>
<?php
    // 接收添加用户数据
    if (!empty($_POST['add-username'])||!empty($_POST['add-password'])) {
        echo adminAdduser($_POST['add-username'],md5($_POST['add-password']),$db_con);
    }
?>
<h1 class="mdui-text-color-theme"><?php echo $lang['adminDashT4']; ?></h1>
<form name="deluser" method="post" action="dash.php">
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label"><?php echo $lang['adminDashT5']; ?></label>
        <input class="mdui-textfield-input" type="text" name="del-username" required />
    </div>
    <input type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" value="我确认删除！" />
</form>
<?php
    // 接收删除用户数据
    if (!empty($_POST['del-username'])) {
        echo adminDeluser($_POST['del-username'],$db_con);
    }
?>
</body>

</html>