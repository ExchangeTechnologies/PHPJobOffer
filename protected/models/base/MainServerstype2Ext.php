<?php

class MainServerstype2Ext extends MainServers
{
  public function check($server_account) {
    $obj = new Servertype2Ext();
    return $obj->check($this->settings, $server_account);
  }
}
