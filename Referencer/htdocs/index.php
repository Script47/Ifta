<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Script47"/>
        <meta name="description" content="Easy Referencer for scholars."/>
        <meta name="keywords" content="referencer, easy, quick"/>
        <meta name="copyright" content="Script47"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

        <style>
        #header {
            text-align: center;
            font-weight: bold;
            background-color: palegoldenrod;
            box-shadow: 0px 5px 5px 0px rgba(0,0,0,1);            
            -webkit-box-shadow: 0px 5px 5px 0px rgba(0,0,0,1);
            -moz-box-shadow: 0px 5px 5px 0px rgba(0,0,0,1);            
        }

        #ajax_indicator {
            display: none;
            position: absolute;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            z-index: 9999;
        }
        </style>

        <title>Referencer</title>
    </head>

    <body>
        <?php require_once 'prepend.php'; ?>

        <div id="header" class="jumbotron">
            <h1>Referencer</h1>
        </div>

        <div class="jumbotron">
            <div class="form-group">
                <div id="text" class="form-control" contenteditable="true"></div>
            </div>

            <div class="form-group">
                <div id="output" class="form-control"></div>
            </div>
        
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button id="get_references" class="btn btn-primary btn-block">Get References</button>
                </div>
            </div>
        </div>

        <div id="ajax_indicator" class="fa fa-spinner fa-pulse fa-3x fa-fw"></div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script>
        $(document).ready(function () {
            $(document).on('click', '#get_references', function () {
                if ($.trim($('#text').text()) !== '') {
                    $.ajax({
                        type: 'POST',
                        url: 'referencer.php',
                        data: {
                            token: '$2y$10$GsDOiVzQFH5eGhzYooRlS.dEiS89R.Tzwfz3TSVrUO9JeN0xdeQQG',
                            text: $.trim($('#text').text())                        
                        },

                        beforeSend: function () {
                            $('#ajax_indicator').fadeIn();
                        },

                        complete: function () {
                            $('#ajax_indicator').fadeOut();
                        },

                        success: function (response) {
                            response = JSON.parse(response);
                            
                            if (response.hasOwnProperty('error')) {
                                return false;
                            }

                            $('#output').html(response.success);

                            $('[data-toggle="tooltip"]').tooltip({
                                html: true
                            });                        
                        }
                    });                    
                }
            });
        });
        </script>

    </body>

</html>