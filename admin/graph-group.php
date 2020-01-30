<?php 
include "../config.php";
$row_ids = $_POST['row_ids'];
$row_ids_count = count($row_ids);
	
	/*check if user has completed the test and then create a new array -- starts here*/
	$j=0;
    $rows_ids_score = array();
    
    if($row_ids_count > 1) {
    
    for($i=0; $i<$row_ids_count; $i++) {
	    $query_ids = "select distinct xirb_form_lead_id from xirb_form_questions_answers where xirb_form_lead_id='".strip_tags($row_ids[$i])."'";
		$result_ids = mysqli_query($conn,$query_ids); 
		if($result_ids->num_rows > 0) {
			while($rows_ids = $result_ids->fetch_assoc()) {
				$rows_ids_score[$j] = $rows_ids['xirb_form_lead_id'];
				$j++;
			}
		}
    }
    /*check if user has completed the test and then create a new array -- ends here*/
    
    $row_ids_score_count = count($rows_ids_score);
    $group_multi_scores[] = array();
    
    
    for($i_main=0; $i_main<$row_ids_score_count; $i_main++) {
		
		$query_report = "select * from xirb_form_questions_answers where xirb_form_lead_id='".$rows_ids_score[$i_main]."' order by question_id asc";
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
		
		$group_multi_scores[$i_main] = $final_score_array_calculated;
	}
	}
	
	
	$group_scores = array();
	
	for ($i = 0; $i < count($group_multi_scores); $i++){  
		for ($j = 1; $j <= count($group_multi_scores[$i]); $j++){                
	       	$group_scores[$j] += $group_multi_scores[$i][$j];
	    }
    }  
	
	for($i=1; $i<=count($group_scores); $i++) {
		$group_scores[$i] = round($group_scores[$i] / $row_ids_score_count,0,PHP_ROUND_HALF_UP);
	}
	
	
	
	//group score json	
	$final_score_array_calculated_data_series = "[".implode(",",$group_scores)."]";
	
	
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
	
	?>
	
	<div id="container-report" class="move-down"></div>
	
	<script type="text/javascript">
	$(function () {
		Highcharts.chart('container-report', {
		chart: {
            polar: true,
            type: 'line'
        },

        title: {
            text: 'Group Score vs Industry Average',
            x: -50
        },

        pane: {
            size: '80%'
        },

        xAxis: {
            categories: <?php print $final_categories_data_series; ?>,
            tickmarkPlacement: 'on',
            lineWidth: 0
        },

        yAxis: {
            gridLineInterpolation: 'polygon',
            lineWidth: 0,
            min: 0,
            /*plotBands: [{
            	color: 'orange',
	            from: 0, 
	            to: 25 
            },{
            	color: 'black',
	            from: 25, 
				to: 50 
            }]*/
        },

        tooltip: {
            shared: true,
            pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
        },

        legend: {
            align: 'right',
            verticalAlign: 'top',
            y: 70,
            layout: 'vertical'
        },

        series: [{
            name: 'User Score',
            data: <?php print $final_score_array_calculated_data_series; ?>,
            pointPlacement: 'on'
        }, {
            name: 'Industry Average',
            data: <?php print $final_categroies_score_data_series; ?>,
            pointPlacement: 'on'
        }]

	});
	});
	</script>
	<style>
		.highcharts-credits {
			display: none;
		}
	</style>
	<?php
	} 
	else {
		?>
		<div style="text-align:center; margin:30px;">
		<h1>User has no report</h1>
		<a href="report.php" class='btn'>Go Back To Reports</a>
		</div>
		<?php
	}
	?>