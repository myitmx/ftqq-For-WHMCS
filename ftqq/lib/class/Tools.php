<?php
namespace Myitmx\ftqq;

use WHMCS\Database\Capsule;
class Tools
{
    public function getModuleVars($var = "")
    {
        $var = (string) trim($var);
        if (empty($var)) {
            throw new \Exception("未传入需要获取的模块变量");
        }
        $value = \Illuminate\Database\Capsule\Manager::table("tbladdonmodules")->where("module", "ftqq")->where("setting", $var)->first()->value;
        return $value;
    }
    public function sc_send($text, $desp)
    {
        $sckey = Tools::getModuleVars("SCKEY");
        $postdata = http_build_query(array('text' => $text, 'desp' => $desp));
        $opts = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
        $context = stream_context_create($opts);
        $result = file_get_contents('http://sc.ftqq.com/' . $sckey . '.send', false, $context);
    }
    public function hooks()
    {
        add_hook('TicketOpen', 1, function ($vars) {
            $new = Tools::getModuleVars("new");
            if ($new == "on") {
                $text = "有客户新建了工单";
                $desp = "**" . "用户ID为：" . $vars["userid"] . "** 的客户在新建的工单 「" . $vars["subject"] . "」中说到: \n\n > " . $vars["message"];
                $result = Tools::sc_send($text, $desp);
            }
        });
        add_hook('TicketUserReply', 1, function ($vars) {
            $reply = Tools::getModuleVars("reply");
            if ($reply == "on") {
                $text = "有客户回复了工单";
                $desp = "**" . "用户ID为：" . $vars["userid"] . "** 的客户在工单 「" . $vars["subject"] . "」中回复到: \n\n > " . $vars["message"];
                $result = Tools::sc_send($text, $desp);
            }
        });
    }
}