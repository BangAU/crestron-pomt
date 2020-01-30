<?php 
include "header.php";
?>
<body>
<div id="wrapper">
<?php 
    include "navigation.php";
    include "sidebar.php"; 
?>
                

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <?php
                     $xirb_lead_id = $_REQUEST['xirb_lead_id'];
	$query_report = "select * from xirb_form_questions_answers where xirb_form_lead_id='".$xirb_lead_id."' order by question_id asc";
	$result_report = mysqli_query($conn,$query_report); 
	
	$score_array = array();
	$score_array_int = array();
	if($result_report->num_rows > 0) {
	      while($row_report = $result_report->fetch_assoc()) {
	      		$score_array[$row_report['question_id']] = $row_report['question_value'];
	      		$score_array_int[$row_report['question_id']] = round($row_report['question_value'],0,PHP_ROUND_HALF_DOWN);
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
	
	?>
	
	
	
    <div id="container-report" style="min-width: 300px; max-width: 600px; height: 400px; margin: 30px auto; background: #ffffff" class="move-down"></div>
    <a href="report.php" class='btn'>Go Back To Reports</a>
    <script type="text/javascript">
	$(function () {
		Highcharts.chart('container-report', {
		chart: {
            polar: true,
            type: 'line'
        },
		
		title: {
            text: 'User Score vs Industry Average',
            x: -80
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
		<h1>User has no report</h1>
		<a href="report.php" class='btn'>Go Back To Reports</a>
		<?php
	}
	?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php 
	include "js-include.php";
?>