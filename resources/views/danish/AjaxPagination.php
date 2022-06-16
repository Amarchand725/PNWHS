
<?php 
class AjaxPagination extends CApplicationComponent{
	
	public $tbody;
	public $pagination_div;
	public $url;
	public $class_for_search_btn;
	
	

	public function GetAjaxScript(){
		
		$data['tbody'] = $this->tbody;
		$data['pagination_div'] = $this->pagination_div;
		$data['url'] = $this->url;
		
		$pagination_class = str_replace(' ','.',trim($this->pagination_div));
		
		$data['pagination_class'] = $pagination_class;
		$data['class_for_search_btn'] = $this->class_for_search_btn;

		
		Yii::app()->controller->renderPartial('application.components.danish.script',array('data'=>$data),false);
	}

}