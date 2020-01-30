<?php
include "../../../config.php";
$query = "select * from xirb_form_leads where generate_images=0 and xirb_lead_id!=''";
$result = mysqli_query($conn,$query); 
	
	if($result->num_rows > 0) {
		      while($row = $result->fetch_assoc()) {
		      		$file_name = $row['xirb_lead_id'];	
		      		$xirb_lead_id = $row['xirb_lead_id'];
		      		if (!file_exists($file_name) && !is_dir($file_name)) {
		      		mkdir("./".$file_name."",  0777, true);
		      		}
			  
		      

/*to get scores and get the question sections*/
$query_report = "select * from xirb_form_questions_answers where xirb_form_lead_id='".$xirb_lead_id."' order by question_id asc";
	
	$result_report = mysqli_query($conn,$query_report); 
	
	$score_array = array();
	$score_array_int = array();
	if($result_report->num_rows > 0) {
	      while($row_report = $result_report->fetch_assoc()) {
	      		$score_array[$row_report['question_id']] = $row_report['question_value'];
	      		$score_array_int[$row_report['question_id']] = round($row_report['question_value'],0,PHP_ROUND_HALF_DOWN);;
		  }
	
	$final_score_array = array();     
		foreach ($score_array_int as $key => $item)
		{
		$query_get_score = "select * from answers where question_id=".$key." and answer_sort_order=".$item."";     
		$result_get_score = mysqli_query($conn,$query_get_score);
			if($result_get_score->num_rows > 0) {
				while($row_get_score = $result_get_score->fetch_assoc()) {
					$final_score_array[$key] = $row_get_score['answer_score'];
				}
			}
		}     
		
		$final_score_array_calculated = array();	
		$j=1;
	
		for ($i=1; $i<count($final_score_array); $i=$i+2) {
			$final_score_array_calculated[$j] = round(($final_score_array[$i]+$final_score_array[$i+1])/2, 0, PHP_ROUND_HALF_UP);
			$j++;
		}
	
	//user score json	
	$final_score_array_calculated_data_series = "[".implode(",",$final_score_array_calculated)."]";
	
	
	$categories_array = array();
	$categroies_score_array = array();
	
	$query_industry_value = "select * from questions_section where questions_section_id!='' order by questions_section_id asc";
	$result_industry_value = mysqli_query($conn, $query_industry_value);
	$i=0;
	if($result_industry_value->num_rows > 0) {
	      while($row_industry_value = $result_industry_value->fetch_assoc()) {
	      	$categories_array[$i] = "'".$row_industry_value['questions_section_header']."'";
	      	$categroies_score_array[$i] = $row_industry_value['questions_section_value'];
	      	$i++;
	      }
	}  
	$final_categories_data_series = "[".implode(",",$categories_array)."]";
	$final_categroies_score_data_series = "[".implode(",",$categroies_score_array)."]";
	
	
/*to generate the json file for user score*/
$options_text = "{chart: {polar: true,type: 'line'}, credits:{enabled: false}, title: { text: 'User Score vs Industry Average',x: -80},pane: {size: '80%'},xAxis: {categories: ".$final_categories_data_series.",tickmarkPlacement: 'on',lineWidth: 0},yAxis: {gridLineInterpolation: 'polygon',lineWidth: 0,min: 0,plotBands: [{color: '#bad9ed',from: 0,to: 10 }, {color: '#d2dff8',from: 10,to: 20 }, {color: '#eee9fb',from: 20,to: 30 }]},legend: {align: 'right',verticalAlign: 'top',y: 70,layout: 'vertical'},series: [{name: 'User Score',data: ".$final_score_array_calculated_data_series.",pointPlacement: 'on'}]}";
	
$fp = fopen("./".$file_name."/".$file_name."-user-score.json","w+");
fwrite($fp,$options_text);
fclose($fp);

/*to generate the image - user score*/
exec("phantomjs highcharts-convert.js -infile ./".$file_name."/".$file_name."-user-score.json -outfile ./".$file_name."/".$file_name."-user-score.png -scale 2.5 -width 800");


/*to generate the json file for user score v/s industry average*/	
$options_text = "{chart: {polar: true,type: 'line'}, credits:{enabled: false}, title: { text: 'User Score vs Industry Average',x: -80},pane: {size: '80%'},xAxis: {categories: ".$final_categories_data_series.",tickmarkPlacement: 'on',lineWidth: 0},yAxis: {gridLineInterpolation: 'polygon',lineWidth: 0,min: 0,plotBands: [{color: 'orange',from: 0,to: 25 },{color: 'black',from: 25,to: 50}]},legend: {align: 'right',verticalAlign: 'top',y: 70,layout: 'vertical'},series: [{name: 'User Score',data: ".$final_score_array_calculated_data_series.",pointPlacement: 'on'}, {name: 'Industry Average',data: ".$final_categroies_score_data_series.",pointPlacement: 'on'}]}";

$fp = fopen("./".$file_name."/".$file_name."-user-industry-score.json","w+");
fwrite($fp,$options_text);
fclose($fp);

/*to generate the image - user score v/s industry average*/
exec("phantomjs highcharts-convert.js -infile ./".$file_name."/".$file_name."-user-industry-score.json -outfile ./".$file_name."/".$file_name."-user-industry-score.png -scale 2.5 -width 800");
}
$query_update = "update xirb_form_leads set generate_images=1 where xirb_lead_id='".$xirb_lead_id."'";
mysqli_query($conn,$query_update);
}
}
?>