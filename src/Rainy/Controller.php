<?php

/**
 * Rainy - A Light-Weight PHP Framework For Beginner
 *
 * @package  RainyFramework
 * @author   Dinh Phong <dinhphong.developer@gmail.com>
 *
 */

namespace Rainy;

class Controller
{
    /**
     * Model class
     */
    protected $model;

    /**
     * Trying to get Model class
     *
     * @param string $model
     *
     * @return \Rainy\Model Object
     * @return Exception Model not exists
     */
    protected function getModel($model)
    {
        if(file_exists("app/model/" . $model . EXT)) {

            $model = "app\\model\\".$model;

            return new $model;

        } else {
            throw new \Exception("The model: {$model} not exists");
        }
    }

    /**
     * Public call model on controller
     * @param String $model
     *
     * @return Object Model
     * @return echo Exception
     */
    public function model($model)
    {
        try {
            $this->model =  $this->getModel($model);
            return $this->model;
        } catch (\Exception $e) {
            echo 'Caught exception: '. $e->getMessage() . "\n";
        }
    }

    /**
     * Trying to require view file
     *
     * @param string $view
     * @param array $data
     *
     * @return require view file
     * @return Exception view not exists
     */
    protected function getView($view, $data = [])
    {
        if(file_exists("app/View/" . $view . EXT)) {

            return require("app/View/" . $view . EXT);

        } else {
            throw new \Exception("The view: {$view} not exists");
        }
    }

    /**
     * Public call view on controller
     *
     * @param string $view
     * @param array $data
     *
     * @return require view file
     * @return Exception view not exists
     */
    public function view($view, $data = [])
    {
        try {
            $this->getView($view, $data);
        } catch (\Exception $e) {
            echo 'Caught exception: '. $e->getMessage() . "\n";
        }
    }
}