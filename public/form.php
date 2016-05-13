<html>
<head>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.dataTables.min.css"/>

<script>
$(document).ready(function(){
	
	intTable();
    $("#btn_save_bill").click(function(){
    	formdata = $("#div_form_bill").find("select, textarea, input").serialize();

    	console.log(formdata);
         $.ajax({
            type: "POST",
            url: "/api/v1/bills", 
            data:formdata, 
            crossDomain: true,
            success: function(result) {
            	desTable()
                intTable();
            },

			error: function(result) {
                console.log(result);
			}
        });
    });

    

    function intTable()
    {
    	$('#example').DataTable( {
        "ajax": "http://shb.dev/api/v1/bills",
        "columns": [
            { "data": "id" },
            { "data": "bill_type" },
            { "data": "month" },
            { "data": "amount" },
            { "data": "date_pay" },
            { "data": "created_at" }
        ]
        } );
    }

    function desTable()
    {
		$('#example').dataTable().fnDestroy();
    }
});


</script>	
<style type="text/css">
TD {
    padding: 5px;
    vertical-align:top;
}
</style>
</head>
<div id="div_form_bill">
bill type: <select name="bill_type">
                <option value="api">Api</option>
                <option value="Air">Air</option>
                <option value="Maintainance">Maintainance</option>
                <option value="Telekom">Telekom</option>
           </select> <br>
month: <input type="text" name="month"> <br>
amount: <input type="text" name="amount"> <br>
date_pay: <input type="date" name="date_pay"> <br>
<button id="btn_save_bill">Save</button>
</div>
<table id="example"></table>
</html>