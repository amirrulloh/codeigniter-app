<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Complete</title>

    <!-- Bootstrap  CSS -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">


    <!-- JQuery -->
    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>

    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>

    <style>
        .ui-autocomplete {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            text-align: left;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
        }

        .ui-autocomplete > li > div {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333333;
            white-space: nowrap;
        }

        .ui-state-hover,
        .ui-state-active,
        .ui-state-focus {
            text-decoration: none;
            color: #262626;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .ui-helper-hidden-accessible {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }
    </style>

</head>
<body>
    <input type="hidden" id="base_path" value="<?php echo base_url(); ?>">
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="<?php echo base_url(); ?>assets/images/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
            Bootstrap
        </a>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 offset-md-3">
                <h1>Simple jQuery Autocomplete in CodeIgniter</h1>
                <form> 
                    <div class="form-group">
                        <label for="employee_id">Employee ID</label>
                        <input type="text" class="form-control" name="employee_id" id="employee_id" aria-describedby="employee_id" placeholder="Enter Employee ID">
                        <div class="spinner-grow spinner-grow-sm" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" class="form-control" name="department" id="department" placeholder="Department">
                    </div>
                    <button class="btn btn-success btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

    <script>
    $(document).ready(function(){
        var basePath = $("#base_path").val();
        $("#employee_id").autocomplete({
            source: function(request, cb){
                console.log(request);
                
                $.ajax({
                    url: basePath+'employees/'+request.term,
                    method: 'GET',
                    dataType: 'json',
                    success: function(res){
                        var result;
                        result = [
                            {
                                label: 'There is no matching record found for '+request.term,
                                value: ''
                            }
                        ];

                        console.log("Before format", res);
                        

                        if (res.length) {
                            result = $.map(res, function(obj){
                                return {
                                    label: obj.emp_no,
                                    value: obj.emp_no,
                                    data : obj
                                };
                            });
                        }

                        console.log("formatted response", result);
                        cb(result);
                    }
                });
            },
            select: function( event, selectedData ) {
                console.log(selectedData);

                if (selectedData && selectedData.item && selectedData.item.data){
                    var data = selectedData.item.data;
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#department').val(data.dept_name);
                }
                
            }  
        });  
    });
    </script>

    <script>
    $('#employee_id').keyup(function(e){
        if(e.keyCode == 46 || e.keyCode == 8) {
            $('#first_name').val('');
            $('#last_name').val('');
            $('#department').val('');
        }
    });
    </script>
</html>