<?php

class MainServerstype1Ext extends MainServers
{
  public function check($server_account) {
    $obj = new Servertype1Ext();    
    return $obj->check($this->settings, $server_account);
  }
}
