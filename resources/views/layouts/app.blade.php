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
                @yield("content")
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
</div>
<script type="application/javascript" src="{{asset("js/main.js")}}"></script>
<script type="application/javascript">
    (function($){
        var logRes = function(res){
            console.log(res);
            console.log(JSON.parse(res));
        };
        $("#btnGlobalFishCo").on("click", function(){
            var url = "store/index";
            $.get(url, logRes);
        });

        $("#btnStoreVietnam").on("click", function(){
            var url = "store/4";
            $.get(url, logRes);
        });
    })(jQuery);
</script>
</body>
</html>