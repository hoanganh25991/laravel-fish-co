<!DOCTYPE html>
<html>
<head>
    <title>listen event</title>
    <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/bootstrap-3.3.6.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/style.css")}}">

    <script type="text/javascript" src="{{asset("js/jquery-2.2.3.min.js")}}"></script>
    <script src="{{asset("js/bootstrap-3.3.6.min.js")}}"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12 col-xs-offset-0">
            <div class="row">
                <div class="col-md-12 col-xs-12" id="welcome">
                    <div class="text-center">
                        <h1>Fish & Co</h1>
                        <p>Sea food in Japan</p>
                        <h3>Whale-come to Global Fish & Co.!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate</p>
                        <button class="btn btn-default btn-lg" id="btnGlobalFishCo">GlobalFISHCO</button>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12" id="play">
                    {{--form input, to submit--}}
                    <form class="form-group" method="POST" action="" id="submissionForm" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="file" name="submission_image" class="form-control" required>
                        <label for="name">name</label>
                        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                            <input type="text" name="caption" class="form-control" id="name">
                        </div>
                        <label for="email">email</label>
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <label for="contact_number">contact number</label>
                        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                </span>
                            <input type="text" name="contact_number" class="form-control" id="contact_number" required>
                        </div>
                        {{--for demo, hard code on options--}}
                        <label for="country_id">country</label>
                        <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-flag" aria-hidden="true"></i>
                </span>
                            <select name="country_id" class="form-control" id="country_id">
                                <option value="1">Singapore</option>
                                <option value="2">Brunei</option>
                                <option value="3">Malaysia</option>
                                <option value="4">Vietnam</option>
                                <option value="5">India</option>
                            </select>
                        </div>
                        <div>
                            <div class="checkbox">
                                <label for="mailing_list">
                                    <input type="checkbox" name="mailing_list" value="true" id="mailing_list">
                                    Sign me up for mailing list
                                </label>
                            </div>
                            <div class="checkbox">
                                <label for="term_condition">
                                    <input type="checkbox" name="term_condition" id="term_condition">
                                    I've read the <a href="https://google.com.vn">terms & conditions</a>
                                </label>
                            </div>
                        </div>
                        <input type="submit" id="btnSubmit" value="Submit Now!" class="btn btn-default btn-block">
                    </form>
                </div>

            </div>
            <div class="row" id="footer">
                <div class="col-md-3 col-xs-3">
                    <div class="btn btn-default btn-block" id="btnAbout">
                        <div class="text-center">
                            <i class="fa fa-info-circle fa-3x" aria-hidden="true"></i>
                            <p>About</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-3">
                    <div class="btn btn-default btn-block" id="btnCampaign">
                        <div class="text-center">
                            <i class="fa fa-calendar fa-3x" aria-hidden="true"></i>
                            <p>Campaign</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-3">
                    <div class="btn btn-default btn-block" id="btnPlay">
                        <div class="text-center">
                            <i class="fa fa-play fa-3x" aria-hidden="true"></i>
                            <p>Play</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-3">
                    <div class="btn btn-default btn-block" id="btnSubmissions">
                        <div class="text-center">
                            <i class="fa fa-th fa-3x" aria-hidden="true"></i>
                            <p>Submissions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h1>test area</h1>
    <div class="row">
        <button class="btn btn-default" id="btnStoreVietnam">store in Vietnam</button>
    </div>
    <div id="">

    </div>
</div>
<script type="application/javascript" src="{{asset("js/main.js")}}"></script>
<script type="application/javascript">
    (function($){
        var logRes = function(res, statusText, xhr){
//            var status = xhr.status;
//            console.log(status);
            console.log(res);
            /** it is json, no need to parse*/
//            console.log(JSON.parse(res))
        };
        /**
         * verify device.serial_number
         */
        $.post("token", function(token){
            var data = {
                "serial_number": "F9:32:28:15:88:13",
                "_token": token
            };
            $.ajax({
                url: "candidate/verify",
                method: "post",
                data: data,
                statusCode: {
                    200: logRes
                }
            });
        });
        var file;
        $("input[name='submission_image']").on("change", function(e){
            console.log(e);
            file = e.target.files[0];
        });

        $("#submissionForm").on("submit", function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);
//                formData.append("submission_image", file);
            formData.append("serial_number", "F9:32:28:15:88:13");
            var oReq = new XMLHttpRequest();
            oReq.open("POST", "submission/create");
            oReq.send(formData);
            oReq.onload = function(){
                console.log(oReq.status);
                console.log(oReq.response);
            };
        });

        $("#btnGlobalFishCo").on("click", function(){
            var url = "store/index";
            $.get(url, logRes);
        });

        $("#btnStoreVietnam").on("click", function(){
            var url = "store/4";
            $.get(url, logRes);
        });

        $("#btnCampaign").on("click", function(){
            var url = "campaign/index";
            $.get(url, logRes);
        });

        $("#btnSubmissions").on("click", function(){
            var ajaxCall = function(_token){
                var data = {
                    "serial_number": "39:FE:A1:56:7E:E6",
                    "_token": _token
                };
                console.log(data);
                $.ajax({
                    url: "submission/index",
                    method: "POST",
                    data: data,
                    statusCode: {
                        200: logRes
                    },
//                    error: function(xyz){
//                        console.log(xyz);
//                    }
                });
            };

            $.ajax({
                url: "token",
                method: "POST",
                statusCode: {
                    200: ajaxCall
                }
            });
        });
    })(jQuery);
</script>
</body>
</html>