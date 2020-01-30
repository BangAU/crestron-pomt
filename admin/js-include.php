<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="vendor/metisMenu/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>
<script type="text/javascript" language="javascript" src="utilities/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="utilities/dataTables.select.min.js"></script>
<script type="text/javascript" language="javascript" src="utilities/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="utilities/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="utilities/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="utilities/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="utilities/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="utilities/jquery.colorbox-min.js"></script>
<script src="utilities/jquery.validate.min.js"></script>
<!-- <script src="https://code.highcharts.com/highcharts.js"></script> 
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script> -->
<script type="text/javascript" class="init">
        $(document).ready(function () {
			
			//Validate form
			$("#loginform").validate({
				
			});
        	/*var table = $('#report-data').DataTable({
                iDisplayLength: 50,
                dom: 'lBfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    
                    {
						text: 'Select all',
						action: function () {
							table.rows().select();
							}
					},
					{
		                text: 'Select none',
		                action: function () {
		                    table.rows().deselect();
		                }
					},
                    
                    {
                    	text: 'Show Graph - Selected Data',
						action: function ( e, dt, type, indexes ) {
							
							var rowData = table.rows( { selected: true }).data().toArray();
							var rowData_length = rowData.length;
							
							/*if rows are selected*/
							//if(rowData_length > 1) {
								
							//}
							//else {
							/*if rows are not selected, go by the search filter input*/
							//rowData = table.rows( 'tr', {"filter":"applied"}).data().toArray();
							/*rowData_length = rowData.length;
							}
							
							var row_ids = new Array();
							
							for(i=0; i<rowData_length; i++) {
								row_ids[i] = rowData[i][0];
							}
							
							console.log(row_ids);
							
							$.ajax({
								type: "POST",
								url: "graph-group.php", 
								data: { row_ids : row_ids },
								success: function (result) {
									console.log(result);
									$.colorbox({html: result, width:"80%", height:"80%"});
								}
							});	

							
						}
					
					}
                ],
                
                select: {
					style: 'multi'
				},
				columnDefs: [{
                    "targets": [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26],
                    "visible": false
                }],
                order: [[26, "desc"]]
            });*/

			$('#report-data').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                /*columnDefs: [{
                    "targets": [7],
                    "visible": false
                }],
                order: [[7, "desc"]]*/
            });
            
            $('#report-data-contact').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                columnDefs: [{
                    "targets": [7],
                    "visible": false
                }],
                order: [[7, "desc"]]
            });
            
        });
</script>
</body>
</html>