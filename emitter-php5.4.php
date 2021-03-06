<?php
class Socket_Emitter{
     private static $key = 'socket.io#emitter';
     private static $redis;
     public static $namespace;
     public static function init($redis,$namespace = '/'){
          self::$redis = $redis;
          self::$namespace = $namespace;
     }
     public static function emit($rooms){
          self::$redis->publish(self::$key, msgpack_pack([[
               'type' => 2,
               'data' => array_slice(func_get_args(),1),
               'nsp' => self::$namespace
          ], [
               'rooms' => $rooms,
               'flags' => []
          ]]));
     }
};