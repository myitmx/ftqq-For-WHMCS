<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}
function ftqq_config()
{
    return ['name' => '工单提醒', 'description' => '此插件将工单状态通过 <a target="_blank" href="https://sc.ftqq.com/">方糖</a> 推送到微信', 'author' => '<a target="_blank" href="https://www.myitmx.com/">Myitmx</a>', 'version' => '1.0', 'fields' => ['SCKEY' => ['FriendlyName' => '方糖SCKEY', 'Type' => 'text', 'Size' => '254', 'Description' => '请填写您在方糖获取的SCKEY 没有SCKEY？<a target="_blank" href="http://sc.ftqq.com/?c=code">点此获取</a>'], 'new' => ['FriendlyName' => '新建工单提醒', 'Type' => 'yesno', 'Description' => '勾选后，用户新建工单时推送到微信通知'], 'reply' => ['FriendlyName' => '回复工单提醒', 'Type' => 'yesno', 'Description' => '勾选后，用户回复工单时推送到微信通知']]];
}
function ftqq_activate()
{
    return array('status' => 'success', 'description' => '插件激活成功');
}
function ftqq_deactivate()
{
    return array('status' => 'success', 'description' => '插件关闭成功');
}