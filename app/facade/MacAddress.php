<?php

namespace app\facade;

class MacAddress
{

    public $result = [];
    public $macAddrs = [];
    public $macAddr;



    public function get()
    {
        $this->getMac();

       return $this->macAddr;
    }


    private function GetMac()
    {
        $os = PHP_OS;
        switch (strtolower($os)) {
            case "unix":
                break;
            case "solaris":
                break;
            case "aix":
                break;
            case "linux":
                $this->getLinux();
                break;
            default:
                $this->getWindows();
                break;
        }
        $tem = array();
        foreach ($this->result as $val) {
            if (preg_match("/[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f][:-]" . "[0-9a-f][0-9a-f]/i", $val, $tem)) {
                $this->macAddr = $tem[0];//多个网卡时，会返回第一个网卡的mac地址，一般够用。
                break;
                //$this->macAddrs[] = $temp_array[0];//返回所有的mac地址
            }
        }
        unset($temp_array);
        return $this->macAddr;
    }

    //Linux系统
    function getLinux()
    {
        @exec("ifconfig -a", $this->result);
        return $this->result;
    }

    //Windows系统
    function getWindows()
    {
        @exec("ipconfig /all", $this->result);
        if ($this->result) {
            return $this->result;
        } else {
            $ipconfig = $_SERVER["WINDIR"] . "\system32\ipconfig.exe";
            if (is_file($ipconfig)) {
                @exec($ipconfig . " /all", $this->result);
            } else {
                @exec($_SERVER["WINDIR"] . "\system\ipconfig.exe /all", $this->result);
                return $this->result;
            }
        }
    }

}