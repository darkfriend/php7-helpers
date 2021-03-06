<?php
/**
 * Created by PhpStorm.
 * User: darkfriend <hi@darkfriend.ru>
 * Date: 07.04.2021
 * Time: 16:27
 */

namespace darkfriend\helpers;


class HeaderCollection
{
    private $_headers = [];

    public function __construct($init=true)
    {
        if($init) {
            $this->init();
        }
    }

    protected function init()
    {
        if (\function_exists('getallheaders')) {
            $headers = \getallheaders();
            foreach ($headers as $name => $value) {
                $this->add($name, $value);
            }
        } elseif (\function_exists('http_get_request_headers')) {
            $headers = \http_get_request_headers();
            foreach ($headers as $name => $value) {
                $this->add($name, $value);
            }
        } else {
            foreach ($_SERVER as $name => $value) {
                if (\strncmp($name, 'HTTP_', 5) === 0) {
                    $name = \str_replace(
                        ' ',
                        '-',
                        \ucwords(
                            \strtolower(
                                \str_replace('_', ' ', \substr($name, 5))
                            )
                        )
                    );
                    $this->add($name, $value);
                }
            }
        }
    }

    public function get($name, $default = null, $first = true)
    {
        $name = \strtolower($name);
        if (isset($this->_headers[$name])) {
            return $first ? \reset($this->_headers[$name]) : $this->_headers[$name];
        }

        return $default;
    }

    public function set($name, $value = ''): self
    {
        $name = \strtolower($name);
        $this->_headers[$name] = (array) $value;

        return $this;
    }

    public function add($name, $value): self
    {
        $name = \strtolower($name);
        $this->_headers[$name][] = $value;

        return $this;
    }

    public function getCount(): int
    {
        return \count($this->_headers);
    }

    public function has($name): bool
    {
        $name = \strtolower($name);
        return isset($this->_headers[$name]);
    }

    public function remove($name)
    {
        $name = \strtolower($name);
        if (isset($this->_headers[$name])) {
            $value = $this->_headers[$name];
            unset($this->_headers[$name]);
            return $value;
        }

        return null;
    }

    public function removeAll()
    {
        $this->_headers = [];
    }
}