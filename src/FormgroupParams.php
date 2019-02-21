<?php

namespace Vannyvann\Formgroup;

class FormgroupParams
{
    protected $params = [];
    protected $casts = [];
    protected $group = null;
    protected $config = [];
    protected $errors = null;
    public $error = null;

    public function __construct($params, $errors, $options, $config)
    {
        $this->params = $params;
        $this->options = $options;
        $this->errors = $errors;
        $this->config = $config;
        $this->classes = [];

        $this->replaceCasts();
        $this->replaceDefaults();
        $this->replaceError();

        return $this;
    }

    public function basicOptions($options = [])
    {
        $this->classes[] = array_get($options, 'class');
        $this->classes[] = array_get($this->get('class'), 'class');
        $params = array_merge($this->params, $options);
        $params['class'] = implode(' ',$this->classes);

        $params = $this->replaceHidden($params);

        $output = [];
        foreach($params as $key => $param){
            $output[] = $this->tagParam($key, $param);
        }

        return implode(' ', $output);
    }

    private function replaceCasts()
    {
        $casts = array_get($this->options, 'casts', []);
        foreach($casts as $index => $cast){
            if(array_get($this->params, $index)){

                // Check if param already set to avoid overwriting and save value
                if(!$this->has($cast)){
                    $this->set($cast, $this->params[$index]);
                }

                // Remove numeral index
                unset($this->params[$index]);
            }
        }
    }

    private function replaceHidden($params)
    {
        $hiddens = array_get($this->options, 'hidden', []);
        $hiddens = array_merge($hiddens, $this->config('hidden'));
        foreach ($hiddens as $hidden) {
            unset($params[$hidden]);
        }
        return $params;
    }

    private function replaceError()
    {
        $errorName = $this->nameToDotNotation($this->get('name'));

        if($this->errors && $this->errors->has($errorName)){
            $this->error = $this->errors->first($errorName);
            $this->classes[] = $this->config('error');
        }
    }

    protected function replaceDefaults()
    {
        $this->setDefaultId();
        $this->setDefaultLabel();
    }

    protected function tagParam($key, $value)
    {
        // if param set as [... 'param' => false]
        if($value === false){
            return null;
        }

        // if params set as [... 'param']
        if(is_integer($key)){
            return $value;
        }

        // if param set as [... 'param' => true]
        if($value === true){
            return $key;
        }

        // if param set as [... 'key' => 'param']
        return $key . "=\"" . $value ."\"";
    }

    public function get($name, $default = null)
    {
        return array_get($this->params, $name, $default);
    }

    public function has($name)
    {
        return array_key_exists($name, $this->params);
    }

    public function set($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function config($name, $default = null)
    {
        return array_get($this->config, $name, $default);
    }

    protected function setDefaultId()
    {
        if(!$this->has('id') && $this->config('id')){
            $this->set('id', $this->get($this->config('id')));
        }
    }

    protected function setDefaultLabel()
    {
        if(!$this->has('label') && $this->config('label.auto')){

            $label = $this->get($this->config('label.auto'));

            // Replace options
            foreach ($this->config('label.replace') as $key => $value) {
                $label = is_int($key) ?
                               str_replace($value, '', $label) :
                               str_replace($key, $value, $label);
            }

            // Apply Capitalize option (function) if set
            if($capitalize = $this->config('label.capitalize')){
                $label = $capitalize($label);
            }

            $this->set('label', $label);
        }
    }

    protected function nameToDotNotation($name)
    {
        // Get dot notation name for detecting errors,
        // so name like "name[]", "name[subname]..." will be "name", "name.subname"
        $replacements = [
            '[]' => '',
            '][' => '.',
            '[' => '.',
            ']' => ''
        ];
        foreach($replacements as $find => $replace){
            $name = str_replace($find, $replace, $name);
        }
        return $name;
    }

}
