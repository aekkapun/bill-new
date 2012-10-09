<?php
/**
 * User: Denis A Boldinov
 * Date: 10/3/12
 * Time: 4:12 PM
 */

require_once(__DIR__ . '/vendor/symfony/Symfony/Component/ClassLoader/UniversalClassLoader.php');
use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'PhpAmqpLib' => __DIR__,
));
$loader->register();

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Amqp extends CApplicationComponent
{
    public $host = '127.0.0.1';

    public $port = 5672;

    public $user = 'guest';

    public $pass = 'guest';

    public $vhost = '/';

//    public $exchange = '';

    public $queue = 'report';

    private $_connection;

    private $_channel;

    public function init()
    {
        $this->connect();
        parent::init();
    }

    public function getChannel()
    {
        return $this->_channel;
    }

    public function getConnection()
    {
        return $this->_connection;
    }

    public function connect()
    {
        $this->_connection = new AMQPConnection($this->host, $this->port, $this->user, $this->pass, $this->vhost);
        $this->_channel = $this->_connection->channel();
//        $this->getChannel()->queue_declare($this->queue, false, true, false, false);
//        $this->getChannel()->exchange_declare($this->exchange, 'direct', false, true, false);
//        $this->getChannel()->queue_bind($this->queue, '', 'report');
    }

    public function publish($body, $properties = array())
    {
        $message = new AMQPMessage($body, $properties);
        $this->getChannel()->basic_publish($message, '', 'report');
    }
}
