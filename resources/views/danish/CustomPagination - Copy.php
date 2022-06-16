<?php 

// pagination click
// custom form Search With Desired Operator like > or <
// ajax part has to be separate 

class CustomPagination extends CApplicationComponent{
    
	public $table_name;
	public $url;
	public $default_condition;
	public $custom_form;
	public $columns;
	public $searching_columns;
	public $searched_word;
	public $page_size;
	public $page;
	public $condition_sign;
	public $order_by;
	public $join;
	public $operators;
	
	public function GetDataWithPaging(){
		
		 $per_page = (int)(empty($this->page_size) ? 10 : $this->page_size);		
         $startpoint = ($this->page * $per_page) - $per_page;
		
		$criteria = new CDbCriteria;
		$c2 =new CDbCriteria;
		
		if(!empty($this->default_condition)){
		$criteria->addCondition($this->default_condition);
		}else{
		$criteria->addCondition('1=1');	
		}
		$columns = implode(",",$this->columns);
		
		$table_name = $this->table_name;
		
		
		$query = Yii::app()->db->createCommand()
				->select($columns)
				->from($table_name);
		
		// performing join
		if(!empty($this->join)){
			$query = $this->PerformJoin($query);			
		}		
		// performing like OR Search
		if(!empty($this->searched_word) && $this->searched_word != 'empty'){
			
			foreach($this->searching_columns as $key => $value){
				$c2->compare($value,$this->searched_word,true,'OR');
			}
			$criteria->addCondition($c2->condition);
			$criteria->params+=$c2->params;	
		
			//http://www.yiiframework.com/wiki/610/how-to-create-a-criteria-condition-for-a-multiple-value-text-search-i-e-a-like-in/
		
		}else if (!empty($this->custom_form) ){
		
			// Performing Custom Form Search with AND	
			$operators = (!empty($this->operators) ? $this->operators : null);
			$form_condition = $this->Create_condition_of_custom_form( $this->custom_form, $operators );
			$criteria->addCondition($form_condition);

		}
		
		 //print_r($criteria);return $criteria;		
		$query_half = $query->where($criteria->condition, $criteria->params)
				
		//->group('AccountId,CharityId')
		->limit($per_page, $startpoint);
		//print_r($query_half);return $criteria;	
		$results = $query_half->queryAll();
		//print_r($results);return $criteria;				
		$dataa['data'] = $results;		
		
		
		
		$dataa['pagination'] = $this->GetPaging($per_page,$this->page,$this->url,$this->searched_word,$this->condition_sign);
		
		return $dataa;
		
    }
	
	private function PerformJoin($query){
		// 2 table join
		if(count($this->join) == 2){
			$query_continue = $query->leftjoin($this->join[0],$this->join[1]);
			
		}else if(count($this->join) == 4){
		// 3 table join
			$query_continue = $query->leftjoin($this->join[0],$this->join[1])
			->leftjoin($this->join[2],$this->join[3]);
		}else if(count($this->join) == 6){
		// 4 table join
			$query_continue = $query->leftjoin($this->join[0],$this->join[1])
			->leftjoin($this->join[2],$this->join[3])
			->leftjoin($this->join[4],$this->join[5]);
		}
		return $query_continue;
	}
	
	
	private function Create_condition_of_custom_form($query_string,$operators=null){
	
	// query string contains something like  "emp.Name=blah & emp.Father=blah & emp.Address=blah"
	
	$query_string = str_replace('+',' ',$query_string);
	
	if(stripos($query_string,'&') !== false){
				$query_string1 = explode('&',$query_string);
				
				
				
				$last_value = end($query_string1);
				
				foreach($query_string1 as $string){
					$str = explode('=',$string);
					
					
						
					
						
						if($string == $last_value){
							
							if(!empty( $str[1] ) ){
								
								$str[1] = htmlspecialchars($str[1], ENT_QUOTES, 'UTF-8');
								$str[0] = htmlspecialchars($str[0], ENT_QUOTES, 'UTF-8');
								
								if(!empty($operators)){
									
									foreach($operators as $key => $value){
										if($key == $str[0]){
											if($value[0] == 'int'){
											$operator = $value[1];
											$condition .= ' '.$str[0] ."$value ". $str[1] . " ";	
											}else{
											$operator = $value[1];
											$condition .= ' '.$str[0] ."$value'". $str[1] . "' ";	
											}
											
										}
									}
									
								}else{
									$condition .= ' '.$str[0] ."='". $str[1] . "' ";
								}
								
								
									
							}else{
								$condition .= ' (1=1)';
							}
						
							}else{
							if(!empty( $str[1] ) ){
								$str[1] = htmlspecialchars($str[1], ENT_QUOTES, 'UTF-8');
								$str[0] = htmlspecialchars($str[0], ENT_QUOTES, 'UTF-8');
								if(!empty($operators)){
									
									foreach($operators as $key => $value){
										if($key == $str[0]){
											
											if($value[0] == 'int'){
											$operator = $value[1];
											$condition .= ' '.$str[0] ." $operator ". $str[1] ."  AND ";		
											}else if($value[0] = 'string'){
											$operator = $value[1];
											$condition .= ' '.$str[0] ."$operator '". $str[1] ."' AND ";		
											}
											
										}
									}
									
								}else{
									$condition .= ' '.$str[0] ."='". $str[1] ."' AND ";	
								}
								
							}
						
						
						}	
					
					
					
					
					
				}
				
			}else{
				
				
				$str = explode('=',$query_string);
					
					if(!empty( $str[1] ) ){
							$str[1] = htmlspecialchars($str[1], ENT_QUOTES, 'UTF-8');
							$str[0] = htmlspecialchars($str[0], ENT_QUOTES, 'UTF-8');
							$condition .= ' '.$str[0] ."='". $str[1] . "' ";	
						}
						
						
				
				
			}
	
	return $condition;
}
	
