<?php

/**
 * Loads the views and controllers
 * Class Controller
 */
abstract class Controller {
      /**
       * This function expects the name of a model to charge.
       * The model is a class in charge of managing all the data of a
       * specific genre..
       * @param $model name of the model to load
       * @return mixed model to laod
       */
      public function model($model){
      // Require model file
      require_once '../app/models/' . $model . '.php';

      // Instantiate model
      return new $model();
    }

      /**
       * The view function takes a path to a view in the views folder.
       * You have the option to pass an array of data from the controller
       * which can then be accessed on the .php file assigned. A good example
       * of this behaviour is the Pages.php controller and it's corresponding view.
       * @param $view name of the view to load
       * @param array $data
       */
      public function view($view, array $data = []){
      // Check for view file
      if(file_exists('../app/views/' . $view . '.php')){
        require_once '../app/views/' . $view . '.php';
      } else {
        // View does not exist
        die('View does not exist');
      }
    }
  }