<?php

class CustomDataProvider extends CActiveDataProvider
{
  public $customCriteria = array();

  protected function fetchData() {
    //$origin_data = parent::fetchData();
    
    $criteria=clone $this->getCriteria();
		$baseCriteria=$this->model->getDbCriteria(false);
    $validation_sort_direction = null;
    
		if(($sort=$this->getSort())!==false)
		{
      $direction = $sort->getDirections();
      
      $validation_sort_direction = isset($direction['validation_search']) ? $direction['validation_search'] : null;
      if (!isset($validation_sort_direction)) {
        // set model criteria so that CSort can use its table alias setting
        if($baseCriteria!==null)
        {
          $c=clone $baseCriteria;
          $c->mergeWith($criteria);
          $this->model->setDbCriteria($c);
        }
        else
          $this->model->setDbCriteria($criteria);
        $sort->applyOrder($criteria);
      }
		}

		$this->model->setDbCriteria($baseCriteria!==null ? clone $baseCriteria : null);
		$origin_data=$this->model->findAll($criteria);
		$this->model->setDbCriteria($baseCriteria);  // restore original criteria            
   
    $data = array();
    $sort_array = array();
    foreach ($origin_data as $value) { 
      if (isset($this->customCriteria['Validation']) && strlen($this->customCriteria['Validation']) > 0) {
        if ($value->Validation == $this->customCriteria['Validation']) {
          $data[] = $value;
          $sort_array[] = $value->Validation;
        }
      } else {
        $data[] = $value;
        $sort_array[] = $value->Validation;
      }            
    }
    
    if (isset($validation_sort_direction)) {
      if (!$validation_sort_direction) {
        asort($sort_array);
      } else {
        arsort($sort_array);
      }
            
      foreach ($sort_array as $k => &$v) {
        $v = $data[$k];
      }
      $data = $sort_array;
    }
   
    if(($pagination=$this->getPagination())!==false)
		{
      $this->setTotalItemCount(count($data));
      $pagination->setItemCount(count($data));
      
      $limit = $pagination->getLimit();
      $offset = $pagination->getOffset(); 
      $data = array_slice($data, $offset, $limit);      
		}
    
    return $data;
  }

}