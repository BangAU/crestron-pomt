<?php 
include "../../../config.php";
$query = "select * from xirb_form_leads where generate_images=1 and xirb_lead_id!=''";
$result = mysqli_query($conn,$query); 

if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$xirb_lead_id = $row['xirb_lead_id'];
	}
}
header('Content-Type: application/pdf');
header('Content-disposition: inline; filename="download.php"');
header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert Page Breaks Before and After HTML Elements Using CSS</title>
</head>
<body style="width: 1010px; font-family: 'Times New Roman'; font-size: 20px; margin: 5px">
    <div style="width: 100%; height: 500px; background-color: aliceblue; border: 2px solid gray; text-align: center">
        <div style="width: 100%; height: 200px"></div>
        A block <b>without any page break</b> style<br />
        <br />
        [ Follows a block with <i>page-break-before : always</i> and <i>page-break-after : always</i> styles ]
    </div>
    <div style="page-break-before: always; page-break-after: always; width: 100%; height: 500px; background-color: gainsboro; border: 2px solid gray; text-align: center">
        <div style="width: 100%; height: 200px"></div>
        A block with <b>page-break-before : always</b> and <b>page-break-after : always</b> styles<br />
        <br />
        <b>This block will be always rendered alone in a PDF page</b><br />
        <br />
        [ Follows a block with <i>page-break-after : always</i> style ]
    </div>
    <div style="page-break-after: always; width: 100%; height: 500px; background-color: beige; border: 2px solid gray; text-align: center">
        <div style="width: 100%; height: 200px"></div>
        A block with <b>page-break-after : always</b> style<br />
        <br />
        <b>Nothing will be rendered after this block in PDF page</b>
        <br />
        <br />
        [ Follows a block <i>without any page break</i> style ]
    </div>
    <div style="width: 100%; height: 500px; background-color: aliceblue; border: 2px solid gray; text-align: center">
        <div style="width: 100%; height: 200px"></div>
        A block <b>without any page break</b> style<br />
        <br />
        [ Follows a block with <i>page-break-before : always</i> style ]
    </div>
    <div style="page-break-before: always; width: 100%; height: 500px; background-color: lightgray; border: 2px solid gray; text-align: center">
        <div style="width: 100%; height: 200px"></div>
        A block with <b>page-break-before : always</b> style<br />
        <br />
        <b>This block will always be rendered at the top of a PDF page</b>
    </div>
</body>
</html>