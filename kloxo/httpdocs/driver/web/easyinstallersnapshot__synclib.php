<?php 

class easyinstallersnapshot__sync extends \Lxdriverclass
{
    function dbactionDelete()
    {
        \lxfile_rm_rec("{$this->main->__var_snapbase}/{$this->main->nname}");
    }
    static function getSnapList($path)
    {
        if (!\file_exists($path)) {
            return \null;
        }
        $list = \lscandir_without_dot($path);
        if (!$list) {
            return \null;
        }
        foreach ($list as $l) {
            $res['nname'] = $l;
            $rmt = \lfile_get_unserialize("{$path}/{$l}/metadata.data");
            list($res['appname'], $res['ddate']) = array_reverse(\explode("-", $l));
            $res['app_real_nname'] = $rmt->data->nname;
            $res['app_real_date'] = $rmt->data->ddate;
            $ret[$l] = $res;
        }
        return $ret;
    }
}
