<?php
/**
 * Created by PhpStorm.
 * User: darkfriend <hi@darkfriend.ru>
 * Date: 03.09.2019
 * Time: 17:58
 */

namespace darkfriend\helpers;


use \ErrorException;

/**
 * Class ReCaptchaHelper
 * @package darkfriend\helpers
 * @author darkfriend <hi@darkfriend.ru>
 * @version 1.0.0
 * @since 1.0.3
 */
class ReCaptchaHelper
{
    use Singleton;
    /** @var string Публичный ключ */
    protected $publicToken = '';
    /** @var string Приватный ключ */
    protected $secretToken = '';
    /** @var string Ссылка на верификацию */
    protected $url = 'https://www.google.com/recaptcha/api/siteverify';
    /** @var null|string */
    protected $remoteIp = null;

    protected $errorCodes = [
        'missing-input-secret' => 'The secret parameter is missing',
        'invalid-input-secret' => 'The secret parameter is invalid or malformed',
        'missing-input-response' => 'The response parameter is missing',
        'invalid-input-response' => 'The response parameter is invalid or malformed',
        'bad-request' => 'The request is invalid or malformed',
        'timeout-or-duplicate' => 'The response is no longer valid: either is too old or has been used previously',
    ];

    public function __construct($params = [])
    {
        if($params) {
            $this->setParams($params);
        }
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams($params)
    {
        foreach ($params as $param=>$valParam) {
            if(!property_exists($this,$param)) continue;
            $this->$param = $valParam;
        }
        return $this;
    }

    /**
     * @param string $token
     * @param array $params = [
     *     'publicToken' => '',
     *     'secretToken' => '',
     *     'remoteIp' => '',
     * ]
     * @return bool
     * @throws ErrorException
     */
    public static function verify($token, $params=[])
    {
        return self::getInstance()->setParams($params)->getResult($token);
    }

    /**
     * @param string $token
     * @return bool
     * @throws ErrorException
     */
    public function getResult($token)
    {
        if(empty($this->secretToken)) {
            throw new ErrorException('Secret Token is empty');
        }
        if(empty($token)) {
            throw new ErrorException('Token is empty');
        }
        $resp = CurlHelper::getInstance()->request(
            $this->url,
            [
                'secret' => $this->secretToken,
                'response' => $token,
                'remoteip' => $this->remoteIp ?? $_SERVER['REMOTE_ADDR'],
            ]
        );
        if(!$resp) {
            throw new ErrorException(
                'Error request to reCaptcha!',
                CurlHelper::getInstance()->lastCode
            );
        }
        if(empty($resp['success'])) {
            throw new ErrorException(
                'reCaptcha: '
                .ErrorHelper::toStr(
                    $this->getErrorByCode($resp['error-codes'])
                )
            );
        }
        return true;
    }

    /**
     * Return human error text
     * @param mixed $error
     * @return mixed
     */
    public function getErrorByCode($error)
    {
        if(is_array($error)) {
            foreach ($error as &$item) {
                $item = $this->getErrorByCode($item);
            }
            unset($item);
        } else {
            $error = $this->errorCodes[$error];
        }
        return $error;
    }

    /**
     * @return string
     */
    public function getPublicToken()
    {
        return $this->publicToken;
    }
}