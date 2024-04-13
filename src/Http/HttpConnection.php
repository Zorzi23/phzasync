<?php

namespace Http;

class HttpConnection {


    /**
     * 
     * @return void
     */
    public static function closeConnection() {
        header('Content-Enconding: none');
        header('Connection: close');
        header(sprintf('Content-Length: %s', ob_get_length()));
    }

    /**
     * 
     * @return void
     */
    public static function flush() {
        ob_end_flush();
        flush();
    }

}