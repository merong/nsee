<?php

class RedisCache
{

    protected $config;

    protected $data_store;

    protected $use_redis = false;

    protected $default_key_prefix = "sql_cache:";

    protected $default_host = "127.0.0.1";
    protected $default_port = 6379;

    protected $is_debug = false;
    protected $debug_info = array();
    protected $time_elapsed_last;

    public function __construct($data_store=NULL) {
        $this->time_elapsed_last = microtime(true);
        if (!$data_store instanceof Redis) {
            try {
                $this->add_debug_info("[" . __METHOD__ . "()] redis 서비스에 접속합니다.");
                $redis = new Redis();
                $redis->connect($this->default_host, $this->default_port, 5);
                $this->data_store = $redis;
                $this->use_redis = true;
            } catch (Exception $e) {
                $this->use_redis = false;
                $this->add_debug_info("[" . __METHOD__ . "()] ".$e->getMessage(). " redis 서버에 접속할수 없습니다.");
            }
        } else {
            $this->add_debug_info("[" . __METHOD__ . "()] 기존 redis 객체를 사용합니다.");
            $this->data_store = $data_store;
            $this->use_redis = true;
        }
    }

    public function select($db_index) {
        if($this->use_redis) {
            $this->data_store->select($db_index);
        }
    }

    public function __destruct() {

    }

    public function set_debug($is_debug) {
        $this->is_debug = $is_debug;
    }

    public function add($key, $value, $ttl=0) {
        $value = $this->serialize($value);

    }


    public function delete($key) {
        return (bool) $this->data_store->delete($key);
    }


    public function get($key, $default=NULL) {
        $value = $this->data_store->get($key);
        if ($value === FALSE) { return $default; }
        return $value;
    }

    public function serialize($value) {
        return serialize($value);
    }

    public function set($key, $value, $ttl=60) {

        try {
            if($ttl == 0) {
                return $this->data_store->set($key, $value);
            } else {
                return $this->data_store->setex($key, $ttl, $value);
            }
        } catch(Exception $e){
            $this->add_debug_info($e->getMessage());
            return false;
        }
    }

    public function exists($key) {
        try {
            return $this->data_store->exists($key);
        }catch(Exception $e){
            $this->add_debug_info($e->getMessage());
            return false;
        }
    }

    public function ttl($key) {
        try {
            return $this->data_store->ttl($key);
        }catch(Exception $e){
            $this->add_debug_info($e->getMessage());
            return false;
        }
    }

    /**
     * 캐시를 강제로 지운다.
     * @param null $key
     */
    public function clean_query_cache($key = NULL) {
        if($key == NULL) {
            //key 를 지정하지 않은 경우 query문을 이용한 md5 해쉬키를 생성한다.
            //동일한 쿼리라면, 동일한 hash key 가 생성됨.
            $key = $this->default_key_prefix;
        }
        $all_keys =  $this->data_store->keys("{$key}*");
        foreach ($all_keys as $key) {
            $this->add_debug_info("[".__METHOD__."()] $key delete..");
            $this->delete($key);
        }
    }

    /**
     * @param $query sql 쿼리문
     * @param int $ttl cache 만료시간 (초단위)
     * @param null $key cache key
     * @return array|mixed|null
     */
    public function get_query_cache($query, $ttl=60, $key=NULL ) {
        $list = array();

        if($this->debug) {
            $this->get_time_elapsed();
        }

        if($this->use_redis == false) {
            $this->add_debug_info("[" . __METHOD__ . "()] not used redis cache");
            return $this->get_query_result($query);
        } else {
            if ($key == NULL) {
                //key 를 지정하지 않은 경우 query문을 이용한 md5 해쉬키를 생성한다.
                //동일한 쿼리라면, 동일한 hash key 가 생성됨.
                $key = $this->default_key_prefix.hash("md5", $query);

            }

            if($this->is_debug) {
                $this->add_debug_info("[" . __METHOD__ . "()] cache_exist = " . $this->data_store->exists($key) . ", ttl=" . $this->data_store->ttl($key));
            }
            if ($this->exists($key) && $this->ttl($key) > 0) { //캐시가 만료되지 않았다면,
                $result = $this->get($key);
                $list = $this->unserialize($result);
                $this->add_debug_info("[" . __METHOD__ . "()] cache_key = $key HIT!!!");
            } else {
                //만료된 경우 캐시에 저장한다.
                $list = $this->get_query_result($query);
                $value = $this->serialize($list);
                $this->set($key, $value, $ttl);
                $this->add_debug_info("[" . __METHOD__ . "()] cache_key = $key NEW");
            }
        }

        $this->add_debug_info("[" . __METHOD__ . "()] exec_time =  " . $this->get_time_elapsed());

        return $list;
    }

    function get_query_result($query) {
        $this->add_debug_info("[" . __METHOD__ . "()] exec query = ".$query);
        $result = sql_query($query);
        while(($row = sql_fetch_array($result)) != null) {
            $list[] = $row;
        }
        return $list;
    }

    public function unserialize($value) {
        return unserialize($value);
    }

    public function get_debug_info() {
        return $this->debug_info;
    }

    function add_debug_info($comment) {
        $this->debug_info[] = "DEBUG ".date("Y-m-d H:i:s")." ".$comment;
    }

    function get_time_elapsed() {

        // $unit="s"; $scale=1000000; // output in seconds
        // $unit="ms"; $scale=1000; // output in milliseconds


        $now = microtime(true);

        $exec_time =   round(($now - $this->time_elapsed_last)*1000000)/1000;

        $this->time_elapsed_last = $now;

        return sprintf("%.3f", $exec_time / 1000)."s";
    }


}
