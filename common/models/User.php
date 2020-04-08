<?php

namespace common\models;

use benbanfa\user\UserInterface;
use benbanfa\user\UserTrait;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements UserInterface
{
    use UserTrait;

    private $loginIdTypeCode;

    private $loginIdName;

    public function getRaddyDisplayName()
    {
        return $this->id;
    }

    public function setLoginIdTypeCode($loginIdTypeCode)
    {
        $this->loginIdTypeCode = $loginIdTypeCode;

        return $this;
    }

    public function getLoginIdTypeCode(): string
    {
        return $this->loginIdTypeCode ? $this->loginIdTypeCode : ($this->loginId ? $this->loginId->typeCode : '');
    }

    public function setLoginIdName($loginIdName)
    {
        $this->loginIdName = $loginIdName;

        return $this;
    }

    public function getLoginIdName(): string
    {
        return $this->loginIdName ? $this->loginIdName : ($this->loginId ? $this->loginId->name : '');
    }

    public function getLoginId()
    {
        return $this->hasOne(LoginId::class, ['userId' => 'id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createTime', 'updateTime'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updateTime'],
                ],
                'value' => date('Y-m-d H:i:s', time()),
            ],
        ];
    }

    public function rules()
    {
        $rules = [
            [[
                'loginIdTypeCode',
                'loginIdName',
                'isFlagged',
            ], 'required'],
            [['loginIdTypeCode', 'loginIdName', 'password'], 'string'],
        ];

        if (empty($this->id)) {
            $rules[] = [['password'], 'required'];
        }

        return $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键ID',
            'loginIdTypeCode' => '登录身份',
            'loginIdName' => '登录名称',
            'password' => '登录密码',
            'isFlagged' => '是否无效',
            'createTime' => '创建时间',
            'updateTime' => '更新时间',
        ];
    }
}
