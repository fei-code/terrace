<?php

namespace app\facade;

class HtmlForm
{

    public function getType()
    {
        return [
            1 => '文本[text]',
            2 => '数字[number]',
            3 => '密码[password]',
            4 => '身份证[id_card]',
            5 => '网址[url]',
            6 => 'IP地址[ip]',
            7 => '文本域[textarea]',
            8 => '复选框[checkbox]',
            9 => '开关[switch]',
            10 => '单选[radio]',
            11 => '选择列表[select]',
            12 => '图片上传[image]',
            13 => '文件上传[file]',
            14 => '日期[date]',
            15 => '日期时间[datetime]',
            16 => '日期时间范围[datetime_range]',
            17 => '年[year]',
            18 => '年范围[year_range]',
            19 => '年月[year_month]',
            20 => '年月范围[year_month_range]',
            21 => '富文本编辑器[editor]',
            22 => '多选择[multi_select]'
        ];
    }

    private $name;
    private $field;
    private $value = '';
    private $row = 3;
    private $option;

    public function column($name, $field)
    {
        $this->name = $name;
        $this->field = $field;
        return $this;
    }

    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function row($row)
    {
        $this->row = $row;
        return $this;
    }

    public function options($option)
    {
        $this->option = $option;
    }


    public function text()
    {
        return <<< EOD
<div class="form-group">
    <label for="{$this->field}" class="col-sm-2 control-label">{$this->name}</label>
    <div class="col-sm-10 col-md-4">
        <input id="{$this->field}" name="{$this->field}" value="{$this->value}" placeholder="请输入{$this->name}" type="text" class="form-control field-text">
    </div>
</div>

EOD;

    }

    public function number()
    {
        return <<< EOD
<div class="form-group">
    <label for="{$this->name}" class="col-sm-2 control-label">{$this->name}</label>
    <div class="col-sm-10 col-md-4">
         <div class="input-group">
            <input id="{$this->field}" name="{$this->field}" value="{$this->value}" placeholder="请输入{$this->name}" type="number" class="form-control field-number">
        </div>
    </div>
</div>
<script>
    $('#{$this->field}')
        .bootstrapNumber({
            upClass: 'success',
            downClass: 'primary',
            center: true
        });
</script>

EOD;

    }

    public function password()
    {
        return <<<EOD
<div class="form-group">
    <label for="{$this->field}" class="col-sm-2 control-label">{$this->name}</label>
    <div class="col-sm-10 col-md-4">
        <input id="{$this->field}" name="{$this->field}" value="{$this->value}" placeholder="请输入{$this->name}" type="password" class="form-control field-password">
    </div>
</div>
EOD;
    }

    public function id_card()
    {
        return <<<EOD
<div class="form-group">
    <label for="{$this->field}" class="col-sm-2 control-label">{$this->name}</label>
    <div class="col-sm-10 col-md-4">
        <input id="{$this->field}" name="{$this->field}" value="{$this->value}" placeholder="请输入{$this->name}" type="text" maxlength="18" class="form-control field-id-card">
    </div>
</div>
EOD;

    }

    public function url()
    {
        return <<<EOD
<div class="form-group">
    <label for="{$this->field}" class="col-sm-2 control-label">{$this->name}</label>
    <div class="col-sm-10 col-md-4">
        <input id="{$this->field}" name="{$this->field}" value="{$this->value}" placeholder="请输入{$this->name}" type="text" class="form-control field-map">
    </div>
</div>
EOD;

    }

    public function ip()
    {
        return <<<EOD
<div class="form-group">
    <label for="{$this->field}" class="col-sm-2 control-label">{$this->name}</label>
    <div class="col-sm-10 col-md-4">
        <input id="{$this->field}" name="{$this->field}" value="{$this->value}" placeholder="请输入{$this->name}" type="text" class="form-control field-map">
    </div>
</div>

EOD;

    }

    public function textarea()
    {
        return <<<EOP
<div class="form-group">
    <label for="{$this->field}" class="col-sm-2 control-label">{$this->name}</label>
    <div class="col-sm-10 col-md-4">
        <textarea id="{$this->field}" name="{$this->field}" class="form-control" rows="{$this->row}" placeholder="请输入{$this->name}">{$this->value}</textarea>
    </div>
</div>
EOP;

    }


    public function checkbox()
    {
        $a1 = <<<EOP
<div class="form-group">
    <label class="col-sm-2 control-label">{$this->name}</label>
    <div class="col-sm-10 col-md-4">
        <div class="checkbox">
            <label>
EOP;
        if (count($this->option) == 0) {
            $a2 = '     <input type="checkbox" name="{$this->field}[]" class="field-checkbox"> {$this->value}';
        } else {
            $a2 = '';
            foreach ($this->option as $value) {
                $a2 .= ' <input type="checkbox" name="{$this->field}[]" class="field-checkbox"> {$value}';
            }
        }
        $a3 = <<<EOP
        </label>
        </div>
    </div>
</div>
EOP;

        return $a1 . $a2 . $a3;

    }

    public function select()
    {

    }



}