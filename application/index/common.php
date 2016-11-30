<?php

function send_mail($to, $content) {
    echo "send mail ...\n";
}

function WebSocket($address, $port) {
    $server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    socket_set_option($server, SOL_SOCKET, SO_REUSEADDR, 1); //1表示接受所有的数据包
    socket_bind($server, $address, $port);
    socket_listen($server);
    return $server;
}