	private function GetPaging($per_page=10,$page=1,$url='?',$searched_word=null,$condition_sign=null){   
		
	/*** repeat query bcoz I'm feeling lazy right now ***/	
		$criteria = new CDbCriteria;
		$c2 =new CDbCriteria;
		
		if(!empty($this->default_condition)){
		$criteria->addCondition($this->default_condition);
		}
		$columns = implode(",",$this->columns);
		
		$table_name = $this->table_name;
		
		
		$query = Yii::app()->db->createCommand()
				->select('count(*) as `num`')
				->from($table_name);
		
		// performing join
		if(!empty($this->join)){
			$query = $this->PerformJoin($query);			
		}		
		// performing like OR Search
		if(!empty($this->searched_word) && $this->searched_word != 'empty'){
			
			foreach($this->searching_columns as $key => $value){
				$c2->compare($value,$this->searched_word,true,'OR');
			}
			$criteria->addCondition($c2->condition);
			$criteria->params+=$c2->params;	
		
			//http://www.yiiframework.com/wiki/610/how-to-create-a-criteria-condition-for-a-multiple-value-text-search-i-e-a-like-in/
		
		}else if (!empty($this->custom_form) ){
		
			// Performing Custom Form Search with AND	
			
			$form_condition = $this->Create_condition_of_custom_form( $this->custom_form );
			$criteria->addCondition($form_condition);

		}
		
		//print_r('aaa');return $criteria;		
		$results  = $query->where($criteria->condition, $criteria->params)
				
		//->group('AccountId,CharityId')
		//->limit($this->page_size , ($this->page-1));
		->queryAll();
	/*** end repeat query ****/	
	$url=Yii::app()->baseUrl.'/'.$url;
	
	
    $total = $results[0]['num'];
    $adjacents = "2"; 
      
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $lastlabel = "Last &rsaquo;&rsaquo;";
      
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
      
    $prev = $page - 1;                          
    $next = $page + 1;
      
    $lastpage = ceil($total/$per_page);
      
    $lpm1 = $lastpage - 1; // //last page minus 1
      
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= "<ul class='pagination customPagination_All'>";
        $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
              
            if ($page > 1) $pagination.= "<li><a data-page='{$prev}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>{$prevlabel}</a></li>";
              
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li><a  class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a data-page='{$counter}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>{$counter}</a></li>";                    
            }
          
        } elseif($lastpage > 5 + ($adjacents * 2)){
              
            if($page < 1 + ($adjacents * 2)) {
                  
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a data-page='{$counter}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>...</li>";
                $pagination.= "<li><a data-page='{$lpm1}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>{$lpm1}</a></li>";
                $pagination.= "<li><a data-page='{$lastpage}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>{$lastpage}</a></li>";  
                      
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                  
                $pagination.= "<li><a data-page='1' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>1</a></li>";
                $pagination.= "<li><a data-page='2' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a data-page='{$counter}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a data-page='{$counter}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a data-page='{$lpm1}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>{$lpm1}</a></li>";
                $pagination.= "<li><a data-page='{$lastpage}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>{$lastpage}</a></li>";      
                  
            } else {
                  
                $pagination.= "<li><a data-page='1' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>1</a></li>";
                $pagination.= "<li><a data-page='2' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a data-page='{$counter}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a data-page='{$counter}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>{$counter}</a></li>";                    
                }
            }
        }
          
            if ($page < $counter - 1) {
                $pagination.= "<li><a data-page='{$next}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}'>{$nextlabel}</a></li>";
                $pagination.= "<li><a data-page='{$lastpage}' data-searched='$searched_word' data-custom-form='$this->custom_form' data-t='$condition_sign' href='{$url}>{$lastlabel}</a></li>";
            }
          
        $pagination.= "</ul>";        
    }
      
    return $pagination;
		
	}
	
	
	


}
?>