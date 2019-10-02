<a href="/core.php?id=' . $Core['id'] . '">
    <li class="mdui-list-item mdui-ripple">
        <i class="mdui-list-item-icon mdui-icon material-icons" mdui-tooltip="{content: \'' . $typeout . '\'}">' . $icon . '</i>
        <div class="mdui-list-item-content">
            <div class="mdui-list-item-title mdui-list-item-one-line">
                ' . $Core['name'] . '
                <div class="mdui-typo-subheading-opacity">' . $Core['version'] . '
                </div>
            </div>
            <div class="mdui-list-item-text mdui-list-item-one-line">' . $Core['shortdes'] . '</div>
            <div class="mdui-list-item-text mdui-list-item-one-line"><i class="mdui-icon material-icons">account_circle</i>上传者:' . User::getUserInfo($Core['uploader'])['nickname'] . '&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdui-icon material-icons">assessment</i>版本:&nbsp;' . $Core['version'] . '</div>
        </div>
        <a class="mdui-hidden-lg-down" href="/down.php?id=' . $Core['id'] . '"><button class="mdui-hidden-sm-down mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">cloud_download</i>&nbsp;下载</button></a>
        <a class="mdui-hidden-xl" href="/down.php?id=' . $Core['id'] . '"><button class="mdui-hidden-sm-up mdui-btn mdui-btn-icon mdui-btn-raised mdui-ripple mdui-color-theme-accent"><i class="mdui-icon material-icons">cloud_download</i></button></a>
    </li>
</a>