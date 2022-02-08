<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class ModalsResponse extends JsonResponse
{
    public const SUCCESS = 'success';
    public const INFO = 'info';
    public const WARNING = 'warning';
    public const ERROR = 'error';

    public const SUCCESS_CHANGED = 'You have successfully changed!';
    public const SUCCESS_CREATED = 'You have successfully created!';
    public const SUCCESS_UPDATED = 'You have successfully updated!';
    public const SUCCESS_DELETED = 'You have successfully deleted!';

    public const CHANGE_FAILED = 'You have change failed!';
    public const CREATE_FAILED = 'You have create failed!';
    public const UPDATE_FAILED = 'You have update failed!';
    public const DELETE_FAILED = 'You have delete failed!';

    public function __construct($message, $data = [], string $type = self::SUCCESS, string $title = null, array $options = [])
    {
        $data['toast'] = [
            'message' => __($message),
            'type' => $type,
            'title' => empty($title)?null:__($title),
            'options' => $options
        ];
        parent::__construct($data, 200, [], 0);
    }

    public function setTitle($title): ModalsResponse
    {
        $original = $this->original;
        $original['toast']['title'] = __($title);
        $this->setData($original);
        return $this;
    }

    public function withData($data): ModalsResponse
    {
        $original = array_merge($this->original, $data);
        $this->setData($original);
        return $this;
    }

    public function setType($type): ModalsResponse
    {
        $original = $this->original;
        $original['toast']['type'] = $type;
        $this->setData($original);
        return $this;
    }

    public function setOption($option): ModalsResponse
    {
        $original = $this->original;
        $original['toast']['option'] = $option;
        $this->setData($original);
        return $this;
    }
}
