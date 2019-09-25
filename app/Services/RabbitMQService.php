<?php

namespace App\Services;
use PhpAmqpLib\Connection\AMQPConnection;

/**
 * Class RabbitMQService
 * @package App\Services
 */
class RabbitMQService
{
    /**
     * @var
     */
    public $channel;
    /**
     * @var
     */
    public $connection;

    /**
     * @return bool
     */
    public function connectionRabbit(){
        $this->connection = new AMQPConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            env('RABBITMQ_LOGIN'),
            env('RABBITMQ_PASSWORD'),
            env('RABBITMQ_VHOST')
        );

        $this->channel = $this->connection->channel();

        return true;
    }

    /**
     * @return bool
     */
    public function closeRabbit(){
        $this->channel->close();
        $this->connection->close();

        return true;
    }

    /**
     * @param string $queue
     * @param bool $passive
     * @param bool $durable
     * @param bool $exclusive
     * @param bool $auto_delete
     * @return bool
     */
    public function queueDeclare($queue = '', $passive = false, $durable = false, $exclusive = false, $auto_delete = true){

        $this->channel->queue_declare(
            $queue,    #queue - Queue names may be up to 255 bytes of UTF-8 characters
            $passive,              #passive - can use this to check whether an exchange exists without modifying the server state
            $durable,               #durable, make sure that RabbitMQ will never lose our queue if a crash occurs - the queue will survive a broker restart
            $exclusive,              #exclusive - used by only one connection and the queue will be deleted when that connection closes
            $auto_delete               #auto delete - queue is deleted when last consumer unsubscribes
        );

        return true;
    }

    /**
     * @param $exchange
     * @param $type
     * @param bool $passive
     * @param bool $durable
     * @param bool $auto_delete
     * @return bool
     */
    public function exchangeDeclare($exchange, $type, $passive = false, $durable = false, $auto_delete = true){

        $this->channel->exchange_declare(
            $exchange,
            $type,
            $passive,
            $durable,
            $auto_delete
        );

        return true;
    }

}